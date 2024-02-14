# Projet ECF Garage Vincent Parrot

Ce projet est une application web développée avec Symfony. Il s'agit d'un site pour un garage qui propose des services de mécanique, carosserie, entretien ainsi que la vente de voitures.

## Prérequis

Assurez-vous d'avoir les éléments suivants installés sur votre machine avant de commencer :

- PHP 7.4 ou supérieur
- Composer
- Symfony CLI
- MySQL

## Installation

1. Clonez le dépôt Git :

```bash
git clone https://github.com/zakaria-tehami/VincentParrot_ECF

```

2.  Accédez au répertoire du projet cloné :

```bash
cd le projet

```

3. Installez les dépendances avec Composer :

```bash
composer install

```

4. Créer un fichier .env.local :

Copier les paramètres de .env et Configurez les paramètres de la base de données

5. Créez la base de données :

```bash
symfony console doctrine:database:create

```

6. Appliquez les migrations :

```bash
symfony console doctrine:migrations:migrate

```

## Exécution

Lancez le serveur Symfony :

```bash
symfony serve

```

Accès au Site

Accédez au site dans votre navigateur : http://127.0.0.1:8000

Pour créer un admin du site exécuter la requète sql :

```bash
INSERT INTO user (email, roles, password, first_name, last_name)
VALUES ('vincent.parrot@auto.fr', '["ROLE_ADMIN"]', '$2y$13$oYQNWxGBGCSZZA4kPLaKouB4T/7UANEj0HmZ5O.GgvR6EZlPhXuei', 'Vincent', 'Parrot');
```

Et si besoin de créer des salarié, a faire depuis l'espace admin.

Tester l'envoie des mails en local : 

Configurer MailTrap et mettre  à jour le fichier mailer.yaml ou .env avec votre DNS MailTrap