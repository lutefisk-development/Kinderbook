<?php

use \Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Populate roles table 
         */
        db::table('roles')->insert([
            'role_name' => 'Förskolechef',
            'is_admin' => true,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        db::table('roles')->insert([
            'role_name' => 'Biträdande Förskolechef',
            'is_admin' => true,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        db::table('roles')->insert([
            'role_name' => 'Förälder',
            'is_admin' => false,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        db::table('roles')->insert([
            'role_name' => 'Anställd',
            'is_admin' => false,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        db::table('roles')->insert([
            'role_name' => 'Vikarie',
            'is_admin' => false,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        /**
         * Populate kindergartens table
         */
        DB::table('kindergartens')->insert([
            'address' => 'Testgatan 1',
            'city' => 'Teststaden',
            'name' => 'I Ur och Skur Storkboet',
            'phone_nr' => '0123456789',
            'email' => 'storkboet@example.com',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        /**
         * Populate departments table
         */
        DB::table('departments')->insert([
            'kindergarten_id' => 1,
            'name' => 'Frö',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),

        ]);
        DB::table('departments')->insert([
            'kindergarten_id' => 1,
            'name' => 'Knopp',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('departments')->insert([
            'kindergarten_id' => 1,
            'name' => 'Knytte',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('departments')->insert([
            'kindergarten_id' => 1,
            'name' => 'Mullebarn',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    

        /**
         * Insert Admin users to DB
         */
        DB::table('users')->insert([
            'role_id' => 1,
            'first_name' => 'Admin',
            'last_name' => 'Person',
            'address' => 'Testgatan 1',
            'city' => 'Teststaden',
            'phone_nr' => '0123456789',
            'email' => 'admin@laravel.test',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('users')->insert([
            'role_id' => 2,
            'first_name' => 'Test',
            'last_name' => 'Person',
            'address' => 'Testgatan 1',
            'city' => 'Teststaden',
            'phone_nr' => '0123456789',
            'email' => 'test@laravel.test',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        /**
         * Insert Employees to DB
         */
        DB::table('users')->insert([
            'role_id' => 4,
            'first_name' => 'Lina',
            'last_name' => 'Linason',
            'address' => 'Linagatan 1',
            'city' => 'Teststaden',
            'phone_nr' => '0123456789',
            'email' => 'lina@laravel.test',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('users')->insert([
            'role_id' => 4,
            'first_name' => 'Jennie',
            'last_name' => 'Jennieson',
            'address' => 'Jenniegatan 1',
            'city' => 'Teststaden',
            'phone_nr' => '0123456789',
            'email' => 'jennie@laravel.test',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('users')->insert([
            'role_id' => 5,
            'first_name' => 'Vikarie',
            'last_name' => 'Vikarieson',
            'address' => 'Vikariegatan 1',
            'city' => 'Teststaden',
            'phone_nr' => '0123456789',
            'email' => 'vikarie@laravel.test',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        /**
         * Insert Parent to DB
         */
        DB::table('users')->insert([
            'role_id' => 3,
            'first_name' => 'Marie',
            'last_name' => 'Jönsson',
            'address' => 'Testgatan 5',
            'city' => 'Teststaden',
            'phone_nr' => '0123456789',
            'email' => 'marie@laravel.test',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        /**
         * Populate kids table
         */
        DB::table('kids')->insert([
            'user_id' => 6,
            'department_id' => 1,
            'first_name' => 'Tommy',
            'last_name' => 'Jönsson',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('kids')->insert([
            'user_id' => 6,
            'department_id' => 3,
            'first_name' => 'Josefine',
            'last_name' => 'Jönsson',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
