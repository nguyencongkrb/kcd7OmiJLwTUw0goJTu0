<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use DateTime;
use App\Common;
use App\Language;
use App\Attachment;
use App\Province;
use App\Http\Requests\ProvinceRequest;

class ProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function filter(ProvinceRequest $request)
    {
        if ($request->ajax()) {
            $type = $request->input('type', '');
            if ($type == 'dropdown') {
                $multiple = $request->input('multiple', 'false');
                $ids = $request->input('ids', '');
                $search = $request->input('search', '');

                if ($multiple == 'false') {
                    $provinces = Province::all();
                    return response()->json($provinces->toArray());
                }

                if ($ids != '') {
                    $provinces = Province::whereIn('id', $ids)->get();
                }
                if ($search != '') {
                    $provinces = Province::where('name', 'LIKE', '%'. $search .'%')->get();
                }
                
                return response()->json($provinces->toArray());
            }

            $provinces = Province::all();
            return response()->json($provinces->toArray());
        }
    }
}
