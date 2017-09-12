<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Language;

class LanguageController extends Controller
{
	public function index()
	{
		return response()->json(Language::all());
	}
}
