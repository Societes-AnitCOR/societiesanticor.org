# Sociétés AntiCOR
![logo](./logo_societe_anticor.png)

Table of content
================
1. [Description](#description)
2. [Architecture](#architecture)
3. [Installation](#installation)
4. [Contributing](#contributing)
5. [License](#license)

Description
===========
### General objective.

Developping an intuitive and searchable database to find the companies that are or have been involved in the fight against covid-19, with the possibility for users to mention the scope of the help offered (local, national, international) and whether or not the offer is still relevant, shoud help to recreate (if needed) a chain of solidarity in a way that is faster and more efficent than during the first wave of the pandemic.


### How it could help : examples
 - A Hospital using the website could see that a software company specialized in planification offers its software and expertise for free in order to help optimize the organization of home care. An association which delivers food for vulnerable people at home could benefit from the same offer to optimize their delivery ininerary.

- But solutions are even more varied ang go from making free lunches for healthcare professionals to supporting small buisnesses, as well as providing calculus power for reasearch and softwares that assists doctors for diagnosis.

- The searchable database is aimed at covering 5 themes : Making equipment, Support Hospitals and Research, Support helpers, Helping the community, Helping companies.


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

Contributing
============
Contributions should be made by pull request to the develop branch.  

Pull requests are accepted once reviewed, which includes an intergration and **test** by a moderator as well as a code review.  

Read our [Guidelines for contributing](CONTRIBUTING.md).


License
====== 
Copyright (c) "Société AntiCOR" 2020
 
Released under the ____, see the [LICENSE](LICENSE.txt) file to read the full text.
