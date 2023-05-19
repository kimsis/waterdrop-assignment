cd backend

docker-compose down

docker rm $(docker ps -aq)

docker rmi $(docker images)

docker rm -v $(docker volume ps)