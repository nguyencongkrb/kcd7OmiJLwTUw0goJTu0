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
use App\ProductColor;
use App\Http\Requests\ProductColorRequest;

class ProductColorController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return view('backend.productcolors.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$this->authorize('create', ProductColor::class);
		return redirect()->route('productcolors.index');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(ProductColorRequest $request)
	{
		$this->authorize('create', ProductColor::class);

		// find language generate key
		$languageDefault = Language::where('is_key_language', 1)->first();
		if (is_null($languageDefault)) {
			$languageDefault = Language::first();
		}

		$productColor = new ProductColor;

		// sure execute success, if not success rollback
		DB::transaction(function () use ($request, $languageDefault, $productColor) {
			$user = Auth::user();

			// insert ProductColor
			$productColor->key = Common::createKeyURL($request->input('ProductColor.ProductColorTranslation.'.$languageDefault->code.'.name'));
			$productColor->parent_id = $request->input('ProductColor.parent_id', 0);
			$productColor->priority = $request->input('ProductColor.priority', 0);
			$productColor->published = $request->input('ProductColor.published', 0);
			$productColor->created_by = $user->id;
			$productColor->save();

			// save attachments
			if ($request->input('ProductColor.attachments') != "") {
				$requestAttachments = explode(',', $request->input('ProductColor.attachments'));
				$attachments = [];
				foreach ($requestAttachments as $key => $value) {
					array_push($attachments, new Attachment([
						'path' => $value,
						'priority' => $key,
						'published' => 1
						]));
				}
				if (count($attachments) > 0) {
					$productColor->attachments()->saveMany($attachments);
				}
			}

			// save data languages
			foreach ($request->input('ProductColor.ProductColorTranslation') as $locale => $value) {
				$productColor->translateOrNew($locale)->name = $request->input('ProductColor.ProductColorTranslation.' .$locale. '.name');
				$productColor->translateOrNew($locale)->summary = $request->input('ProductColor.ProductColorTranslation.' .$locale. '.summary');
				$productColor->translateOrNew($locale)->meta_description = $request->input('ProductColor.ProductColorTranslation.' .$locale. '.meta_description');
				$productColor->translateOrNew($locale)->meta_keywords = $request->input('ProductColor.ProductColorTranslation.' .$locale. '.meta_keywords');
			}

			$productColor->save();

		});

		$productColor->load('attachments');

		if ($request->ajax()) {
			return response()->json($productColor->toArray());
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
		$productColor = ProductColor::findOrFail($id);
		$this->authorize('view', $productColor);
		$productColor->load('translations', 'attachments', 'userCreated', 'userUpdated');
		return response()->json($productColor->toArray());
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$productColor = ProductColor::findOrFail($id);
		$this->authorize('update', $productColor);
		return redirect()->route('productcolors.index');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(ProductColorRequest $request, $id)
	{
		$productColor = ProductColor::findOrFail($id);
		$this->authorize('update', $productColor);

		// find language default
		$languageDefault = Language::where('is_key_language', 1)->first();
		if (is_null($languageDefault)) {
			$languageDefault = Language::first();
		}

		// sure execute success, if not success rollback
		DB::transaction(function () use ($request, $productColor, $languageDefault) {
			$user = Auth::user();

			if (!$productColor->not_delete) {
				$productColor->key = Common::createKeyURL($request->input('ProductColor.ProductColorTranslation.'.$languageDefault->code.'.name'));
			}
			$productColor->parent_id = $request->input('ProductColor.parent_id', 0);
			$productColor->priority = $request->input('ProductColor.priority', 0);
			$productColor->published = $request->input('ProductColor.published', 0);
			$productColor->updated_by = $user->id;
			$productColor->save();

			// save attachments
			if ($request->input('ProductColor.attachments') != "") {
				$paths = preg_replace('/\d+\|/', '', $request->input('ProductColor.attachments'));
				$paths = explode(',', $paths);

				$insertAttachments = [];
				foreach ($paths as $key => $path) {
					// find by path
					$attachment = $productColor->attachments()->where('path', $path)->first();
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
					$productColor->attachments()->saveMany($insertAttachments);
				}
				$productColor->attachments()->whereNotIn('path', $paths)->delete();
			}

			// save data languages
			foreach ($request->input('ProductColor.ProductColorTranslation') as $locale => $value) {
				$productColor->translateOrNew($locale)->name = $request->input('ProductColor.ProductColorTranslation.' .$locale. '.name');
				$productColor->translateOrNew($locale)->summary = $request->input('ProductColor.ProductColorTranslation.' .$locale. '.summary');
				$productColor->translateOrNew($locale)->meta_description = $request->input('ProductColor.ProductColorTranslation.' .$locale. '.meta_description');
				$productColor->translateOrNew($locale)->meta_keywords = $request->input('ProductColor.ProductColorTranslation.' .$locale. '.meta_keywords');
			}

			$productColor->save();

		});

		$productColor->load('attachments');

		if ($request->ajax()) {
			return response()->json($productColor->toArray());
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
		$productColor = ProductColor::findOrFail($id);
		$this->authorize('destroy', $productColor);

		DB::transaction(function () use ($productColor) {
			$user = Auth::user();
			$productColor->deleted_by = $user->id;
			$productColor->key = $productColor->key.'-'.microtime(true);
			$productColor->save();

			// soft delete
			$productColor->delete();
		});
	}

	public function filter(ProductColorRequest $request)
	{
		if ($request->ajax()) {
			$type = $request->input('type', '');
			if ($type == 'dropdown') {
				$multiple = $request->input('multiple', 'false');
				$ids = $request->input('ids', '');
				$search = $request->input('search', '');

				if ($multiple == 'false') {
					$productcolors = ProductColor::all();
					return response()->json($productcolors->toArray());
				}

				if ($ids != '') {
					$productcolors = ProductColor::whereIn('id', $ids)->get();
				}
				if ($search != '') {
					$productcolors = ProductColor::whereTranslationLike('name', '%'. $search .'%')->get();
				}
				
				return response()->json($productcolors->toArray());
			}

			$productcolors = ProductColor::with('attachments')->orderBy('priority')->get();
			return response()->json($productcolors->toArray());
		}
	}
}
