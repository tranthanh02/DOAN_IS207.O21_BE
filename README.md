<!-- Banner -->
<p align="center">
  <a href="https://www.uit.edu.vn/" title="Trường Đại học Công nghệ Thông tin" style="border: none;">
    <img src="https://i.imgur.com/WmMnSRt.png" alt="Trường Đại học Công nghệ Thông tin | University of Information Technology">
  </a>
</p>

<h1 align="center"><b>PHÁT TRIÊN ỨNG DỤNG WEB</b></h1>

# Thành viên nhóm

| STT |   MSSV   |       Họ và Tên |    Chức Vụ |
| --- | :------: | --------------: | ---------: |
| 1   | 17520375 |   Ngọ Viết Dũng | Thành viên |
| 2   | 20521926 | Trần Ngọc Thành | Thành viên |
| 3   | 21522254 |   Lê Chánh Kiệt | Thành viên |
| 4   | 22521594 |       Vũ Anh Tú | Thành viên |
| 5   | 22521633 |  Phạm Văn tuyên | Thành viên |

# GIỚI THIỆU MÔN HỌC

-   **Tên môn học:** Phát triển ứng dụng web
-   **Mã môn học:** IS207.021
-   **Năm học:** HK2 (2023 - 2024)
-   **Giảng viên**:Nguyễn Dương Tùng

# ĐỒ ÁN CUỐI KÌ

-   **Đề tài:** Trang web bán giày

1, học PHP and laravel
-PHP:https://www.youtube.com/playlist?list=PL8y3hWbcppt21UiT79eZNhGYHmVJVV4xx
-laravel : https://www.youtube.com/watch?v=sMXkSWFlV28&list=PL8y3hWbcppt2nWBglaxrQm_A5sRjstdnK

2, install
-visual studio code

-   postman
    -XAMPP : https://www.apachefriends.org/download.html
    -composer :https://laravel.com/docs/4.2
    -mysql workbech :https://www.youtube.com/watch?v=BYwb50Xbf8s

# API Documentation

## Authentication

-   **Register (token)**

    -   Method: `POST`
    -   Endpoint: `/auth/register`

-   **Login (token)**

    -   Method: `POST`
    -   Endpoint: `/auth/login`

-   **Reset Password**

    -   Method: `POST`
    -   Endpoint: `/auth/reset-password`
    -   Middleware: `auth:api`

-   **Get User Info**

    -   Method: `GET`
    -   Endpoint: `/auth/user-infor`
    -   Middleware: `auth:api`

-   **Login with Google**
    -   Method: `POST`
    -   Endpoint: `/auth/google`

## User

-   **Update User Info**

    -   Method: `PUT`
    -   Endpoint: `/user/update-user-info`
    -   Middleware: `auth:api`

-   **Change Password**

    -   Method: `POST`
    -   Endpoint: `/user/change-password`
    -   Middleware: `auth:api`

-   **Get All Bills by User ID**

    -   Method: `GET`
    -   Endpoint: `/user/get-all-bills`
    -   Middleware: `auth:api`

-   **Get Users List**

    -   Method: `GET`
    -   Endpoint: `/users`

-   **Search Users by Name**

    -   Method: `GET`
    -   Endpoint: `/users/search`

-   **Update User Info (Admin)**
    -   Method: `PUT`
    -   Endpoint: `/user/update-user-info-admin/{id}`

## Favorites

-   **Add to Favorites**

    -   Method: `POST`
    -   Endpoint: `/user-favorites/add`
    -   Middleware: `auth:api`

-   **Remove from Favorites**

    -   Method: `POST`
    -   Endpoint: `/user-favorites/remove`
    -   Middleware: `auth:api`

-   **Get User Favorites**
    -   Method: `GET`
    -   Endpoint: `/favorites/{userId}`
    -   Middleware: `auth:api`

## Product

-   **Get Product List**

    -   Method: `GET`
    -   Endpoint: `/products`

-   **Get Product by ID**

    -   Method: `GET`
    -   Endpoint: `/products/{productId}`

-   **Get All Images by Product ID**

    -   Method: `GET`
    -   Endpoint: `/products/{productId}/images`

-   **Get Top 10 Best-Selling Products**

    -   Method: `GET`
    -   Endpoint: `/top-products`

-   **Search Products**

    -   Method: `GET`
    -   Endpoint: `/search-products`

-   **Update Product Quantity After Purchase**

    -   Method: `PATCH`
    -   Endpoint: `/products/{id}/purchase`

-   **Add Product (Admin)**

    -   Method: `POST`
    -   Endpoint: `/product/add-product`

-   **Update Product (Admin)**

    -   Method: `PUT`
    -   Endpoint: `/product/update-product/{id}`

-   **Delete Product (Admin)**
    -   Method: `DELETE`
    -   Endpoint: `/product/delete-product/{id}`

## Product Style

-   **Get Products by Style ID**

    -   Method: `GET`
    -   Endpoint: `/products-style/{styleId}`

-   **Get Product Style List**
    -   Method: `GET`
    -   Endpoint: `/products-style`

## Bill

-   **Create Bill**

    -   Method: `POST`
    -   Endpoint: `/bill/create-bill`

-   **Get Bills by User**

    -   Method: `GET`
    -   Endpoint: `/bill/get-bill-user`
    -   Middleware: `auth:api`

-   **Get Bills List**

    -   Method: `GET`
    -   Endpoint: `/bill`

-   **Get Bill by ID**
    -   Method: `GET`
    -   Endpoint: `/bill/{billId}`

## Revenue

-   **Get Monthly Revenue**

    -   Method: `GET`
    -   Endpoint: `/revenue/monthly/{year}`

-   **Get Yearly Revenue**
    -   Method: `GET`
    -   Endpoint: `/revenue/yearly`

# Project Setup

## 1. Clone Project

----->1.clone project
----->2. tạo file .env -> paste đoạn dưới -> chạy lệnh : php artisan key:generate
----->3.tạo database : chạy lệnh: php artisan migrate
----->4. chạy seeder : php artisan db:seed --class=ProductsImageTableSeeder or chạy tất cả seeder : php artisan db:seed
or php artisan: migrate:refresh --seed (refresh all) ->php artisan serve (để chạy server)

## 2. Set Up .env File

Create a `.env` file in the root directory of the project and paste the following content. Then run the command: `php artisan key:generate`.

```dotenv
APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=shoe_database
DB_USERNAME=root
DB_PASSWORD=123456

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=mt1

VITE_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
VITE_PUSHER_HOST="${PUSHER_HOST}"
VITE_PUSHER_PORT="${PUSHER_PORT}"
VITE_PUSHER_SCHEME="${PUSHER_SCHEME}"
VITE_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

```
