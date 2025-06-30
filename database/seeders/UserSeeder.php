<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $basePassword = 'password123';
        $roles = ['admin', 'team-leader', 'team-member'];
        $departments = ['sales', 'support', 'seo', 'development'];

        // 1. Admin user (no department needed)
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'encrypted_password' => Hash::make($basePassword),
            'decrypted_password' => $basePassword,
            'phone' => '1000000000',
            'address' => 'Admin Office',
            'profile_image' => 'default.jpg',
            'gender' => 'male',
            'dob' => '1980-01-01',
            'role' => 'admin',
            'department' => null, // or ''
            'position' => 'System Administrator', // New position
            'is_active' => 1,
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 2. Team-Leaders for all departments
        foreach ($departments as $dept) {
            User::create([
                'name' => ucfirst($dept) . ' Team Leader',
                'email' => "teamleader_$dept@example.com",
                'email_verified_at' => now(),
                'encrypted_password' => Hash::make($basePassword),
                'decrypted_password' => $basePassword,
                'phone' => '2000000000',
                'address' => ucfirst($dept) . ' Dept Office',
                'profile_image' => 'default.jpg',
                'gender' => 'female',
                'dob' => '1985-05-05',
                'role' => 'team-leader',
                'department' => $dept,
                'position' => 'Team Leader',
                'is_active' => 1,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 3. Team-Members for all departments
        foreach ($departments as $dept) {
            User::create([
                'name' => ucfirst($dept) . ' Team Member',
                'email' => "teammember_$dept@example.com",
                'email_verified_at' => now(),
                'encrypted_password' => Hash::make($basePassword),
                'decrypted_password' => $basePassword,
                'phone' => '3000000000',
                'address' => ucfirst($dept) . ' Dept Office',
                'profile_image' => 'default.jpg',
                'gender' => 'male',
                'dob' => '1992-10-10',
                'role' => 'team-member',
                'department' => $dept,
                'position' => 'Developer',
                'is_active' => 1,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
