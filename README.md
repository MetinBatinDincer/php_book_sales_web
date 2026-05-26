# Metin Kitap - Laravel Kitap Satis Sitesi

Ogrenci: Metin Batin Dincer  
Ders: Web Programlama  
Framework: Laravel 11  
Proje konusu: Icerik yonetim sistemine sahip kitap satis sitesi
GitHub: https://github.com/MetinBatinDincer/php_book_sales_web

## Ozellikler

- Laravel MVC yapisi: route, controller, model, migration, seeder ve Blade view kullanimi
- Admin ve user rolleri
- Kullanici kayit, giris, profil guncelleme, sifre degistirme ve uyeligi pasife alma
- Admin urun ekleme, guncelleme, silme, satisa acma/kapatma, fotograf yukleme ve stok takibi
- Urun listeleme, urun detay sayfasi, sepet, toplam tutar ve odeme ekrani
- Siparis olusturma, admin siparis onayi ve hazirlik sureci ilerletme
- Kullanici siparis takibi ve teslim alma onayi
- Admin onaylamadan once siparis iptali ve tutarin site bakiyesine iadesi
- Sonraki alisveriste once kullanici bakiyesinden harcama
- Bootstrap 5 ile responsive arayuz
- Migration, seeder, SQLite test veritabani ve MySQL SQL yedegi

## Kurulum

1. PHP 8.2+ ve Composer hazir olmalidir. Bu bilgisayarda XAMPP PHP yolu: `C:\xampp\php\php.exe`.
2. Bagimliliklar eksikse:

```powershell
composer install
```

3. `.env` dosyasi yoksa `.env.example` dosyasindan olusturun ve anahtar uretin:

```powershell
C:\xampp\php\php.exe artisan key:generate
```

4. SQLite ile hizli kurulum icin:

```powershell
New-Item -ItemType File database\database.sqlite -Force
C:\xampp\php\php.exe artisan migrate:fresh --seed
C:\xampp\php\php.exe artisan serve --host=127.0.0.1 --port=8000
```

5. Tarayicidan `http://127.0.0.1:8000` adresini acin.

MySQL kullanilacaksa `.env` icindeki `DB_CONNECTION`, `DB_DATABASE`, `DB_USERNAME` ve `DB_PASSWORD` alanlari MySQL bilgilerine gore duzenlenebilir. SQL yedegi `database/book_sales.sql` dosyasindadir.

## Demo Hesaplar

Tum demo hesaplarin sifresi: `password`

- Admin: `admin@metinkitap.test`
- User: `ayse@test.com`
- User: `mehmet@test.com`
- User: `elif@test.com`
- User: `can@test.com`
- User: `zeynep@test.com`

## Test

```powershell
C:\xampp\php\php.exe artisan test
```

Son dogrulamada 6 test ve 24 assertion basariyla gecmistir.

## Klasor Yapisi

- `routes/web.php`: Web route tanimlari
- `app/Http/Controllers`: Kullanici, sepet, siparis ve admin controller siniflari
- `app/Models`: User, Product, Order ve OrderItem modelleri
- `resources/views`: Blade arayuz dosyalari
- `database/migrations`: Laravel migration dosyalari
- `database/seeders/DatabaseSeeder.php`: 1 admin, 5 user ve 20 urun demo verisi
- `database/book_sales.sql`: MySQL uyumlu veritabani yedegi

Eski saf PHP MVC surumu `legacy_php_mvc` klasorunde sadece arsiv amaciyla saklanmistir. Calisan ana proje Laravel kok yapisidir.
