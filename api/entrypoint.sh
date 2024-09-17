#!/bin/bash

# Wait for MySQL to be ready
until php bin/console doctrine:query:sql "SELECT 1" &> /dev/null; do
    echo "Waiting for database connection..."
    sleep 5
done

# Run migrations
php bin/console doctrine:migrations:migrate --no-interaction

# Load data fixtures
php bin/console doctrine:fixtures:load --no-interaction

php-fpm
