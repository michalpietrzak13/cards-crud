Cards CRUD (Vue 3 + Laravel + MySQL)
Simple CRUD app for “Cards” with pagination and basic validation.

Requirements
PHP 8.2+, Composer
Node 18+

MySQL

Quick start
Backend (Laravel):

cd backend

Copy .env.example to .env and set DB_DATABASE, DB_USERNAME, DB_PASSWORD, and FRONTEND_URL=http://localhost:5173

composer install

php artisan key:generate

php artisan migrate --seed

php artisan serve (http://localhost:8000)

Frontend (Vue + Vite):

cd frontend

Create .env with VITE_API_URL=http://localhost:8000

npm install

npm run dev (http://localhost:5173)

SQL (alternative)
If migrations fail:

run sql/schema.sql and sql/seed.sql
