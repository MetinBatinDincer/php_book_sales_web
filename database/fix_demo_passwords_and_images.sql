USE book_sales;

UPDATE users
SET password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2uheWG/igi'
WHERE email IN (
    'admin@metinkitap.test',
    'ayse@test.com',
    'mehmet@test.com',
    'elif@test.com',
    'can@test.com',
    'zeynep@test.com'
);

UPDATE products SET image_url='https://covers.openlibrary.org/b/isbn/9780451419439-L.jpg' WHERE title='Sefiller';
UPDATE products SET image_url='https://covers.openlibrary.org/b/isbn/9780140449136-L.jpg' WHERE title='Suc ve Ceza';
UPDATE products SET image_url='https://covers.openlibrary.org/b/isbn/9789753638029-L.jpg' WHERE title='Kurk Mantolu Madonna';
UPDATE products SET image_url='https://covers.openlibrary.org/b/isbn/9780451524935-L.jpg' WHERE title='1984';
UPDATE products SET image_url='https://covers.openlibrary.org/b/isbn/9780451526342-L.jpg' WHERE title='Hayvan Ciftligi';
UPDATE products SET image_url='https://covers.openlibrary.org/b/isbn/9780061122415-L.jpg' WHERE title='Simyaci';
UPDATE products SET image_url='https://covers.openlibrary.org/b/isbn/9789754700114-L.jpg' WHERE title='Tutunamayanlar';
UPDATE products SET image_url='https://covers.openlibrary.org/b/isbn/9789759953317-L.jpg' WHERE title='Saatleri Ayarlama Enstitusu';
UPDATE products SET image_url='https://covers.openlibrary.org/b/isbn/9789750807145-L.jpg' WHERE title='Ince Memed';
UPDATE products SET image_url='https://covers.openlibrary.org/b/isbn/9780441172719-L.jpg' WHERE title='Dune';
UPDATE products SET image_url='https://covers.openlibrary.org/b/isbn/9781451673319-L.jpg' WHERE title='Fahrenheit 451';
UPDATE products SET image_url='https://covers.openlibrary.org/b/isbn/9780156012195-L.jpg' WHERE title='Kucuk Prens';
UPDATE products SET image_url='https://covers.openlibrary.org/b/isbn/9786053841509-L.jpg' WHERE title='Beyaz Zambaklar Ulkesinde';
UPDATE products SET image_url='https://covers.openlibrary.org/b/isbn/9786050958903-L.jpg' WHERE title='Bir Omur Nasil Yasanir';
UPDATE products SET image_url='https://covers.openlibrary.org/b/isbn/9780140280197-L.jpg' WHERE title='Ustaligin 48 Yasasi';
UPDATE products SET image_url='https://covers.openlibrary.org/b/isbn/9780735211292-L.jpg' WHERE title='Atomik Aliskanliklar';
UPDATE products SET image_url='https://covers.openlibrary.org/b/isbn/9780132350884-L.jpg' WHERE title='Clean Code';
UPDATE products SET image_url='https://covers.openlibrary.org/b/isbn/9781491905012-L.jpg' WHERE title='PHP ve MySQL';
UPDATE products SET image_url='https://covers.openlibrary.org/b/isbn/9781785283017-L.jpg' WHERE title='Laravel ile Web Gelistirme';
UPDATE products SET image_url='https://covers.openlibrary.org/b/isbn/9780133970777-L.jpg' WHERE title='Veritabani Sistemleri';

