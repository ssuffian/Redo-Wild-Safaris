set -e
docker-compose exec web mysql -uroot -e "create database if not exists chris_website"
docker-compose exec web mysql -uroot -e "create user if not exists 'chris'@'localhost' identified by 'password'"
docker-compose exec web mysql -uroot -e "grant all privileges on chris_website.* to 'chris'@'localhost'"
