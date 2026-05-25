# Metin Kitap - PHP Kitap Satış Sitesi

Öğrenci: Metin Batın Dincer  
Ders: TBL304 Web Programlama  
Proje konusu: İçerik yönetim sistemine sahip kitap satış sitesi

GitHub: https://github.com/MetinBatinDincer/php_book_sales_web

## Özellikler

- Admin ve kullanıcı rolleri
- Kullanıcı kayıt, giriş, profil güncelleme, şifre değiştirme ve üyelik pasife alma
- Admin ürün ekleme, güncelleme, silme, satışa açma/kapatma, fotoğraf yükleme, stok takibi
- Ürün listeleme, detay sayfası, sepet, toplam tutar ve ödeme ekranı
- Sipariş oluşturma, admin sipariş onayı ve hazırlık süreci ilerletme
- Kullanıcı sipariş takibi ve teslim alma onayı
- Admin onaylamadan önce sipariş iptali ve tutarın site bakiyesine iadesi
- Sonraki alışverişte önce kullanıcı bakiyesinden harcama
- Bootstrap ile responsive arayüz
- MySQL veritabanı yedeği ve örnek veri

## Kurulum

1. XAMPP/WAMP gibi PHP + MySQL ortamını çalıştırın.
2. Bu klasörü web kök dizininize `book_sales` adıyla koyun.
3. `database/book_sales.sql` dosyasını phpMyAdmin veya MySQL komut satırı ile içe aktarın.
4. Veritabanı bilgileriniz farklıysa `app/config.php` dosyasındaki `DB_USER` ve `DB_PASS` alanlarını güncelleyin.
5. Tarayıcıdan `http://localhost/book_sales/public/index.php` adresine gidin.

## Demo Hesaplar

Tüm demo hesapların şifresi: `password`

- Admin: `admin@metinkitap.test`
- User: `ayse@test.com`
- User: `mehmet@test.com`
- User: `elif@test.com`
- User: `can@test.com`
- User: `zeynep@test.com`

## Klasör Yapısı

- `public/index.php`: Front controller ve rota yönetimi
- `app/models`: User, Product ve Order veritabanı işlemleri
- `app/views`: Kullanıcı ve admin arayüzleri
- `database/book_sales.sql`: Veritabanı yedeği ve örnek veriler
- `reports/Metin_Batin_Dincer_221307021_Kitap_Satis_Sitesi_Proje_Raporu.docx`: Proje raporu

## Not

Bu çalışma saf PHP ile MVC mantığında düzenlenmiştir. Klasör yapısında `models` veriyi, `views` arayüzü, `public/index.php` ise controller/route akışlarını yönetir.
