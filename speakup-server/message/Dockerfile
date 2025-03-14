FROM php:8.3-cli

# Installer les dépendances nécessaires pour Composer et le Datastax PHP Driver
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    libzip-dev \
    libssl-dev \
    libsasl2-dev \
    libcurl4-openssl-dev \
    libprotobuf-dev \
    protobuf-compiler \
    wget \
    python3 \
    python3-pip \
    && docker-php-ext-install zip

WORKDIR /var/php

# Copier Composer dans le conteneur
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Mettre à jour Composer
RUN composer self-update

# Copier les fichiers de l'application dans le conteneur
COPY . /var/php

# Installer les dépendances PHP via Composer
RUN composer install

# Installer cqlsh
RUN wget https://downloads.apache.org/cassandra/5.0.3/apache-cassandra-5.0.3-bin.tar.gz \
    && tar -xzf apache-cassandra-5.0.3-bin.tar.gz \
    && mv apache-cassandra-5.0.3 /opt/cassandra \
    && ln -s /opt/cassandra/bin/cqlsh /usr/local/bin/cqlsh

# Copier le script d'initialisation et les fichiers CQL
COPY ./sql/init-cql.sh /var/php/init-cql.sh
COPY ./sql/init-messages.cql /var/php/init-messages.cql

# Donner les droits d'exécution au script d'initialisation
RUN chmod +x /var/php/init-cql.sh

# Commande pour démarrer le serveur PHP et exécuter le script d'initialisation CQL
CMD ["/bin/bash", "/var/php/init-cql.sh", "&&", "php", "-S", "0.0.0.0:80", "-t", "public"]
