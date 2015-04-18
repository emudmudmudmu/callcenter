THIS_FILE_PATH="$PWD/$0"
cd ${THIS_FILE_PATH%/*}
rm ./app/storage/cache/* -R
rm ./public/dist/img/uploads/* -R
php artisan migrate:rollback
php artisan migrate:rollback
php artisan migrate:rollback
php artisan migrate --package=cartalyst/sentry
php artisan migrate --package=sukohi/surpass
php artisan migrate
php artisan db:seed
php artisan view:publish sukohi/surpass
sudo chmod 777 ./public/dist/img/uploads/* -R