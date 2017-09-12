<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use DateTime;
use App\Common;
use App\Language;
use App\Attachment;
use App\Project;
use App\Http\Requests\ProjectRequest;

class ProjectController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return view('backend.projects.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$this->authorize('create', Project::class);
		return redirect()->route('projects.index');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(ProjectRequest $request)
	{
		$this->authorize('create', Project::class);

		// find language generate key
		$languageDefault = Language::where('is_key_language', 1)->first();
		if (is_null($languageDefault)) {
			$languageDefault = Language::first();
		}

		$project = new Project;

		// sure execute success, if not success rollback
		DB::transaction(function () use ($request, $languageDefault, $project) {
			$user = Auth::user();

			// insert Project
			$project->key = Common::createKeyURL($request->input('Project.ProjectTranslation.'.$languageDefault->code.'.name'));
			$project->priority = $request->input('Project.priority', 0);
			$project->execution_time = $request->input('Project.execution_time', '');
			if ($project->execution_time == null) {
				$project->execution_time = null;
			}
			else{
				$project->execution_time = DateTime::createFromFormat('Y-m-d', $project->execution_time);
			}
			$project->website = $request->input('Project.website', '');
			$project->published = $request->input('Project.published', 0);
			$project->created_by = $user->id;
			$project->save();

			// sync ProjectCategories
			$categories =  $request->input('Project.projectCategories', []);
			if (count($categories) > 0) {
				$project->ProjectCategories()->attach($categories);
			}

			// sync ProjectTypes
			$projectTypes =  $request->input('Project.projectTypes', []);
			if (count($projectTypes) > 0) {
				$project->ProjectTypes()->attach($projectTypes);
			}

			// sync tags
			$tags =  $request->input('Project.tags', []);
			if (count($tags) > 0) {
				$project->tags()->attach($tags);
			}

			// save attachments
			if ($request->input('Project.attachments') != "") {
				$requestAttachments = explode(',', $request->input('Project.attachments'));
				$attachments = [];
				foreach ($requestAttachments as $key => $value) {
					array_push($attachments, new Attachment([
						'path' => $value,
						'priority' => $key,
						'published' => 1
						]));
				}
				if (count($attachments) > 0) {
					$project->attachments()->saveMany($attachments);
				}
			}

			// save data languages
			foreach ($request->input('Project.ProjectTranslation') as $locale => $value) {
				$project->translateOrNew($locale)->name = $request->input('Project.ProjectTranslation.' .$locale. '.name');
				$project->translateOrNew($locale)->client_name = $request->input('Project.ProjectTranslation.' .$locale. '.client_name');
				$project->translateOrNew($locale)->summary = $request->input('Project.ProjectTranslation.' .$locale. '.summary');
				$project->translateOrNew($locale)->description = $request->input('Project.ProjectTranslation.' .$locale. '.description');
				$project->translateOrNew($locale)->meta_description = $request->input('Project.ProjectTranslation.' .$locale. '.meta_description');
				$project->translateOrNew($locale)->meta_keywords = $request->input('Project.ProjectTranslation.' .$locale. '.meta_keywords');
			}

			$project->save();

		});

		$project->load('attachments', 'projectCategories', 'projectTypes', 'tags');

		if ($request->ajax()) {
			return response()->json($project->toArray());
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
		$project = Project::findOrFail($id);
		$this->authorize('view', $project);
		$project->load('translations', 'projectCategories', 'projectTypes', 'tags', 'attachments', 'userCreated', 'userUpdated');
		return response()->json($project->toArray());
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$project = Project::findOrFail($id);
		$this->authorize('update', $project);
		return redirect()->route('projects.index');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(ProjectRequest $request, $id)
	{
		$project = Project::findOrFail($id);
		$this->authorize('update', $project);

		// find language default
		$languageDefault = Language::where('is_key_language', 1)->first();
		if (is_null($languageDefault)) {
			$languageDefault = Language::first();
		}

		// sure execute success, if not success rollback
		DB::transaction(function () use ($request, $project, $languageDefault) {
			$user = Auth::user();

			if (!$project->not_delete) {
				$project->key = Common::createKeyURL($request->input('Project.ProjectTranslation.'.$languageDefault->code.'.name'));
			}
			$project->priority = $request->input('Project.priority', 0);
			$project->execution_time = $request->input('Project.execution_time', '');
			if ($project->execution_time == null) {
				$project->execution_time = null;
			}
			else{
				$project->execution_time = DateTime::createFromFormat('Y-m-d', $project->execution_time);
			}
			$project->website = $request->input('Project.website', '');
			$project->published = $request->input('Project.published', 0);
			$project->updated_by = $user->id;
			$project->save();

			// sync ProjectCategories
			$project->ProjectCategories()->detach();
			$categories =  $request->input('Project.projectCategories', []);
			if (count($categories) > 0) {
				$project->ProjectCategories()->attach($categories);
			}

			// sync ProjectTypes
			$project->ProjectTypes()->detach();
			$projectTypes =  $request->input('Project.projectTypes', []);
			if (count($projectTypes) > 0) {
				$project->ProjectTypes()->attach($projectTypes);
			}

			// sync tags
			$project->tags()->detach();
			$tags =  $request->input('Project.tags', []);
			if (count($tags) > 0) {
				$project->tags()->attach($tags);
			}

			// save attachments
			if ($request->input('Project.attachments') != "") {
				$paths = preg_replace('/\d+\|/', '', $request->input('Project.attachments'));
				$paths = explode(',', $paths);

				$insertAttachments = [];
				foreach ($paths as $key => $path) {
					// find by path
					$attachment = $project->attachments()->where('path', $path)->first();
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
					$project->attachments()->saveMany($insertAttachments);
				}
				$project->attachments()->whereNotIn('path', $paths)->delete();
			}

			// save data languages
			foreach ($request->input('Project.ProjectTranslation') as $locale => $value) {
				$project->translateOrNew($locale)->name = $request->input('Project.ProjectTranslation.' .$locale. '.name');
				$project->translateOrNew($locale)->client_name = $request->input('Project.ProjectTranslation.' .$locale. '.client_name');
				$project->translateOrNew($locale)->summary = $request->input('Project.ProjectTranslation.' .$locale. '.summary');
				$project->translateOrNew($locale)->description = $request->input('Project.ProjectTranslation.' .$locale. '.description');
				$project->translateOrNew($locale)->meta_description = $request->input('Project.ProjectTranslation.' .$locale. '.meta_description');
				$project->translateOrNew($locale)->meta_keywords = $request->input('Project.ProjectTranslation.' .$locale. '.meta_keywords');
			}

			$project->save();

		});

		$project->load('attachments', 'projectCategories', 'projectTypes', 'tags');

		if ($request->ajax()) {
			return response()->json($project->toArray());
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
		$project = Project::findOrFail($id);
		$this->authorize('destroy', $project);

		DB::transaction(function () use ($project) {
			$user = Auth::user();
			$project->deleted_by = $user->id;
			$project->key = $project->key.'-'.microtime(true);
			$project->save();

			// soft delete
			$project->delete();
		});
	}

	public function filter(ProjectRequest $request)
	{
		if ($request->ajax()) {
			$type = $request->input('type', '');
			if ($type == 'dropdown') {
				$multiple = $request->input('multiple', 'false');
				$ids = $request->input('ids', '');
				$search = $request->input('search', '');

				if ($multiple == 'false') {
					$projects = Project::all();
					return response()->json($projects->toArray());
				}

				if ($ids != '') {
					$projects = Project::whereIn('id', $ids)->get();
				}
				if ($search != '') {
					$projects = Project::whereTranslationLike('name', '%'. $search .'%')->get();
				}
				
				return response()->json($projects->toArray());
			}

			$projects = Project::with('attachments', 'projectCategories', 'projectTypes', 'tags')->orderBy('priority')->get();
			return response()->json($projects->toArray());
		}
	}
}
