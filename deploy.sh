#!/bin/bash

# Définir les répertoires des projets
FRONTEND_DIR="frontend"
BACKEND_DIR="backend-v2"

# Construire et démarrer le projet frontend
echo "Building and starting frontend..."
cd "$FRONTEND_DIR" || exit
sudo docker compose build
sudo docker compose up -d

# Revenir au répertoire parent
cd ..

# Construire et démarrer le projet backend
echo "Building and starting backend..."
cd "$BACKEND_DIR" || exit
sudo docker compose -f examples/echotest-jsonrpc/docker-compose.yaml build
sudo docker compose -f examples/echotest-jsonrpc/docker-compose.yaml up -d

# Revenir au répertoire parent
cd ..

echo "Projects are up and running."
