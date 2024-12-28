# Makefile for Symfony with Docker

# Define the container names for convenience
SYMFONY_CONTAINER =product-service

# Enter the Symfony Docker container and start a shell
console:
	docker-compose exec -it $(SYMFONY_CONTAINER) bash

# Run migrations inside the Symfony Docker container
migration:
	docker-compose exec -it $(SYMFONY_CONTAINER) php bin/console doctrine:migration:migrate --no-interaction

# Run migrations inside the Symfony Docker container
seed:
	docker-compose exec -it $(SYMFONY_CONTAINER) php bin/console app:seed-products

# Ensure the containers are up and running before running the migration
up:
	docker-compose up -d

# You can define any other useful make commands below

cc:
	docker-compose exec -it $(SYMFONY_CONTAINER) php bin/console cache:clear