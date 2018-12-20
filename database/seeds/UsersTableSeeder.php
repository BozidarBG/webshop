<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Address;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names=['Luka Doncic', 'James Harden', 'Victor Oladipo', 'Nikola Jokic', 'Kevin Love',
            'Al Horford', 'Garry Harris', 'Kevin Durant', 'Anthony Davis', 'Monte Morris', 'Goran Dragic',
            'Boban Marjanovic', 'Kawhi Leonard', 'Joel Embiid', 'Marcus Smart', 'Paul George', 'Dirk Novitzky',
            'Blake Griffin'];


        for($i=0; $i<count($names); $i++){


            $user=new User();
            $user->name=$names[$i];

            $email=trim(strstr($names[$i], " "))."@gmail.com";
            $user->email=strtolower($email);
            $user->role_id=2;
            $user->email_verified_at=\Carbon\Carbon::now();
            $user->password=Hash::make('111111');
            $user->save();
        }
    }
}
