# About the project

The project has been split into 2 (well maybe 3) logical parts.

- The api, built with Laravel
- The frontend, built with Vue3
- The Postgres database

# Pre-requisites

- Composer needs to be installed
- yarn needs to be installed

# Deployment

For ease of use and development, all the services (api, db, frontend) can be started in docker containers.

To do this, navigate to the project folder (/waterdrop-assignment) and run the following:

- $ chmod 777 setup_env.sh
- $ ./setup_env.sh
- $ docker-compose up --build -d

# Testing

Tests can be run on the API, by running 'php artisan test' in the /api folder

# Service Access
No additional setup should be required, as the docker containers equip themselves.

- The frontend will be available at localhost:8000
- The api will be available at localhost:9000
- The database will be available at localhost:5432

# Api secret key

A secret key is used to authorize the api, being the very secure keyword 'secret_key'
In the api, it is stored in the .env file, however in the fe it is hardcoded (couldn't get it working with a shared env file)

# Postman

A postman collection has been exported, 'waterdrop.postman_collection.json'.
It contains:

- GET request for retrieving all dogs
- GET request for retrieving dogs containing provided name
- POST request for creating a single dog

# WARNING

In case of trouble with the docker containers, there is a 'clear-dockers.sh' script, which will stop and clean everything.
!!! DANGER !!! It will remove ALL docker containers/volumes/networks/images on the machine.
