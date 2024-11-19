server-enter:
	@ssh root@5.199.168.121

# rsync -avz ~/Alfredo/Personal/Proyectos/jorgeUsa/listoclean/assets/ root@194.62.96.38:/home/sobunny/core/public/assets/ &
# 194.62.96.38
enter:
	@docker exec -it php-sobunny /bin/bash
clear:
	@docker exec -it php-sobunny /bin/bash -c "php artisan config:cache && php artisan cache:clear && php artisan config:clear && php artisan route:clear && php artisan route:cache"
