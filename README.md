# お問い合わせフォーム

## 環境構築

### Docker ビルド

    1.git clone git@github.com:matsu-shima-130/contact-form-exam.git
    2.cd contact-form-exam
    3.docker-compose up -d --build

### Laravel 環境構築

    1.docker-compose exec php bash
    2.composer install
    3.cp .env.example .env
    4.php artisan key:generate
    5.php artisan migrate
    6.php artisan db:seed

## 使用技術

・PHP 8.x
・Laravel 10.x
・MySQL 8.0
・Docker

## URL

開発環境: http://localhost/

phpMyAdmin: http://localhost:8080/