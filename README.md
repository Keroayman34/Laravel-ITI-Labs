# 🚀 Laravel ITI Labs Project

A full-stack Laravel project built during my Laravel training at ITI, covering core backend concepts, clean architecture, and real-world development practices.

This project demonstrates my ability to build scalable web applications using Laravel with proper structure, validation, authentication, and API development.

---

## 📌 Overview

This project includes:

- Full CRUD system for Posts
- User management and relationships
- Authentication using Laravel Breeze
- Image upload & storage handling
- Soft Deletes with restore functionality
- Polymorphic relationships (Comments)
- RESTful API with authentication (Sanctum)
- Clean JSON responses using API Resources
- Slug system for SEO-friendly URLs

---

## 🛠️ Tech Stack

- Laravel (Latest Version)
- PHP
- MySQL
- Laravel Breeze (Authentication)
- Laravel Sanctum (API Auth)
- Tailwind CSS
- Eloquent ORM

---

## 📅 Project Breakdown

### 🟢 Day 1 - CRUD System

- Built full CRUD operations for Posts
- Created Post model, migration, controller, and views
- Connected posts to users using relationships
- Displayed posts in a clean UI

---

### 🟢 Day 2 - Validation & Forms

- Implemented Form Request validation (Store & Update)
- Validation rules:
  - Title: required, min:3, unique
  - Description: required, min:10
- Handled update case without breaking unique validation
- Added user dropdown in create/edit forms

---

### 🟢 Day 3 - Advanced Features

- Created 100 Users & 100 Posts using Factories & Seeders
- Implemented Pagination on posts index page
- Formatted dates using Carbon
- Applied Soft Deletes
- Added Restore functionality
- Implemented Polymorphic Relationship (Comments)
  - Add & display comments on posts

---

### 🟢 Day 4 - Authentication & File Upload

- Installed Laravel Breeze for authentication
- Implemented:
  - Login / Register / Logout
- Linked posts to authenticated users
- Added image upload for posts
- Validated uploaded images (type, size)
- Stored images in storage (public disk)
- Displayed images in UI
- Automatically deleted image when post is deleted

---

### 🟢 Day 5 - API Development

- Built RESTful API endpoints:
  - `GET /api/posts`
  - `GET /api/posts/{id}`
  - `POST /api/posts`
- Secured API using Laravel Sanctum
- Used API Resources for structured JSON responses
- Included post creator data using UserResource
- Applied pagination in API responses
- Implemented validation for API requests
- Used Eager Loading for performance optimization

---

### ⭐ Bonus Features

- Implemented Slug system for posts
- Slug auto-generated from title (SEO-friendly)
- Prevented manual slug input
- Displayed slug in UI

---

## 🔐 Authentication

- Web Authentication: Laravel Breeze
- API Authentication: Laravel Sanctum

---

## 📂 Project Structure Highlights

- `app/Models` → Models (Post, User, Comment)
- `app/Http/Controllers` → Business logic
- `app/Http/Requests` → Validation logic
- `resources/views` → Blade UI
- `routes/web.php` → Web routes
- `routes/api.php` → API routes

---

## ⚙️ Setup Instructions

```bash
git clone <repo-link>
cd project

composer install
npm install
npm run dev

cp .env.example .env
php artisan key:generate

php artisan migrate --seed
php artisan storage:link

php artisan serve
