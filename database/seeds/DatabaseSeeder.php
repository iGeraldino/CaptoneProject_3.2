<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this -> call(MainTest::class);


    }
}
class MainTest extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $num = 10 ;
        for ($i=0;$i < $num; $i++){

            DB::table('admins')->insert([

                'username' => '123123',
                'email' => '123123@gmail.com',
                'password' => bcrypt(123123)

            ]);


        }

        $this->command->info("admin added");

    }
}
