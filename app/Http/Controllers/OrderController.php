<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\OrderPossibleState;
use App\Product;
use Carbon\Carbon;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $startDate = $request->startDate;
        $endDate = $request->endDate;
        $clientName = $request->clientName;
        $clientPhone = $request->clientPhone;
        $customId = $request->customId;
        $stateId = $request->stateId;
        $orders = Order::query();
        if ($startDate != null) {
            $startDate = Carbon::parse($startDate, "UTC");
            $startDate->setTime(23, 59, 59);
            $orders = $orders->where("created_at", ">=", $startDate);
        }
        if ($endDate != null) {
            $endDate = Carbon::parse($endDate, "UTC");
            $endDate->setTime(23, 59, 59);
            $orders = $orders->where("created_at", "<=", $endDate);
        }
        if ($clientName != null) {
            $orders = $orders->where("client_name", "LIKE", "%" . $clientName . "%");
        }
        if ($clientPhone != null) {
            $orders = $orders->where("client_phone", "LIKE", "%" . $clientPhone . "%");
        }
        if ($customId != null) {
            $orders = $orders->where("custom_id", "LIKE", $customId);
        }
        $orders = $orders->get();
        if ($stateId != null) {
            $orders = array_filter($orders->toArray(), function($order) use ($stateId) {
                $order = (object) $order;
                return $order->currentState['id'] == $stateId;
            });
        }
        return response()->json(["orders" => $orders]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = Order::create([
            'user_placed' => Auth::user()->id,
            'client_name' => $request->clientName,
            "client_phone" => $request->clientPhone,
            "client_address" => $request->clientAddress,
            "additional_info" => $request->additionalInfo
        ]);
        $product = Product::find($request->productId);
        $quantity = $request->quantity;
        $order->products()->attach($product, [
            'one_item_price' => $product->price,
            'quantity' => $quantity
        ]);

        return response()->json(["result" => "success"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(["order" => Order::find($id)]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        $order = $order->fill([
            'client_name' => $request->clientName,
            "client_phone" => $request->clientPhone,
            "client_address" => $request->clientAddress,
            "additional_info" => $request->additionalInfo
        ]);
        $order->save();
        $product = Product::find($request->productId);
        $quantity = $request->quantity;
        $order->products()->attach($product, [
            'one_item_price' => $product->price,
            'quantity' => $quantity
        ]);

        return response()->json(["result" => "success"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Order::find($id)->delete();
        return response()->json(["result" => "success"]);
    }
}
