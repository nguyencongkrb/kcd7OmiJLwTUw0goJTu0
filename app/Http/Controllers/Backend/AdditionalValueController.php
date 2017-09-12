<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use App\Language;
use App\AdditionalValue;
use App\Http\Requests\AdditionalValueRequest;

class AdditionalValueController extends Controller
{
    /**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return view('backend.additionalvalues.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$this->authorize('create', AdditionalValue::class);
		return redirect()->route('additionalvalues.index');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(AdditionalValueRequest $request)
	{
		$this->authorize('create', AdditionalValue::class);

		// find language generate key
		$languageDefault = Language::where('is_key_language', 1)->first();
		if (is_null($languageDefault)) {
			$languageDefault = Language::first();
		}

		$additionalValue = new AdditionalValue;

		// sure execute success, if not success rollback
		DB::transaction(function () use ($request, $languageDefault, $additionalValue) {
			$user = Auth::user();

			// insert AdditionalValue
			$additionalValue->additional_category_id = $request->input('AdditionalValue.additional_category_id', 0);
			$additionalValue->priority = $request->input('AdditionalValue.priority', 0);
			$additionalValue->published = $request->input('AdditionalValue.published', 0);
			$additionalValue->created_by = $user->id;
			$additionalValue->save();

			// save data languages
			foreach ($request->input('AdditionalValue.AdditionalValueTranslation') as $locale => $value) {
				$additionalValue->translateOrNew($locale)->name = $request->input('AdditionalValue.AdditionalValueTranslation.' .$locale. '.name');
				$additionalValue->translateOrNew($locale)->summary = $request->input('AdditionalValue.AdditionalValueTranslation.' .$locale. '.summary');
				$additionalValue->translateOrNew($locale)->content = $request->input('AdditionalValue.AdditionalValueTranslation.' .$locale. '.content');
			}

			$additionalValue->save();

		});

		if ($request->ajax()) {
			return response()->json($additionalValue->toArray());
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
		$additionalValue = AdditionalValue::findOrFail($id);

		$this->authorize('view', $additionalValue);
		$additionalValue->load('translations', 'userCreated', 'userUpdated');
		return response()->json($additionalValue->toArray());
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$additionalValue = AdditionalValue::findOrFail($id);
		$this->authorize('update', $additionalValue);
		return redirect()->route('additionalvalues.index');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(AdditionalValueRequest $request, $id)
	{
		$additionalValue = AdditionalValue::findOrFail($id);

		$this->authorize('update', $additionalValue);

		// find language default
		$languageDefault = Language::where('is_key_language', 1)->first();
		if (is_null($languageDefault)) {
			$languageDefault = Language::first();
		}

		// sure execute success, if not success rollback
		DB::transaction(function () use ($request, $additionalValue, $languageDefault) {
			$user = Auth::user();

			$additionalValue->additional_category_id = $request->input('AdditionalValue.additional_category_id', 0);
			$additionalValue->priority = $request->input('AdditionalValue.priority', 0);
			$additionalValue->published = $request->input('AdditionalValue.published', 0);
			$additionalValue->updated_by = $user->id;
			$additionalValue->save();

			// save data languages
			foreach ($request->input('AdditionalValue.AdditionalValueTranslation') as $locale => $value) {
				$additionalValue->translateOrNew($locale)->name = $request->input('AdditionalValue.AdditionalValueTranslation.' .$locale. '.name');
				$additionalValue->translateOrNew($locale)->summary = $request->input('AdditionalValue.AdditionalValueTranslation.' .$locale. '.summary');
				$additionalValue->translateOrNew($locale)->content = $request->input('AdditionalValue.AdditionalValueTranslation.' .$locale. '.content');
			}

			$additionalValue->save();

		});

		if ($request->ajax()) {
			return response()->json($additionalValue->toArray());
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
		$additionalValue = AdditionalValue::findOrFail($id);
		$this->authorize('destroy', $additionalValue);

		DB::transaction(function () use ($additionalValue) {
			$user = Auth::user();
			$additionalValue->deleted_by = $user->id;
			$additionalValue->save();

			// soft delete
			$additionalValue->delete();
		});
	}

	public function filter(AdditionalValueRequest $request)
	{
		if ($request->ajax()) {
			$type = $request->input('type', '');
			if ($type == 'dropdown') {
				$multiple = $request->input('multiple', 'false');
				$ids = $request->input('ids', '');
				$search = $request->input('search', '');

				if ($multiple == 'false') {
					$additionalValues = AdditionalValue::all();
					return response()->json($additionalValues->toArray());
				}

				if ($ids != '') {
					$additionalValues = AdditionalValue::whereIn('id', $ids)->get();
				}
				if ($search != '') {
					$additionalValues = AdditionalValue::whereTranslationLike('name', '%'. $search .'%')->get();
				}
				
				return response()->json($additionalValues->toArray());
			}

			$additionalValues = AdditionalValue::orderBy('priority')->get();
			return response()->json($additionalValues->toArray());
		}
	}

	public function buildJsHiddenControls()
	{
		$hiddenControlCategory = 1;
		$hiddenControls = AdditionalValue::where('additional_category_id', $hiddenControlCategory)->where('published', 1)->get();
		return response()->view('backend.partials.jshiddencontrols',compact('hiddenControls'))->header('Content-Type', 'text/javascript');
	}
}
