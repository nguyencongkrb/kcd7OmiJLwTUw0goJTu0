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
use App\Banner;
use App\Http\Requests\BannerRequest;

class BannerController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return view('backend.banners.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$this->authorize('create', Banner::class);
		return redirect()->route('banners.index');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(BannerRequest $request)
	{
		$this->authorize('create', Banner::class);

		// find language generate key
		$languageDefault = Language::where('is_key_language', 1)->first();
		if (is_null($languageDefault)) {
			$languageDefault = Language::first();
		}

		$banner = new Banner;

		// sure execute success, if not success rollback
		DB::transaction(function () use ($request, $languageDefault, $banner) {
			$user = Auth::user();

			// insert Banner
			$banner->key = Common::createKeyURL($request->input('Banner.BannerTranslation.'.$languageDefault->code.'.name'));
			$banner->banner_category_id = $request->input('Banner.banner_category_id', 0);
			$banner->priority = $request->input('Banner.priority', 0);
			$banner->published = $request->input('Banner.published', 0);
			$banner->created_by = $user->id;
			$banner->save();

			// sync tags
			$tags =  $request->input('Banner.tags', []);
			if (count($tags) > 0) {
				$banner->tags()->attach($tags);
			}

			// sync related banners
			$relatedBanners =  $request->input('Banner.relatedBanners', []);
			if (count($relatedBanners) > 0) {
				$banner->relatedBanners()->attach($relatedBanners);
			}

			// save attachments
			if ($request->input('Banner.attachments') != "") {
				$requestAttachments = explode(',', $request->input('Banner.attachments'));
				$attachments = [];
				foreach ($requestAttachments as $key => $value) {
					array_push($attachments, new Attachment([
						'path' => $value,
						'priority' => $key,
						'published' => 1
						]));
				}
				if (count($attachments) > 0) {
					$banner->attachments()->saveMany($attachments);
				}
			}

			// save data languages
			foreach ($request->input('Banner.BannerTranslation') as $locale => $value) {
				$banner->translateOrNew($locale)->name = $request->input('Banner.BannerTranslation.' .$locale. '.name');
				$banner->translateOrNew($locale)->summary = $request->input('Banner.BannerTranslation.' .$locale. '.summary');
				$banner->translateOrNew($locale)->content = $request->input('Banner.BannerTranslation.' .$locale. '.content');
				$banner->translateOrNew($locale)->link = $request->input('Banner.BannerTranslation.' .$locale. '.link');
			}

			$banner->save();

		});

		$banner->load('attachments', 'bannerCategory', 'tags');

		if ($request->ajax()) {
			return response()->json($banner->toArray());
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
		$banner = Banner::findOrFail($id);
		$this->authorize('view', $banner);
		$banner->load('translations', 'attachments', 'tags', 'userCreated', 'userUpdated', 'relatedBanners');
		return response()->json($banner->toArray());
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$banner = Banner::findOrFail($id);
		$this->authorize('update', $banner);
		return redirect()->route('banners.index');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(BannerRequest $request, $id)
	{
		$banner = Banner::findOrFail($id);
		$this->authorize('update', $banner);

		// find language default
		$languageDefault = Language::where('is_key_language', 1)->first();
		if (is_null($languageDefault)) {
			$languageDefault = Language::first();
		}

		// sure execute success, if not success rollback
		DB::transaction(function () use ($request, $banner, $languageDefault) {
			$user = Auth::user();

			if (!$banner->not_delete) {
				$banner->key = Common::createKeyURL($request->input('Banner.BannerTranslation.'.$languageDefault->code.'.name'));
			}
			$banner->banner_category_id = $request->input('Banner.banner_category_id', 0);
			$banner->priority = $request->input('Banner.priority', 0);
			$banner->published = $request->input('Banner.published', 0);
			$banner->updated_by = $user->id;
			$banner->save();

			// sync tags
			$banner->tags()->detach();
			$tags =  $request->input('Banner.tags', []);
			if (count($tags) > 0) {
				$banner->tags()->attach($tags);
			}

			// sync related banners
			$banner->relatedBanners()->detach();
			$relatedBanners =  $request->input('Banner.relatedBanners', []);
			if (count($relatedBanners) > 0) {
				$banner->relatedBanners()->attach($relatedBanners);
			}

			// save attachments
			// only insert or delete, not update
			if ($request->input('Banner.attachments') != "") {
				$paths = preg_replace('/\d+\|/', '', $request->input('Banner.attachments'));
				$paths = explode(',', $paths);

				$insertAttachments = [];
				foreach ($paths as $key => $path) {
					// find by path
					$attachment = $banner->attachments()->where('path', $path)->first();
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
					$banner->attachments()->saveMany($insertAttachments);
				}
				$banner->attachments()->whereNotIn('path', $paths)->delete();
			}

			// save data languages
			foreach ($request->input('Banner.BannerTranslation') as $locale => $value) {
				$banner->translateOrNew($locale)->name = $request->input('Banner.BannerTranslation.' .$locale. '.name');
				$banner->translateOrNew($locale)->summary = $request->input('Banner.BannerTranslation.' .$locale. '.summary');
				$banner->translateOrNew($locale)->content = $request->input('Banner.BannerTranslation.' .$locale. '.content');
				$banner->translateOrNew($locale)->link = $request->input('Banner.BannerTranslation.' .$locale. '.link');
			}

			$banner->save();

		});

		$banner->load('attachments', 'bannerCategory', 'tags');

		if ($request->ajax()) {
			return response()->json($banner->toArray());
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
		$banner = Banner::findOrFail($id);
		$this->authorize('destroy', $banner);

		DB::transaction(function () use ($banner) {
			$user = Auth::user();
			$banner->deleted_by = $user->id;
			$banner->key = $banner->key.'-'.microtime(true);
			$banner->save();

			// soft delete
			$banner->delete();
		});
	}

	public function filter(BannerRequest $request)
	{
		if ($request->ajax()) {
			$type = $request->input('type', '');
			if ($type == 'dropdown') {
				$multiple = $request->input('multiple', 'false');
				$ids = $request->input('ids', '');
				$search = $request->input('search', '');

				if ($multiple == 'false') {
					$banners = Banner::all();
					return response()->json($banners->toArray());
				}

				if ($ids != '') {
					$banners = Banner::whereIn('id', $ids)->get();
				}
				if ($search != '') {
					$banners = Banner::whereTranslationLike('name', '%'. $search .'%')->get();
				}
				
				return response()->json($banners->toArray());
			}

			$banners = Banner::with('attachments', 'bannerCategory', 'tags')->orderBy('priority')->get();
			return response()->json($banners->toArray());
		}
	}
}
