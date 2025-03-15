.PHONY: build up down logs

build:
	sudo docker compose build

up:
	sudo docker compose up -d

down:
	sudo docker compose down

logs:
	sudo docker compose logs -f

install:
	@echo "Installing PHP dependencies..."
	@composer install --working-dir=auth
	@composer install --working-dir=communication
	@composer install --working-dir=gateway
	@composer install --working-dir=message
	@composer install --working-dir=room
	@composer install --working-dir=user

update:
	@echo "Updating PHP dependencies..."
	@composer update --working-dir=auth
	@composer update --working-dir=communication
	@composer update --working-dir=gateway
	@composer update --working-dir=message
	@composer update --working-dir=room
	@composer update --working-dir=user

up-services:
	sudo docker compose up -d