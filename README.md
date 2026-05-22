# Shelter for Stray Animals

Вебсайт притулку для безпритульних тварин.

Проєкт призначений для перегляду тварин, які шукають дім, подання заявок на усиновлення, надсилання звернень щодо допомоги притулку, роботи з профілем користувача та керування даними тварин, заявок і користувачів.

## Технологічний стек

У проєкті використано такі технології:

- PHP
- Laravel
- Blade
- HTML
- CSS
- Bootstrap
- SQLite
- Composer
- XAMPP

## Системні вимоги

Для локального запуску та розгортання проєкту необхідно мати:

- PHP
- Composer
- SQLite
- Apache або інше серверне середовище з підтримкою PHP
- XAMPP для локального запуску проєкту

База даних у проєкті реалізована за допомогою SQLite і зберігається у файлі:

database/database.sqlite

## Інструкція для розгортання проєкту

1. Клонувати репозиторій:

git clone https://github.com/Dmytro-Demich/shelter-for-stray-animals.git

2. Перейти до каталогу проєкту:

cd shelter-for-stray-animals

3. Встановити залежності Laravel:

composer install

4. Створити файл .env на основі .env.example.

5. Налаштувати підключення до SQLite у файлі .env:

DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite

6. Згенерувати ключ застосунку:

php artisan key:generate

7. Виконати міграції бази даних:

php artisan migrate

8. За потреби заповнити базу початковими даними:

php artisan db:seed

9. Запустити проєкт локально:

php artisan serve

Також проєкт може бути розміщений у каталозі XAMPP htdocs і відкритий через локальний сервер Apache.
