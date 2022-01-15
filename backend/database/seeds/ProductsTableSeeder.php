<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1 ; $i <= 25 ; $i++) {

            $product = new \App\Product();
            $product->name = $i .'番目の商品名';
            $product->amount = array_random([500, 1000, 1500]); // ランダム
            $product->sizes = array_random([ // ランダム
                ['M'],
                ['M', 'L'],
                ['S', 'M', 'L']
            ]);
            $product->save();

        }
    }
}
