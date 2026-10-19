 install:
	docker compose run --rm app composer create-project laravel/laravel .
	docker compose run --rm app php artisan key:generate

up:
	docker compose up -d

down:
	docker compose down

shell:
	docker compose exec app bash

artisan:
	docker compose exec app php artisan $(cmd)

migrate:
	docker compose exec app php artisan migrate

migrate-fresh:
	docker compose exec app php artisan migrate:fresh --seed

logs:
	docker compose logs -f
