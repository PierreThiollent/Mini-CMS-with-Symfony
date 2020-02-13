# Projet de mini CMS avec Symfony 🔥

Ce projet de blog/mini CMS a été réalisé lors d'un exercice à la [Normandie Web School](https://normandie-web-school.fr/).
J'ai choisi d'utiliser le framework Symfony pour le réaliser.

## Prérequis 🔧

- Composer
- Php (^7.2.5)
- Un serveur web (MAMP ou WAMP) ou bien le serveur de dev de Symfony (necéssite le CLI)

### Installation 🔄

`$ git clone`

`$ cd <project>`

`$ composer install`

### Configuration

- BDD user : L'utilisateur de MAMP
- BDD password : Password de l'utilisateur de MAMP
- BDD name : cms

### Initialisation

Exécuter la commande ci-dessous pour ajouter des données de test 

`$ php bin/console doctrine:fixtures:load`

### Lancement 

Pour lancer le serveur de developpement, exécuter la commande 

`$ symfony serve` 

ou lancer le serveur MAMP/WAMP

### Utilisation

- Serveur symfony : http://127.0.0.1:8000
- Serveur MAMP/WAMP : http://localhost:80/nom-du-projet/public


### Objectifs bonus visés
Pour les bonus j'ai décidé d'ajouter un joli design au blog, la possibilité de rechercher un article par rapport à son titre ou son contenu.
J'ai également ajouté une partie admin (sans connexion pour le moment) afin de pouvoir créer, modifier ou supprimer un article
