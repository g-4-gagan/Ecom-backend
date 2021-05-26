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

    function deleteProduct($id)
    {
        $result = Product::where('id',$id)->delete();
        if ($result) 
        {
            return ['status'=>'success'];
        }
        else{
            return ['status'=>'fail'];
        }
        
    }

    function getProduct($id)
    {
        return Product::find($id);
    }

    function updateProduct($id,Request $request)
    {
        $product = Product::find($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        if ($request->file('file')) {
            $product->file_path=$request->file('file')->store('products');
        }
        $product->save();
        $result = array("status"=>"success");
        return json_encode($result);
    }

    function search($key)
    {
        return Product::where('name','LIKE',"%$key%")->get();
    }


}
