# Société AntiCOR
![logo](./logo_societe_anticor.png)

Table of content
================
1. [Description](#description)
2. [Architecture](#architecture)
3. [Installation](#installation)
    - [Development](#development)
4. [Git Flow](#git-flow)
5. [Contributing](#contributing)
6. [License](#license)

Description
===========
## Objectif général

Ce projet est destiné à tirer des leçons de la première vague de l'épidémie liée au covid-19 afin de réagir de façon plus efficace et plus rapide dans l'hypothèse d'une deuxième vague. Tirer les leçons de la première vague implique au minimum de connaître les solutions qui ont pu être mises en place pendant cette période afin d'être en mesure de les redeployer plus rapidement si une deuxième vague se présentait. Cela implique également de se doter d'un outil pour faciliter la mise en place de nouvelles solutions en fonction des nouveaux besoins. 

## Concrètement, le projet ? 
Un annuaire en ligne cherchable et intuitif qui répertorie les sociétés qui ont déjà proposé ou qui proposent actuellement une aide face au covid-19, en leur permettant de modifier leur contribution et indiquer si celle-ci est toujours valable. 

1er objectif : faire connaître les acteurs solidaires de la première vague pour permettre, si le besoin venait à se représenter, de recréer une chaîne de solidarité plus rapidement et plus efficacement. Pour cela, pendant la période de mars à juin 2020, nous avons repertorié dans notre base de données plus de 300 actions solidaires recouvrant 5 thèmes: Fabriquer du matériel, Accompagner les hôpitaux et la recherche, Soutenir les soignants, Aider la communauté, Aider les entreprises.

2ème objectif : inviter de nouveaux acteurs à faire connaître leur contribution en s'inscrivant sur le site de façon à pouvoir actualiser et modifier leur contribution (et indiquer si celle-ci est toujours valable), car les besoins de la première vague ne seront pas nécessairement ou uniquement ceux de la deuxième vague.

## Exemples d'applications
Concrètement ça pourrait par exemple permettre à un Hôpital qui connaît une forte augmentation de cas de voir qu'une société de conseil en logiciels informatiques propose gratuitement une expertise en optimisation des tournées et planification des opérations pour optimiser l'organisation de soins à domicile. Une association qui fait des livraisons à domicile pour les personnes vulnérables pourrait chercher à bénéficier de la même offre pour optimiser les tournées.

Mais les solutions sont bien plus variées, et vont des repas solidaires pour les soignants à une aide de trésorerie pour les petits commerce en passant par des logiciels d'aide au diagnostic pour les medecins et une mise à disposition de capacités de calcul pour la recherche.

## Pourquoi "sociétés anticor"?
Le principe est un peu le même que le système immunitaire adaptatif et des anticorps : garder la mémoire de la première exposition pour avoir une ligne de réponse prète la deuxième fois.

Architecture
============
This project has been built on Symfony, it uses standard [Symfony 5 file structure](https://symfony.com/doc/current/index.html#gsc.tab=0).
```bash
├── README.md
├── bin
├── composer.json
├── composer.lock
├── config
├── logo_societe_anticor.png
├── outils # Tools and utilities
├── phpunit.xml.dist
├── public  # Entry point for the project (contains assets ?)
├── src # source files 
├── symfony.lock
├── templates # html templates built with twig
├── tests
└── translations
```
Installation
============
- Fork the project. [Click here](https://github.com/Societes-AnitCOR/societiesanticor.org/fork) or up there!
- Clone it on your local dev machine. [[Docs to do git]](https://www.linode.com/docs/development/version-control/how-to-install-git-on-linux-mac-and-windows/)
    - with https
    ```bash
        git clone https://github.com/YOUR USER NAME HERE/societiesanticor.org.git
    ```
    - with ssh
    ```bash
        git clone git@github.com:YOUR USER NAME HERE/societiesanticor.org.git
    ```

### Prerequisites 
- PHP 
- MySQL
- Symfony 5
- Composer
    
#### Server
##### Windows & Linux
Use php web-server, such [xampp](https://www.apachefriends.org/download.html) or use the native server from [symfony cli](https://symfony.com/download).

Usage for xampp-like servers:
 - Once, installation is done,
 - Place or git clone the project into `htdocs`.
 - Run your server.

Usage for symfony cli:

 - Once the installation is done,
 - Open your terminal, use command `cd` in the project.
 - Use `symfony serve` to start the project.

#### Database
if you are using _xampp-like database_, use **its built-in database** (Windows & Linux), or use [install Mysql installer](https://www.liquidweb.com/kb/install-mysql-windows/) (Windows only).
##### Linux
```shell
# assuming you use ubuntu
sudo apt install mysql-server
```

Usage:
 - At the root of the project copy the .env
 - Paste and rename it to `.env.local`
 - Change the line
```shell
DATABASE_URL=mysql://USER_HERE:PASSWORD_HERE@127.0.0.1:3306/initiative?serverVersion=5.7 
```
 - Note: most basic install has `root` and no password for install. (If you need help for the install, open an issue with INSTALL HELP as title, we will be happy to help).

If you've completed all the usage at each step, proceed with command-line below (at the root of the project):
 > Note: In case you have error like `The server requested authentication method unknown to the client` in Mysql 8, login into your mysql-cli, execute:
```sql
ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'root';  
```


#### Composer 
##### Windows & Linux
- For windows, download the .exe file at [getcomposer.org](https://getcomposer.org/download/).
- For Linux, use the CLI command at [getcomposer.org](https://getcomposer.org/download/)


Usage:
- After installation,
- At root of the project, run on command `composer install`.
- This will **install all the project dependencies**.

#### Setup
- Create database:
```sql
CREATE DATABASE initiative;
```
- Create migration:
```shell
php bin/console d:m:m
```
- Load fixtures:
```shell
php bin/console doctrine:fixtures:load
php bin/console import:referentiels -dtrue
```
Development
===========
- TODO

Git Flow
========
![git flow](./gitflow.svg)

#### Prinicpal Branches
- master 
    - production
- validation 
    - branch which holds the configuration being tested.
    - pull request to master
- develop
    - intergration branch for incoming contributions
    - pull request to validation

Contributing
============
Contributions should be made by pull request to the develop branch.  

Pull requests are accepted once reviewed, which includes an intergration and **test** by a moderator as well as a code review.  

Read our [Guidelines for contributing](CONTRIBUTING.md).

Authors:
- TODO

Contributors:
- TODO

 
License
====== 
Copyright (c) "Société AntiCOR" 2020
 
Released under the ____, see the [LICENSE](LICENSE.txt) file to read the full text.
