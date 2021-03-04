<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Helpers\StringGenerator;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'slug' => (new StringGenerator())->generateSlug(),
            'name' => '',
        ]);

        DB::table('categories')->insert([
            'slug' => (new StringGenerator())->generateSlug(),
            'name' => 'เวชภัณฑ์',
        ]);

        DB::table('categories')->insert([
            'slug' => (new StringGenerator())->generateSlug(),
            'name' => 'เวชสำอางค์',
        ]);

        DB::table('categories')->insert([
            'slug' => (new StringGenerator())->generateSlug(),
            'name' => 'เครื่องมือแพทย์',
        ]);

        DB::table('categories')->insert([
            'slug' => (new StringGenerator())->generateSlug(),
            'name' => 'สินค้าทั่วไป',
        ]);

        DB::table('categories')->insert([
            'slug' => (new StringGenerator())->generateSlug(),
            'name' => 'ยาแผนโบราณ',
        ]);

        DB::table('categories')->insert([
            'slug' => (new StringGenerator())->generateSlug(),
            'name' => 'วิตามิน อาหารเสริม',
        ]);

        DB::table('categories')->insert([
            'slug' => (new StringGenerator())->generateSlug(),
            'name' => 'ยาสัตว์',
        ]);

        DB::table('categories')->insert([
            'slug' => (new StringGenerator())->generateSlug(),
            'name' => 'ยาฉีด',
        ]);

        DB::table('categories')->insert([
            'slug' => (new StringGenerator())->generateSlug(),
            'name' => 'ยาสามัญประจำบ้าน',
        ]);

        DB::table('categories')->insert([
            'slug' => (new StringGenerator())->generateSlug(),
            'name' => 'แชมพูเชื้อรา หิด เหา ผมร่วง',
        ]);

        DB::table('categories')->insert([
            'slug' => (new StringGenerator())->generateSlug(),
            'name' => 'ยาหู ตา จมูก',
        ]);

        DB::table('categories')->insert([
            'slug' => (new StringGenerator())->generateSlug(),
            'name' => 'ยาฮอร์โมน',
        ]);

        DB::table('categories')->insert([
            'slug' => (new StringGenerator())->generateSlug(),
            'name' => 'ยาทา พ่น แปะแก้ปวด',
        ]);

        DB::table('categories')->insert([
            'slug' => (new StringGenerator())->generateSlug(),
            'name' => 'ยาฆ่าเชื้อแบคทีเรีย รา ไวรัส',
        ]);

        DB::table('categories')->insert([
            'slug' => (new StringGenerator())->generateSlug(),
            'name' => 'ครีม ขี้ผึง โลชั่น ยาเหน็บ',
        ]);

        DB::table('categories')->insert([
            'slug' => (new StringGenerator())->generateSlug(),
            'name' => 'โรคเรื้อรัง',
        ]);

        DB::table('categories')->insert([
            'slug' => (new StringGenerator())->generateSlug(),
            'name' => 'ระบบประสาท สมอง',
        ]);

        DB::table('categories')->insert([
            'slug' => (new StringGenerator())->generateSlug(),
            'name' => 'ยาทางเดินอาหาร',
        ]);

        DB::table('categories')->insert([
            'slug' => (new StringGenerator())->generateSlug(),
            'name' => 'แก้ปวด ลดปวดเกร็ง',
        ]);

        DB::table('categories')->insert([
            'slug' => (new StringGenerator())->generateSlug(),
            'name' => 'ทางเดินหายใจ แก้ไอ แก้แพ้',
        ]);
    }
}
