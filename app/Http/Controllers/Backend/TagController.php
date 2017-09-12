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
use App\Tag;
use App\Http\Requests\TagRequest;

class TagController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return view('backend.tags.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$this->authorize('create', Tag::class);
		return redirect()->route('tags.index');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(TagRequest $request)
	{
		$this->authorize('create', Tag::class);

		// find language generate key
		$languageDefault = Language::where('is_key_language', 1)->first();
		if (is_null($languageDefault)) {
			$languageDefault = Language::first();
		}

		$tag = new Tag;

		// sure execute success, if not success rollback
		DB::transaction(function () use ($request, $languageDefault, $tag) {
			$user = Auth::user();

			// insert Tag
			$tag->key = Common::createKeyURL($request->input('Tag.TagTranslation.'.$languageDefault->code.'.name'));
			$tag->parent_id = $request->input('Tag.parent_id', 0);
			$tag->priority = $request->input('Tag.priority', 0);
			$tag->published = $request->input('Tag.published', 0);
			$tag->created_by = $user->id;
			$tag->save();

			// save attachments
			if ($request->input('Tag.attachments') != "") {
				$requestAttachments = explode(',', $request->input('Tag.attachments'));
				$attachments = [];
				foreach ($requestAttachments as $key => $value) {
					array_push($attachments, new Attachment([
						'path' => $value,
						'priority' => $key,
						'published' => 1
						]));
				}
				if (count($attachments) > 0) {
					$tag->attachments()->saveMany($attachments);
				}
			}

			// save data languages
			foreach ($request->input('Tag.TagTranslation') as $locale => $value) {
				$tag->translateOrNew($locale)->name = $request->input('Tag.TagTranslation.' .$locale. '.name');
				$tag->translateOrNew($locale)->summary = $request->input('Tag.TagTranslation.' .$locale. '.summary');
				$tag->translateOrNew($locale)->meta_description = $request->input('Tag.TagTranslation.' .$locale. '.meta_description');
				$tag->translateOrNew($locale)->meta_keywords = $request->input('Tag.TagTranslation.' .$locale. '.meta_keywords');
			}

			$tag->save();

		});

		$tag->load('attachments');

		if ($request->ajax()) {
			return response()->json($tag->toArray());
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
		$tag = Tag::findOrFail($id);
		$this->authorize('view', $tag);
		$tag->load('translations', 'attachments', 'userCreated', 'userUpdated');
		return response()->json($tag->toArray());
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$tag = Tag::findOrFail($id);
		$this->authorize('update', $tag);
		return redirect()->route('tags.index');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(TagRequest $request, $id)
	{
		$tag = Tag::findOrFail($id);
		$this->authorize('update', $tag);

		// find language default
		$languageDefault = Language::where('is_key_language', 1)->first();
		if (is_null($languageDefault)) {
			$languageDefault = Language::first();
		}

		// sure execute success, if not success rollback
		DB::transaction(function () use ($request, $tag, $languageDefault) {
			$user = Auth::user();

			if (!$tag->not_delete) {
				$tag->key = Common::createKeyURL($request->input('Tag.TagTranslation.'.$languageDefault->code.'.name'));
			}
			$tag->parent_id = $request->input('Tag.parent_id', 0);
			$tag->priority = $request->input('Tag.priority', 0);
			$tag->published = $request->input('Tag.published', 0);
			$tag->updated_by = $user->id;
			$tag->save();

			// save attachments
			if ($request->input('Tag.attachments') != "") {
				$paths = preg_replace('/\d+\|/', '', $request->input('Tag.attachments'));
				$paths = explode(',', $paths);

				$insertAttachments = [];
				foreach ($paths as $key => $path) {
					// find by path
					$attachment = $tag->attachments()->where('path', $path)->first();
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
					$tag->attachments()->saveMany($insertAttachments);
				}
				$tag->attachments()->whereNotIn('path', $paths)->delete();
			}

			// save data languages
			foreach ($request->input('Tag.TagTranslation') as $locale => $value) {
				$tag->translateOrNew($locale)->name = $request->input('Tag.TagTranslation.' .$locale. '.name');
				$tag->translateOrNew($locale)->summary = $request->input('Tag.TagTranslation.' .$locale. '.summary');
				$tag->translateOrNew($locale)->meta_description = $request->input('Tag.TagTranslation.' .$locale. '.meta_description');
				$tag->translateOrNew($locale)->meta_keywords = $request->input('Tag.TagTranslation.' .$locale. '.meta_keywords');
			}

			$tag->save();

		});

		$tag->load('attachments');

		if ($request->ajax()) {
			return response()->json($tag->toArray());
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
		$tag = Tag::findOrFail($id);
		$this->authorize('destroy', $tag);

		DB::transaction(function () use ($tag) {
			$user = Auth::user();
			$tag->deleted_by = $user->id;
			$tag->key = $tag->key.'-'.microtime(true);
			$tag->save();

			// soft delete
			$tag->delete();
		});
	}

	public function filter(TagRequest $request)
	{
		if ($request->ajax()) {
			$type = $request->input('type', '');
			if ($type == 'dropdown') {
				$multiple = $request->input('multiple', 'false');
				$ids = $request->input('ids', '');
				$search = $request->input('search', '');

				if ($multiple == 'false') {
					$tags = Tag::all();
					return response()->json($tags->toArray());
				}

				if ($ids != '') {
					$tags = Tag::whereIn('id', $ids)->get();
				}
				if ($search != '') {
					$tags = Tag::whereTranslationLike('name', '%'. $search .'%')->get();
				}
				
				return response()->json($tags->toArray());
			}

			$tags = Tag::with('attachments')->orderBy('priority')->get();
			return response()->json($tags->toArray());
		}
	}
}
