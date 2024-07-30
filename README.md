# Notes App

## Loyiha Haqida
Bu loyiha oddiy eslatmalar ilovasidir, PHP va MySQL yordamida ishlab chiqilgan. Foydalanuvchilar eslatmalar qo'shish, tahrirlash va o'chirish imkoniyatiga ega.

## O'rnatish

### Talablar
- PHP 7.4 yoki undan yuqori
- MySQL
- Apache yoki Nginx

### O'rnatish Bosqichlari

1. **Loyihani klonlash:**
   ```bash
   git clone https://github.com/username/repository.git
2. **Ma'lumotlar bazasini sozlash:

db.php faylini oching va ma'lumotlar bazasiga ulanish uchun quyidagi o'zgaruvchilarni sozlang:   
```<?php
$servername = "localhost";
$username = "sobirjon";
$password = "4061";
$dbname = "notes_db";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
```
3. **Ma'lumotlar bazasini yaratish:

MySQL serveriga kirib, quyidagi SQL kodlarni bajarib, notes_db ma'lumotlar bazasini va notes jadvalini yarating:
```bash
CREATE DATABASE notes_db;
USE notes_db;

CREATE TABLE notes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL
);
```
4. Veb-serverni ishga tushirish:

Apache yoki Nginx serverini ishga tushiring va loyihaning joriy papkasini serverning hujjat ildiziga sozlang.

### Foydalanish
*Eslatma qo'shish:
Asosiy sahifada, Title va Description maydonlarini to'ldiring va "Add Note" tugmasini bosing.

*Eslatmani tahrirlash:
"Edit" tugmasini bosib, modal oynada eslatma ma'lumotlarini tahrir qiling, so'ngra "Update Note" tugmasini bosing.

*Eslatmani o'chirish:
"Delete" tugmasini bosib, eslatmani o'chiring.

### API Router
/api/notes - Eslatmalar ro'yxatini olish yoki yangi eslatma qo'shish.

*GET: Eslatmalar ro'yxatini olish.
POST: Yangi eslatma qo'shish.
/api/notes/{id} - Ma'lum bir eslatmani olish, yangilash yoki o'chirish.

*GET: Eslatmani olish.
*PUT: Eslatmani yangilash.
*DELETE: Eslatmani o'chirish.
### Telegram Bot
Telegram bot yordamida eslatmalarni boshqarish imkoniyatlarini qo'shish mumkin. Bot yordamida eslatma qo'shish, tahrirlash va o'chirish mumkin bo'ladi. Telegram bot API hujjatlari va token olish uchun Telegram BotFather ga murojaat qiling.

### Hissalar
Agar siz ushbu loyihaga hissa qo'shmoqchi bo'lsangiz, iltimos, issues bo'limida xabar qoldiring yoki pull requests yuboring.

###Litsenziya
```
Loyiha MIT litsenziyasi ostida tarqatiladi. Batafsil ma'lumot uchun LICENSE faylini ko'ring.
```
