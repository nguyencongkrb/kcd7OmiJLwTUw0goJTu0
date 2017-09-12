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
use App\ProductSize;
use App\Http\Requests\ProductSizeRequest;

class ProductSizeController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return view('backend.productsizes.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$this->authorize('create', ProductSize::class);
		return redirect()->route('productsizes.index');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(ProductSizeRequest $request)
	{
		$this->authorize('create', ProductSize::class);

		// find language generate key
		$languageDefault = Language::where('is_key_language', 1)->first();
		if (is_null($languageDefault)) {
			$languageDefault = Language::first();
		}

		$productSize = new ProductSize;

		// sure execute success, if not success rollback
		DB::transaction(function () use ($request, $languageDefault, $productSize) {
			$user = Auth::user();

			// insert ProductSize
			$productSize->key = Common::createKeyURL($request->input('ProductSize.ProductSizeTranslation.'.$languageDefault->code.'.name'));
			$productSize->parent_id = $request->input('ProductSize.parent_id', 0);
			$productSize->priority = $request->input('ProductSize.priority', 0);
			$productSize->published = $request->input('ProductSize.published', 0);
			$productSize->created_by = $user->id;
			$productSize->save();

			// save attachments
			if ($request->input('ProductSize.attachments') != "") {
				$requestAttachments = explode(',', $request->input('ProductSize.attachments'));
				$attachments = [];
				foreach ($requestAttachments as $key => $value) {
					array_push($attachments, new Attachment([
						'path' => $value,
						'priority' => $key,
						'published' => 1
						]));
				}
				if (count($attachments) > 0) {
					$productSize->attachments()->saveMany($attachments);
				}
			}

			// save data languages
			foreach ($request->input('ProductSize.ProductSizeTranslation') as $locale => $value) {
				$productSize->translateOrNew($locale)->name = $request->input('ProductSize.ProductSizeTranslation.' .$locale. '.name');
				$productSize->translateOrNew($locale)->summary = $request->input('ProductSize.ProductSizeTranslation.' .$locale. '.summary');
				$productSize->translateOrNew($locale)->meta_description = $request->input('ProductSize.ProductSizeTranslation.' .$locale. '.meta_description');
				$productSize->translateOrNew($locale)->meta_keywords = $request->input('ProductSize.ProductSizeTranslation.' .$locale. '.meta_keywords');
			}

			$productSize->save();

		});

		$productSize->load('attachments');

		if ($request->ajax()) {
			return response()->json($productSize->toArray());
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
		$productSize = ProductSize::findOrFail($id);
		$this->authorize('view', $productSize);
		$productSize->load('translations', 'attachments', 'userCreated', 'userUpdated');
		return response()->json($productSize->toArray());
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$productSize = ProductSize::findOrFail($id);
		$this->authorize('update', $productSize);
		return redirect()->route('productsizes.index');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(ProductSizeRequest $request, $id)
	{
		$productSize = ProductSize::findOrFail($id);
		$this->authorize('update', $productSize);

		// find language default
		$languageDefault = Language::where('is_key_language', 1)->first();
		if (is_null($languageDefault)) {
			$languageDefault = Language::first();
		}

		// sure execute success, if not success rollback
		DB::transaction(function () use ($request, $productSize, $languageDefault) {
			$user = Auth::user();

			if (!$productSize->not_delete) {
				$productSize->key = Common::createKeyURL($request->input('ProductSize.ProductSizeTranslation.'.$languageDefault->code.'.name'));
			}
			$productSize->parent_id = $request->input('ProductSize.parent_id', 0);
			$productSize->priority = $request->input('ProductSize.priority', 0);
			$productSize->published = $request->input('ProductSize.published', 0);
			$productSize->updated_by = $user->id;
			$productSize->save();

			// save attachments
			if ($request->input('ProductSize.attachments') != "") {
				$paths = preg_replace('/\d+\|/', '', $request->input('ProductSize.attachments'));
				$paths = explode(',', $paths);

				$insertAttachments = [];
				foreach ($paths as $key => $path) {
					// find by path
					$attachment = $productSize->attachments()->where('path', $path)->first();
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
					$productSize->attachments()->saveMany($insertAttachments);
				}
				$productSize->attachments()->whereNotIn('path', $paths)->delete();
			}

			// save data languages
			foreach ($request->input('ProductSize.ProductSizeTranslation') as $locale => $value) {
				$productSize->translateOrNew($locale)->name = $request->input('ProductSize.ProductSizeTranslation.' .$locale. '.name');
				$productSize->translateOrNew($locale)->summary = $request->input('ProductSize.ProductSizeTranslation.' .$locale. '.summary');
				$productSize->translateOrNew($locale)->meta_description = $request->input('ProductSize.ProductSizeTranslation.' .$locale. '.meta_description');
				$productSize->translateOrNew($locale)->meta_keywords = $request->input('ProductSize.ProductSizeTranslation.' .$locale. '.meta_keywords');
			}

			$productSize->save();

		});

		$productSize->load('attachments');

		if ($request->ajax()) {
			return response()->json($productSize->toArray());
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
		$productSize = ProductSize::findOrFail($id);
		$this->authorize('destroy', $productSize);

		DB::transaction(function () use ($productSize) {
			$user = Auth::user();
			$productSize->deleted_by = $user->id;
			$productSize->key = $productSize->key.'-'.microtime(true);
			$productSize->save();

			// soft delete
			$productSize->delete();
		});
	}

	public function filter(ProductSizeRequest $request)
	{
		if ($request->ajax()) {
			$type = $request->input('type', '');
			if ($type == 'dropdown') {
				$multiple = $request->input('multiple', 'false');
				$ids = $request->input('ids', '');
				$search = $request->input('search', '');

				if ($multiple == 'false') {
					$productSizes = ProductSize::all();
					return response()->json($productSizes->toArray());
				}

				if ($ids != '') {
					$productSizes = ProductSize::whereIn('id', $ids)->get();
				}
				if ($search != '') {
					$productSizes = ProductSize::whereTranslationLike('name', '%'. $search .'%')->get();
				}
				
				return response()->json($productSizes->toArray());
			}

			$productSizes = ProductSize::with('attachments')->orderBy('priority')->get();
			return response()->json($productSizes->toArray());
		}
	}
}
