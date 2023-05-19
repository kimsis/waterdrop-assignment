#!/bin/bash

cd backend

docker-compose down
process_id=$!
wait $process_id

docker volume rm $(docker volume ls -q)
process_id=$!
wait $process_id

docker-compose up -d
process_id=$!
wait $process_id

sleep 1
process_id=$!
wait $process_id

php artisan migrate:install
process_id=$!
wait $process_id

php artisan migrate
process_id=$!
wait $process_id

php artisan test
process_id=$!
wait $process_id

php artisan serve
