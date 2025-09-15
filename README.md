# GoldenAxe - Système de Gestion Bancaire

## Description
GoldenAxe est une application web de gestion bancaire développée en PHP avec une interface utilisateur moderne et réactive. Cette application permet de gérer des comptes bancaires, des transactions et des utilisateurs avec différents niveaux d'accès.

## Fonctionnalités

### Pour les Clients
- Consultation du solde et des transactions
- Effectuer des virements
- Gestion du profil utilisateur
- Historique des transactions

### Pour les Employés
- Gestion des comptes clients
- Validation des transactions
- Génération de rapports
- Assistance client

### Pour les Administrateurs
- Gestion des utilisateurs et des rôles
- Tableau de bord administratif
- Journal d'audit
- Configuration du système

## Prérequis

- PHP 7.4 ou supérieur
- MySQL 5.7 ou supérieur
- Serveur web (Apache/Nginx)
- Composer (pour les dépendances)

## Installation

1. Cloner le dépôt :
   ```bash
   git clone [URL_DU_DEPOT]
   cd Goldenaxe
   ```

2. Installer les dépendances :
   ```bash
   composer install
   ```

3. Configurer la base de données :
   - Créer une base de données MySQL
   - Importer le fichier `database/schema.sql`
   - Copier `.env.example` vers `.env` et configurer les accès

4. Configurer le serveur web :
   - Définir le dossier public comme racine web
   - Activer la réécriture d'URL

5. Lancer l'application :
   ```bash
   php -S localhost:8000 -t public
   ```

## Structure du Projet

```
Goldenaxe/
├── app/                  # Code source de l'application
│   ├── Controllers/      # Contrôleurs
│   ├── Models/           # Modèles de données
│   └── Views/            # Vues
├── config/               # Fichiers de configuration
├── public/               # Fichiers accessibles publiquement
│   ├── css/              # Feuilles de style
│   ├── js/               # Scripts JavaScript
│   └── index.php         # Point d'entrée
├── resources/            # Ressources (images, etc.)
├── routes/               # Définition des routes
└── vendor/               # Dépendances Composer
```

## Sécurité

- Validation des entrées utilisateur
- Protection contre les injections SQL
- Gestion sécurisée des sessions
- Hashage des mots de passe avec Bcrypt
- Protection CSRF

## Licence

Ce projet est sous licence MIT. Voir le fichier `LICENSE` pour plus de détails.

## Auteur

[Votre Nom] - [Votre Email]

## Remerciements

- [Bootstrap](https://getbootstrap.com/)
- [jQuery](https://jquery.com/)
- [Font Awesome](https://fontawesome.com/)
- [AdminLTE](https://adminlte.io/)
