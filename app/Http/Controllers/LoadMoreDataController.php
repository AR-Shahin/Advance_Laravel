<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;

class LoadMoreDataController extends Controller
{
    public function index(){
       // return Product::where('id','<=',5)->latest()->get();
        return view('load.index');
    }

    public function loadMoreData(Request $request)
    {
        //return $request->id;
        if ($request->id > 0) {
            //info($request->id);
            info('clicked');
            $data = Product::with('category')
                    ->where('id','<',$request->id)
                    ->orderBy('id','DESC')
                    ->limit(10)
                    ->get();
        } else {
            $data = Product::with('category')->limit(10)->orderBy('id', 'DESC')->get();
        }

        $output = '';
        $last_id = '';

        if (!$data->isEmpty()) {
            foreach ($data as $row) {
                $output .= '
                <div class="row">
                <div class="col-md-12">
                <span class="text-info">'.$row->id.'</span>
                <h3 class="text-info"><b>' . $row->name . '</b></h3>
                <p>' . $row->category->name . '</p>
                <hr />
                </div>
                </div>
                ';
                $last_id = $row->id ;
                info($last_id);
            }
            $output .= '
       <div id="load_more">
        <button type="button" name="load_more_button" class="btn btn-success form-control" data-id="' . $last_id . '" id="load_more_button">Load More</button>
        <span>Last : '.$last_id.'</span>
       </div>
       ';
        } else {
            $output .= '
       <div id="load_more">
        <button type="button" name="load_more_button" class="btn btn-info form-control">No Data Found</button>
       </div>
       ';
        }
        return $output;
    }

}
