DC := docker compose exec
FPM := $(DC) php-fpm
ARTISAN := $(FPM) php artisan
NODE := $(DC) node
NPM := $(NODE) npm

build:
	@docker compose build --no-cache

start:
	@docker compose up -d

stop:
	@docker compose stop

restart: stop start

setup: start composer-install keygen passport node-install

composer-install:
	@$(FPM) composer install

composer-dumpautoload:
	@$(FPM) composer dumpautoload

keygen:
	@$(ARTISAN) key:generate

passport:
	@$(ARTISAN) passport:keys

clear:
	@$(ARTISAN) optimize:clear

cache-clear:
	@$(ARTISAN) cache:clear

fresh:
	@$(ARTISAN) migrate:fresh

migrate:
	@$(ARTISAN) migrate

rollback:
	@$(ARTISAN) migrate:rollback

seed:
	@$(ARTISAN) db:seed

bash:
	@$(FPM) bash

node-bash:
	@$(NODE) bash

node-install:
	@$(NPM) install

node-dev:
	@$(NPM) run dev

node-build:
	@export NODE_OPTIONS=--openssl-legacy-provider && $(NPM) run prod

test:
	@$(ARTISAN) test
