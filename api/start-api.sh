sleep 1 &
process_id=$!
wait $process_id

php artisan migrate &

php artisan queue:work &

php artisan serve --port 9000
