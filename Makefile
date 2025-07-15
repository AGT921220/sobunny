include .env

server-enter:
	@ssh root@$(SERVER_IP)

enter:
	@docker exec -it php-sobunny /bin/bash
clear:
	@docker exec -it php-sobunny /bin/bash -c "cd core && php artisan config:cache && php artisan cache:clear && php artisan config:clear && php artisan route:clear && php artisan route:cache && chown -R www-data:www-data /var/www/html/core/bootstrap/cache && chown -R www-data:www-data /var/www/html/core/storage && php artisan route:cache"

export-db:
	@read -p "Nombre de la base de datos: " DB_NAME; \
	read -sp "Contraseña: " PASSWORD; \
	echo ""; \
	docker exec -i mysql-sobunny mysqldump -u root -p$$PASSWORD $$DB_NAME > sobunny.sql

import-db:
	@read -p "Nombre de la base de datos: " DB_NAME; \
	echo "Conectando con las credenciales del archivo .env..."; \
	docker exec -i mysql-sobunny mysql -u root -p$(DB_PASSWORD) -e "DROP DATABASE IF EXISTS $$DB_NAME; CREATE DATABASE $$DB_NAME;" && \
	docker exec -i mysql-sobunny mysql -u root -p$(DB_PASSWORD) $$DB_NAME < sobunny.sql

# export-db:
# 	docker exec -i mysql-sobunny mysqldump -u root -p1234 db > sobunny.sql
# export-db:
# 	@read -p "Nombre de la base de datos: " DB_NAME; \
# 	read -sp "Contraseña: " PASSWORD; \
# 	echo ""; \
# 	docker exec -i mysql-sobunny mysqldump -u root -p$$PASSWORD $$DB_NAME > sobunny.sql

import-db-old:
	@docker exec -i mysql-sobunny mysql -u user -ppassword -e "DROP DATABASE IF EXISTS db; CREATE DATABASE db;"
	@docker exec -i mysql-sobunny mysql -u user -ppassword db < sobunny_db.sql
pull-server-database:
	scp root@$(SERVER_IP):/home/sobunnyv1/sobunny.sql .
pull-report-virus:
	scp root@$(SERVER_IP):/var/log/rkhunter.log .
iqnews-server:
	@ssh root@$(SERVER_IP)
full-clear:
	@docker exec -it php-sobunny /bin/bash -c "cd core && php artisan config:cache && php artisan cache:clear && php artisan config:clear && php artisan route:clear && php artisan route:cache && php artisan view:clear && php artisan view:cache"

push-server-database:
	@scp sobunny.sql root@$(SERVER_IP):/home/sobunnyv1/
ngrok:
	@ngrok http --host-header=rewrite http://localhost:8088;
pull-images-server:
	scp -r root@$(SERVER_IP):/home/sobunnyv1/assets/uploads .
