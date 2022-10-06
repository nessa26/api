<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderProduct;

class OrderProductController extends Controller
{
    public function index()
    {
       return response()->json([['orderProduct'=>OrderProduct::all()]],200);
    }

    public function show($id, Request $r)
    {
        return response()->json([['orderProduct'=>OrderProduct::find($id)]],200);
    }

    public function create(Request $r)
    {
        try {
            $orderProduct = OrderProduct::create([
                'id_order'=>$r->id_order,
                'id_product'=>$r->id_product
            ]);
            return response()->json(['message'=>'product and order created successfully']);
        } catch (\Exception $e) {
            return response()->json([$e -> getMessage()]);
        }
    }

    public function update($id, Request $r)
    {
        try{
            $orderProduct = OrderProduct::find($id);
            $orderProduct->update($r->all());
            return response()->json(['message'=>'product and order updated successfully']);
        }catch(\Exception $e){
            return response()->json([$e -> getMessage()]);
        }
    }

    public function delete($id, Request $r)
    {
        $orderProduct = OrderProduct::find($id);
        $orderProduct ->delete($r->all());
        return response()->json(['message'=>'product and order deleted successfully']);
    }
}
