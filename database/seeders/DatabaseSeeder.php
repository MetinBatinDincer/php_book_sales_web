<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $password = Hash::make('password');

        $users = [
            ['name' => 'Metin Batin Dincer', 'email' => 'admin@metinkitap.test', 'role' => 'admin', 'address' => 'Kocaeli Universitesi Teknoloji Fakultesi', 'wallet_balance' => 0],
            ['name' => 'Ayse Yilmaz', 'email' => 'ayse@test.com', 'role' => 'user', 'address' => 'Izmit / Kocaeli', 'wallet_balance' => 120],
            ['name' => 'Mehmet Kaya', 'email' => 'mehmet@test.com', 'role' => 'user', 'address' => 'Gebze / Kocaeli', 'wallet_balance' => 0],
            ['name' => 'Elif Demir', 'email' => 'elif@test.com', 'role' => 'user', 'address' => 'Kadikoy / Istanbul', 'wallet_balance' => 45.50],
            ['name' => 'Can Oz', 'email' => 'can@test.com', 'role' => 'user', 'address' => 'Cankaya / Ankara', 'wallet_balance' => 0],
            ['name' => 'Zeynep Arslan', 'email' => 'zeynep@test.com', 'role' => 'user', 'address' => 'Nilufer / Bursa', 'wallet_balance' => 80],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']],
                $user + ['password' => $password, 'status' => 'active']
            );
        }

        $products = [
            ['Sefiller', 'Victor Hugo', 'Toplumsal adalet, vicdan ve insanlik hallerini anlatan klasik roman.', 245, 15, 'https://covers.openlibrary.org/b/isbn/9780451419439-L.jpg'],
            ['Suc ve Ceza', 'Fyodor Dostoyevski', 'Psikolojik derinligiyle suc, vicdan ve kefaret temasini isleyen basyapit.', 210, 20, 'https://covers.openlibrary.org/b/isbn/9780140449136-L.jpg'],
            ['Kurk Mantolu Madonna', 'Sabahattin Ali', 'Ask, yalnizlik ve ic dunyaya odaklanan Turk edebiyati klasigi.', 95, 35, 'https://covers.openlibrary.org/b/isbn/9789753638029-L.jpg'],
            ['1984', 'George Orwell', 'Totaliter sistemleri ve gozetim toplumunu anlatan distopik roman.', 145, 28, 'https://covers.openlibrary.org/b/isbn/9780451524935-L.jpg'],
            ['Hayvan Ciftligi', 'George Orwell', 'Siyasi alegori turunun en bilinen eserlerinden biri.', 88, 40, 'https://covers.openlibrary.org/b/isbn/9780451526342-L.jpg'],
            ['Simyaci', 'Paulo Coelho', 'Kisisel yolculuk ve hayallerin pesinden gitme uzerine modern klasik.', 130, 24, 'https://covers.openlibrary.org/b/isbn/9780061122415-L.jpg'],
            ['Tutunamayanlar', 'Oguz Atay', 'Modern Turk edebiyatinin yenilikci ve katmanli romanlarindan.', 310, 12, 'https://covers.openlibrary.org/b/isbn/9789754700114-L.jpg'],
            ['Saatleri Ayarlama Enstitusu', 'Ahmet Hamdi Tanpinar', 'Modernlesme, zaman ve toplum uzerine ironik bir roman.', 175, 18, 'https://covers.openlibrary.org/b/isbn/9789759953317-L.jpg'],
            ['Ince Memed', 'Yasar Kemal', 'Cukurova insanini ve adalet arayisini epik bir dille anlatir.', 220, 22, 'https://covers.openlibrary.org/b/isbn/9789750807145-L.jpg'],
            ['Dune', 'Frank Herbert', 'Politika, ekoloji ve guc dengeleriyle kurulu bilim kurgu romani.', 360, 17, 'https://covers.openlibrary.org/b/isbn/9780441172719-L.jpg'],
            ['Fahrenheit 451', 'Ray Bradbury', 'Kitaplarin yasaklandigi bir gelecekte dusunce ozgurlugunu sorgular.', 125, 27, 'https://covers.openlibrary.org/b/isbn/9781451673319-L.jpg'],
            ['Kucuk Prens', 'Antoine de Saint-Exupery', 'Cocuk ve yetiskin okurlar icin sade ama derin bir anlatim.', 75, 50, 'https://covers.openlibrary.org/b/isbn/9780156012195-L.jpg'],
            ['Beyaz Zambaklar Ulkesinde', 'Grigory Petrov', 'Egitim ve toplumsal kalkinma uzerine ilham veren eser.', 70, 32, 'https://covers.openlibrary.org/b/isbn/9786053841509-L.jpg'],
            ['Bir Omur Nasil Yasanir', 'Ilber Ortayli', 'Yasam, kultur ve kariyer uzerine sohbet tadinda oneriler.', 160, 25, 'https://covers.openlibrary.org/b/isbn/9786050958903-L.jpg'],
            ['Ustaligin 48 Yasasi', 'Robert Greene', 'Guc iliskileri ve stratejik davranislar uzerine populer inceleme.', 290, 10, 'https://covers.openlibrary.org/b/isbn/9780140280197-L.jpg'],
            ['Atomik Aliskanliklar', 'James Clear', 'Kucuk aliskanliklarin buyuk sonuclara etkisini anlatan kisisel gelisim kitabi.', 255, 30, 'https://covers.openlibrary.org/b/isbn/9780735211292-L.jpg'],
            ['Clean Code', 'Robert C. Martin', 'Okunabilir ve surdurulebilir yazilim gelistirme prensipleri.', 520, 9, 'https://covers.openlibrary.org/b/isbn/9780132350884-L.jpg'],
            ['PHP ve MySQL', 'Web Akademi', 'Temel PHP, form islemleri, oturum ve veritabani konularini anlatir.', 199, 21, 'https://covers.openlibrary.org/b/isbn/9781491905012-L.jpg'],
            ['Laravel ile Web Gelistirme', 'Kod Atolyesi', 'MVC mimarisi, rota, model ve blade temellerini orneklerle aciklar.', 275, 14, 'https://covers.openlibrary.org/b/isbn/9781785283017-L.jpg'],
            ['Veritabani Sistemleri', 'Akademik Yayin', 'Iliskisel model, SQL, ER diyagrami ve normalizasyon konularini kapsar.', 235, 16, 'https://covers.openlibrary.org/b/isbn/9780133970777-L.jpg'],
        ];

        foreach ($products as [$title, $author, $description, $price, $stock, $imageUrl]) {
            Product::updateOrCreate(
                ['title' => $title],
                [
                    'author' => $author,
                    'description' => $description,
                    'price' => $price,
                    'stock' => $stock,
                    'image_url' => $imageUrl,
                    'is_active' => true,
                ]
            );
        }
    }
}
