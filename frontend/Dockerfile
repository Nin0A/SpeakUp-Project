# Utilisez une version compatible de Node.js
FROM node:20

# Définissez le répertoire de travail dans le conteneur
WORKDIR /app

# Copiez les fichiers package.json et yarn.lock
COPY package.json yarn.lock ./

# Installez les dépendances
RUN yarn install

# Copiez le reste des fichiers de l'application
COPY . .

# Définissez la variable d'environnement pour OpenSSL
ENV NODE_OPTIONS=--openssl-legacy-provider

# Construisez l'application Vue.js
RUN yarn build

# Exposez le port sur lequel l'application sera accessible
EXPOSE 8080

# Commande pour démarrer l'application
CMD ["yarn", "serve"]
