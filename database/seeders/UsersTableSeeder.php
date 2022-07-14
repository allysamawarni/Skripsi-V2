<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = array(
            [
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123'),
            'roles' => 'admin'
            ],
            [
            'name' => 'Ketua',
            'email' => 'ketua@gmail.com',
            'password' => bcrypt('123'),
            'roles' => 'ketua'
            ],
            [
                'name' => 'Bola',
                'email' => 'bola@gmail.com',
                'password' => bcrypt('123'),
                'roles' => 'ukm'
            ],
            [
                'name' => 'Hockey',
                'email' => 'hockey@gmail.com',
                'password' => bcrypt('123'),
                'roles' => 'ukm'
            ],
            [
                'name' => 'Basket',
                'email' => 'basket@gmail.com',
                'password' => bcrypt('123'),
                'roles' => 'ukm'
            ],
            [
                'name' => 'Taekwondo',
                'email' => 'taekwondo@gmail.com',
                'password' => bcrypt('123'),
                'roles' => 'ukm'
            ],
            [
                'name' => 'Tarung Derajat',
                'email' => 'td@gmail.com',
                'password' => bcrypt('123'),
                'roles' => 'ukm'
            ],
            [
                'name' => 'Karate',
                'email' => 'karate@gmail.com',
                'password' => bcrypt('123'),
                'roles' => 'ukm'
            ],
            [
                'name' => 'Kipas',
                'email' => 'kipas@gmail.com',
                'password' => bcrypt('123'),
                'roles' => 'ukm'
            ],
            [
                'name' => 'Siaran Terbatas Universitas Pancasila',
                'email' => 'stupa@gmail.com',
                'password' => bcrypt('123'),
                'roles' => 'ukm'
            ],
            [
                'name' => 'Pancasila Scooter',
                'email' => 'pas@gmail.com',
                'password' => bcrypt('123'),
                'roles' => 'ukm'
            ],
            [
                'name' => 'Gema Alpas',
                'email' => 'gema@gmail.com',
                'password' => bcrypt('123'),
                'roles' => 'ukm'
            ],
            [
                'name' => 'Photografi',
                'email' => 'photoup@gmail.com',
                'password' => bcrypt('123'),
                'roles' => 'ukm'
            ],
            [
                'name' => 'Pancasila Red Corss',
                'email' => 'prc@gmail.com',
                'password' => bcrypt('123'),
                'roles' => 'ukm'
            ],
            [
                'name' => 'Research dan Development',
                'email' => 'rd@gmail.com',
                'password' => bcrypt('123'),
                'roles' => 'ukm'
            ],
            [
                'name' => 'Resimen Mahasiswa',
                'email' => 'menwa@gmail.com',
                'password' => bcrypt('123'),
                'roles' => 'ukm'
            ],
            [
                'name' => 'Cipta Alam Ceria',
                'email' => 'cicera@gmail.com',
                'password' => bcrypt('123'),
                'roles' => 'ukm'
            ],
            [
                'name' => 'Satuan Kegiatan Islam',
                'email' => 'ski@gmail.com',
                'password' => bcrypt('123'),
                'roles' => 'ukm'
            ],
            [
                'name' => 'Satuan Kegiatan Katolik',
                'email' => 'sakka@gmail.com',
                'password' => bcrypt('123'),
                'roles' => 'ukm'
            ],
            [
                'name' => 'Persekutuan Mahasiswa Kristen',
                'email' => 'pmk@gmail.com',
                'password' => bcrypt('123'),
                'roles' => 'ukm'
            ],
            [
                'name' => 'Perhimpunan Mahasiswa Budhis',
                'email' => 'pb@gmail.com',
                'password' => bcrypt('123'),
                'roles' => 'ukm'
            ],
            [
                'name' => 'Kesatuan Mahasiswa Hindu Dharma',
                'email' => 'kmhd@gmail.com',
                'password' => bcrypt('123'),
                'roles' => 'ukm'
            ],
        );
    
        array_map(function (array $user) {
            User::query()->updateOrCreate(
                ['email' => $user['email']],
                $user
                );
            }, $users);
        }
    }

