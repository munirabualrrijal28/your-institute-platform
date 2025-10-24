<?php

namespace Database\Seeders;

use App\Constants\UserRole;
use App\Models\Institute;
use App\Models\User;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InstituteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          $institutes = [
            ['path' => 'images/inst_profile/your/your.png', 'name' => 'Your-Institute'],
            ['path' => 'images/inst_profile/jats/jats.png', 'name' => 'JATS'],
            ['path' => 'images/inst_profile/lbm/lb.jpg', 'name' => 'LBM'],
            ['path' => 'images/inst_profile/24/24_ins.jpg', 'name' => '24 Academy'],
            ['path' => 'images/inst_profile/yali/yali.jpg', 'name' => 'Yali'],
            ['path' => 'images/inst_profile/speak/speak.jpg', 'name' => 'SpeakNow'],
            ['path' => 'images/inst_profile/we_can/we.jpg', 'name' => 'We Can'],
        ];

        foreach ($institutes as $data) {
            $user = User::create([
                'name' => $data['name'],
                'email' => strtolower(str_replace(' ', '', $data['name'])) . '@gmail.com',
                'password' => Hash::make('password'),
                'role' =>  UserRole::InstituteRole
,
            ]);

            Institute::create([
                'user_id_fk' => $user->id,
                'ins_name' => $user->name,
                'ins_profile_photo' => $data['path'],
                'ins_lic_photo' => '',
                'ins_is_verified' => false,
            ]);
        }

}

}
