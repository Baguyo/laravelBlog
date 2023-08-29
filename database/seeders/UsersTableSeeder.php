<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $usersCount = max((int)$this->command->ask("How many user you would like to create?",20),1);

        User::factory()->defaultUser()->create();
        User::factory()->count($usersCount)->create();
        
    }
}
