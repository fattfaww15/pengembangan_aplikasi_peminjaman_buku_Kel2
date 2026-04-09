<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BooksSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = [
            [
                'title' => 'Laskar Pelangi',
                'author_name' => 'Andrea Hirata',
                'stock' => 5,
                'published_year' => 2005,
                'description' => 'Novel tentang perjuangan anak-anak di sebuah sekolah di Belitung.',
            ],
            [
                'title' => 'Sang Pemimpi',
                'author_name' => 'Andrea Hirata',
                'stock' => 3,
                'published_year' => 2006,
                'description' => 'Kisah kelanjutan dari Laskar Pelangi.',
            ],
            [
                'title' => 'Edensor',
                'author_name' => 'Andrea Hirata',
                'stock' => 4,
                'published_year' => 2007,
                'description' => 'Novel tentang persahabatan dan impian.',
            ],
            [
                'title' => 'Hati yang Damai',
                'author_name' => 'Tere Liye',
                'stock' => 6,
                'published_year' => 2010,
                'description' => 'Novel tentang persahabatan dan pengampunan.',
            ],
            [
                'title' => 'Daun yang Jatuh Tak Pernah Membenci Angin',
                'author_name' => 'Tere Liye',
                'stock' => 4,
                'published_year' => 2010,
                'description' => 'Kisah tentang cinta dan pengorbanan.',
            ],
            [
                'title' => 'Bumi Manusia',
                'author_name' => 'Pramoedya Ananta Toer',
                'stock' => 3,
                'published_year' => 1980,
                'description' => 'Novel tentang perjuangan kemerdekaan Indonesia.',
            ],
            [
                'title' => 'Anak Semua Bangsa',
                'author_name' => 'Pramoedya Ananta Toer',
                'stock' => 2,
                'published_year' => 1980,
                'description' => 'Kelanjutan dari Bumi Manusia.',
            ],
            [
                'title' => 'Ayat-Ayat Cinta',
                'author_name' => 'Habiburrahman El Shirazy',
                'stock' => 8,
                'published_year' => 2004,
                'description' => 'Novel tentang cinta dan perjalanan spiritual.',
            ],
            [
                'title' => 'Ketika Cinta Bertasbih',
                'author_name' => 'Habiburrahman El Shirazy',
                'stock' => 5,
                'published_year' => 2007,
                'description' => 'Novel tentang cinta dan takdir.',
            ],
            [
                'title' => 'Ronggeng Dukuh Paruk',
                'author_name' => 'Ahmad Tohari',
                'stock' => 3,
                'published_year' => 1982,
                'description' => 'Novel tentang tradisi ronggeng di Jawa.',
            ],
            [
                'title' => 'Supernova',
                'author_name' => 'Dee Lestari',
                'stock' => 4,
                'published_year' => 2001,
                'description' => 'Novel tentang cinta dan takdir.',
            ],
            [
                'title' => 'Manusia Setengah Salmon',
                'author_name' => 'Eka Kurniawan',
                'stock' => 2,
                'published_year' => 2016,
                'description' => 'Novel tentang kehidupan dan kematian.',
            ],
            [
                'title' => 'Pulang',
                'author_name' => 'Leila S. Chudori',
                'stock' => 4,
                'published_year' => 2012,
                'description' => 'Novel tentang eksil dan pulang ke tanah air.',
            ],
            [
                'title' => 'Cantik Itu Luka',
                'author_name' => 'Eka Kurniawan',
                'stock' => 3,
                'published_year' => 2002,
                'description' => 'Novel tentang sejarah dan trauma.',
            ],
            [
                'title' => 'Negeri 5 Menara',
                'author_name' => 'Ahmad Fuadi',
                'stock' => 6,
                'published_year' => 2009,
                'description' => 'Novel tentang perjuangan pendidikan di pesantren.',
            ],
        ];

        foreach ($books as $bookData) {
            $author = Author::where('name', $bookData['author_name'])->first();
            if ($author) {
                Book::create([
                    'title' => $bookData['title'],
                    'author_id' => $author->id,
                    'stock' => $bookData['stock'],
                    'published_year' => $bookData['published_year'],
                    'description' => $bookData['description'],
                ]);
            }
        }
    }
}