<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('tags')->delete();

        DB::table('tags')->insert(array (
            0 =>
            array (
                'id' => 1,
                'created_at' => '2021-02-11 09:46:59',
                'updated_at' => '2021-02-11 09:46:59',
                'slug' => 'CNu5Wq9fbHajnccBzS7LBIDIFD6Hg6pt0cdd7Emy',
                'name' => 'ซื้อหนึ่งแถมหนึ่ง',
            ),
            1 =>
            array (
                'id' => 2,
                'created_at' => '2021-02-11 09:47:12',
                'updated_at' => '2021-02-11 09:47:12',
                'slug' => 'TK4EhLTjGGc9OHZ9De14EOC9VD0q7bltO8vI1ufb',
                'name' => 'Flash Sale',
            ),
            2 =>
            array (
                'id' => 3,
                'created_at' => '2021-02-11 09:47:24',
                'updated_at' => '2021-02-11 09:47:24',
                'slug' => '9jO6HzJGHEnbJOit9FFsPsSXEhYoCEjWbkHW2Hrj',
                'name' => 'ลดล้างสต็อก',
            ),
        ));


    }
}
