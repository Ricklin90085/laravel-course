<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UpdateCartItem;
use App\Models\Cart;
use App\Models\CartItem;
// use Illuminate\Support\Facades\DB;

class CartItemController extends Controller
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
        // 錯誤訊息
        $message = [
            'required' => ':attribute 為必填',
            'integer' => ':attribute 要是數字',
            'between' => ':attribute 的值 :input 並不在 :min - :max 之間'
        ];
        // 驗證
        $validator = Validator::make($request->all(), [
            'cart_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required|integer|between:1,10'
        ], $message);
        // 驗證失敗處理
        if ($validator->fails()) {
            return response($validator->errors(), 400);
        }
        // 取得驗證後的資料
        $validatedData = $validator->validate();

        // Model
        // 先找到 cart_id 對應到的 cart
        $cart = Cart::find($validatedData['cart_id']);
        $result = $cart->cartItems()
                        ->create(['product_id' => $validatedData['product_id'],
                                'quantity' => $validatedData['quantity']]);

        // Query Builder
        // $result = DB::table('cart_items')->insert(['cart_id' => $validatedData['cart_id'],
        //                                 'product_id' => $validatedData['product_id'],
        //                                 'quantity' => $validatedData['quantity'],
        //                                 'created_at' => now(),
        //                                 'updated_at' => now()]);
        return response()->json($result);
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
    public function update(UpdateCartItem $request, $id)
    {
        $form = $request->validated();

        // fill 可以將資料先存在 Model，但是不寫入資料庫
        // $cartItem = CartItem::find($id)->fill(['quantity' => $form['quantity']]);
        // 透過 save 寫入
        // $cartItem->save();

        // 使用 update 會直接更新＋寫入
        CartItem::find($id)->update(['quantity' => $form['quantity']]);

        // Query Builder
        // DB::table('cart_items')->where('id', $id)->update(['quantity' => $form['quantity'],
        //                                                     'updated_at' => now()]);
        return response()->json(true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // 在 Model 加入軟刪除後 delete 就會執行軟刪除
        // CartItem::find($id)->delete();
        // forceDelete() 可以強制刪除資料
        CartItem::find($id)->forceDelete();
        // DB::table('cart_items')->where('id', $id)->delete();
        return response()->json(true);
    }
}
