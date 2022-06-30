## Sommaire
1. [Information du projet](#Information-du-projet)
2. [Les Technologies](#technologies)
3. [Installation](#installation)
### Information du projet
***
Le projet s'appelle veille.io, il s'agit d'un blog codé en PHP, comme tout blog, nous pouvons s'inscrire, se connecter, créer, supprimer un article, y répondre... J'ai utilisé bootstrap pour le styliser.
## Les technologies
***
Les technologies utilisées pour le projet:
* [PHP](https://www.php.net/docs.php): Version 8.0.13 
* [BOOTSTRAP](https://getbootstrap.com/docs/5.2/getting-started/introduction/): Version 5.2
## Installation
***
Comment installer Veille.io
```
$ git clone https://github.com/WassimSss/Blog-poo
  Créer une base de données veilleio sur MySQL 
  Importer la base de données veilleio_empty.sql pour avoir une base de données vide
  Importer la base de données veilleio_fixtures.sql pour avoir une base de données remplies (Les mots de passe pour chaque email sont Test01)
  Pour tester les droits administrateurs, il faut aller dans la base de données, et mettre comme valeur de role admin 1 pour l'utilisateur souhaiter, ou bien importer fixtures.sql et se connecter avec l'email admin@gmail.com
  Modifier la variable $pdo dans seed.php pour faire correspondre a votre base de données