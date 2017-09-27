<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use DateTime;
use Excel;
use App\Language;
use App\PromotionCode;
use App\Http\Requests\PromotionCodeRequest;

class PromotionCodeController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return view('backend.promotioncodes.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$this->authorize('create', PromotionCode::class);
		return redirect()->route('promotioncodes.index');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(PromotionCodeRequest $request)
	{
		$this->authorize('create', PromotionCode::class);

		$promotioncode = new PromotionCode;
		$promotioncode->code = $request->input('PromotionCode.code');
		$promotioncode->value_type = $request->input('PromotionCode.value_type', 0);
		$promotioncode->cash_value = $request->input('PromotionCode.cash_value', 0);
		$promotioncode->percent_value = $request->input('PromotionCode.percent_value', 0);
		$promotioncode->effective_date = DateTime::createFromFormat('Y-m-d', $request->input('PromotionCode.effective_date'));
		$promotioncode->expiry_date = DateTime::createFromFormat('Y-m-d', $request->input('PromotionCode.expiry_date'));
		$promotioncode->quantity = $request->input('PromotionCode.quantity', 0);
		$promotioncode->quantity_used = 0;
		$promotioncode->created_by = Auth::user()->id;
		$promotioncode->save();

		if ($request->ajax()) {
			return response()->json($promotioncode->toArray());
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
		$promotioncode = PromotionCode::findOrFail($id);
		$this->authorize('view', $promotioncode);
		$promotioncode->load('userCreated', 'userUpdated');
		return response()->json($promotioncode->toArray());
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$promotioncode = PromotionCode::findOrFail($id);
		$this->authorize('update', $promotioncode);
		return redirect()->route('promotioncodes.index');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(PromotionCodeRequest $request, $id)
	{
		$promotioncode = PromotionCode::findOrFail($id);
		$this->authorize('update', $promotioncode);

		$promotioncode->code = $request->input('PromotionCode.code');
		$promotioncode->value_type = $request->input('PromotionCode.value_type', 0);
		$promotioncode->cash_value = $request->input('PromotionCode.cash_value', 0);
		$promotioncode->percent_value = $request->input('PromotionCode.percent_value', 0);
		$promotioncode->effective_date = DateTime::createFromFormat('Y-m-d', $request->input('PromotionCode.effective_date'));
		$promotioncode->expiry_date = DateTime::createFromFormat('Y-m-d', $request->input('PromotionCode.expiry_date'));
		$promotioncode->quantity = $request->input('PromotionCode.quantity', 0);
		$promotioncode->updated_by = Auth::user()->id;
		$promotioncode->save();

		if ($request->ajax()) {
			return response()->json($promotioncode->toArray());
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
		$promotioncode = PromotionCode::findOrFail($id);
		$this->authorize('destroy', $promotioncode);

		$user = Auth::user();
		$promotioncode->deleted_by = $user->id;
		$promotioncode->save();

		// soft delete
		$promotioncode->delete();
	}

	public function filter(Request $request)
	{
		if ($request->ajax()) {
			$type = $request->input('type', '');
			if ($type == 'dropdown') {
				$multiple = $request->input('multiple', 'false');
				$ids = $request->input('ids', '');
				$search = $request->input('search', '');

				if ($multiple == 'false') {
					$promotioncode = PromotionCode::all();
					return response()->json($promotioncode->toArray());
				}

				if ($ids != '') {
					$promotioncode = PromotionCode::whereIn('id', $ids)->get();
				}
				if ($search != '') {
					$promotioncode = PromotionCode::where('code', '%'. $search .'%')->get();
				}
				
				return response()->json($promotioncode->toArray());
			}

			$promotioncode = PromotionCode::all();
			return response()->json($promotioncode->toArray());
		}
	}

	public function imports()
	{
		//$this->authorize('imports', Product::class);
		return view('backend.promotioncodes.imports');
	}

	public function importPromotionCodes(PromotionCodeRequest $request)
	{
		//return dd($request->file('PromotionCode.import_file'));
		$message = '';
		$errorcodes = '';

		if($request->hasFile('PromotionCode.import_file')){
			ini_set('max_execution_time', 300);
			config(['excel.import.dates.columns' => ['ngay_hieu_luc', 'ngay_het_han']]);

			//$path = storage_path('app/public/promotion_list.xls');
			$path = $request->file('PromotionCode.import_file')->path();
			Excel::filter('chunk')->load($path)->chunk(250, function($results)
			{
				foreach($results as $row)
				{
					try {
						//return dd($row['ngay_hieu_luc']->date);
						$promotioncode = new PromotionCode;
						$promotioncode->code = $row['ma_khuyen_mai'];
						$promotioncode->value_type = (bool)$row['tinh_theo'];
						$promotioncode->percent_value = $row['gia_tri'];
						$promotioncode->cash_value = $row['gia_tri_tien_mat'];
						$promotioncode->effective_date = $row['ngay_hieu_luc'];
						$promotioncode->expiry_date = $row['ngay_het_han'];
						$promotioncode->quantity = (int)$row['so_luong'];
						$promotioncode->created_by = Auth::user()->id;
						$promotioncode->save();
					} catch (Exception $e) {
						$errorcodes = $errorcodes . ', ' . $row['ma_khuyen_mai'];
					}
				}
			});

			config(['excel.import.dates.columns' => []]);
			$message = 'Import thành công!';
		}
		else{
			$message = 'Vui lòng upload file!';
		}
		if($errorcodes != '')
			$message =  'Những mã sau đã gặp lỗi trong quá trình import: ' . $errorcodes;
		return redirect(route('promotioncodes.importsform'))->with('status', $message);
	}
}
