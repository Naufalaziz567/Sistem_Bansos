<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Profile;

class ProfileSeeder extends Seeder
{
    public function run(): void
    {
        Profile::create([
            'name'  => 'Naufal Aziz Armansa',
            'email'   => 'naufalazizpgk@gmail.com',
            'bio' => 'bio Naufal Aziz Armansa.',
            'phone' => '085766955097',
            'address' => 'Jl. Pinus No. 122',
            'avatar' => 'img/profile.jpg',
        ]);
    }
}
