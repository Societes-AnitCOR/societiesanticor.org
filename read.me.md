# Initiative solidaire

## Prerequisites 
- PHP 
- MySQL
- Symfony 5
    - Composer

## Installation

1. `composer update`
    - memory-limit of 2GB needed for an update from scratch
2. `php bin/console d:m:m`
3. `php bin/console doctrine:fixtures:load`
4. `php bin/console import:referentiels -dtrue`

A l'initialisation du projet, vous devez avoir une BDD vide (pour éviter les conflits avec l'ancienne version)
Les référentiels sont chargés en ligne de commande
