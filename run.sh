#!/bin/bash
echo -n "Начало установки..."
cp .env.example .env
if docker-compose up -d --build; then
    docker-compose exec php-fpm composer install
    docker-compose exec php-fpm php artisan key:generate
    docker-compose exec php-fpm php artisan migrate -n --force
    docker-compose exec php-fpm php artisan cache:clear
    docker-compose exec php-fpm npm run development
    docker-compose exec php-fpm php artisan queue:work --tries=3 &
    echo "\nГотово. В браузере набираем: http://localhost:8068"
else
        echo "Не удалось запустить контейнеры!!!\n"
fi

