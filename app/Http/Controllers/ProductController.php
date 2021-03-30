<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data = DB::table('products')->get();
        // DB::enableQueryLog();
        $data = DB::table('products')->get();
        // dump(DB::getQueryLog());
        return response($data);
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
        $data = $this->getData();
        $newData = $request->all();
        $data->push(collect($newData));
        return response($data);
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
        $form = $request->all();
        $data = $this->getData();
        $selected = $data->where('id', $id)->first();
        $selected = $selected->merge(collect($form));
        return response($selected);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->getData();
        $data = $data->filter(function($product) use ($id) {
            return $product['id'] != $id;
        });
        return response($data->values());
    }

    public function getData() {
        return collect([
            collect([
                'id' => 0,
                'title' => '商品1',
                'content' => '商品描述1',
                'price' => 160
            ]),
            collect([
                'id' => 1,
                'title' => '商品2',
                'content' => '商品描述2',
                'price' => 161
            ]),
            collect([
                'id' => 2,
                'title' => '商品3',
                'content' => '商品描述3',
                'price' => 200
            ]),
            collect([
                'id' => 3,
                'title' => '商品4',
                'content' => '商品描述4',
                'price' => 800
            ])
        ]);
    }
}
