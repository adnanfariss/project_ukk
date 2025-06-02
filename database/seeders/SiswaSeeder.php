<?php

namespace Database\Seeders;

use App\Models\Siswa;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $siswa = Siswa::insert([
                [
                'nama' => 'ABU BAKAR TSABIT GHUFRON',
                'nis' => '20388',
                'gender' => 'L',
                'alamat' => 'Sleman',
                'kontak' => '081234567890',
                'email' => 'abu@gmail.com',
                'status_lapor_pkl' => false,
            ],
            [
                'nama' => 'ADE RAFIF DANESWARA',
                'nis' => '20389',
                'gender' => 'L',
                'alamat' => 'Bantul',
                'kontak' => '081234567890',
                'email' => 'ade@gmail.com',
                'status_lapor_pkl' => false,
            ],
            [
                'nama' => 'ADE ZAIDAN ALTHAF',
                'nis' => '20390',
                'gender' => 'L',
                'alamat' => 'Gunungkidul',
                'kontak' => '081234567890',
                'email' => 'zaidan@gmail.com',
                'status_lapor_pkl' => false,
            ],
            [
                'nama' => 'ADHWA KHALILA RAMADHANI',
                'nis' => '20391',
                'gender' => 'P',
                'alamat' => 'Sleman',
                'kontak' => '081234567890',
                'email' => 'adhwa@gmail.com',
                'status_lapor_pkl' => false,
            ],
            [
                'nama' => 'ADNAN FARIS',
                'nis' => '20392',
                'gender' => 'L',
                'alamat' => 'Bantul',
                'kontak' => '081234567890',
                'email' => 'adnan@gmail.com',
                'status_lapor_pkl' => false,
            ],
            [
                'nama' => 'AHMAD HANAFFI RAHMADHANI',
                'nis' => '20393',
                'gender' => 'L',
                'alamat' => 'Gunungkidul',
                'kontak' => '081234567890',
                'email' => 'ahmad@gmail.com',
                'status_lapor_pkl' => false,
            ],
            [
                'nama' => 'AKBAR ADHA KUSUMAWARDHANA',
                'nis' => '20394',
                'gender' => 'L',
                'alamat' => 'Sleman',
                'kontak' => '081234567890',
                'email' => 'akbar@gmail.com',
                'status_lapor_pkl' => false,
            ],
            [
                'nama' => 'ANDHIKA AUGUST FARNAZ',
                'nis' => '20395',
                'gender' => 'L',
                'alamat' => 'Bantul',
                'kontak' => '081234567890',
                'email' => 'andhika@gmail.com',
                'status_lapor_pkl' => false,
            ],
            [
                'nama' => 'ANGELINA THITHIS SEKAR LANGIT',
                'nis' => '20396',
                'gender' => 'P',
                'alamat' => 'Gunungkidul',
                'kontak' => '081234567890',
                'email' => 'angelina@gmail.com',
                'status_lapor_pkl' => false,
            ],
            [
                'nama' => 'ARIFIN NUR IHSAN',
                'nis' => '20397',
                'gender' => 'L',
                'alamat' => 'Sleman',
                'kontak' => '081234567890',
                'email' => 'arifin@gmail.com',
                'status_lapor_pkl' => false,
            ],
        ]);
    }
}
