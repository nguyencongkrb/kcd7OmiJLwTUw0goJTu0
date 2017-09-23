<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Excel;
use App\Province;
use App\District;
use App\Ward;

class DashboardController extends Controller
{
	public function index()
	{
		//return view('backend.dashboard.index');
		return redirect()->route('articles.index');
	}

	public function importProvinces()
	{
		ini_set('max_execution_time', 300);

		Province::truncate();
		District::truncate();
		Ward::truncate();

		$filePath = storage_path('app/public/province_list.xls');
		Excel::filter('chunk')->load($filePath)->chunk(250, function($results)
		{
			foreach($results as $row)
			{
				// province import
				$province_id = (int)$row['ma_tp'];
				$province = Province::find($province_id);
				if(is_null($province)){
					$province = Province::create([
						'id' => $province_id,
						'name' => $row['tinh_thanh_pho']
					]);
				}

				// district import
				$district_id = (int)$row['ma_qh'];
				$district = District::find($district_id);
				if(is_null($district)){
					$district = District::create([
						'id' => $district_id,
						'province_id' => $province->id,
						'name' => $row['quan_huyen']
					]);
				}

				// district import
				$ward_id = (int)$row['ma_px'];
				$ward = Ward::find($ward_id);
				if(is_null($ward)){
					$ward = Ward::create([
						'id' => $ward_id,
						'district_id' => $district->id,
						'name' => $row['phuong_xa']
					]);
				}

				//return dd($ward);
			}
		});
		return 'mport done!';
	}
}
