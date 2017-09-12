<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use App\Common;
use App\Language;
use App\Attachment;
use App\ArticleCategory;
use App\Http\Requests\ArticleCategoryRequest;

class ArticleCategoryController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return view('backend.articlecategories.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$this->authorize('create', ArticleCategory::class);
		return redirect()->route('articlecategories.index');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(ArticleCategoryRequest $request)
	{
		$this->authorize('create', ArticleCategory::class);

		// find language generate key
		$languageDefault = Language::where('is_key_language', 1)->first();
		if (is_null($languageDefault)) {
			$languageDefault = Language::first();
		}

		$articleCategory = new ArticleCategory;

		// sure execute success, if not success rollback
		DB::transaction(function () use ($request, $languageDefault, $articleCategory) {
			$user = Auth::user();

			// insert ArticleCategory
			$articleCategory->key = Common::createKeyURL($request->input('ArticleCategory.ArticleCategoryTranslation.'.$languageDefault->code.'.name'));
			$articleCategory->parent_id = $request->input('ArticleCategory.parent_id', 0);
			$articleCategory->priority = $request->input('ArticleCategory.priority', 0);
			$articleCategory->published = $request->input('ArticleCategory.published', 0);
			$articleCategory->created_by = $user->id;
			$articleCategory->save();

			// save attachments
			if ($request->input('ArticleCategory.attachments') != "") {
				$requestAttachments = explode(',', $request->input('ArticleCategory.attachments'));
				$attachments = [];
				foreach ($requestAttachments as $key => $value) {
					array_push($attachments, new Attachment([
						'path' => $value,
						'priority' => $key,
						'published' => 1
						]));
				}
				if (count($attachments) > 0) {
					$articleCategory->attachments()->saveMany($attachments);
				}
			}

			// save data languages
			foreach ($request->input('ArticleCategory.ArticleCategoryTranslation') as $locale => $value) {
				$articleCategory->translateOrNew($locale)->name = $request->input('ArticleCategory.ArticleCategoryTranslation.' .$locale. '.name');
				$articleCategory->translateOrNew($locale)->summary = $request->input('ArticleCategory.ArticleCategoryTranslation.' .$locale. '.summary');
				$articleCategory->translateOrNew($locale)->meta_description = $request->input('ArticleCategory.ArticleCategoryTranslation.' .$locale. '.meta_description');
				$articleCategory->translateOrNew($locale)->meta_keywords = $request->input('ArticleCategory.ArticleCategoryTranslation.' .$locale. '.meta_keywords');
			}

			$articleCategory->save();

		});

		$articleCategory->load('attachments');

		if ($request->ajax()) {
			return response()->json($articleCategory->toArray());
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$articleCategory = ArticleCategory::findOrFail($id);

		$this->authorize('view', $articleCategory);
		$articleCategory->load('translations', 'attachments', 'userCreated', 'userUpdated');
		return response()->json($articleCategory->toArray());
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$articleCategory = ArticleCategory::findOrFail($id);
		$this->authorize('update', $articleCategory);
		return redirect()->route('articlecategories.index');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(ArticleCategoryRequest $request, $id)
	{
		$articleCategory = ArticleCategory::findOrFail($id);

		$this->authorize('update', $articleCategory);

		// find language default
		$languageDefault = Language::where('is_key_language', 1)->first();
		if (is_null($languageDefault)) {
			$languageDefault = Language::first();
		}

		// sure execute success, if not success rollback
		DB::transaction(function () use ($request, $articleCategory, $languageDefault) {
			$user = Auth::user();

			if (!$articleCategory->not_delete) {
				$articleCategory->key = Common::createKeyURL($request->input('ArticleCategory.ArticleCategoryTranslation.'.$languageDefault->code.'.name'));
			}
			$articleCategory->parent_id = $request->input('ArticleCategory.parent_id', 0);
			$articleCategory->priority = $request->input('ArticleCategory.priority', 0);
			$articleCategory->published = $request->input('ArticleCategory.published', 0);
			$articleCategory->updated_by = $user->id;
			$articleCategory->save();

			// save attachments
			if ($request->input('ArticleCategory.attachments') != "") {
				$paths = preg_replace('/\d+\|/', '', $request->input('ArticleCategory.attachments'));
				$paths = explode(',', $paths);

				$insertAttachments = [];
				foreach ($paths as $key => $path) {
					// find by path
					$attachment = $articleCategory->attachments()->where('path', $path)->first();
					if ($attachment) {
						$attachment->priority = $key;
						$attachment->save();
					}
					else{
						array_push($insertAttachments, new Attachment([
							'path' => $path,
							'priority' => $key,
							'published' => 1
						]));
					}
				}
				if (count($insertAttachments) > 0) {
					$articleCategory->attachments()->saveMany($insertAttachments);
				}
				$articleCategory->attachments()->whereNotIn('path', $paths)->delete();
			}

			// save data languages
			foreach ($request->input('ArticleCategory.ArticleCategoryTranslation') as $locale => $value) {
				$articleCategory->translateOrNew($locale)->name = $request->input('ArticleCategory.ArticleCategoryTranslation.' .$locale. '.name');
				$articleCategory->translateOrNew($locale)->summary = $request->input('ArticleCategory.ArticleCategoryTranslation.' .$locale. '.summary');
				$articleCategory->translateOrNew($locale)->meta_description = $request->input('ArticleCategory.ArticleCategoryTranslation.' .$locale. '.meta_description');
				$articleCategory->translateOrNew($locale)->meta_keywords = $request->input('ArticleCategory.ArticleCategoryTranslation.' .$locale. '.meta_keywords');
			}

			$articleCategory->save();

		});

		$articleCategory->load('attachments');

		if ($request->ajax()) {
			return response()->json($articleCategory->toArray());
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$articleCategory = ArticleCategory::findOrFail($id);
		$this->authorize('destroy', $articleCategory);

		DB::transaction(function () use ($articleCategory) {
			$user = Auth::user();
			$articleCategory->deleted_by = $user->id;
			$articleCategory->key = $articleCategory->key.'-'.microtime(true);
			$articleCategory->save();

			// soft delete
			$articleCategory->delete();
		});
	}

	public function filter(ArticleCategoryRequest $request)
	{
		if ($request->ajax()) {
			$type = $request->input('type', '');
			if ($type == 'dropdown') {
				$multiple = $request->input('multiple', 'false');
				$ids = $request->input('ids', '');
				$search = $request->input('search', '');

				if ($multiple == 'false') {
					$articleCategories = ArticleCategory::all();
					return response()->json($articleCategories->toArray());
				}

				if ($ids != '') {
					$articleCategories = ArticleCategory::whereIn('id', $ids)->get();
				}
				if ($search != '') {
					$articleCategories = ArticleCategory::whereTranslationLike('name', '%'. $search .'%')->get();
				}
				
				return response()->json($articleCategories->toArray());
			}

			$articleCategories = ArticleCategory::with('attachments')->orderBy('priority')->get();
			return response()->json($articleCategories->toArray());
		}
	}
}
