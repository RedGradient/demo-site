Инструкция для запуска.
1. Клонировать репозиторий
2. Перейти в папку demo-site
3. Выполнить docker-compose up --build
4. Выполнить docker-compose exec app composer install
5. Выполнить docker-compose exec app php artisan migrate:fresh --seed

Сайт должен быть доступен на 127.0.0.1:8000.
