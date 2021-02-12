<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('images')->delete();

        DB::table('images')->insert(array (
            0 =>
            array (
                'id' => 1,
                'created_at' => '2021-02-11 07:37:35',
                'updated_at' => '2021-02-11 07:37:36',
                'slug' => 'opFC1Eovxdx9b4vcSixvc1v5WMgsk0m0hAQzM88O',
                'name' => 're_cp_phptlZfLS.png',
                'mime' => 'image/png',
                'original_name' => 'Logo.png',
            ),
            1 =>
            array (
                'id' => 2,
                'created_at' => '2021-02-11 09:49:37',
                'updated_at' => '2021-02-11 09:49:37',
                'slug' => 'DSDawJ1HtYZFHlFQVeMi7QVOE9SDY6ugiPph2ZtP',
                'name' => 're_cp_phpnpROwU.png',
                'mime' => 'image/png',
                'original_name' => 'Mathoyyfoxbith-08.png',
            ),
            2 =>
            array (
                'id' => 3,
                'created_at' => '2021-02-11 09:51:23',
                'updated_at' => '2021-02-11 09:51:23',
                'slug' => 'bCWHSeJD0adTnAZrEbqbUSmxE350kPeRPftc1DNb',
                'name' => 're_cp_phptC9aca.png',
                'mime' => 'image/png',
                'original_name' => 'Mathoyyfoxbith-08.png',
            ),
            3 =>
            array (
                'id' => 4,
                'created_at' => '2021-02-11 09:52:10',
                'updated_at' => '2021-02-11 09:52:10',
                'slug' => 'uG5R6EbEqdOf0OkVXELO3s1q1PP7mKoPJaE9PBlO',
                'name' => 're_cp_phpcHZGlH.png',
                'mime' => 'image/png',
                'original_name' => 'Mathoyyfoxbith-08@3x.png',
            ),
            4 =>
            array (
                'id' => 5,
                'created_at' => '2021-02-12 07:42:39',
                'updated_at' => '2021-02-12 07:42:40',
                'slug' => 'crOJzxjiVut6lbxiqOhSEbSB03CC6z7B6kjLPtc4',
                'name' => 're_cp_php8W1fZI.jpg',
                'mime' => 'image/jpeg',
                'original_name' => 'Doc_1_352794.jpg',
            ),
        ));


    }
}
