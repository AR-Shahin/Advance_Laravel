<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ScrollInfiniteController extends Controller
{
    function index(Request $request){

        $posts = Product::paginate(8);
        $data = '';
        if ($request->ajax()) {
            foreach ($posts as $post) {
                $data .= '<li>' . $post->id . ' <strong>' . $post->name . '</strong> : ';
            }
            return $data;
        }
        return view('infinite.index');
    }
}
