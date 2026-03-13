#!/bin/sh
set -e

# Ensure storage directories exist with proper structure
mkdir -p storage/logs storage/framework/cache storage/framework/sessions storage/framework/views
chmod -R 775 storage bootstrap/cache

# Initialize SQLite database if it doesn't exist
if [ ! -f database/database.sqlite ]; then
    echo "Creating SQLite database..."
    touch database/database.sqlite
    chown www-data:www-data database/database.sqlite
    chmod 664 database/database.sqlite
    php artisan migrate --force
    php artisan db:seed --force
    echo "Database initialized with migrations and seeds."
else
    echo "Database exists. Running pending migrations..."
    php artisan migrate --force
fi

# Ensure database directory permissions
chown -R www-data:www-data database
chmod -R 775 database

# Copy public files to shared volume so nginx can serve them
if [ -d /var/www/public-shared ]; then
    cp -r public/* /var/www/public-shared/
    echo "Public files synced to shared volume."
fi

# Cache config and routes for production
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Application ready."

exec "$@"
