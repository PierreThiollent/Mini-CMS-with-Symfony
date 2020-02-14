# Projet de mini CMS avec Symfony 🔥

![](./public/assets/images/screenshot.png)

Ce projet de blog/mini CMS a été réalisé lors d'un exercice à la [Normandie Web School](https://normandie-web-school.fr/).
J'ai choisi d'utiliser le framework Symfony pour le réaliser.

## Prérequis 🔧
- Composer
- PHP (^7.2.5)
- Apache
- MySQL

### Installation 🔄
```
$ git clone
```

```
$ cd <project>
```

```
$ composer install
```

### Configuration
Créer un fichier .env.local et y renseigner cette configuration

```
APP_ENV=dev
APP_SECRET=whatever
DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=5.7
```

- db_user : Nom d'utilisateur MySQL
- db_password : Mot de passe de l'utilisateur MySQL
- db_password : cms
- APP_SECRET : Clé à générer aléatoirement

### Initialisation
Exécuter la commande ci-dessous afin de créer la base de données ainsi que les tables.

```
$ php bin/console doctrine:migration:migrate
```

Exécuter la commande ci-dessous pour ajouter des données de test 

```
$ php bin/console doctrine:fixtures:load
```

### Lancement 
Pour lancer le serveur de developpement, exécuter la commande 

```
$ symfony serve
``` 

ou lancer un serveur MAMP/WAMP

### Utilisation
- Serveur symfony : http://127.0.0.1:8000
- Serveur MAMP/WAMP : http://localhost:80/nom-du-projet/public


### Objectifs bonus visés
Pour les bonus j'ai décidé d'ajouter un joli design au blog, la possibilité de rechercher un article par rapport à son titre ou son contenu.
J'ai également ajouté une partie admin (sans connexion pour le moment) afin de pouvoir créer, modifier ou supprimer un article
