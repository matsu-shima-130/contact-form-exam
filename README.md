# お問い合わせフォーム

## 環境構築

### Docker ビルド

1.  リポジトリを取得

    ```bash
    git clone https://github.com/matsu-shima-130/contact-form-exam.git
    cd contact-form-exam
    ```

2.  コンテナを作成・起動

    ```bash
    docker-compose up -d --build
    ```

    ＊MYSQL は、OS によって起動しない場合があるのでそれぞれの PC に合わせて docker-compose.yml ファイルを編集してください。

### Laravel 環境構築

1. PHP コンテナに入る

   ```bash
   docker-compose exec php bash
   ```

2. 依存をインストール & 環境ファイル

   ```bash
   composer install
   cp .env.example .env
   php artisan key:generate
   ```

3. .env の DB 設定

   ```bash
   DB_CONNECTION=mysql
   DB_HOST=mysql
   DB_PORT=3306
   DB_DATABASE=laravel_db
   DB_USERNAME=laravel_user
   DB_PASSWORD=laravel_pass
   ```

4. マイグレーション

   ```bash
   php artisan migrate
   ```

5. シーディング

   ```bash
   php artisan db:seed
   ```

## 使用技術

- PHP 8.1.33
- Laravel 8.83.8
- MySQL 8.0.26
- Nginx 1.21.1

## ER図

```mermaid
erDiagram
  USERS ||--o{ CONTACTS : "created_by (任意)"
  CATEGORIES ||--o{ CONTACTS : "1カテゴリ-多問い合わせ"

  USERS {
    bigint id PK
    string name
    string email UK
    string password
    timestamp email_verified_at
    string remember_token
    timestamps
  }

  CATEGORIES {
    bigint id PK
    string name
    timestamps
  }

  CONTACTS {
    bigint id PK
    bigint category_id FK
    string first_name
    string last_name
    tinyint gender  "1:男性 2:女性 3:その他"
    string email
    string tel
    string postcode
    string address
    string building
    text detail
    timestamps
  }
```

## URL

- 開発環境: http://localhost/
- phpMyAdmin: http://localhost:8080/
