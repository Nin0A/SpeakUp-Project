FROM golang:stretch

# Définissez le répertoire de travail
WORKDIR /go/src/github.com/pion/ion-sfu

# Copiez les fichiers go.mod et go.sum depuis le répertoire racine du dépôt
COPY go.mod go.sum ./

# Téléchargez les dépendances Go
RUN go mod download

# Copiez le répertoire sfu depuis le répertoire backend-v2/pkg/sfu
COPY backend-v2/pkg/sfu/ ./pkg/

# Copiez le répertoire cmd depuis le répertoire approprié
COPY cmd/ ./cmd/

# Copiez le fichier de configuration depuis le répertoire racine du dépôt
COPY config.toml ./

# Construisez l'application
RUN go build -o /usr/local/bin/ion-sfu ./cmd/signal/json-rpc/main.go

# Exposez les ports nécessaires
EXPOSE 7000
EXPOSE 5000-5200/udp

# Commande pour démarrer l'application
CMD ["ion-sfu", "-c", "config.toml"]
