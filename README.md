Anaxago symfony-starter-kit
===================

# Description

Ce projet est une propositon de réponse à l'exercice proposé par Anaxago  
Il ajoute une API REST JSON au kit de démarrage   

Il fonctionne avec :
- Symfony 4.2 minimum
- php 7.2 
- Api Platefrom
- Docker (PHP-FPM)
- Hooks (phpmd, phpcs)

La base de données contient 4 tables :
- user => pour la gestion et la connexion des utilisateurs 
- project => pour la liste des projets
- interest => pour les présenter un interêt de financements des projets par les utilisateurs

Les données préchargés sont
- pour les users 

| email     | password    | Role |
| ----------|-------------|--------|
| john@local.com  | john   | ROLE_USER    |
| admin@local.com | admin | ROLE_ADMIN   | 

 - une liste de 3 projets
 
La connexion et l'enregistrement des utilisateurs sont déjà configurés et opérationnels

# Installation
- Serveur configuration:
    - vhost configuration : https://symfony.com/doc/current/setup/web_server_configuration.html 
    - built in serveur : https://symfony.com/doc/current/setup/built_in_web_server.html    
- ```composer install```
- ```composer init-db ```
    - Script personnalisé permet de créer la base de données, de lancer la création du schéma et de précharger les données
    - Ce script peut être réutilisé pour ré-initialiser la base de données à son état initial à tout moment

    
API doc : http://dev.anaxago.fr/api  

```
Le jeton nommé acces_token est à placer dans l'entête HTTP Authorization sous la forme "Bearer {{jeton }}"