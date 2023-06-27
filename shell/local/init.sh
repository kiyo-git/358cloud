cd /var/www/html/pist6
cp .env.local .env
composer install
npm install
npm run build
php artisan cache:clear
php artisan config:cache
php artisan optimize
php artisan key:generate
php artisan migrate:fresh --seed