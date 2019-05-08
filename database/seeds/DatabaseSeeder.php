<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        DB::table('roles')->insert(
            [
                ['name' => 'admin', 'description' => 'Administrator'],
                ['name' => 'student', 'description' => 'Student'],
                ['name' => 'lab_tech', 'description' => 'Lab Tech'],
                ['name' => 'it_staff', 'description' => 'IT Staff Member'],
                ['name' => 'it_manager', 'description' => 'IT Manager'],
                ['name' => 'lab_manager', 'description' => 'Lab Manager'],
            ]
        );

        DB::table('users')->insert(
            [
                'username' => 'admin', 
                'password' => Hash::make('password'), 
                'active' => 1,
                'name' => 'Administrator',
                'email' => 'programmerlemar@gmail.com',
                'role_id' => \App\Role::where('name', 'admin')->first()->id
            ]
        );

        DB::table('status')->insert([
            ['name' => 'Active'],
            ['name' => 'Cancel'],
            ['name' => 'Disable'],
            ['name' => 'Open'],
            ['name' => 'Closed'],
            ['name' => 'Resolved'],
        ]);
    }
}
