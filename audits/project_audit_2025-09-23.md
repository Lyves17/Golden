# Audit du projet Golden (rapport du 2025-09-23)

Ce rapport est une analyse PASSIVE. Aucun fichier n'a été modifié.

## Résumé des constats

- **C:\\Users\\cobay\\Downloads\\Golden\\conn.php**
  - Type: Utilisation de credentials
  - Commentaire: Connexion MySQL AlwaysData via `mysqli_connect` exposée en clair et utilisée partout.

- **C:\\Users\\cobay\\Downloads\\Golden\\config.php**
  - Type: Incohérence de configuration
  - Commentaire: Définit des constantes DB locales non utilisées (le projet utilise `conn.php`). `BASE_URL`/`APP_ROOT` ciblent "Goldenaxe" alors que le dossier est "Golden". `ENVIRONMENT` référencé mais non défini.
  - Reco: Unifier avec `conn.php` ou supprimer. Corriger `BASE_URL`/`APP_ROOT`.

- **C:\\Users\\cobay\\Downloads\\Golden\\dashboard.php**
  - Type: Logique de rôles dupliquée
  - Commentaire: Utilise `$isAdmin/$isEmployee/$isClient` et aussi `$_SESSION["type"]`.
  - Type: Fragment HTML orphelin
  - Lignes ~276–279
  - Commentaire: `<i class="material-icons">home</i><span>Home</span>` sans `<a>`/`<li>`.
  - Type: Fermeture PHP redondante
  - Lignes ~521–523
  - Reco: Garder une seule source de vérité pour les rôles. Retirer le fragment orphelin. Nettoyer `?>` superflu.

- **C:\\Users\\cobay\\Downloads\\Golden\\index.php**
  - Type: Mécanisme d'authentification incohérent
  - Commentaire: Compare des mots de passe en clair alors que `signup/index.php` hash les mots de passe (`password_hash`).
  - Type: Contrainte de JOIN
  - Commentaire: JOIN obligatoire sur `emp_details` — les clients sans ligne associée ne peuvent pas se connecter.
  - Reco: Utiliser `password_verify()` et supporter les clients.

- **C:\\Users\\cobay\\Downloads\\Golden\\forget.php**
  - Type: Injection SQL
  - Lignes ~16
  - Type: Mots de passe en clair
  - Lignes ~25, 28
  - Reco: Requêtes préparées, jetons de réinitialisation et stockage hashé.

- **C:\\Users\\cobay\\Downloads\\Golden\\email.php**
  - Type: SMTP en dur
  - Commentaire: Identifiants Gmail à configurer, `SMTPSecure` non explicitement défini pour 465.
  - Reco: Variables d'environnement, `PHPMailer::ENCRYPTION_SMTPS`.

- **C:\\Users\\cobay\\Downloads\\Golden\\signup\\index.php**
  - Type: Session non démarrée
  - Commentaire: Utilise `$_SESSION` sans `session_start()`.

- **C:\\Users\\cobay\\Downloads\\Golden\\signup\\success.php**
  - Type: OK

- **C:\\Users\\cobay\\Downloads\\Golden\\setup_database.php**
  - Type: Dépendance manquante
  - Commentaire: Attend `database.sql` non présent.

- **C:\\Users\\cobay\\Downloads\\Golden\\number_fomt.php**
  - Type: Typo de nommage
  - Commentaire: `number_fomt.php` (typo). 
  - Type: Injection SQL potentielle (exécute une chaîne passée).

- **C:\\Users\\cobay\\Downloads\\Golden\\strength.php**
  - Type: Injection SQL potentielle (exécute une chaîne passée).

- **C:\\Users\\cobay\\Downloads\\Golden\\employee\\library.php**
  - Type: Problème structurel HTML
  - Commentaire: Fichier complet HTML (`<!DOCTYPE html>`, `<html>`, `<body>`) inclus dans d'autres pages → HTML imbriqué invalide.

- **C:\\Users\\cobay\\Downloads\\Golden\\employee\\delete.php**
  - Type: Erreur de syntaxe PHP
  - Ligne 1
  - Commentaire: `<<<?php` au lieu de `<?php`.
  - Type: Injection SQL
  - Lignes ~10

- **C:\\Users\\cobay\\Downloads\\Golden\\employee\\emp_delete.php**
  - Type: Injection SQL (utilise `$_GET['id']` directement).

- **C:\\Users\\cobay\\Downloads\\Golden\\employee\\emp_block.php**
  - Type: Injection SQL (`id`, `type` non échappés)
  - Type: Typo superglobale
  - Ligne ~26: `$GET` au lieu de `$_GET`.
  - Type: Espace traînant dans l'ID (" ... 'id' = '... ' ")

- **C:\\Users\\cobay\\Downloads\\Golden\\employee\\up_action.php**
  - Type: Variable indéfinie
  - Lignes ~23, 28: `$id` non défini alors qu'utilisé en `WHERE`.

- **C:\\Users\\cobay\\Downloads\\Golden\\employee\\with_action.php**
  - Type: Mésappariement d'accolades potentiel
  - Fin de fichier ~47–57: Accolade en trop → erreurs de parse possibles.

- **C:\\Users\\cobay\\Downloads\\Golden\\employee\\withdraw.php**
  - Type: Mésappariement d'accolades potentiel (49–61)
  - Commentaire: `ob_start()/ob_end_flush()` autour d'une logique conditionnelle → vérifier le flux.

- **C:\\Users\\cobay\\Downloads\\Golden\\employee\\transfer.php**
  - Type: Injection SQL
  - Lignes ~354, 364
  - Type: Intégrité transactionnelle
  - Commentaire: 2 `UPDATE` + 2 `INSERT` non atomiques (pas de transaction).

- **C:\\Users\\cobay\\Downloads\\Golden\\employee\\deposit.php**
  - Type: Injection SQL (~317)
  - Type: Validation numérique insuffisante (~17–21)

- **C:\\Users\\cobay\\Downloads\\Golden\\employee\\history.php**
  - Type: Injection SQL (comptes et dates)
  - Type: Incohérence de casse des types d'historique ("DEPOSIT" vs "Deposit").

- **C:\\Users\\cobay\\Downloads\\Golden\\employee\\history_details.php**
  - Type: Variable non définie
  - Ligne ~332: champ caché avec `$sender` non défini.
  - Type: Injection SQL (dates/types).

- **C:\\Users\\cobay\\Downloads\\Golden\\employee\\bank_balance.php**
  - Type: Variable non définie
  - Ligne ~342: `$sender` non défini.

- **C:\\Users\\cobay\\Downloads\\Golden\\employee\\search.php**
  - Type: Injection SQL (dates)
  - Type: Performance/Pagination
  - Commentaire: Aucun paging sur des tables potentiellement volumineuses.

- **C:\\Users\\cobay\\Downloads\\Golden\\employee\\account_details.php**
  - Type: Injection SQL (`$_GET["id"]` direct)
  - Reco: Valider contre une liste blanche ("Current", "Saving").

- **Divers (emp_list.php, emp_details.php, user_profile.php, change_pin.php)**
  - Type: Injection SQL + XSS
  - Commentaire: Interpolations directes dans SQL et `echo` de valeurs sans `htmlspecialchars()`.

- **Projet – Observations globales**
  - Sécurité: Interpolations SQL fréquentes, mots de passe en clair à plusieurs endroits, aucune protection CSRF.
  - Intégrité des données: Opérations monétaires sans transactions.
  - Fuseaux horaires: `Asia/Karachi` vs `Europe/Paris` (incohérent).
  - Nommage: "Transection" au lieu de "Transaction".
  - Fichier manquant: `errors/403.php` référencé par `config.php` absent.
  - Emails: PHPMailer + Gmail nécessite mot de passe d'application/OAuth et options de sécurité correctes.

## Recommandations (sans modification de code)

- **Authentification**
  - Utiliser `password_hash`/`password_verify` partout. Autoriser la connexion des clients (pas uniquement employés).

- **Accès base de données**
  - Migrer vers des requêtes préparées.
  - Encapsuler dépôts/retraits/transferts dans des transactions.

- **Validation des entrées**
  - Valider/caster les numériques (`amount`, soldes), whitelister les enums (types de comptes, types d'historique).

- **Structure HTML**
  - Transformer `employee/library.php` en partials (CSS/JS) sans balises `<html>/<body>`.
  - Retirer les fragments orphelins dans `dashboard.php`.

- **Corrections ciblées**
  - `employee/delete.php`: `<?php` en tête, sécuriser l'ID.
  - `employee/emp_block.php`: `$_GET`, enlever espace dans l'ID, requêtes préparées.
  - `employee/up_action.php`: définir/valider `$id`.
  - `employee/with_action.php` et `employee/withdraw.php`: réaligner les accolades.
  - `signup/index.php`: ajouter `session_start()`.

- **Config**
  - Unifier `config.php` et `conn.php`. Centraliser le fuseau horaire.

- **Emailing**
  - Variables d'environnement, chiffrement SMTP explicite, prestataire transactionnel.

- **Divers**
  - Ajouter `errors/403.php` ou retirer l'include.
  - Ajouter de la pagination aux listes volumineuses.
