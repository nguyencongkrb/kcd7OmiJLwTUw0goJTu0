<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Attachment;
use Auth;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;

class UploadController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$controlname = $request->get('name', 'upload');	// "upload" is controlname of CKeditor

		 // getting all of the post data
		$file = array($controlname => $request->file($controlname));
		// setting up rules
		$rules = array('image' => 'mimes:jpg,jpeg,gif,png,pdf,rar,zip,7z,doc,docx,xls,xlsx,txt|max:5120');
		// doing the validation, passing post data, rules and the messages
		$validator = Validator::make($file, $rules);
		if ($validator->fails()) {
			// send back to the page with the input data and errors
			return $results = [
			'error' => $validator->messages()->toArray()
			];
		}
		else {
			if ($request->hasFile($controlname)) {
				// checking file is valid.
				if ($request->file($controlname)->isValid()) {					
					$path = $request->file($controlname)->store('uploads', 'public');

					// only 2 position upload: ckeditor & InputImages
					if ($controlname == 'upload') {	// is CKeditor
						$results = 'storage/'.$path;
					}
					else{
						$path = str_replace('uploads', '', $path);
						$results = [
						'initialPreview' => ['<img src="/imagecache/small' .$path. '" class="file-preview-image">',]
						];
					}

					return $results;
				}
				else {
					// sending back with error message.
					return $results = [
					'error' => 'Lỗi trong quá trình upload.'
					];
				}
			}
			else{
				return $results = [
				'error' => 'Không nhận được dữ liệu.['.$controlname.']'
				];
			}
		}
	}

	public function destroy(Request $request)
	{		
		$attachmentId = $request->get('key');
		$filePath = $request->get('path');
		$attachment = Attachment::findOrFail($attachmentId);

		if(!is_null($filePath) && $filePath == $attachment->path){
			$attachment->delete();
			//Storage::disk('public')->delete($filePath);
			return response()->json([]);
		}
		else{
			abort(400, 'Bad Request');
		}
	}
}
