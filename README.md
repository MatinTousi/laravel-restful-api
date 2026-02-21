# 🚀 Laravel RESTful API – Admin Authentication (Sanctum)

A RESTful API built with Laravel using **Admin-based authentication** powered by **Laravel Sanctum**.

This project demonstrates secure token-based authentication and CRUD operations for posts.

---

## 📌 Features

- ✅ Admin Registration
- ✅ Admin Login (Token Generation)
- ✅ Secure Logout (Token Deletion)
- ✅ Protected Post Routes
- ✅ RESTful API Structure
- ✅ Token-based Authentication (Sanctum)
- ✅ Middleware Protection
- ✅ JSON Responses

---

## 🛠️ Tech Stack

- Laravel
- Laravel Sanctum
- MySQL
- RESTful API Architecture
- Postman (for testing)

---

## ⚙️ Installation

Clone the repository:

```bash
git clone https://github.com/MatinTousi/laravel-restful-api.git
cd laravel-restful-api
```
### Install dependencies:
```bash
composer install
```


### Set up your database inside .env, then run:
```bash
php artisan migrate
```

### Run the server:
```bash
php artisan serve
```
___
## 🔐 Authentication Flow (Admin)
### 1️⃣ Register Admin
``` js
POST /api/admin/register
```
#### Request body (JSON):
``` json
{
  "name": "Admin Name",
  "email": "admin@example.com",
  "password": "123456",
  "password_confirmation": "123456"
}
```
___
## 2️⃣ Login Admin
``` js
POST /api/admin/login
``` 
#### Request body (JSON):
``` json
{
  "email": "admin@example.com",
  "password": "123456"
}

Response:

{
  "token": "your_generated_token"
}
```

### This token is used to access protected routes.

## 3️⃣ Using Token in Postman

Set Authorization → Bearer Token

Paste your token from login response

### Add Header:

Accept: application/json
## 4️⃣ Logout Admin
```js
POST /api/admin/logout
```
> [!WARNING]  
>This deletes the current access token.

___
### 📂 Protected Routes (Require Token)
Method	Endpoint	Description
GET	/api/posts	Get all posts
POST	/api/posts/store	Create a new post
DELETE	/api/posts/delete/{id}	Delete a post by ID
___
### 🧠 Project Structure

Admin model used for authentication

Custom guard configured for Sanctum

Middleware: auth:sanctum

Token-based authentication (No session)

Routes are in routes/api.php

Controllers handle authentication and post CRUD
___
### 📌 Database Policy

The database file is not included in this repository for security reasons.

Instead, the project uses:

✅ Laravel Migrations to create the database structure

✅ (Optional) Seeders to generate test data

To set up the database after cloning the project:

php artisan migrate
php artisan db:seed

 This ensures a clean, secure, and reproducible database setup without exposing sensitive data. 
___
### 👨‍💻 Author

Matin Tousi


Backend Developer Laravel

