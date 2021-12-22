<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::insert([
            'name' => 'Doi Nam',
            'email' => 'doidangnam@gmail.com',
            'email_verified_at' => now(),
            'role' => '1',
            'password' => '$2y$10$ydyoyz8jzpOU7rPyEYRygOrhumPNOvdAuZJThNJPQDMvMZQFz7Jim', // admin
            'remember_token' => Str::random(10),
        ]);
        Admin::insert([
            'name' => 'Tuong Vit',
            'email' => 'tuongvit@gmail.com',
            'email_verified_at' => now(),
            'role' => '2',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        Admin::insert([
            'name' => 'Thanh Cong',
            'email' => 'thanhcong@gmail.com',
            'email_verified_at' => now(),
            'role' => '3',
            'password' => '$2y$10$ydyoyz8jzpOU7rPyEYRygOrhumPNOvdAuZJThNJPQDMvMZQFz7Jim', // admin
            'remember_token' => Str::random(10),
        ]);
    }
}
