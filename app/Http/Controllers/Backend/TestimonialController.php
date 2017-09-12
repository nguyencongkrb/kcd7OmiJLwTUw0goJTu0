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
use App\Testimonial;
use App\Http\Requests\TestimonialRequest;

class TestimonialController extends Controller
{
    /**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return view('backend.testimonials.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$this->authorize('create', Testimonial::class);
		return redirect()->route('testimonials.index');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(TestimonialRequest $request)
	{
		$this->authorize('create', Testimonial::class);

		// find language generate key
		$languageDefault = Language::where('is_key_language', 1)->first();
		if (is_null($languageDefault)) {
			$languageDefault = Language::first();
		}

		$testimonial = new Testimonial;

		// sure execute success, if not success rollback
		DB::transaction(function () use ($request, $languageDefault, $testimonial) {
			$user = Auth::user();

			// insert Testimonial
			$testimonial->priority = $request->input('Testimonial.priority', 0);
			$testimonial->published = $request->input('Testimonial.published', 0);
			$testimonial->created_by = $user->id;
			$testimonial->save();

			// save attachments
			if ($request->input('Testimonial.attachments') != "") {
				$requestAttachments = explode(',', $request->input('Testimonial.attachments'));
				$attachments = [];
				foreach ($requestAttachments as $key => $value) {
					array_push($attachments, new Attachment([
						'path' => $value,
						'priority' => $key,
						'published' => 1
						]));
				}
				if (count($attachments) > 0) {
					$testimonial->attachments()->saveMany($attachments);
				}
			}

			// save data languages
			foreach ($request->input('Testimonial.TestimonialTranslation') as $locale => $value) {
				$testimonial->translateOrNew($locale)->full_name = $request->input('Testimonial.TestimonialTranslation.' .$locale. '.full_name');
				$testimonial->translateOrNew($locale)->job_title = $request->input('Testimonial.TestimonialTranslation.' .$locale. '.job_title');
				$testimonial->translateOrNew($locale)->company_name = $request->input('Testimonial.TestimonialTranslation.' .$locale. '.company_name');
				$testimonial->translateOrNew($locale)->content = $request->input('Testimonial.TestimonialTranslation.' .$locale. '.content');
			}

			$testimonial->save();

		});

		$testimonial->load('attachments');

		if ($request->ajax()) {
			return response()->json($testimonial->toArray());
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
		$testimonial = Testimonial::findOrFail($id);
		$this->authorize('view', $testimonial);
		$testimonial->load('translations', 'attachments', 'userCreated', 'userUpdated');
		return response()->json($testimonial->toArray());
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$testimonial = Testimonial::findOrFail($id);
		$this->authorize('update', $testimonial);
		return redirect()->route('testimonials.index');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(TestimonialRequest $request, $id)
	{
		$testimonial = Testimonial::findOrFail($id);
		$this->authorize('update', $testimonial);

		// find language default
		$languageDefault = Language::where('is_key_language', 1)->first();
		if (is_null($languageDefault)) {
			$languageDefault = Language::first();
		}

		// sure execute success, if not success rollback
		DB::transaction(function () use ($request, $testimonial, $languageDefault) {
			$user = Auth::user();

			$testimonial->priority = $request->input('Testimonial.priority', 0);
			$testimonial->published = $request->input('Testimonial.published', 0);
			$testimonial->updated_by = $user->id;
			$testimonial->save();

			// save attachments
			if ($request->input('Testimonial.attachments') != "") {
				$paths = preg_replace('/\d+\|/', '', $request->input('Testimonial.attachments'));
				$paths = explode(',', $paths);

				$insertAttachments = [];
				foreach ($paths as $key => $path) {
					// find by path
					$attachment = $testimonial->attachments()->where('path', $path)->first();
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
					$testimonial->attachments()->saveMany($insertAttachments);
				}
				$testimonial->attachments()->whereNotIn('path', $paths)->delete();
			}

			// save data languages
			foreach ($request->input('Testimonial.TestimonialTranslation') as $locale => $value) {
				$testimonial->translateOrNew($locale)->full_name = $request->input('Testimonial.TestimonialTranslation.' .$locale. '.full_name');
				$testimonial->translateOrNew($locale)->job_title = $request->input('Testimonial.TestimonialTranslation.' .$locale. '.job_title');
				$testimonial->translateOrNew($locale)->company_name = $request->input('Testimonial.TestimonialTranslation.' .$locale. '.company_name');
				$testimonial->translateOrNew($locale)->content = $request->input('Testimonial.TestimonialTranslation.' .$locale. '.content');
			}

			$testimonial->save();

		});

		$testimonial->load('attachments');

		if ($request->ajax()) {
			return response()->json($testimonial->toArray());
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
		$testimonial = Testimonial::findOrFail($id);
		$this->authorize('destroy', $testimonial);

		DB::transaction(function () use ($testimonial) {
			$user = Auth::user();
			$testimonial->deleted_by = $user->id;
			$testimonial->save();

			// soft delete
			$testimonial->delete();
		});
	}

	public function filter(TestimonialRequest $request)
	{
		if ($request->ajax()) {
			$type = $request->input('type', '');
			if ($type == 'dropdown') {
				$multiple = $request->input('multiple', 'false');
				$ids = $request->input('ids', '');
				$search = $request->input('search', '');

				if ($multiple == 'false') {
					$testimonials = Testimonial::all();
					return response()->json($testimonials->toArray());
				}

				if ($ids != '') {
					$testimonials = Testimonial::whereIn('id', $ids)->get();
				}
				if ($search != '') {
					$testimonials = Testimonial::whereTranslationLike('full_name', '%'. $search .'%')->get();
				}
				
				return response()->json($testimonials->toArray());
			}

			$testimonials = Testimonial::with('attachments')->orderBy('priority')->get();
			return response()->json($testimonials->toArray());
		}
	}
}
