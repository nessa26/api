<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderProduct;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\Product;

class OrderController extends Controller
{
    public function index()
    {

        try {
            $orders = Order::with(['order_product','users'])->get();
            return response()->json($orders, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 400);
        }
    //    return response()->json([['orders'=>Order::all()]],200);
    }

    // public function show($id, Request $r)
    public function show($reference)
    {
        try {
            $order = Order::with(['order_product', 'users'])->where('reference', $reference)->first();
            return response()->json([
                'order' => $order
            ],200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 400);
        }
        // return response()->json([['orders'=>Order::find($id)]],200);
    }

    public function create(Request $r)
    {
        try {
            $reference = Str::random(10) . '_' . Carbon::now();
            $r->validate([
                'id_user' => 'required|numeric',
                'products' => 'required|array', // [ {id: 1, quantity:10}]
            ]);
            $order = Order::create([
                'reference' => $reference,
                'id_user' => $r->id_user,
            ]);

            $subtotal = 0;
            $total = 0;
            foreach ($r->$products as $product)
            {
                $price = Product::find($product['id'])->price;
                $orderItem = OrderProduct::create([
                    'id_order' => $order->id,
                    'id_product' => $product['id'],
                    'quantity' => $product['quantity']
                ]);
                $subtotal = $subtotal + ($price * $orderItem->quantity);
            }
            $total = $total + ($subtotal * 1.19);
            $order->total = $total;
            $order->subtotal = $subtotal;
            $order->save();
            return response()->json([
                'order' => $order
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 400);
        }
    
        // try {
        //     $order = Order::create([
        //         'total'=>$r->total,
        //         'id_user'=>$r->id_user,
        //     ]);
        //     return response()->json(['message'=>'Order created successfully']);
        // } catch (\Exception $e) {
        //     return response()->json([$e -> getMessage()]);
        // }

    }

    public function update($id, Request $r)
    {
        try{
            $order = Order::find($id);
            $order->update($r->all());
            return response()->json(['message'=>'Order updated successfully']);
        }catch(\Exception $e){
            return response()->json([$e -> getMessage()]);
        }
    }

    public function delete($id, Request $r)
    {
        $order = Order::find($id);
        $order ->delete($r->all());
        return response()->json(['message'=>'Order deleted successfully']);
    }
}