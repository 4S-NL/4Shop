<?php

namespace App\Http\Controllers;

use App\Product;
use App\Order_rule;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function set(Request $request)
    {
        if(session('type') == null && $request->route()->getName() != 'leden' && $request->route()->getName() != 'leiding')
        {
            return view('home');
        }

        //determine 'leden' or 'leiding'
        $type = $request->route()->getName();
        session(['type' => $type]);
        return redirect()->route('shop');
    }

    public function index()
    {
        $products = Product::where('active', true);
        if(session('type') == 'leden')
        { 
            $products = $products->where('leiding', false);
        }
        $products = $products->orderBy('leiding', 'desc')->get();
        
        return view('products.index')
                ->with(compact('products'));
    }

    public function show(Product $product)
    {
        return view('products.show')
                ->with(compact('product'));
    }

    public function order(Product $product, Request $request)
    {
        $rule = new Order_rule();
        $rule->product = $product;
        $rule->type = $request->type;
        $rule->size = $request->size;
        

        // $rule = array();
        // $rule['product'] = $product->id;
        // $rule['type'] = $request->type;
        // $rule['size'] = $request->size;

        $request->session()->push('cart', $rule);
        return redirect()->route('cart');
    }
}
