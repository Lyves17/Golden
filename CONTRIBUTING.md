# Guide de Contribution pour GoldenAxe

Merci de contribuer à GoldenAxe ! Voici comment vous pouvez nous aider à améliorer ce projet.

## Table des matières

- [Code de Conduite](#code-de-conduite)
- [Comment Contribuer](#comment-contribuer)
  - [Signaler un Problème](#signaler-un-problème)
  - [Proposer une Amélioration](#proposer-une-amélioration)
  - [Soumettre une Demande de Fusion](#soumettre-une-demande-de-fusion)
- [Configuration de l'Environnement de Développement](#configuration-de-lenvironnement-de-développement)
- [Structure du Projet](#structure-du-projet)
- [Standards de Code](#standards-de-code)
- [Tests](#tests)
- [Documentation](#documentation)
- [Questions](#questions)

## Code de Conduite

Ce projet et tous ceux qui y participent sont régis par notre [Code de Conduite](CODE_OF_CONDUCT.md). En participant, vous êtes tenu de respecter ce code. Veuillez signaler tout comportement inacceptable à [votre-email@exemple.com](mailto:votre-email@exemple.com).

## Comment Contribuer

### Signaler un Problème

1. Vérifiez d'abord si le problème n'a pas déjà été signalé dans les [problèmes existants](https://github.com/votre-utilisateur/goldenaxe/issues).
2. Si le problème n'existe pas encore, créez un nouveau ticket avec une description claire et détaillée.
3. Incluez des étapes pour reproduire le problème, la version de l'application et tout message d'erreur pertinent.

### Proposer une Amélioration

1. Créez d'abord un ticket pour discuter de votre proposition d'amélioration.
2. Attendez l'approbation avant de commencer à travailler dessus.
3. Une fois approuvé, suivez le processus de soumission de demande de fusion ci-dessous.

### Soumettre une Demande de Fusion

1. Forkez le dépôt et créez une branche à partir de `main`.
2. Si vous avez ajouté du code, ajoutez des tests.
3. Si vous avez modifié des API, mettez à jour la documentation.
4. Assurez-vous que la suite de tests passe.
5. Assurez-vous que votre code respecte les standards de codage.
6. Mettez à jour le fichier CHANGELOG.md avec vos modifications.
7. Ouvrez une Pull Request avec une description claire de vos modifications.

## Configuration de l'Environnement de Développement

### Prérequis

- PHP 8.1 ou supérieur
- Composer 2.0 ou supérieur
- MySQL 8.0 ou supérieur
- Node.js 16.x ou supérieur et NPM 8.x ou supérieur (pour les assets frontend)
- Docker et Docker Compose (recommandé)

### Installation avec Docker (recommandé)

1. Clonez le dépôt :
   ```bash
   git clone https://github.com/votre-utilisateur/goldenaxe.git
   cd goldenaxe
   ```

2. Copiez le fichier d'environnement :
   ```bash
   cp .env.example .env
   ```

3. Générez une clé d'application :
   ```bash
   docker-compose run --rm php php artisan key:generate
   ```

4. Démarrez les conteneurs :
   ```bash
   docker-compose up -d
   ```

5. Installez les dépendances :
   ```bash
   docker-compose run --rm composer install
   docker-compose run --rm npm install
   docker-compose run --rm npm run dev
   ```

6. Exécutez les migrations et les seeders :
   ```bash
   docker-compose run --rm php artisan migrate --seed
   ```

7. Accédez à l'application :
   - Application : http://localhost:8080
   - PHPMyAdmin : http://localhost:8081
   - MailHog (pour les emails) : http://localhost:8025

### Installation sans Docker

1. Clonez le dépôt et installez les dépendances PHP :
   ```bash
   git clone https://github.com/votre-utilisateur/goldenaxe.git
   cd goldenaxe
   composer install
   npm install
   npm run dev
   ```

2. Configurez votre environnement :
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

3. Configurez votre base de données dans le fichier `.env`.

4. Exécutez les migrations et les seeders :
   ```bash
   php artisan migrate --seed
   ```

5. Lancez le serveur de développement :
   ```bash
   php artisan serve
   ```

## Structure du Projet

```
goldenaxe/
├── app/                  # Code source de l'application
│   ├── Console/          # Commandes Artisan
│   ├── Exceptions/       # Gestionnaires d'exceptions
│   ├── Http/             # Contrôleurs, Middleware, Requêtes
│   ├── Models/           # Modèles Eloquent
│   ├── Providers/        # Fournisseurs de services
│   └── Services/         # Services métier
├── bootstrap/            # Fichiers d'amorçage
├── config/               # Fichiers de configuration
├── database/             # Migrations, Seeders, Factories
├── public/               # Point d'entrée public
├── resources/            # Vues, fichiers de langue, assets
├── routes/               # Définitions des routes
├── storage/              # Fichiers de stockage
├── tests/                # Tests automatisés
└── vendor/               # Dépendances Composer
```

## Standards de Code

- Suivez les [PSR-12](https://www.php-fig.org/psr/psr-12/) pour le code PHP.
- Utilisez des noms de variables et de méthodes descriptifs.
- Commentez votre code de manière appropriée.
- Écrivez des tests unitaires pour les nouvelles fonctionnalités.
- Assurez-vous que votre code est compatible avec PHP 8.1+.

## Tests

Exécutez les tests avec la commande suivante :

```bash
# Avec Docker
docker-compose run --rm php vendor/bin/phpunit

# Sans Docker
./vendor/bin/phpunit
```

## Documentation

La documentation est stockée dans le répertoire `docs/`. Pour mettre à jour la documentation :

1. Modifiez les fichiers Markdown dans `docs/`.
2. Vérifiez le formatage avec un prévisualiseur Markdown.
3. Soumettez une demande de fusion avec vos modifications.

## Questions

Pour toute question, veuillez ouvrir un ticket ou contacter [votre-email@exemple.com](mailto:votre-email@exemple.com).
