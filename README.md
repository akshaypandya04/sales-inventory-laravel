# Sales Inventory System (Laravel)

This is a web-based Sales Inventory Management System built with Laravel.

## 🔧 Features

- Sales entry with customer, item, dimensions, and pricing
- Automatic square footage calculation
- Discount and final amount handling
- Purchase and stock management
- Expense tracking

## 📦 Tech Stack

- PHP 7.4
- Laravel 5.8
- MySQL
- Bootstrap 3
- JavaScript / jQuery

## 🛠️ Setup

```bash
git clone https://github.com/akshaypandya04/sales-inventory-laravel.git
cd sales-inventory-laravel
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate