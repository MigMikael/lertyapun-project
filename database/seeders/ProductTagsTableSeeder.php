<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTagsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('product_tags')->delete();

        DB::table('product_tags')->insert(array (
            0 =>
            array (
                'id' => 1,
                'created_at' => '2021-02-11 09:50:23',
                'updated_at' => '2021-02-11 09:50:23',
                'product_id' => 2,
                'tag_id' => 1,
            ),
        ));


    }
}
