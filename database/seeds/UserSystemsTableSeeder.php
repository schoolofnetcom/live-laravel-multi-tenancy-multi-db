<?php

use App\Models\UserSystem;
use Illuminate\Database\Seeder;

class UserSystemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(UserSystem::class)->create([
            'email' => 'system@user.com'
        ]);
    }
}
