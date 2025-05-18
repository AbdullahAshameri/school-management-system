# Student Management and Tracking System

A complete school management system built with **Laravel** and **Livewire**.  
Supports Arabic and English with modules such as student records, attendance, grades, promotions, file uploads, notifications, and more.

---

## Features

- Multi-role login system (Admin, Teacher, Parent)
- Student, teacher, class, and subject management
- Attendance tracking (teacher role)
- Upload student/teacher images (Polymorphic Relations)
- Real-time multilingual UI (using `spatie/laravel-translatable`)
- Promotions & graduation system (with rollback)
- SoftDeletes for recoverable deletion
- Multi-file upload via custom Trait

---

## Technical Stack

- Laravel 7 + Livewire
- Live, step-by-step wizards & validation
- Database Transactions for consistency
- `updateOrCreate()` to avoid duplicates
- Repository Pattern for code maintainability
- Schema designed via Laravel Schema Designer & XMind

---

## Installation Guide

```bash
# 1. Clone the repository
git clone https://github.com/AbdullahAshameri/school-management-system.git

# 2. Navigate to the folder
cd school-management-system

# 3. Install dependencies
composer install

# 4. Copy .env and generate app key
cp .env.example .env
php artisan key:generate

# 5. Set up database
# DB Name: school_db
# Username: admin@gmail.com
# Password: password

# 6. Run migrations
php artisan migrate

# 7. Serve the app
php artisan serve

