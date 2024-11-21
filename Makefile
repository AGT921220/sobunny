include .env

server-enter:
	@ssh root@$(SERVER_IP)

enter:
	@docker exec -it php-sobunny /bin/bash
clear:
	@docker exec -it php-sobunny /bin/bash -c "php artisan config:cache && php artisan cache:clear && php artisan config:clear && php artisan route:clear && php artisan route:cache"

export-db:
	@read -p "Nombre de la base de datos: " DB_NAME; \
	read -sp "Contraseña: " PASSWORD; \
	echo ""; \
	docker exec -i mysql-sobunny mysqldump -u root -p$$PASSWORD $$DB_NAME > sobunny.sql

import-db:
	@read -p "Nombre de la base de datos: " DB_NAME; \
	read -sp "Contraseña: " PASSWORD; \
	echo ""; \
	@docker exec -i mysql-sobunny mysql -u user -p$$PASSWORD -e "DROP DATABASE IF EXISTS $$DB_NAME; CREATE DATABASE $$DB_NAME;" \
	&& docker exec -i mysql-sobunny mysql -u user -p$$PASSWORD $$DB_NAME < sobunny.sql


# export-db:
# 	docker exec -i mysql-sobunny mysqldump -u root -p1234 db > sobunny.sql
# export-db:
# 	@read -p "Nombre de la base de datos: " DB_NAME; \
# 	read -sp "Contraseña: " PASSWORD; \
# 	echo ""; \
# 	docker exec -i mysql-sobunny mysqldump -u root -p$$PASSWORD $$DB_NAME > sobunny.sql

# import-db:
# 	@docker exec -i mysql-sobunny mysql -u user -ppassword -e "DROP DATABASE IF EXISTS db; CREATE DATABASE db;"
# 	@docker exec -i mysql-sobunny mysql -u user -ppassword db < sobunny.sql
pull-server-database:
	scp root@$(SERVER_IP):/home/sobunny/sobunny.sql .
pull-report-virus:
	scp root@$(SERVER_IP):/var/log/rkhunter.log .
iqnews-server:
	@ssh root@$(SERVER_IP)
full-clear:
	@docker exec -it php-sobunny /bin/bash -c "php artisan config:cache && php artisan cache:clear && php artisan config:clear && php artisan route:clear && php artisan route:cache && php artisan view:clear && php artisan view:cache"
