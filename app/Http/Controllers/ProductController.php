<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    //

    function addProduct(Request $request)
    {
    	$product = new Product;
    	$product->name = $request->name;
    	$product->description = $request->description;
    	$product->price = $request->price;
    	$product->file_path=$request->file('file')->store('products');
    	$product->save();
        $result = array("status"=>"success");
    	return json_encode($result);

    }

    function productList()
    {
        return Product::all();
    }
}
