db-up:
	docker compose up -d

db-down:
	docker compose down

db-restart:
	docker compose down
	docker compose up -d

db-migrate:
	php artisan migrate

db-seed:
	php artisan db:seed

db-migrate-fresh:
	php artisan migrate:fresh

db-migrate-fresh-seed:
	php artisan migrate:fresh --seed
