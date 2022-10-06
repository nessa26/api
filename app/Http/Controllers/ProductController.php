<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
       return response()->json([['products'=>Product::all()]],200);
    }

    public function show($id, Request $r)
    {
        return response()->json([['products'=>Product::find($id)]],200);
    }

    public function create(Request $r)
    {
        try {
            $product = Product::create([
                'cipher'=>$r->cipher,
                'name'=>$r->name,
                'description'=>$r->description,
                'price'=>$r->price,
                'quantity'=>$r->quantity
            ]);
            return response()->json(['message'=>'successfully created product']);
        } catch (\Exception $e) {
            return response()->json([$e -> getMessage()]);
        }
    }

    public function update($id, Request $r)
    {
        try{
            $product = Product::find($id);
            $product->update($r->all());
            return response()->json(['message'=>'product upgraded successfully']);
        }catch(\Exception $e){
            return response()->json([$e -> getMessage()]);
        }
    }

    public function delete($id, Request $r)
    {
        $product = Product::find($id);
        $product ->delete($r->all());
        return response()->json(['message'=>'product removed successfully']);
    }
}
