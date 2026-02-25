<?php

namespace Database\Seeders;

use App\Models\Buku;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bukus = [
            [
                'judul' => 'Harry Potter and the Philosopher\'s Stone',
                'pengarang' => 'J.K. Rowling',
                'penerbit' => 'Bloomsbury',
                'deskripsi' => 'Petualangan seorang anak laki-laki penyihir muda yang menemukan warisan magisnya.',
                'isbn' => '978-0747532699',
                'tahun_terbit' => 1997,
                'jumlah_total' => 5,
                'jumlah_tersedia' => 5,
            ],
            [
                'judul' => 'The Lord of the Rings',
                'pengarang' => 'J.R.R. Tolkien',
                'penerbit' => 'Allen and Unwin',
                'deskripsi' => 'Epik fantasi tentang perjalanan untuk menghancurkan cincin ajaib.',
                'isbn' => '978-0544003415',
                'tahun_terbit' => 1954,
                'jumlah_total' => 4,
                'jumlah_tersedia' => 4,
            ],
            [
                'judul' => 'To Kill a Mockingbird',
                'pengarang' => 'Harper Lee',
                'penerbit' => 'J. B. Lippincott',
                'deskripsi' => 'Novel tentang rasialisme dan keadilan di Amerika Selatan.',
                'isbn' => '978-0061120084',
                'tahun_terbit' => 1960,
                'jumlah_total' => 3,
                'jumlah_tersedia' => 3,
            ],
            [
                'judul' => '1984',
                'pengarang' => 'George Orwell',
                'penerbit' => 'Secker and Warburg',
                'deskripsi' => 'Distopia tentang totalitarianisme dan pengawasan pemerintah.',
                'isbn' => '978-0451524935',
                'tahun_terbit' => 1949,
                'jumlah_total' => 5,
                'jumlah_tersedia' => 5,
            ],
            [
                'judul' => 'Pride and Prejudice',
                'pengarang' => 'Jane Austen',
                'penerbit' => 'T. Egerton',
                'deskripsi' => 'Kisah cinta dan masyarakat di Inggris abad ke-19.',
                'isbn' => '978-0141439518',
                'tahun_terbit' => 1813,
                'jumlah_total' => 4,
                'jumlah_tersedia' => 4,
            ],
            [
                'judul' => 'The Great Gatsby',
                'pengarang' => 'F. Scott Fitzgerald',
                'penerbit' => 'Scribner',
                'deskripsi' => 'Novel tentang ambisi, cinta, dan decadence di era Jazz.',
                'isbn' => '978-0743273565',
                'tahun_terbit' => 1925,
                'jumlah_total' => 6,
                'jumlah_tersedia' => 6,
            ],
            [
                'judul' => 'The Catcher in the Rye',
                'pengarang' => 'J.D. Salinger',
                'penerbit' => 'Little, Brown',
                'deskripsi' => 'Kisah seorang remaja yang mencari arti kehidupan di New York.',
                'isbn' => '978-0316769174',
                'tahun_terbit' => 1951,
                'jumlah_total' => 3,
                'jumlah_tersedia' => 3,
            ],
            [
                'judul' => 'The Hobbit',
                'pengarang' => 'J.R.R. Tolkien',
                'penerbit' => 'Allen and Unwin',
                'deskripsi' => 'Petualangan fantasi tentang seorang hobbit yang direkrut untuk mencuri harta.',
                'isbn' => '978-0547928227',
                'tahun_terbit' => 1937,
                'jumlah_total' => 5,
                'jumlah_tersedia' => 5,
            ],
        ];

        foreach ($bukus as $buku) {
            Buku::create($buku);
        }
    }
}
