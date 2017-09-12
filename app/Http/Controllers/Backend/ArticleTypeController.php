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
use App\ArticleType;
use App\Http\Requests\ArticleTypeRequest;

class ArticleTypeController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return view('backend.articletypes.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$this->authorize('create', ArticleType::class);
		return redirect()->route('articletypes.index');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(ArticleTypeRequest $request)
	{
		$this->authorize('create', ArticleType::class);

		// find language generate key
		$languageDefault = Language::where('is_key_language', 1)->first();
		if (is_null($languageDefault)) {
			$languageDefault = Language::first();
		}

		$articleType = new ArticleType;

		// sure execute success, if not success rollback
		DB::transaction(function () use ($request, $languageDefault, $articleType) {
			$user = Auth::user();

			// insert ArticleType
			$articleType->key = Common::createKeyURL($request->input('ArticleType.ArticleTypeTranslation.'.$languageDefault->code.'.name'));
			$articleType->parent_id = $request->input('ArticleType.parent_id', 0);
			$articleType->priority = $request->input('ArticleType.priority', 0);
			$articleType->published = $request->input('ArticleType.published', 0);
			$articleType->created_by = $user->id;
			$articleType->save();

			// save attachments
			if ($request->input('ArticleType.attachments') != "") {
				$requestAttachments = explode(',', $request->input('ArticleType.attachments'));
				$attachments = [];
				foreach ($requestAttachments as $key => $value) {
					array_push($attachments, new Attachment([
						'path' => $value,
						'priority' => $key,
						'published' => 1
						]));
				}
				if (count($attachments) > 0) {
					$articleType->attachments()->saveMany($attachments);
				}
			}

			// save data languages
			foreach ($request->input('ArticleType.ArticleTypeTranslation') as $locale => $value) {
				$articleType->translateOrNew($locale)->name = $request->input('ArticleType.ArticleTypeTranslation.' .$locale. '.name');
				$articleType->translateOrNew($locale)->summary = $request->input('ArticleType.ArticleTypeTranslation.' .$locale. '.summary');
				$articleType->translateOrNew($locale)->meta_description = $request->input('ArticleType.ArticleTypeTranslation.' .$locale. '.meta_description');
				$articleType->translateOrNew($locale)->meta_keywords = $request->input('ArticleType.ArticleTypeTranslation.' .$locale. '.meta_keywords');
			}

			$articleType->save();

		});

		$articleType->load('attachments');

		if ($request->ajax()) {
			return response()->json($articleType->toArray());
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
		$articleType = ArticleType::findOrFail($id);
		$this->authorize('view', $articleType);
		$articleType->load('translations', 'attachments', 'userCreated', 'userUpdated');
		return response()->json($articleType->toArray());
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$articleType = ArticleType::findOrFail($id);
		$this->authorize('update', $articleType);
		return redirect()->route('articletypes.index');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(ArticleTypeRequest $request, $id)
	{
		$articleType = ArticleType::findOrFail($id);
		$this->authorize('update', $articleType);

		// find language default
		$languageDefault = Language::where('is_key_language', 1)->first();
		if (is_null($languageDefault)) {
			$languageDefault = Language::first();
		}

		// sure execute success, if not success rollback
		DB::transaction(function () use ($request, $articleType, $languageDefault) {
			$user = Auth::user();

			if (!$articleType->not_delete) {
				$articleType->key = Common::createKeyURL($request->input('ArticleType.ArticleTypeTranslation.'.$languageDefault->code.'.name'));
			}
			$articleType->parent_id = $request->input('ArticleType.parent_id', 0);
			$articleType->priority = $request->input('ArticleType.priority', 0);
			$articleType->published = $request->input('ArticleType.published', 0);
			$articleType->updated_by = $user->id;
			$articleType->save();

			// save attachments
			if ($request->input('ArticleType.attachments') != "") {
				$paths = preg_replace('/\d+\|/', '', $request->input('ArticleType.attachments'));
				$paths = explode(',', $paths);

				$insertAttachments = [];
				foreach ($paths as $key => $path) {
					// find by path
					$attachment = $articleType->attachments()->where('path', $path)->first();
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
					$articleType->attachments()->saveMany($insertAttachments);
				}
				$articleType->attachments()->whereNotIn('path', $paths)->delete();
			}

			// save data languages
			foreach ($request->input('ArticleType.ArticleTypeTranslation') as $locale => $value) {
				$articleType->translateOrNew($locale)->name = $request->input('ArticleType.ArticleTypeTranslation.' .$locale. '.name');
				$articleType->translateOrNew($locale)->summary = $request->input('ArticleType.ArticleTypeTranslation.' .$locale. '.summary');
				$articleType->translateOrNew($locale)->meta_description = $request->input('ArticleType.ArticleTypeTranslation.' .$locale. '.meta_description');
				$articleType->translateOrNew($locale)->meta_keywords = $request->input('ArticleType.ArticleTypeTranslation.' .$locale. '.meta_keywords');
			}

			$articleType->save();

		});

		$articleType->load('attachments');

		if ($request->ajax()) {
			return response()->json($articleType->toArray());
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
		$articleType = ArticleType::findOrFail($id);
		$this->authorize('destroy', $articleType);

		DB::transaction(function () use ($articleType) {
			$user = Auth::user();
			$articleType->deleted_by = $user->id;
			$articleType->key = $articleType->key.'-'.microtime(true);
			$articleType->save();

			// soft delete
			$articleType->delete();
		});
	}

	public function filter(ArticleTypeRequest $request)
	{
		if ($request->ajax()) {
			$type = $request->input('type', '');
			if ($type == 'dropdown') {
				$multiple = $request->input('multiple', 'false');
				$ids = $request->input('ids', '');
				$search = $request->input('search', '');

				if ($multiple == 'false') {
					$articleTypes = ArticleType::all();
					return response()->json($articleTypes->toArray());
				}

				if ($ids != '') {
					$articleTypes = ArticleType::whereIn('id', $ids)->get();
				}
				if ($search != '') {
					$articleTypes = ArticleType::whereTranslationLike('name', '%'. $search .'%')->get();
				}
				
				return response()->json($articleTypes->toArray());
			}

			$articleTypes = ArticleType::with('attachments')->orderBy('priority')->get();
			return response()->json($articleTypes->toArray());
		}
	}
}
