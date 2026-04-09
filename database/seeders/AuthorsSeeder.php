<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorsSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $authors = [
            [
                'name' => 'Andrea Hirata',
                'biography' => 'Penulis novel Laskar Pelangi dan berbagai karya sastra Indonesia.',
            ],
            [
                'name' => 'Tere Liye',
                'biography' => 'Penulis novel remaja seperti Hati yang Damai dan Daun yang Jatuh Tak Pernah Membenci Angin.',
            ],
            [
                'name' => 'Pramoedya Ananta Toer',
                'biography' => 'Sastrawan Indonesia terkemuka, pemenang Ramon Magsaysay Award.',
            ],
            [
                'name' => 'Habiburrahman El Shirazy',
                'biography' => 'Penulis novel Ayat-Ayat Cinta dan berbagai karya islami.',
            ],
            [
                'name' => 'Ahmad Tohari',
                'biography' => 'Penulis Ronggeng Dukuh Paruk dan berbagai karya sastra.',
            ],
            [
                'name' => 'Dee Lestari',
                'biography' => 'Penulis novel Supernova dan berbagai karya sastra modern.',
            ],
            [
                'name' => 'Eka Kurniawan',
                'biography' => 'Penulis Manusia Setengah Salmon dan Cantik Itu Luka.',
            ],
            [
                'name' => 'Leila S. Chudori',
                'biography' => 'Penulis Pulang dan berbagai karya sastra.',
            ],
            [
                'name' => 'Ahmad Fuadi',
                'biography' => 'Penulis Negeri 5 Menara dan berbagai karya inspiratif.',
            ],
        ];

        foreach ($authors as $author) {
            Author::create($author);
        }
    }
}