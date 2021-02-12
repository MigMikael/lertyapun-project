<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('products')->delete();

        DB::table('products')->insert(array (
            0 =>
            array (
                'id' => 1,
                'created_at' => '2021-02-11 07:37:36',
                'updated_at' => '2021-02-11 07:37:36',
                'slug' => 'P4jtP8cCTS34CVM22XYy4WEEdnJx3aTSlDNEqjf2',
                'name' => 'Savvy',
                'description' => 'Savvy Tab',
                'price' => 1000.0,
                'point' => 100,
                'quantity' => 500,
                'unit' => 'Box',
                'image_id' => 1,
            ),
            1 =>
            array (
                'id' => 2,
                'created_at' => '2021-02-11 09:49:37',
                'updated_at' => '2021-02-11 09:49:37',
                'slug' => 'fmhLMoI3kO8zQ3tsNDmd0YPteMf6AgN4ydHyrmQd',
                'name' => 'Para',
                'description' => 'medicine',
                'price' => 20.0,
                'point' => 1,
                'quantity' => 500,
                'unit' => 'Box',
                'image_id' => 2,
            ),
            2 =>
            array (
                'id' => 3,
                'created_at' => '2021-02-12 07:42:40',
                'updated_at' => '2021-02-12 07:42:40',
                'slug' => 'g81TVBLPfNYEsug674qnneN8Bq4QnO431MbuT3yl',
                'name' => 'B Tab',
                'description' => 'test test',
                'price' => 100.0,
                'point' => 2,
                'quantity' => 500,
                'unit' => 'Box',
                'image_id' => 5,
            ),
        ));


    }
}
