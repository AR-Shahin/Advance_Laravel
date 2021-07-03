<?php

namespace App\Http\Controllers;

use App\Models\Vue;
use Illuminate\Http\Request;

class VueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return response()->json(Vue::latest()->get());
        }
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data =  Vue::create($request->title);
        return response()->json($data);
    }

    public function update(Request $request, Vue $vue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vue  $vue
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vue $vue)
    {
        $vue->delete();
    }
}
