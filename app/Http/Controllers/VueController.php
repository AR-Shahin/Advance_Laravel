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
        return response()->json(Vue::latest()->get());
        // if ($request->ajax()) {
        //     return response()->json(Vue::latest()->get());
        // }
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'unique:vues']
        ]);
        $data =  Vue::create([
            'title' => $request->title
        ]);
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
    public function destroy(Vue $id)
    {
        $id->delete();
    }

    public function toggle(Request $request, Vue $id)
    {
        if ($request->flag === 'done') {
            $id->isDone = true;
        }
        if ($request->flag === 'undo') {
            $id->isDone = false;
        }
        $id->save();
    }
}
