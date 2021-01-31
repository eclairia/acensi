# Test technique Acensi

Pour installer le projet, lancer les commandes suivantes:
```
composer install
yarn install
```

puis créer le fichier .env.local en vous basant sur le fichier .env.

Pour créer la base de données:
- Créer la base de données acensi avec la commande:
```
mysql -uyour_user -pyour_password -e "CREATE DATABASE acensi"
```
- Lancer les fichiers de migration avec la commande:
```
php bin/console doctrine:migrations:migrate
```
- Ajouter les données dans la base de données en important le fichier acensi.sql avec la commande:
```
mysql -uyour_user -pyour_password acensi < acensi.sql
```

Pour build les assets:
```
yarn run dev
```

Pour lancer le serveur web:
```
symfony server:start
```

puis accéder au site avec l'url localhost:8000/students.

La documentation se trouve à l'url localhost:8000/docs.