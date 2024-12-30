# Load environment variables from .env file
ifneq ("$(wildcard .env)","")
	include .env
endif

# Export the variables so they can be used in shell commands
PRODUCT_SERVICE_CONTAINER =product-service

# Function to dynamically include service files (excluding ROOT_COMPOSE)
INCLUDE_SERVICES=$(foreach svc, $(filter-out $(ROOT_COMPOSE), $(ROOT_COMPOSE) $(API_GATEWAY_COMPOSE) $(PRODUCT_SERVICE_COMPOSE)), -f $(svc))

# Debug target to print INCLUDE_SERVICES
.PHONY: debug-includes
debug-includes:
	@echo "Include services: $(INCLUDE_SERVICES)"

# Build all services
.PHONY: build
build:
	@echo "Building all services..."
	docker-compose $(INCLUDE_SERVICES) build

# Start all services in detached mode
.PHONY: up
up:
	@echo "Starting all services..."
	docker-compose -f docker-compose.yml -f api-gateway/docker-compose.yml -f product-service/docker-compose.yml -f user-service/docker-compose.yml up -d

# Start all services in detached mode
.PHONY: up
down:
	@echo "Starting all services..."
	docker-compose -f docker-compose.yml -f api-gateway/docker-compose.yml -f product-service/docker-compose.yml -f user-service/docker-compose.yml down

# Restart all services
.PHONY: restart
restart:
	@echo "Restarting all services..."
	docker-compose -f docker-compose.yml -f api-gateway/docker-compose.yml -f product-service/docker-compose.yml down
	docker-compose -f docker-compose.yml -f api-gateway/docker-compose.yml -f product-service/docker-compose.yml up -d

# Clean up unused resources (containers, networks, volumes)
.PHONY: clean
clean:
	@echo "Removing unused containers, networks, and volumes..."
	docker-compose $(INCLUDE_SERVICES) down --volumes --remove-orphans

ps-migration:
	docker-compose exec -it $(PRODUCT_SERVICE_CONTAINER) php bin/console doctrine:migration:migrate --no-interaction


c-migration:
	docker-compose exec -it $(PRODUCT_SERVICE_CONTAINER) php bin/console