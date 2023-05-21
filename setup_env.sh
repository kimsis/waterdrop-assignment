cp .env.example .env

cd ./api || exit
composer install
cp .env.example .env

cd ../site || exit
yarn