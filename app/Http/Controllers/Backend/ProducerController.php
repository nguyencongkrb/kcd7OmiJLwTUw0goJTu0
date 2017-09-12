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
use App\Producer;
use App\Http\Requests\ProducerRequest;

class ProducerController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return view('backend.producers.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$this->authorize('create', Producer::class);
		return redirect()->route('producers.index');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(ProducerRequest $request)
	{
		$this->authorize('create', Producer::class);

		// find language generate key
		$languageDefault = Language::where('is_key_language', 1)->first();
		if (is_null($languageDefault)) {
			$languageDefault = Language::first();
		}

		$producer = new Producer;

		// sure execute success, if not success rollback
		DB::transaction(function () use ($request, $languageDefault, $producer) {
			$user = Auth::user();

			// insert Producer
			$producer->key = Common::createKeyURL($request->input('Producer.ProducerTranslation.'.$languageDefault->code.'.name'));
			$producer->parent_id = $request->input('Producer.parent_id', 0);
			$producer->priority = $request->input('Producer.priority', 0);
			$producer->published = $request->input('Producer.published', 0);
			$producer->created_by = $user->id;
			$producer->save();

			// save attachments
			if ($request->input('Producer.attachments') != "") {
				$requestAttachments = explode(',', $request->input('Producer.attachments'));
				$attachments = [];
				foreach ($requestAttachments as $key => $value) {
					array_push($attachments, new Attachment([
						'path' => $value,
						'priority' => $key,
						'published' => 1
						]));
				}
				if (count($attachments) > 0) {
					$producer->attachments()->saveMany($attachments);
				}
			}

			// save data languages
			foreach ($request->input('Producer.ProducerTranslation') as $locale => $value) {
				$producer->translateOrNew($locale)->name = $request->input('Producer.ProducerTranslation.' .$locale. '.name');
				$producer->translateOrNew($locale)->summary = $request->input('Producer.ProducerTranslation.' .$locale. '.summary');
				$producer->translateOrNew($locale)->meta_description = $request->input('Producer.ProducerTranslation.' .$locale. '.meta_description');
				$producer->translateOrNew($locale)->meta_keywords = $request->input('Producer.ProducerTranslation.' .$locale. '.meta_keywords');
			}

			$producer->save();

		});

		$producer->load('attachments');

		if ($request->ajax()) {
			return response()->json($producer->toArray());
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
		$producer = Producer::findOrFail($id);
		$this->authorize('view', $producer);
		$producer->load('translations', 'attachments', 'userCreated', 'userUpdated');
		return response()->json($producer->toArray());
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$producer = Producer::findOrFail($id);
		$this->authorize('update', $producer);
		return redirect()->route('producers.index');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(ProducerRequest $request, $id)
	{
		$producer = Producer::findOrFail($id);
		$this->authorize('update', $producer);

		// find language default
		$languageDefault = Language::where('is_key_language', 1)->first();
		if (is_null($languageDefault)) {
			$languageDefault = Language::first();
		}

		// sure execute success, if not success rollback
		DB::transaction(function () use ($request, $producer, $languageDefault) {
			$user = Auth::user();

			if (!$producer->not_delete) {
				$producer->key = Common::createKeyURL($request->input('Producer.ProducerTranslation.'.$languageDefault->code.'.name'));
			}
			$producer->parent_id = $request->input('Producer.parent_id', 0);
			$producer->priority = $request->input('Producer.priority', 0);
			$producer->published = $request->input('Producer.published', 0);
			$producer->updated_by = $user->id;
			$producer->save();

			// save attachments
			if ($request->input('Producer.attachments') != "") {
				$paths = preg_replace('/\d+\|/', '', $request->input('Producer.attachments'));
				$paths = explode(',', $paths);

				$insertAttachments = [];
				foreach ($paths as $key => $path) {
					// find by path
					$attachment = $producer->attachments()->where('path', $path)->first();
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
					$producer->attachments()->saveMany($insertAttachments);
				}
				$producer->attachments()->whereNotIn('path', $paths)->delete();
			}

			// save data languages
			foreach ($request->input('Producer.ProducerTranslation') as $locale => $value) {
				$producer->translateOrNew($locale)->name = $request->input('Producer.ProducerTranslation.' .$locale. '.name');
				$producer->translateOrNew($locale)->summary = $request->input('Producer.ProducerTranslation.' .$locale. '.summary');
				$producer->translateOrNew($locale)->meta_description = $request->input('Producer.ProducerTranslation.' .$locale. '.meta_description');
				$producer->translateOrNew($locale)->meta_keywords = $request->input('Producer.ProducerTranslation.' .$locale. '.meta_keywords');
			}

			$producer->save();

		});

		$producer->load('attachments');

		if ($request->ajax()) {
			return response()->json($producer->toArray());
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
		$producer = Producer::findOrFail($id);
		$this->authorize('destroy', $producer);

		DB::transaction(function () use ($producer) {
			$user = Auth::user();
			$producer->deleted_by = $user->id;
			$producer->key = $producer->key.'-'.microtime(true);
			$producer->save();

			// soft delete
			$producer->delete();
		});
	}

	public function filter(ProducerRequest $request)
	{
		if ($request->ajax()) {
			$type = $request->input('type', '');
			if ($type == 'dropdown') {
				$multiple = $request->input('multiple', 'false');
				$ids = $request->input('ids', '');
				$search = $request->input('search', '');

				if ($multiple == 'false') {
					$producers = Producer::all();
					return response()->json($producers->toArray());
				}

				if ($ids != '') {
					$producers = Producer::whereIn('id', $ids)->get();
				}
				if ($search != '') {
					$producers = Producer::whereTranslationLike('name', '%'. $search .'%')->get();
				}
				
				return response()->json($producers->toArray());
			}

			$producers = Producer::with('attachments')->orderBy('priority')->get();
			return response()->json($producers->toArray());
		}
	}
}
