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

        if($stateId != null) {
            $state = OrderPossibleState::find($stateId);
            $orders = $state->orders(); 
        }        
        if($startDate != null) {
            $startDate = Carbon::parse($startDate, "UTC");
            $startDate->setTime(23, 59, 59);
            $orders = $orders->where("created_at", ">=", $startDate);
        }
        if($endDate != null) {
            $endDate = Carbon::parse($endDate, "UTC");
            $endDate->setTime(23, 59, 59);
            $orders = $orders->where("created_at", "<=", $endDate);
        }
        if($clientName != null) {
            $orders = $orders->where("client_name", "LIKE", "%".$clientName."%");
        }
        if($clientPhone != null) {
            $orders = $orders->where("client_phone", "LIKE", "%".$clientPhone."%");
        }
        if($customId != null) {
            $orders = $orders->where("custom_id", "LIKE", $customId);
        }
        $orders = $orders->get();
        return response()->json(["orders" => $orders]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // for demo
        $order = Order::create([
            'user_placed' => 1,
            'client_name' => "Ahmed",
            "client_phone" => "34923490",
            "client_address" => "Testy"
        ]);
        $product = Product::create([
            'name' => "Test",
            "price" => 100.5,
            "description" => "Hello World"
        ]);

        $order->products()->attach($product, ['one_item_price' => 100.5, 'quantity' => 5]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
