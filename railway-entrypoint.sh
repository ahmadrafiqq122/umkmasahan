#!/bin/bash

echo "🚀 Starting Laravel Application on Railway..."

# Generate app key if not exists
if [ -z "$APP_KEY" ]; then
    echo "⚠️  APP_KEY not found, generating..."
    php artisan key:generate --force --no-interaction
fi

# Run migrations
echo "📦 Running database migrations..."
php artisan migrate --force --no-interaction

# Clear and cache config
echo "⚡ Optimizing application..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Create storage link
echo "🔗 Creating storage link..."
php artisan storage:link || echo "Storage link already exists"

# Seed database if SEED_DATABASE=true
if [ "$SEED_DATABASE" = "true" ]; then
    echo "🌱 Seeding database..."
    php artisan db:seed --force --no-interaction
fi

# Start PHP server
echo "✅ Starting web server on port $PORT..."
php -S 0.0.0.0:$PORT -t public/
