server-enter:
	@ssh root@5.199.168.121

# rsync -avz ~/Alfredo/Personal/Proyectos/jorgeUsa/listoclean/assets/ root@194.62.96.38:/home/sobunny/core/public/assets/ &
# 194.62.96.38
enter:
	@docker exec -it php-sobunny /bin/bash
clear:
	@docker exec -it php-sobunny /bin/bash -c "php artisan config:cache && php artisan cache:clear && php artisan config:clear && php artisan route:clear && php artisan route:cache"

# export-db:
# 	docker exec -i mysql-sobunny mysqldump -u root -p1234 db > sobunny.sql
export-db:
	@read -p "Nombre de la base de datos: " DB_NAME; \
	read -sp "Contraseña: " PASSWORD; \
	echo ""; \
	docker exec -i mysql-sobunny mysqldump -u root -p$$PASSWORD $$DB_NAME > sobunny.sql

import-db:
	@docker exec -i mysql-sobunny mysql -u user -ppassword -e "DROP DATABASE IF EXISTS db; CREATE DATABASE db;"
	@docker exec -i mysql-sobunny mysql -u user -ppassword db < sobunny.sql
