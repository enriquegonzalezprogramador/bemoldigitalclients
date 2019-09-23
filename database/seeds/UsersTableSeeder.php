<?php

use Illuminate\Database\Seeder;
use App\User;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $first_name = [
            'Minera',
        ];
        $last_name = [
            'Luren',
        ];

        $emails = [
            'admin@email.com',
        ];

        for ($i=0; $i < count($emails); $i++) {
            User::create([
                'first_name' => $first_name[$i],
                'last_name' => $last_name[$i],
                'email' => $emails[$i],
                'type' => 'Web',
                'password' => bcrypt('password'),
                'created_at' => now(),
                'updated_at' => now(),
                'confirmed' => true
            ]);
        }
    }
}
