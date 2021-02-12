<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('categories')->delete();

        DB::table('categories')->insert(array (
            0 =>
            array (
                'id' => 1,
                'created_at' => '2021-02-11 09:46:19',
                'updated_at' => '2021-02-11 09:46:19',
                'slug' => 'Q7WPWXYe9RihyHgHLHsjOLCiil04xBeFdMOVxCWU',
                'name' => 'เวชสำอางค์',
            ),
            1 =>
            array (
                'id' => 2,
                'created_at' => '2021-02-11 09:46:33',
                'updated_at' => '2021-02-11 09:46:33',
                'slug' => 'eCgvphNH8ngihvhJA0hkEYitxM6PrNfdz5osVWGf',
                'name' => 'เครื่องมือแพทย์',
            ),
            2 =>
            array (
                'id' => 3,
                'created_at' => '2021-02-11 09:50:12',
                'updated_at' => '2021-02-11 09:50:12',
                'slug' => 'mivG0v8GvWZINjqR6bPpsv1l0oe9MDBrs1WyrHwc',
                'name' => 'สินค้าทั่วไป',
            ),
            3 =>
            array (
                'id' => 4,
                'created_at' => '2021-02-11 15:22:11',
                'updated_at' => '2021-02-11 15:22:11',
                'slug' => 'LioRWWc3OAJIe3xcr8Pp8drJ2aR80MX2NW7XLHsf',
                'name' => 'ยาแผนโบราณ',
            ),
            4 =>
            array (
                'id' => 5,
                'created_at' => '2021-02-11 15:22:34',
                'updated_at' => '2021-02-11 15:22:34',
                'slug' => 'nmhxUr0aDHlMLhqOm8UQtSAkuLuoVRWT85xGy6yX',
                'name' => 'วิตามิน อาหารเสริม',
            ),
            5 =>
            array (
                'id' => 6,
                'created_at' => '2021-02-11 15:22:49',
                'updated_at' => '2021-02-11 15:22:49',
                'slug' => '2IyXtEfV1BqZNrHdmpWcaSfMQzIRpRHbSIH5Cy2G',
                'name' => 'ยาสัตว์',
            ),
            6 =>
            array (
                'id' => 7,
                'created_at' => '2021-02-11 15:22:58',
                'updated_at' => '2021-02-11 15:22:58',
                'slug' => 'JtotmRIT3k6FCZNZX7C7IsGYj5TdauSYQO35ndia',
                'name' => 'ยาฉีด',
            ),
            7 =>
            array (
                'id' => 8,
                'created_at' => '2021-02-11 15:23:13',
                'updated_at' => '2021-02-11 15:23:13',
                'slug' => 'CozwGR39gro6JYra5I3tYMfZe9tUzxUaPSdRwsLL',
                'name' => 'ยาสามัญประจำบ้าน',
            ),
            8 =>
            array (
                'id' => 9,
                'created_at' => '2021-02-11 15:24:54',
                'updated_at' => '2021-02-11 15:24:54',
                'slug' => 'DHlRebujwDRX4utoTa380DyzCWl7Byz44STTa4i4',
                'name' => 'แชมพูเชื้อรา หิด เหา ผมร่วง',
            ),
            9 =>
            array (
                'id' => 10,
                'created_at' => '2021-02-11 15:25:16',
                'updated_at' => '2021-02-11 15:25:16',
                'slug' => 'BOwbSvApIfJzmiaHa3jBHJH3JP1V0eMBA4BWWjSM',
                'name' => 'ยาหู ตา จมูก',
            ),
            10 =>
            array (
                'id' => 11,
                'created_at' => '2021-02-11 15:25:43',
                'updated_at' => '2021-02-11 15:25:43',
                'slug' => 'o1W3eCR8wQONJKM4pPhHXFYNkiq1MSivjchE76el',
                'name' => 'ยาฮอร์โมน',
            ),
            11 =>
            array (
                'id' => 12,
                'created_at' => '2021-02-11 15:26:02',
                'updated_at' => '2021-02-11 15:26:02',
                'slug' => 'qTJlVc1ggcZfWKdDWewalZU4eutALUjHAQz7zWN1',
                'name' => 'ยาทา พ่น แปะแก้ปวด',
            ),
        ));


    }
}
