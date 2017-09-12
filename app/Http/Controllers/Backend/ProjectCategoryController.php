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
use App\ProjectCategory;
use App\Http\Requests\ProjectCategoryRequest;

class ProjectCategoryController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return view('backend.projectcategories.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$this->authorize('create', ProjectCategory::class);
		return redirect()->route('projectcategories.index');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(ProjectCategoryRequest $request)
	{
		$this->authorize('create', ProjectCategory::class);

		// find language generate key
		$languageDefault = Language::where('is_key_language', 1)->first();
		if (is_null($languageDefault)) {
			$languageDefault = Language::first();
		}

		$projectCategory = new ProjectCategory;

		// sure execute success, if not success rollback
		DB::transaction(function () use ($request, $languageDefault, $projectCategory) {
			$user = Auth::user();

			// insert ProjectCategory
			$projectCategory->key = Common::createKeyURL($request->input('ProjectCategory.ProjectCategoryTranslation.'.$languageDefault->code.'.name'));
			$projectCategory->parent_id = $request->input('ProjectCategory.parent_id', 0);
			$projectCategory->priority = $request->input('ProjectCategory.priority', 0);
			$projectCategory->published = $request->input('ProjectCategory.published', 0);
			$projectCategory->created_by = $user->id;
			$projectCategory->save();

			// save attachments
			if ($request->input('ProjectCategory.attachments') != "") {
				$requestAttachments = explode(',', $request->input('ProjectCategory.attachments'));
				$attachments = [];
				foreach ($requestAttachments as $key => $value) {
					array_push($attachments, new Attachment([
						'path' => $value,
						'priority' => $key,
						'published' => 1
						]));
				}
				if (count($attachments) > 0) {
					$projectCategory->attachments()->saveMany($attachments);
				}
			}

			// save data languages
			foreach ($request->input('ProjectCategory.ProjectCategoryTranslation') as $locale => $value) {
				$projectCategory->translateOrNew($locale)->name = $request->input('ProjectCategory.ProjectCategoryTranslation.' .$locale. '.name');
				$projectCategory->translateOrNew($locale)->summary = $request->input('ProjectCategory.ProjectCategoryTranslation.' .$locale. '.summary');
				$projectCategory->translateOrNew($locale)->meta_description = $request->input('ProjectCategory.ProjectCategoryTranslation.' .$locale. '.meta_description');
				$projectCategory->translateOrNew($locale)->meta_keywords = $request->input('ProjectCategory.ProjectCategoryTranslation.' .$locale. '.meta_keywords');
			}

			$projectCategory->save();

		});

		$projectCategory->load('attachments');

		if ($request->ajax()) {
			return response()->json($projectCategory->toArray());
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
		$projectCategory = ProjectCategory::findOrFail($id);

		$this->authorize('view', $projectCategory);
		$projectCategory->load('translations', 'attachments', 'userCreated', 'userUpdated');
		return response()->json($projectCategory->toArray());
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$projectCategory = ProjectCategory::findOrFail($id);
		$this->authorize('update', $projectCategory);
		return redirect()->route('projectcategories.index');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(ProjectCategoryRequest $request, $id)
	{
		$projectCategory = ProjectCategory::findOrFail($id);

		$this->authorize('update', $projectCategory);

		// find language default
		$languageDefault = Language::where('is_key_language', 1)->first();
		if (is_null($languageDefault)) {
			$languageDefault = Language::first();
		}

		// sure execute success, if not success rollback
		DB::transaction(function () use ($request, $projectCategory, $languageDefault) {
			$user = Auth::user();

			if (!$projectCategory->not_delete) {
				$projectCategory->key = Common::createKeyURL($request->input('ProjectCategory.ProjectCategoryTranslation.'.$languageDefault->code.'.name'));
			}
			$projectCategory->parent_id = $request->input('ProjectCategory.parent_id', 0);
			$projectCategory->priority = $request->input('ProjectCategory.priority', 0);
			$projectCategory->published = $request->input('ProjectCategory.published', 0);
			$projectCategory->updated_by = $user->id;
			$projectCategory->save();

			// save attachments
			if ($request->input('ProjectCategory.attachments') != "") {
				$paths = preg_replace('/\d+\|/', '', $request->input('ProjectCategory.attachments'));
				$paths = explode(',', $paths);

				$insertAttachments = [];
				foreach ($paths as $key => $path) {
					// find by path
					$attachment = $projectCategory->attachments()->where('path', $path)->first();
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
					$projectCategory->attachments()->saveMany($insertAttachments);
				}
				$projectCategory->attachments()->whereNotIn('path', $paths)->delete();
			}

			// save data languages
			foreach ($request->input('ProjectCategory.ProjectCategoryTranslation') as $locale => $value) {
				$projectCategory->translateOrNew($locale)->name = $request->input('ProjectCategory.ProjectCategoryTranslation.' .$locale. '.name');
				$projectCategory->translateOrNew($locale)->summary = $request->input('ProjectCategory.ProjectCategoryTranslation.' .$locale. '.summary');
				$projectCategory->translateOrNew($locale)->meta_description = $request->input('ProjectCategory.ProjectCategoryTranslation.' .$locale. '.meta_description');
				$projectCategory->translateOrNew($locale)->meta_keywords = $request->input('ProjectCategory.ProjectCategoryTranslation.' .$locale. '.meta_keywords');
			}

			$projectCategory->save();

		});

		$projectCategory->load('attachments');

		if ($request->ajax()) {
			return response()->json($projectCategory->toArray());
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
		$projectCategory = ProjectCategory::findOrFail($id);
		$this->authorize('destroy', $projectCategory);

		DB::transaction(function () use ($projectCategory) {
			$user = Auth::user();
			$projectCategory->deleted_by = $user->id;
			$projectCategory->key = $projectCategory->key.'-'.microtime(true);
			$projectCategory->save();

			// soft delete
			$projectCategory->delete();
		});
	}

	public function filter(ProjectCategoryRequest $request)
	{
		if ($request->ajax()) {
			$type = $request->input('type', '');
			if ($type == 'dropdown') {
				$multiple = $request->input('multiple', 'false');
				$ids = $request->input('ids', '');
				$search = $request->input('search', '');

				if ($multiple == 'false') {
					$projectCategories = ProjectCategory::all();
					return response()->json($projectCategories->toArray());
				}

				if ($ids != '') {
					$projectCategories = ProjectCategory::whereIn('id', $ids)->get();
				}
				if ($search != '') {
					$projectCategories = ProjectCategory::whereTranslationLike('name', '%'. $search .'%')->get();
				}
				
				return response()->json($projectCategories->toArray());
			}

			$projectCategories = ProjectCategory::with('attachments')->orderBy('priority')->get();
			return response()->json($projectCategories->toArray());
		}
	}
}
