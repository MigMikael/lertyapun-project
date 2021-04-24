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
        DB::table('products')->insert([
            'slug' => 'P-0000001',
            'name' => 'SOLMAX KID 60ML(องุ่น)',
            'description' => 'SOLMAX KID 60ML(องุ่น)',
            'price' => 0,
            'point' => 0,
            'quantity' => 500,
            'unit' => 'ขวด',
            'image_id' => 4,
            'status' => 'active',
            'weight' => 50
        ]);
        DB::table('product_units')->insert([
            'product_id' => 1,
            'unitName' => 'ขวด',
            'pricePerUnit' => 47,
            'quantityPerUnit' => 1,
        ]);
        DB::table('product_units')->insert([
            'product_id' => 1,
            'unitName' => 'กล่อง',
            'pricePerUnit' => 450,
            'quantityPerUnit' => 10,
        ]);



        DB::table('images')->insert([
            'slug' => (new StringGenerator())->generateSlug(),
            'name' => 're_cp_php9660.tmp.png',
            'mime' => 'image/png',
            'original_name' => 'img_5338.png',
        ]);
        DB::table('products')->insert([
            'slug' => 'P-0000002',
            'name' => 'KRESSLOG ORALPASTE 5G.',
            'description' => 'KRESSLOG ORALPASTE 5G.',
            'price' => 0,
            'point' => 0,
            'quantity' => 480,
            'unit' => 'หลอด',
            'image_id' => 5,
            'status' => 'active',
            'weight' => 7
        ]);
        DB::table('product_units')->insert([
            'product_id' => 2,
            'unitName' => 'หลอด',
            'pricePerUnit' => 16.75,
            'quantityPerUnit' => 1,
        ]);
        DB::table('product_units')->insert([
            'product_id' => 2,
            'unitName' => 'โหล',
            'pricePerUnit' => 192,
            'quantityPerUnit' => 12,
        ]);
        DB::table('product_units')->insert([
            'product_id' => 2,
            'unitName' => 'แพ็ค',
            'pricePerUnit' => 760,
            'quantityPerUnit' => 48,
        ]);
    }
}
