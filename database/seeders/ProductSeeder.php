<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Helpers\StringGenerator;
use Carbon\Carbon;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('images')->insert([
            'slug' => (new StringGenerator())->generateSlug(),
            'name' => 're_cp_phpF26F.tmp.png',
            'mime' => 'image/png',
            'original_name' => 'img_4754.png',
        ]);

        DB::table('images')->insert([
            'slug' => (new StringGenerator())->generateSlug(),
            'name' => 're_cp_php9660.tmp.png',
            'mime' => 'image/png',
            'original_name' => 'img_5338.png',
        ]);

        DB::table('products')->insert([
            'slug' => (new StringGenerator())->generateSlug(),
            'name' => 'SOLMAX KID 60ML(องุ่น)',
            'description' => 'SOLMAX KID 60ML(องุ่น)',
            'price' => 47,
            'point' => 0,
            'quantity' => 500,
            'unit' => 'ขวด',
            'image_id' => 4,
            'status' => 'active',
        ]);

        DB::table('products')->insert([
            'slug' => (new StringGenerator())->generateSlug(),
            'name' => 'KRESSLOG ORALPASTE 5G.',
            'description' => 'KRESSLOG ORALPASTE 5G.',
            'price' => 16.75,
            'point' => 0,
            'quantity' => 69,
            'unit' => 'หลอด',
            'image_id' => 5,
            'status' => 'active',
        ]);
    }
}
