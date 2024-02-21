<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'phone' => '62895397776693',
            'born_date' => date(Carbon::parse('1998-02-02')),
            'role' => 2,
            'active_until' => Carbon::now()->addDays(360),
            'email_verified_at' =>Carbon::now(),
            'phone_verified_at' =>Carbon::now(),
            'password' => bcrypt('admin')
        ]);
    }
}
