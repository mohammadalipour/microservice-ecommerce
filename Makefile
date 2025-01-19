# Load environment variables from .env file
ifneq ("$(wildcard .env)","")
	include .env
endif

# Start all services in detached mode
.PHONY: up
up:
	@echo "Starting all services..."
	docker-compose -f docker-compose.yml -f api-gateway/docker-compose.yml -f product-service/docker-compose.yml -f user-service/docker-compose.yml -f shopping-service/docker-compose.yml -f inventory-service/docker-compose.yml up -d

# Build all services in detached mode
.PHONY: up
build:
	@echo "Building all services..."
	docker-compose -f docker-compose.yml -f api-gateway/docker-compose.yml -f product-service/docker-compose.yml -f user-service/docker-compose.yml -f shopping-service/docker-compose.yml -f inventory-service/docker-compose.yml up --build

# Start all services in detached mode
.PHONY: up
down:
	@echo "Starting all services..."
	docker-compose -f docker-compose.yml -f api-gateway/docker-compose.yml -f product-service/docker-compose.yml -f user-service/docker-compose.yml down


# Start all services in detached mode
.PHONY: user-service
user-service:
	@echo "Starting user-service service..."
	docker-compose -f docker-compose.yml -f user-service/docker-compose.yml up -d
