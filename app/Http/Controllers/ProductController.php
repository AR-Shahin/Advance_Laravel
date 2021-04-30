<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = cache('products', function () {
            return Product::with('category')->get();
        });

        return view('product.product',[
            'products' => $products
        ]);
    }
    function create(){
        return view('product.create',['categories' => Category::all()]);
    }
    function store(Request $request){
     Product::create($request->all());
     return redirect(route('products.index'));
    }
}
