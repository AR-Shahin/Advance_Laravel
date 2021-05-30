<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CropController extends Controller
{
    function index(){
        return view('crop.index');
    }
    public function store(Request $request)
    {


        $exploded_image = explode(";", $request->file);
        $exploded_image =  explode("/", $exploded_image[0]);
        $exploded_image_ext = $exploded_image[1];
        $fileName = time() . '_' . uniqid() . '.' . $exploded_image_ext;
        $imageUpload = new Image();
        $imageUpload->path = $fileName;
        $imageUpload->save();
        Storage::putFileAs("public/img", $request->file, $fileName);
        return  'public/img/' .$fileName;







  return  $fileName = time() . '_' . uniqid() . '.' . $request->file->getClientOriginalExtension();











        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('images'), $imageName);

        $imageUpload = new Image();
        $imageUpload->path = $imageName;
        $imageUpload->save();
        return response()->json(['success' => $imageName]);
    }
}
