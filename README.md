# mixi-m-replace

## ローカル環境のセットアップ
- コンテナの立ち上げ
```
cd path/to/pist6-mixi-replace
docker-compose build --no-cache
docker-compose up -d
```

- コンテナの初期化
```
docker-compose exec php bash
sh /var/www/html/shell/local/init.sh
```

- テストデータの挿入
```
php artisan db:seed --class=OldProfileSeeder
php artisan db:seed --class=OldUserSeeder
php artisan db:seed --class=AdminUserSeeder
php artisan db:seed --class=TicketOrderSeeder
php artisan db:seed --class=TicketOrderPaymentSeeder
```
