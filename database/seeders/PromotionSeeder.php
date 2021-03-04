<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Helpers\StringGenerator;
use Carbon\Carbon;

class PromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('promotions')->insert([
            'slug' => (new StringGenerator())->generateSlug(),
            'name' => 'ลด 5%',
            'type' => 'discount',
            'valid_start' => Carbon::now(),
            'valid_start' => Carbon::now(),
        ]);

        DB::table('promotions')->insert([
            'slug' => (new StringGenerator())->generateSlug(),
            'name' => 'ลด 10%',
            'type' => 'discount',
            'valid_start' => Carbon::now(),
            'valid_start' => Carbon::now(),
        ]);

        DB::table('promotions')->insert([
            'slug' => (new StringGenerator())->generateSlug(),
            'name' => 'ลด 20%',
            'type' => 'discount',
            'valid_start' => Carbon::now(),
            'valid_start' => Carbon::now(),
        ]);

        DB::table('promotions')->insert([
            'slug' => (new StringGenerator())->generateSlug(),
            'name' => 'ลด 30%',
            'type' => 'discount',
            'valid_start' => Carbon::now(),
            'valid_start' => Carbon::now(),
        ]);
    }
}
