#!/bin/sh

# -------------------------------------------------------
# 1. Ensure vendor folder exists (your original logic)
# -------------------------------------------------------
if [ ! -d "/var/www/vendor" ]; then
    echo "Copying vendor/ from image to mounted volume..."
    cp -r /tmp/vendor /var/www/vendor
fi

# -------------------------------------------------------
# 2. Ensure Laravel required folders exist
# -------------------------------------------------------
mkdir -p /var/www/html/storage/logs
mkdir -p /var/www/html/bootstrap/cache

# Create log file if missing
if [ ! -f "/var/www/html/storage/logs/laravel.log" ]; then
    touch /var/www/html/storage/logs/laravel.log
fi

# -------------------------------------------------------
# 3. Fix permissions (critical for volumes)
# -------------------------------------------------------
echo "Fixing storage & cache permissions..."

chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# -------------------------------------------------------
# 4. Continue with default CMD
# -------------------------------------------------------
exec "$@"
