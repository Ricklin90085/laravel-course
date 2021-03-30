<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'title' => '測試資料',
            'content' => '測試內容',
            'price' => rand(0, 500),
            'quantity' => 150
        ]);
        Product::create([
            'title' => '測試資料1',
            'content' => '測試內容',
            'price' => rand(0, 500),
            'quantity' => 150
        ]);
        Product::create([
            'title' => '測試資料2',
            'content' => '測試內容',
            'price' => rand(0, 500),
            'quantity' => 150
        ]);

        $this->call(ProductSeeder::class);
        $this->command->info('建立 Product 資料');
    }
}
