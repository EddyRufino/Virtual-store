<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    public function show(Product $product)
    {
    	// $product = Product::findOrFail($product);
    	$images = $product->images;
    	
    	$imagesLeft = collect();
    	$imagesRight = collect();
    	foreach ($images as $key => $image) {
    		if ($key%2==0)
    			$imagesLeft->push($image);
    		else
    			$imagesRight->push($image);
    	}

    	// return view('products.show')->with(compact('product', 'imagesLeft', 'imagesRight'));
        return view('products.show', compact('product', 'imagesLeft', 'imagesRight'));
    }
}
