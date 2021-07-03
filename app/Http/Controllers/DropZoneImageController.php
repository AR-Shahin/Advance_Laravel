<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Image;
use Illuminate\Http\Request;

class DropZoneImageController extends Controller
{
    public function index()
    {
        return view('dropzone.index');
    }
    public function store(Request $request)
    {
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('images'), $imageName);

        $imageUpload = new Image();
        $imageUpload->path = $imageName;
        $imageUpload->save();
        return response()->json(['success' => $imageName]);
    }
    public function delete(Request $request)
    {
        $filename =  $request->get('filename');
        Image::where('path', $filename)->delete();
        $path = public_path() . '/images/' . $filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return $filename;
    }

    public function dropZoneWithData()
    {
        return view('dropzone.with-data');
    }

    public function dropZoneWithDataStore(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => 'required',
        ]);
        info('ok');
        $files = $request->file('file');
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => 555
        ]);
        foreach ($files as $file) {
            $imageName = $file->getClientOriginalName();
            $file->move(public_path('images'), $imageName);
            $im = new Image();
            $im->name = $user->name;
            $im->roll = 111;
            $im->path = time() . '.' . $imageName;
            $im->save();
        }

        return back();
    }
}
