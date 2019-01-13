<?php

use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adm = new App\User;
        $adm->name = "adm";
        $adm->email = "adm@email.com";
        $adm->cpf = '11111111111';
        $adm->password = Hash::make('123456');
        $adm->save();
    }
}
