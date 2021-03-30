<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Query Builder
        // $carts = DB::table('carts')->get()->first();
        // if (empty($carts)) {
        //     DB::table('carts')->insert(['created_at' => now(),
        //                                 'updated_at' => now()]);
        //     $carts = DB::table('carts')->get()->first();
        // }
        // $cart_item = DB::table('cart_items')->where('cart_id', $carts->id)->get();
        // $carts = collect($carts);
        // $carts['items'] = collect($cart_item);

        $user = auth()->user();
        // with 可以載入有建立關聯的資料
        // firstOrCreate 顧名思義就是取得第一筆資料，如果沒有的話就 Create 一個新的
        $carts = Cart::with('cartItems')->where('user_id', $user->id)->firstOrCreate([ 'user_id' => $user->id ]);
        return response($carts);
    }

    public function checkout()
    {
        $user = auth()->user();

        // 可以順便把 cartItems 撈出來
        $cart = $user->carts()->where('checked', false)->with('cartItems')->first();

        if ($cart) {
            // 有購物車的話就執行 Model 裡 checkout 的 function
            $result = $cart->checkout();
            return response($result);
        } else {
            return response('沒有購物車！', 400);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
