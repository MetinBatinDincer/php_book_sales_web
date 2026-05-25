CREATE DATABASE IF NOT EXISTS book_sales CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE book_sales;

DROP TABLE IF EXISTS order_items;
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS products;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(120) NOT NULL,
    email VARCHAR(160) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') NOT NULL DEFAULT 'user',
    address TEXT NULL,
    wallet_balance DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    status ENUM('active', 'passive') NOT NULL DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(180) NOT NULL,
    author VARCHAR(140) NOT NULL,
    description TEXT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    stock INT NOT NULL DEFAULT 0,
    image_url VARCHAR(500) NOT NULL,
    is_active TINYINT(1) NOT NULL DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    total_amount DECIMAL(10,2) NOT NULL,
    wallet_used DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    card_paid DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    shipping_address TEXT NOT NULL,
    status ENUM('pending', 'approved', 'packing', 'cargo', 'on_way', 'delivered', 'completed', 'cancelled') NOT NULL DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NULL,
    product_title VARCHAR(180) NOT NULL,
    quantity INT NOT NULL,
    unit_price DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE SET NULL
);

INSERT INTO users (name, email, password, role, address, wallet_balance) VALUES
('Metin Batin Dincer', 'admin@metinkitap.test', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2uheWG/igi', 'admin', 'Kocaeli Universitesi Teknoloji Fakultesi', 0.00),
('Ayse Yilmaz', 'ayse@test.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2uheWG/igi', 'user', 'Izmit / Kocaeli', 120.00),
('Mehmet Kaya', 'mehmet@test.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2uheWG/igi', 'user', 'Gebze / Kocaeli', 0.00),
('Elif Demir', 'elif@test.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2uheWG/igi', 'user', 'Kadikoy / Istanbul', 45.50),
('Can Oz', 'can@test.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2uheWG/igi', 'user', 'Cankaya / Ankara', 0.00),
('Zeynep Arslan', 'zeynep@test.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2uheWG/igi', 'user', 'Nilufer / Bursa', 80.00);

INSERT INTO products (title, author, description, price, stock, image_url, is_active) VALUES
('Sefiller', 'Victor Hugo', 'Toplumsal adalet, vicdan ve insanlik hallerini anlatan klasik roman.', 245.00, 15, 'https://covers.openlibrary.org/b/isbn/9780451419439-L.jpg', 1),
('Suc ve Ceza', 'Fyodor Dostoyevski', 'Psikolojik derinligiyle suc, vicdan ve kefaret temasini isleyen basyapit.', 210.00, 20, 'https://covers.openlibrary.org/b/isbn/9780140449136-L.jpg', 1),
('Kurk Mantolu Madonna', 'Sabahattin Ali', 'Ask, yalnizlik ve ic dunyaya odaklanan Turk edebiyati klasigi.', 95.00, 35, 'https://covers.openlibrary.org/b/isbn/9789753638029-L.jpg', 1),
('1984', 'George Orwell', 'Totaliter sistemleri ve gozetim toplumunu anlatan distopik roman.', 145.00, 28, 'https://covers.openlibrary.org/b/isbn/9780451524935-L.jpg', 1),
('Hayvan Ciftligi', 'George Orwell', 'Siyasi alegori turunun en bilinen eserlerinden biri.', 88.00, 40, 'https://covers.openlibrary.org/b/isbn/9780451526342-L.jpg', 1),
('Simyaci', 'Paulo Coelho', 'Kisisel yolculuk ve hayallerin pesinden gitme uzerine modern klasik.', 130.00, 24, 'https://covers.openlibrary.org/b/isbn/9780061122415-L.jpg', 1),
('Tutunamayanlar', 'Oguz Atay', 'Modern Turk edebiyatinin yenilikci ve katmanli romanlarindan.', 310.00, 12, 'https://covers.openlibrary.org/b/isbn/9789754700114-L.jpg', 1),
('Saatleri Ayarlama Enstitusu', 'Ahmet Hamdi Tanpinar', 'Modernlesme, zaman ve toplum uzerine ironik bir roman.', 175.00, 18, 'https://covers.openlibrary.org/b/isbn/9789759953317-L.jpg', 1),
('Ince Memed', 'Yasar Kemal', 'Cukurova insanini ve adalet arayisini epik bir dille anlatir.', 220.00, 22, 'https://covers.openlibrary.org/b/isbn/9789750807145-L.jpg', 1),
('Dune', 'Frank Herbert', 'Politika, ekoloji ve guc dengeleriyle kurulu bilim kurgu romani.', 360.00, 17, 'https://covers.openlibrary.org/b/isbn/9780441172719-L.jpg', 1),
('Fahrenheit 451', 'Ray Bradbury', 'Kitaplarin yasaklandigi bir gelecekte dusunce ozgurlugunu sorgular.', 125.00, 27, 'https://covers.openlibrary.org/b/isbn/9781451673319-L.jpg', 1),
('Kucuk Prens', 'Antoine de Saint-Exupery', 'Cocuk ve yetiskin okurlar icin sade ama derin bir anlatim.', 75.00, 50, 'https://covers.openlibrary.org/b/isbn/9780156012195-L.jpg', 1),
('Beyaz Zambaklar Ulkesinde', 'Grigory Petrov', 'Egitim ve toplumsal kalkinma uzerine ilham veren eser.', 70.00, 32, 'https://covers.openlibrary.org/b/isbn/9786053841509-L.jpg', 1),
('Bir Omur Nasil Yasanir', 'Ilber Ortayli', 'Yasam, kultur ve kariyer uzerine sohbet tadinda oneriler.', 160.00, 25, 'https://covers.openlibrary.org/b/isbn/9786050958903-L.jpg', 1),
('Ustaligin 48 Yasasi', 'Robert Greene', 'Guc iliskileri ve stratejik davranislar uzerine populer inceleme.', 290.00, 10, 'https://covers.openlibrary.org/b/isbn/9780140280197-L.jpg', 1),
('Atomik Aliskanliklar', 'James Clear', 'Kucuk aliskanliklarin buyuk sonuclara etkisini anlatan kisisel gelisim kitabi.', 255.00, 30, 'https://covers.openlibrary.org/b/isbn/9780735211292-L.jpg', 1),
('Clean Code', 'Robert C. Martin', 'Okunabilir ve surdurulebilir yazilim gelistirme prensipleri.', 520.00, 9, 'https://covers.openlibrary.org/b/isbn/9780132350884-L.jpg', 1),
('PHP ve MySQL', 'Web Akademi', 'Temel PHP, form islemleri, oturum ve veritabani konularini anlatir.', 199.00, 21, 'https://covers.openlibrary.org/b/isbn/9781491905012-L.jpg', 1),
('Laravel ile Web Gelistirme', 'Kod Atolyesi', 'MVC mimarisi, rota, model ve blade temellerini orneklerle aciklar.', 275.00, 14, 'https://covers.openlibrary.org/b/isbn/9781785283017-L.jpg', 1),
('Veritabani Sistemleri', 'Akademik Yayin', 'Iliskisel model, SQL, ER diyagrami ve normalizasyon konularini kapsar.', 235.00, 16, 'https://covers.openlibrary.org/b/isbn/9780133970777-L.jpg', 1);

