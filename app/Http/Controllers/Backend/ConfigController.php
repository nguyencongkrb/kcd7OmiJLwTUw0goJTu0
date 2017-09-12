<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Storage;
use App\Config;
use App\ArticleCategory;
use App\Article;
use App\ProductCategory;
use App\Product;

class ConfigController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return view('backend.configs.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return redirect()->route('configs.index');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		return redirect()->route('configs.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$config = Config::findOrFail($id);
		$this->authorize('view', $config);
		return response()->json($config->toArray());
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		$config = Config::findOrFail($id);
		$this->authorize('view', $config);
		$config->value = $request->input('Config.value', '');
		$config->save();
		return response()->json($config->toArray());
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		return redirect()->route('configs.index');
	}

	public function filter(Request $request)
	{
		if ($request->ajax()) {
			$config = Config::orderBy('id', 'asc')->get();
			return response()->json($config->toArray());
		}
	}

	public function createSitemap()
	{
		// trang chu
		// lien he
		$sitemaps = [route('home'), route('contact')];

		// article categories
		$articleCategories = ArticleCategory::where('published', 1)->get();
		foreach ($articleCategories as $key => $category) {
			array_push($sitemaps, $category->getLink());
		}

		// articles
		$articles = Article::where('published', 1)->get();
		foreach ($articles as $key => $article) {
			array_push($sitemaps, $article->getLink());
		}

		// product categories
		$productCategories = ProductCategory::where('published', 1)->get();
		foreach ($productCategories as $key => $category) {
			array_push($sitemaps, $category->getLink());
		}

		// products
		$products = Product::where('published', 1)->get();
		foreach ($products as $key => $product) {
			array_push($sitemaps, $product->getLink());
		}
		
		Storage::disk('public_real')->put('sitemap.xml', view('backend.configs.sitemap', compact('sitemaps')));

		//return redirect('/sitemap.xml');
		//return response()->view('admin.dashboard.sitemap', compact('sitemaps'))->header('Content-Type', 'application/xml');
	}
}
