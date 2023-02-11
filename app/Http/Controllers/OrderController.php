<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {          
        $taxRate = 0.16;
        try {
            
            $orderItems = $request->orderItems;

            $productIds = array_column($orderItems, 'productId');
            $products = Product::whereIn('id', $productIds)->get();

            $subTotal = 0;
            foreach ($products as $product) {
                $productInCart = $orderItems[array_search($product->id, $productIds)];

                if(!$productInCart) {
                    return response()->json([
                        'message' => 'El producto no existe',
                    ], 400);
                }

                $subTotal += $product->price * $productInCart['quantity'];
            }
            
            $backEndTotal = $subTotal + ($subTotal * $taxRate);

            if ($request->total !== $backEndTotal) {
                return response()->json([
                    'message' => 'El total no cuadra con el monto',
                ], 400);
            }

            $order = new Order();
            $order->userId = Auth::user()->id;
            $order->isPaid = false;
            $order->subTotal = $request->subTotal;
            $order->tax = $request->tax;
            $order->total = round($request->total, 2);
            $order->numberOfItems = $request->numberOfItems;
            $order->save();

            foreach ($products as $product) {
                $productId = $product['productId'];
                $quantity = $product['quantity'];
                $price = $product['price'];
                $order
                    ->products()
                    ->attach($productId, [
                        'quantity' => $quantity, 
                        'price' => $price, 
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now() 
                    ]
                );

            }        

            return response()->json($order, 201);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error al crear el pedido',
            ], 500);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
