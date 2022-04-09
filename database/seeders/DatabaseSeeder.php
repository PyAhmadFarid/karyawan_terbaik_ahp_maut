<?php

namespace Database\Seeders;

use App\Models\Kriteria;
use App\Models\NilaiPegawai;
use App\Models\Pegawai;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $user = User::create([
            'name' => 'ucok',
            'email' => 'ucok@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('qwe'),
            'remember_token' => Str::random(10),
        ]);

        Kriteria::create([
            'nama' => 'Kinerja',
            'simbol' => 'C1'
        ]);
        Kriteria::create([
            'nama' => 'Kejujuran',
            'simbol' => 'C2'
        ]);
        Kriteria::create([
            'nama' => 'Kerja sama',
            'simbol' => 'C3'
        ]);
        Kriteria::create([
            'nama' => 'Kedisiplinan',
            'simbol' => 'C4'
        ]);
        Kriteria::create([
            'nama' => 'Lama kerja',
            'simbol' => 'C5'
        ]);

        $faker = Faker\Factory::create();
        for ($i = 0; $i < 30; $i++) {
            $gender = $faker->randomElement(['male', 'female']);
            Pegawai::create([
                'nama' => $faker->name($gender),
                'jk' => $gender == 'male' ? 'L' : 'P',
                'umur' => $faker->numberBetween(20, 30)
            ]);
        }

        $nill = [['2', '3', '2', '1', '26'], ['3', '4', '3', '4', '34'], ['2', '3', '1', '1', '33'], ['3', '1', '1', '2', '35'], ['4', '1', '1', '2', '25'], ['2', '2', '2', '3', '35'], ['3', '2', '4', '3', '20'], ['3', '2', '1', '4', '20'], ['1', '1', '2', '4', '34'], ['3', '4', '2', '3', '26'], ['4', '1', '1', '4', '28'], ['1', '2', '2', '2', '29'], ['1', '2', '4', '2', '27'], ['4', '2', '3', '3', '24'], ['1', '1', '1', '2', '26'], ['1', '3', '1', '2', '23'], ['2', '3', '3', '1', '27'], ['2', '4', '3', '3', '24'], ['2', '2', '1', '2', '23'], ['1', '3', '3', '2', '28'], ['4', '3', '1', '3', '25'], ['2', '1', '4', '4', '28'], ['3', '1', '1', '3', '23'], ['2', '3', '4', '4', '33'], ['2', '3', '4', '4', '31'], ['2', '2', '4', '2', '25'], ['3', '3', '3', '4', '20'], ['2', '1', '1', '1', '27'], ['4', '4', '4', '2', '21'], ['3', '3', '2', '3', '26']];
        foreach($nill as $i=>$ni){
            foreach($ni as $j=>$nj){
                NilaiPegawai::create([
                    'id_pegawai'=>$i+1,
                    'id_kriteria'=>$j+1,
                    'nilai'=>(int)$nj,
                ]);
            }
        }

    }
}
