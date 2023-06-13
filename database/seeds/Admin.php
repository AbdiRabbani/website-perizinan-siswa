<?php

use Illuminate\Database\Seeder;

class Admin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new \App\User;
        $user->name = "Abdi Rabbani";
        $user->username = "abdirabbani";
        $user->email = "abdirabbani59@gmail.com";
        $user->password = \Hash::make("rararara");
        $user->level = "admin";
        $user->save();
        $this->command->info("Admin telah tiba");
    }
}
