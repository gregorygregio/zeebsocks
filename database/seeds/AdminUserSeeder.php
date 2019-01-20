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
        $adm->email = env("ADM_EMAIL");
        $adm->cpf = '11111111111';
        $adm->password = env("ADM_PASSWORD");
        $adm->permission = 1;
        $adm->save();
    }
}
