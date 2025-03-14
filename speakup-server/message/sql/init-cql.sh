#!/bin/bash

# Attendre que ScyllaDB soit prêt à accepter des connexions
echo "Attente que ScyllaDB soit prêt..."
until cqlsh speakup-server-messages.db-1 -e 'describe keyspaces'; do
  sleep 5
done

# Exécuter le script d'initialisation CQL
echo "Exécution du script d'initialisation..."
cqlsh speakup-server-messages.db-1 -f /var/php/init-messages.cql

# Lancer le serveur PHP
echo "Démarrage du serveur PHP..."
exec php -S 0.0.0.0:80 -t /var/php/public
