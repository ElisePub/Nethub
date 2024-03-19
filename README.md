# NetHub

Développement d'un Site Web Forum.  
NetHub est une plateforme de discussion en ligne pour permettre à une communauté de partager des informations, échanger des idées et interagir autour de l'informatique.

### Pré-requis

Application testée sur un environnement Ubuntu 22.04.  
Symfony nécéssite l'utilisation d'une version PHP 8.1 ou superieur.

### Installation

Retrouvez la [documentation officielle](https://symfony.com/doc/current/setup.html)

**étape 1 - Installer Composer**  
Composer est un gestionnaire de dépendances pour PHP. Vous pouvez le télécharger et l'installer à partir de [getcomposer.org](https://getcomposer.org/download/).


_exemple_:  

_Depuis le dossier NetHub, executez les commandes suivantes :_  
 ``sudo apt-get install composer``  
 ``sudo apt-get install php8.1-xml``  
 ``sudo apt-get install php8.1-curl`` 
    

**étape 2 - Installer les dépendances du projet**  
Executez ``composer update``  puis ``composer install`` depuis le repertoire du projet. Cela installera toutes les dépendances listées dans le fichier composer.json.

**étape 3 - Installer CLI Symfony**   
``wget https://get.symfony.com/cli/installer -O - | bash``  
``sudo mv ~/.symfony5/bin/symfony /usr/local/bin/symfony``

## Démarrage

Executez la commande ``symfony serve`` pour démarrer le serveur ensuite rendez-vous à https://localhost:8000. Cliquer sur "accepter les risques et continuer" si le navigateur bloque la connexion.
Pour arrêter le serveur executez ``symfony server:stop``.

## Utilisations
Pour tester l'application, vous pouvez créer un utilisateur et cliquer sur le lien de connexion ensuite, ou directement vous connecter à l'utilisateur ``tishia@gmail.com`` avec le mot de passe " ``abcde`` " pré-enregistré dans la base de donnée.

## Logiciel

* [Symfony 6.3.5](https://symfony.com/doc/current/index.html) - Framework PHP
* [PHP 8.1.2](https://www.php.net/) - Backend
* [Twig](https://twig.symfony.com/) - Frontend
* [SQLite 3](https://www.sqlite.org/index.html) - Database
* [Visual Studio Code](https://code.visualstudio.com/) - Editeur de textes


## Auteurs
* **Elise Pubert **