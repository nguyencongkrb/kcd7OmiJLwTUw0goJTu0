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
use App\Product;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return view('backend.products.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$this->authorize('create', Product::class);
		return redirect()->route('products.index');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(ProductRequest $request)
	{
		$this->authorize('create', Product::class);

		// find language generate key
		$languageDefault = Language::where('is_key_language', 1)->first();
		if (is_null($languageDefault)) {
			$languageDefault = Language::first();
		}

		$product = new Product;

		// sure execute success, if not success rollback
		DB::transaction(function () use ($request, $languageDefault, $product) {
			$user = Auth::user();

			// insert product
			$product->key = Common::createKeyURL($request->input('Product.ProductTranslation.'.$languageDefault->code.'.name'));
			$product->code = $request->input('Product.code');
			$product->model = $request->input('Product.model');
			$product->custom_size = $request->input('Product.custom_size');
			$product->producer_id = $request->input('Product.producer_id');
			$product->origin = $request->input('Product.origin');
			$product->unit = $request->input('Product.unit');
			$product->price = $request->input('Product.price', 0);
			$product->sale_price = $request->input('Product.sale_price', 0);
			$product->sale_ratio = $request->input('Product.sale_ratio', 0);
			$product->warranty = $request->input('Product.warranty');
			$product->priority = $request->input('Product.priority', 0);
			$product->published = $request->input('Product.published', 0);
			$product->availability = $request->input('Product.availability', 'instock');
			$product->created_by = $user->id;
			$product->save();

			// sync productCategories
			$categories =  $request->input('Product.productCategories', []);
			if (count($categories) > 0) {
				$product->productCategories()->attach($categories);
			}

			// sync productTypes
			$productTypes =  $request->input('Product.productTypes', []);
			if (count($productTypes) > 0) {
				$product->productTypes()->attach($productTypes);
			}

			// sync productColors
			$productColors =  $request->input('Product.productColors', []);
			if (count($productColors) > 0) {
				$product->productColors()->attach($productColors);
			}

			// sync productSizes
			$productSizes =  $request->input('Product.productSizes', []);
			if (count($productSizes) > 0) {
				$product->productSizes()->attach($productSizes);
			}

			// sync tags
			$tags =  $request->input('Product.tags', []);
			if (count($tags) > 0) {
				$product->tags()->attach($tags);
			}

			// sync related products
			$relatedProducts =  $request->input('Product.relatedProducts', []);
			if (count($relatedProducts) > 0) {
				$product->relatedProducts()->attach($relatedProducts);
			}

			// save attachments
			if ($request->input('Product.attachments') != "") {
				$requestAttachments = explode(',', $request->input('Product.attachments'));
				$attachments = [];
				foreach ($requestAttachments as $key => $value) {
					array_push($attachments, new Attachment([
						'path' => $value,
						'priority' => $key,
						'published' => 1
						]));
				}
				if (count($attachments) > 0) {
					$product->attachments()->saveMany($attachments);
				}
			}

			// save data languages
			foreach ($request->input('Product.ProductTranslation') as $locale => $value) {
				$product->translateOrNew($locale)->name = $request->input('Product.ProductTranslation.' .$locale. '.name');
				$product->translateOrNew($locale)->summary = $request->input('Product.ProductTranslation.' .$locale. '.summary');
				$product->translateOrNew($locale)->description = $request->input('Product.ProductTranslation.' .$locale. '.description');
				$product->translateOrNew($locale)->additional_information = $request->input('Product.ProductTranslation.' .$locale. '.additional_information');
				$product->translateOrNew($locale)->meta_description = $request->input('Product.ProductTranslation.' .$locale. '.meta_description');
				$product->translateOrNew($locale)->meta_keywords = $request->input('Product.ProductTranslation.' .$locale. '.meta_keywords');
			}

			$product->save();

		});

		$product->load('attachments', 'productCategories', 'productTypes', 'tags');

		if ($request->ajax()) {
			return response()->json($product->toArray());
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
		$product = Product::findOrFail($id);
		$this->authorize('view', $product);
		$product->load('translations', 'productCategories', 'productTypes', 'productColors', 'productSizes', 'tags', 'relatedProducts', 'attachments', 'userCreated', 'userUpdated');
		return response()->json($product->toArray());
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$product = Product::findOrFail($id);
		$this->authorize('update', $product);
		return redirect()->route('products.index');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(ProductRequest $request, $id)
	{
		$product = Product::findOrFail($id);
		$this->authorize('update', $product);

		// find language default
		$languageDefault = Language::where('is_key_language', 1)->first();
		if (is_null($languageDefault)) {
			$languageDefault = Language::first();
		}

		// sure execute success, if not success rollback
		DB::transaction(function () use ($request, $product, $languageDefault) {
			$user = Auth::user();

			$product->key = Common::createKeyURL($request->input('Product.ProductTranslation.'.$languageDefault->code.'.name'));
			$product->code = $request->input('Product.code');
			$product->model = $request->input('Product.model');
			$product->custom_size = $request->input('Product.custom_size');
			$product->producer_id = $request->input('Product.producer_id');
			$product->origin = $request->input('Product.origin');
			$product->unit = $request->input('Product.unit');
			$product->price = $request->input('Product.price', 0);
			$product->sale_price = $request->input('Product.sale_price', 0);
			$product->sale_ratio = $request->input('Product.sale_ratio', 0);
			$product->warranty = $request->input('Product.warranty');
			$product->priority = $request->input('Product.priority', 0);
			$product->published = $request->input('Product.published', 0);
			$product->availability = $request->input('Product.availability', 'instock');
			$product->updated_by = $user->id;
			$product->save();

			// sync productCategories
			$product->productCategories()->detach();
			$categories =  $request->input('Product.productCategories', []);
			if (count($categories) > 0) {
				$product->productCategories()->attach($categories);
			}

			// sync productTypes
			$product->productTypes()->detach();
			$productTypes =  $request->input('Product.productTypes', []);
			if (count($productTypes) > 0) {
				$product->productTypes()->attach($productTypes);
			}

			// sync productColors
			$product->productColors()->detach();
			$productColors =  $request->input('Product.productColors', []);
			if (count($productColors) > 0) {
				$product->productColors()->attach($productColors);
			}

			// sync productSizes
			$product->productSizes()->detach();
			$productSizes =  $request->input('Product.productSizes', []);
			if (count($productSizes) > 0) {
				$product->productSizes()->attach($productSizes);
			}

			// sync tags
			$product->tags()->detach();
			$tags =  $request->input('Product.tags', []);
			if (count($tags) > 0) {
				$product->tags()->attach($tags);
			}

			// sync related products
			$product->relatedProducts()->detach();
			$relatedProducts =  $request->input('Product.relatedProducts', []);
			if (count($relatedProducts) > 0) {
				$product->relatedProducts()->attach($relatedProducts);
			}

			// save attachments
			if ($request->input('Product.attachments') != "") {
				$paths = preg_replace('/\d+\|/', '', $request->input('Product.attachments'));
				$paths = explode(',', $paths);

				$insertAttachments = [];
				foreach ($paths as $key => $path) {
					// find by path
					$attachment = $product->attachments()->where('path', $path)->first();
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
					$product->attachments()->saveMany($insertAttachments);
				}
				$product->attachments()->whereNotIn('path', $paths)->delete();
			}

			// save data languages
			foreach ($request->input('Product.ProductTranslation') as $locale => $value) {
				$product->translateOrNew($locale)->name = $request->input('Product.ProductTranslation.' .$locale. '.name');
				$product->translateOrNew($locale)->summary = $request->input('Product.ProductTranslation.' .$locale. '.summary');
				$product->translateOrNew($locale)->description = $request->input('Product.ProductTranslation.' .$locale. '.description');
				$product->translateOrNew($locale)->additional_information = $request->input('Product.ProductTranslation.' .$locale. '.additional_information');
				$product->translateOrNew($locale)->meta_description = $request->input('Product.ProductTranslation.' .$locale. '.meta_description');
				$product->translateOrNew($locale)->meta_keywords = $request->input('Product.ProductTranslation.' .$locale. '.meta_keywords');
			}

			$product->save();

		});

		$product->load('attachments', 'productCategories', 'productTypes', 'tags');

		if ($request->ajax()) {
			return response()->json($product->toArray());
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
		$product = Product::findOrFail($id);
		$this->authorize('destroy', $product);

		DB::transaction(function () use ($product) {
			$user = Auth::user();
			$product->deleted_by = $user->id;
			$product->key = $product->key.'-'.microtime(true);
			$product->save();

			// soft delete
			$product->delete();
		});
	}

	public function filter(ProductRequest $request)
	{
		if ($request->ajax()) {
			$type = $request->input('type', '');
			if ($type == 'dropdown') {
				$multiple = $request->input('multiple', 'false');
				$ids = $request->input('ids', '');
				$search = $request->input('search', '');

				if ($multiple == 'false') {
					$products = Product::all();
					return response()->json($products->toArray());
				}

				if ($ids != '') {
					$products = Product::whereIn('id', $ids)->get();
				}
				if ($search != '') {
					$products = Product::whereTranslationLike('name', '%'. $search .'%')->get();
				}
				
				return response()->json($products->toArray());
			}

			$products = Product::with('attachments', 'productCategories', 'productTypes', 'tags')->orderBy('priority')->get();
			return response()->json($products->toArray());
		}
	}
}
