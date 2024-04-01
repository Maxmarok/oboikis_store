DOCKER_COMPOSE=docker-compose -f docker/docker-compose.yml --project-name=oboikis-store
DOCKER_COMPOSE_PROD=docker-compose -f docker/docker-compose-prod.yml --project-name=oboikis-store-prod

init:
	make build
	make up
	make install
	make storage_link
	make migrate
build:
	${DOCKER_COMPOSE} build app
up:
	${DOCKER_COMPOSE} up -d
ps:
	${DOCKER_COMPOSE} ps
env:
	cp ../.env.example ../.env
install:
	${DOCKER_COMPOSE} exec app composer install
update:
	${DOCKER_COMPOSE} exec app composer update
down:
	${DOCKER_COMPOSE} down --remove-orphans
shell:
	${DOCKER_COMPOSE} exec app php bash
migrate:
	${DOCKER_COMPOSE} exec app php artisan key:generate
	${DOCKER_COMPOSE} exec app php artisan migrate:fresh
test_migrate:
	${DOCKER_COMPOSE} exec app php artisan migrate:fresh --seed --env=testing
migrate_seed:
	${DOCKER_COMPOSE} exec app php artisan migrate:fresh --seed
seed:
	${DOCKER_COMPOSE} exec app php artisan migrate --seed
test:
	${DOCKER_COMPOSE} exec app php artisan test
npm_install:
	${DOCKER_COMPOSE} exec node npm install
	make npm_build
npm_build:
	${DOCKER_COMPOSE} exec node npm run build
npm_dev:
	${DOCKER_COMPOSE} exec node npm run dev
work:
	${DOCKER_COMPOSE} exec app php artisan queue:work
storage_link:
	${DOCKER_COMPOSE} exec app rm -rf public/storage
	${DOCKER_COMPOSE} exec app php artisan storage:link
clear:
	${DOCKER_COMPOSE} exec app php artisan route:clear
	${DOCKER_COMPOSE} exec app php artisan cache:clear
	${DOCKER_COMPOSE} exec app php artisan config:clear
	${DOCKER_COMPOSE} exec app php artisan queue:restart
retry:
	${DOCKER_COMPOSE} exec app php artisan queue:retry all
start:
	${DOCKER_COMPOSE} start
rm:
	${DOCKER_COMPOSE} rm
stop:
	${DOCKER_COMPOSE} stop
restart:
	make stop && make start
rebuild:
	make down && make build && make up
retry_jobs:
	${DOCKER_COMPOSE} exec supervisor php artisan queue:retry all
db_seed:
	${DOCKER_COMPOSE} exec supervisor php artisan db:seed
ziggy:
	${DOCKER_COMPOSE} exec supervisor php artisan ziggy:generate
add_items:
	${DOCKER_COMPOSE} exec app php artisan items:add

prod_build:
	${DOCKER_COMPOSE_PROD} build app
prod_up:
	${DOCKER_COMPOSE_PROD} up -d
prod_install:
	${DOCKER_COMPOSE_PROD} exec app composer install
prod_update:
	${DOCKER_COMPOSE_PROD} exec app composer update
prod_down:
	${DOCKER_COMPOSE_PROD} down --remove-orphans
prod_migrate_seed:
	${DOCKER_COMPOSE_PROD} exec app php artisan migrate:fresh --seed
prod_npm_install:
	${DOCKER_COMPOSE_PROD} exec node npm install
	make prod_npm_build
prod_npm_build:
	${DOCKER_COMPOSE_PROD} exec node npm run build
prod_clear:
	${DOCKER_COMPOSE_PROD} exec app php artisan route:clear
	${DOCKER_COMPOSE_PROD} exec app php artisan cache:clear
	${DOCKER_COMPOSE_PROD} exec app php artisan config:clear
	${DOCKER_COMPOSE_PROD} exec app php artisan queue:restart
prod_tinker:
	${DOCKER_COMPOSE_PROD} exec app php artisan tinker