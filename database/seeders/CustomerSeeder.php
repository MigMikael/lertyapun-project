<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Helpers\StringGenerator;
use Carbon\Carbon;

class CustomerSeeder extends Seeder
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
            'name' => 're_cp_phpA6BB.tmp.PNG',
            'mime' => 'image/png',
            'original_name' => 'tay.PNG',
        ]);

        DB::table('images')->insert([
            'slug' => (new StringGenerator())->generateSlug(),
            'name' => 're_cp_phpA5A4.tmp.PNG',
            'mime' => 'image/png',
            'original_name' => 'steve.PNG',
        ]);

        DB::table('images')->insert([
            'slug' => (new StringGenerator())->generateSlug(),
            'name' => 're_cp_phpF7E1.tmp.jpg',
            'mime' => 'image/jpg',
            'original_name' => 'cert.jpg',
        ]);

        DB::table('customers')->insert([
            'slug' => (new StringGenerator())->generateSlug(),
            'first_name' => 'Tawan',
            'last_name' => 'Vihokratana(Test)',
            'email' => 'tawan@test.com',
            'phone' => '0855554444',
            'password' => Hash::make("12345678"),
            'status' => 'active',
            'point' => 0,
            'remark' => '',
            'avatar_image' => 1,
            'citizen_card_image' => 3,
            'drug_store_approve_image' => 3,
            'medical_license_image' => 3,
        ]);

        DB::table('customers')->insert([
            'slug' => (new StringGenerator())->generateSlug(),
            'first_name' => 'Steve',
            'last_name' => 'Rogers(Test)',
            'email' => 'steve@test.com',
            'phone' => '0877773333',
            'password' => Hash::make("12345678"),
            'status' => 'pending',
            'point' => 0,
            'remark' => '',
            'avatar_image' => 2,
            'citizen_card_image' => 3,
            'drug_store_approve_image' => 3,
            'medical_license_image' => 3,
        ]);
    }
}
