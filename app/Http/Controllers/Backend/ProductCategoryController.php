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
use App\ProductCategory;
use App\Http\Requests\ProductCategoryRequest;

class ProductCategoryController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return view('backend.productcategories.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$this->authorize('create', ProductCategory::class);
		return redirect()->route('productcategories.index');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(ProductCategoryRequest $request)
	{
		$this->authorize('create', ProductCategory::class);

		// find language generate key
		$languageDefault = Language::where('is_key_language', 1)->first();
		if (is_null($languageDefault)) {
			$languageDefault = Language::first();
		}

		$productCategory = new ProductCategory;

		// sure execute success, if not success rollback
		DB::transaction(function () use ($request, $languageDefault, $productCategory) {
			$user = Auth::user();

			// insert ProductCategory
			$productCategory->key = Common::createKeyURL($request->input('ProductCategory.ProductCategoryTranslation.'.$languageDefault->code.'.name'));
			$productCategory->parent_id = $request->input('ProductCategory.parent_id', 0);
			$productCategory->priority = $request->input('ProductCategory.priority', 0);
			$productCategory->published = $request->input('ProductCategory.published', 0);
			$productCategory->created_by = $user->id;
			$productCategory->save();

			// save attachments
			if ($request->input('ProductCategory.attachments') != "") {
				$requestAttachments = explode(',', $request->input('ProductCategory.attachments'));
				$attachments = [];
				foreach ($requestAttachments as $key => $value) {
					array_push($attachments, new Attachment([
						'path' => $value,
						'priority' => $key,
						'published' => 1
						]));
				}
				if (count($attachments) > 0) {
					$productCategory->attachments()->saveMany($attachments);
				}
			}

			// save data languages
			foreach ($request->input('ProductCategory.ProductCategoryTranslation') as $locale => $value) {
				$productCategory->translateOrNew($locale)->name = $request->input('ProductCategory.ProductCategoryTranslation.' .$locale. '.name');
				$productCategory->translateOrNew($locale)->summary = $request->input('ProductCategory.ProductCategoryTranslation.' .$locale. '.summary');
				$productCategory->translateOrNew($locale)->meta_description = $request->input('ProductCategory.ProductCategoryTranslation.' .$locale. '.meta_description');
				$productCategory->translateOrNew($locale)->meta_keywords = $request->input('ProductCategory.ProductCategoryTranslation.' .$locale. '.meta_keywords');
			}

			$productCategory->save();

		});

		$productCategory->load('attachments');

		if ($request->ajax()) {
			return response()->json($productCategory->toArray());
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
		$productCategory = ProductCategory::findOrFail($id);
		$this->authorize('view', $productCategory);
		$productCategory->load('translations', 'attachments', 'userCreated', 'userUpdated');
		return response()->json($productCategory->toArray());
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$productCategory = ProductCategory::findOrFail($id);
		$this->authorize('update', $productCategory);
		return redirect()->route('productcategories.index');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(ProductCategoryRequest $request, $id)
	{
		$productCategory = ProductCategory::findOrFail($id);
		$this->authorize('update', $productCategory);

		// find language default
		$languageDefault = Language::where('is_key_language', 1)->first();
		if (is_null($languageDefault)) {
			$languageDefault = Language::first();
		}

		// sure execute success, if not success rollback
		DB::transaction(function () use ($request, $productCategory, $languageDefault) {
			$user = Auth::user();

			if (!$productCategory->not_delete) {
				$productCategory->key = Common::createKeyURL($request->input('ProductCategory.ProductCategoryTranslation.'.$languageDefault->code.'.name'));
			}
			$productCategory->parent_id = $request->input('ProductCategory.parent_id', 0);
			$productCategory->priority = $request->input('ProductCategory.priority', 0);
			$productCategory->published = $request->input('ProductCategory.published', 0);
			$productCategory->updated_by = $user->id;
			$productCategory->save();

			// save attachments
			if ($request->input('ProductCategory.attachments') != "") {
				$paths = preg_replace('/\d+\|/', '', $request->input('ProductCategory.attachments'));
				$paths = explode(',', $paths);

				$insertAttachments = [];
				foreach ($paths as $key => $path) {
					// find by path
					$attachment = $productCategory->attachments()->where('path', $path)->first();
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
					$productCategory->attachments()->saveMany($insertAttachments);
				}
				$productCategory->attachments()->whereNotIn('path', $paths)->delete();
			}

			// save data languages
			foreach ($request->input('ProductCategory.ProductCategoryTranslation') as $locale => $value) {
				$productCategory->translateOrNew($locale)->name = $request->input('ProductCategory.ProductCategoryTranslation.' .$locale. '.name');
				$productCategory->translateOrNew($locale)->summary = $request->input('ProductCategory.ProductCategoryTranslation.' .$locale. '.summary');
				$productCategory->translateOrNew($locale)->meta_description = $request->input('ProductCategory.ProductCategoryTranslation.' .$locale. '.meta_description');
				$productCategory->translateOrNew($locale)->meta_keywords = $request->input('ProductCategory.ProductCategoryTranslation.' .$locale. '.meta_keywords');
			}

			$productCategory->save();

		});

		$productCategory->load('attachments');

		if ($request->ajax()) {
			return response()->json($productCategory->toArray());
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
		$productCategory = ProductCategory::findOrFail($id);
		$this->authorize('destroy', $productCategory);

		DB::transaction(function () use ($productCategory) {
			$user = Auth::user();
			$productCategory->deleted_by = $user->id;
			$productCategory->key = $productCategory->key.'-'.microtime(true);
			$productCategory->save();

			// soft delete
			$productCategory->delete();
		});
	}

	public function filter(ProductCategoryRequest $request)
	{
		if ($request->ajax()) {
			$type = $request->input('type', '');
			if ($type == 'dropdown') {
				$multiple = $request->input('multiple', 'false');
				$ids = $request->input('ids', '');
				$search = $request->input('search', '');

				if ($multiple == 'false') {
					$productcategories = ProductCategory::all();
					return response()->json($productcategories->toArray());
				}

				if ($ids != '') {
					$productcategories = ProductCategory::whereIn('id', $ids)->get();
				}
				if ($search != '') {
					$productcategories = ProductCategory::whereTranslationLike('name', '%'. $search .'%')->get();
				}
				
				return response()->json($productcategories->toArray());
			}

			$productcategories = ProductCategory::with('attachments')->orderBy('priority')->get();
			return response()->json($productcategories->toArray());
		}
	}
}
