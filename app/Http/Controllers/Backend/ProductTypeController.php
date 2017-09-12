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
use App\ProductType;
use App\Http\Requests\ProductTypeRequest;

class ProductTypeController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return view('backend.producttypes.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$this->authorize('create', ProductType::class);
		return redirect()->route('producttypes.index');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(ProductTypeRequest $request)
	{
		$this->authorize('create', ProductType::class);

		// find language generate key
		$languageDefault = Language::where('is_key_language', 1)->first();
		if (is_null($languageDefault)) {
			$languageDefault = Language::first();
		}

		$productType = new ProductType;

		// sure execute success, if not success rollback
		DB::transaction(function () use ($request, $languageDefault, $productType) {
			$user = Auth::user();

			// insert ProductType
			$productType->key = Common::createKeyURL($request->input('ProductType.ProductTypeTranslation.'.$languageDefault->code.'.name'));
			$productType->parent_id = $request->input('ProductType.parent_id', 0);
			$productType->priority = $request->input('ProductType.priority', 0);
			$productType->published = $request->input('ProductType.published', 0);
			$productType->created_by = $user->id;
			$productType->save();

			// save attachments
			if ($request->input('ProductType.attachments') != "") {
				$requestAttachments = explode(',', $request->input('ProductType.attachments'));
				$attachments = [];
				foreach ($requestAttachments as $key => $value) {
					array_push($attachments, new Attachment([
						'path' => $value,
						'priority' => $key,
						'published' => 1
						]));
				}
				if (count($attachments) > 0) {
					$productType->attachments()->saveMany($attachments);
				}
			}

			// save data languages
			foreach ($request->input('ProductType.ProductTypeTranslation') as $locale => $value) {
				$productType->translateOrNew($locale)->name = $request->input('ProductType.ProductTypeTranslation.' .$locale. '.name');
				$productType->translateOrNew($locale)->summary = $request->input('ProductType.ProductTypeTranslation.' .$locale. '.summary');
				$productType->translateOrNew($locale)->meta_description = $request->input('ProductType.ProductTypeTranslation.' .$locale. '.meta_description');
				$productType->translateOrNew($locale)->meta_keywords = $request->input('ProductType.ProductTypeTranslation.' .$locale. '.meta_keywords');
			}

			$productType->save();

		});

		$productType->load('attachments');

		if ($request->ajax()) {
			return response()->json($productType->toArray());
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
		$productType = ProductType::findOrFail($id);
		$this->authorize('view', $productType);
		$productType->load('translations', 'attachments', 'userCreated', 'userUpdated');
		return response()->json($productType->toArray());
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$productType = ProductType::findOrFail($id);
		$this->authorize('update', $productType);
		return redirect()->route('producttypes.index');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(ProductTypeRequest $request, $id)
	{
		$productType = ProductType::findOrFail($id);
		$this->authorize('update', $productType);

		// find language default
		$languageDefault = Language::where('is_key_language', 1)->first();
		if (is_null($languageDefault)) {
			$languageDefault = Language::first();
		}

		// sure execute success, if not success rollback
		DB::transaction(function () use ($request, $productType, $languageDefault) {
			$user = Auth::user();

			if (!$productType->not_delete) {
				$productType->key = Common::createKeyURL($request->input('ProductType.ProductTypeTranslation.'.$languageDefault->code.'.name'));
			}
			$productType->parent_id = $request->input('ProductType.parent_id', 0);
			$productType->priority = $request->input('ProductType.priority', 0);
			$productType->published = $request->input('ProductType.published', 0);
			$productType->updated_by = $user->id;
			$productType->save();

			// save attachments
			if ($request->input('ProductType.attachments') != "") {
				$paths = preg_replace('/\d+\|/', '', $request->input('ProductType.attachments'));
				$paths = explode(',', $paths);

				$insertAttachments = [];
				foreach ($paths as $key => $path) {
					// find by path
					$attachment = $productType->attachments()->where('path', $path)->first();
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
					$productType->attachments()->saveMany($insertAttachments);
				}
				$productType->attachments()->whereNotIn('path', $paths)->delete();
			}

			// save data languages
			foreach ($request->input('ProductType.ProductTypeTranslation') as $locale => $value) {
				$productType->translateOrNew($locale)->name = $request->input('ProductType.ProductTypeTranslation.' .$locale. '.name');
				$productType->translateOrNew($locale)->summary = $request->input('ProductType.ProductTypeTranslation.' .$locale. '.summary');
				$productType->translateOrNew($locale)->meta_description = $request->input('ProductType.ProductTypeTranslation.' .$locale. '.meta_description');
				$productType->translateOrNew($locale)->meta_keywords = $request->input('ProductType.ProductTypeTranslation.' .$locale. '.meta_keywords');
			}

			$productType->save();

		});

		$productType->load('attachments');

		if ($request->ajax()) {
			return response()->json($productType->toArray());
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
		$productType = ProductType::findOrFail($id);
		$this->authorize('destroy', $productType);

		DB::transaction(function () use ($productType) {
			$user = Auth::user();
			$productType->deleted_by = $user->id;
			$productType->key = $productType->key.'-'.microtime(true);
			$productType->save();

			// soft delete
			$productType->delete();
		});
	}

	public function filter(ProductTypeRequest $request)
	{
		if ($request->ajax()) {
			$type = $request->input('type', '');
			if ($type == 'dropdown') {
				$multiple = $request->input('multiple', 'false');
				$ids = $request->input('ids', '');
				$search = $request->input('search', '');

				if ($multiple == 'false') {
					$productTypes = ProductType::all();
					return response()->json($productTypes->toArray());
				}

				if ($ids != '') {
					$productTypes = ProductType::whereIn('id', $ids)->get();
				}
				if ($search != '') {
					$productTypes = ProductType::whereTranslationLike('name', '%'. $search .'%')->get();
				}
				
				return response()->json($productTypes->toArray());
			}

			$productTypes = ProductType::with('attachments')->orderBy('priority')->get();
			return response()->json($productTypes->toArray());
		}
	}
}
