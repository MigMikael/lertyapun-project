<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryProductsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('category_products')->delete();

        DB::table('category_products')->insert(array (
            0 =>
            array (
                'id' => 2,
                'created_at' => '2021-02-11 14:51:34',
                'updated_at' => '2021-02-11 14:51:34',
                'product_id' => 1,
                'category_id' => 3,
            ),
            1 =>
            array (
                'id' => 7,
                'created_at' => '2021-02-11 16:37:21',
                'updated_at' => '2021-02-11 16:37:21',
                'product_id' => 2,
                'category_id' => 8,
            ),
            2 =>
            array (
                'id' => 8,
                'created_at' => '2021-02-11 16:37:21',
                'updated_at' => '2021-02-11 16:37:21',
                'product_id' => 2,
                'category_id' => 3,
            ),
            3 =>
            array (
                'id' => 9,
                'created_at' => '2021-02-11 16:37:21',
                'updated_at' => '2021-02-11 16:37:21',
                'product_id' => 2,
                'category_id' => 1,
            ),
            4 =>
            array (
                'id' => 10,
                'created_at' => '2021-02-11 16:37:21',
                'updated_at' => '2021-02-11 16:37:21',
                'product_id' => 2,
                'category_id' => 12,
            ),
            5 =>
            array (
                'id' => 11,
                'created_at' => '2021-02-11 16:37:21',
                'updated_at' => '2021-02-11 16:37:21',
                'product_id' => 2,
                'category_id' => 10,
            ),
            6 =>
            array (
                'id' => 12,
                'created_at' => '2021-02-11 16:37:21',
                'updated_at' => '2021-02-11 16:37:21',
                'product_id' => 2,
                'category_id' => 9,
            ),
            7 =>
            array (
                'id' => 13,
                'created_at' => '2021-02-11 16:37:21',
                'updated_at' => '2021-02-11 16:37:21',
                'product_id' => 2,
                'category_id' => 2,
            ),
            8 =>
            array (
                'id' => 14,
                'created_at' => '2021-02-11 16:37:21',
                'updated_at' => '2021-02-11 16:37:21',
                'product_id' => 2,
                'category_id' => 4,
            ),
            9 =>
            array (
                'id' => 15,
                'created_at' => '2021-02-11 16:37:21',
                'updated_at' => '2021-02-11 16:37:21',
                'product_id' => 2,
                'category_id' => 5,
            ),
            10 =>
            array (
                'id' => 16,
                'created_at' => '2021-02-11 16:37:21',
                'updated_at' => '2021-02-11 16:37:21',
                'product_id' => 2,
                'category_id' => 7,
            ),
            11 =>
            array (
                'id' => 17,
                'created_at' => '2021-02-11 16:37:21',
                'updated_at' => '2021-02-11 16:37:21',
                'product_id' => 2,
                'category_id' => 6,
            ),
            12 =>
            array (
                'id' => 18,
                'created_at' => '2021-02-11 16:37:21',
                'updated_at' => '2021-02-11 16:37:21',
                'product_id' => 2,
                'category_id' => 11,
            ),
            13 =>
            array (
                'id' => 19,
                'created_at' => '2021-02-12 07:43:38',
                'updated_at' => '2021-02-12 07:43:38',
                'product_id' => 3,
                'category_id' => 3,
            ),
            14 =>
            array (
                'id' => 20,
                'created_at' => '2021-02-12 07:43:38',
                'updated_at' => '2021-02-12 07:43:38',
                'product_id' => 3,
                'category_id' => 8,
            ),
        ));


    }
}
