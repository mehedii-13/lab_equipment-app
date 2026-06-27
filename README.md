# Lab Equipment App

Laravel 12 project configured with MySQL authentication and custom role-based dashboards.

## Features

- MySQL database configuration
- Register page for new users
- Login page for existing users
- Role-aware redirect after login:
  - student -> `/student/dashboard`
  - lab_admin -> `/admin/dashboard`
  - super_admin -> `/super-admin/dashboard`
- Logout support

## Requirements

- PHP 8.2+
- Composer
- Node.js 18+
- MySQL 8+

## 1) Create MySQL Database

Create a database named `lab_equipment`:

```sql
CREATE DATABASE lab_equipment;
```

If you prefer a different name, update `DB_DATABASE` in `.env`.

## 2) Configure Environment

The project is already set for MySQL in `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=lab_equipment
DB_USERNAME=root
DB_PASSWORD=
```

Update `DB_USERNAME` and `DB_PASSWORD` to match your local MySQL credentials.

## 3) Install Dependencies

```bash
composer install
npm install
```

## 4) App Key and Migrations

```bash
php artisan key:generate
php artisan migrate
```

## 5) Seed Demo Users

```bash
php artisan db:seed
```

Seeded accounts (password: `password`):

- superadmin@example.com (super_admin)
- labadmin@example.com (lab_admin)
- student@example.com (student)

## 6) Run the App

Start backend:

```bash
php artisan serve
```

Start frontend assets:

```bash
npm run dev
```

Open: http://127.0.0.1:8000

## Authentication Routes

- `GET /login` - login page
- `POST /login` - authenticate user
- `GET /register` - register page
- `POST /register` - create user
- `POST /logout` - logout user

## Notes

- Root route `/` redirects guests to `/login`.
- New users can register as `student` or `lab_admin` from the register page.
