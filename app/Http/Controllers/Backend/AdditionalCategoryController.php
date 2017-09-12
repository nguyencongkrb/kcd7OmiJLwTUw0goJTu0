<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use App\Language;
use App\AdditionalCategory;
use App\Http\Requests\AdditionalCategoryRequest;

class AdditionalCategoryController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		abort(404);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		abort(404);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(AdditionalCategoryRequest $request)
	{
		abort(404);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		abort(404);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		abort(404);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(AdditionalCategoryRequest $request, $id)
	{
		abort(404);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		abort(404);
	}

	public function filter(AdditionalCategoryRequest $request)
	{
		if ($request->ajax()) {
			$type = $request->input('type', '');
			if ($type == 'dropdown') {
				$multiple = $request->input('multiple', 'false');
				$ids = $request->input('ids', '');
				$search = $request->input('search', '');

				if ($multiple == 'false') {
					$AdditionalCategorys = AdditionalCategory::all();
					return response()->json($AdditionalCategorys->toArray());
				}

				if ($ids != '') {
					$AdditionalCategorys = AdditionalCategory::whereIn('id', $ids)->get();
				}
				if ($search != '') {
					$AdditionalCategorys = AdditionalCategory::where('name', 'LIKE', '%'. $search .'%')->get();
				}
				
				return response()->json($AdditionalCategorys->toArray());
			}

			$AdditionalCategorys = AdditionalCategory::all();
			return response()->json($AdditionalCategorys->toArray());
		}
	}
}
