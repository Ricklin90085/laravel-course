<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * 第一個參數傳入要修改的資料
         * 第二個參數設定 Primary Key，如果存在的話就更新，若無則新增
         * 第三個參數設定可以更改的欄位
         */
        Product::upsert([
            [
                'id' => 8,
                'title' => '固定資料',
                'content' => '固定內容',
                'price' => rand(0, 500),
                'quantity' => 150
            ],
            [
                'id' => 9,
                'title' => '固定資料1',
                'content' => '固定內容1',
                'price' => rand(0, 500),
                'quantity' => 150
            ]
        ], ['id'], ['quantity', 'price']);
    }
}
