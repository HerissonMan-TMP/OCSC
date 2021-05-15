<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();

        User::factory()->hasAttached(Role::where('name', 'Chief Executive Officer')->first())->create();

        $setOfUsers1 = User::factory(19)->create();
        $setOfUsers2 = User::factory(2)->withTemporaryPassword()->create();

        $setOfUsers = $setOfUsers1->merge($setOfUsers2);

        foreach ($setOfUsers as $user) {
            $user->roles()->attach(Role::inRandomOrder()->first());
        }
    }
}
