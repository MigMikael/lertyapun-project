<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Helpers\StringGenerator;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('tags')->insert([
        //     'slug' => (new StringGenerator())->generateSlug(),
        //     'name' => 'ลด 5%',
        // ]);

        // DB::table('admins')->insert([
        //     'slug' => (new StringGenerator())->generateSlug(),
        //     'name' => 'ลด 10%',
        // ]);

        // DB::table('admins')->insert([
        //     'slug' => (new StringGenerator())->generateSlug(),
        //     'name' => 'ลด 20%',
        // ]);

        // DB::table('admins')->insert([
        //     'slug' => (new StringGenerator())->generateSlug(),
        //     'name' => 'ลด 30%',
        // ]);
    }
}
