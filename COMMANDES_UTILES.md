# 🛠️ Commandes Utiles - CampusConnect

## 📦 Installation et Configuration

### Installation Initiale
```bash
# Installer les dépendances PHP
composer install

# Installer les dépendances JavaScript
npm install

# Compiler les assets
npm run build

# Copier le fichier d'environnement
cp .env.example .env

# Générer la clé d'application
php artisan key:generate

# Créer le lien symbolique pour le stockage
php artisan storage:link
```

### Configuration de la Base de Données
```bash
# Créer la base de données MySQL
mysql -u root -p
CREATE DATABASE campusconnect CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
exit;

# Exécuter les migrations
php artisan migrate

# Exécuter les migrations avec seeders
php artisan migrate:fresh --seed

# Réinitialiser complètement la base de données
php artisan migrate:fresh --seed
```

---

## 🚀 Démarrage du Serveur

### Serveur de Développement
```bash
# Démarrer le serveur Laravel
php artisan serve

# Démarrer sur un port spécifique
php artisan serve --port=8080

# Démarrer sur une adresse spécifique
php artisan serve --host=0.0.0.0 --port=8000
```

### Compilation des Assets
```bash
# Compiler les assets en mode développement
npm run dev

# Compiler et surveiller les changements
npm run watch

# Compiler pour la production
npm run build
```

---

## 🗄️ Gestion de la Base de Données

### Migrations
```bash
# Exécuter les migrations
php artisan migrate

# Annuler la dernière migration
php artisan migrate:rollback

# Annuler toutes les migrations
php artisan migrate:reset

# Réinitialiser et réexécuter toutes les migrations
php artisan migrate:refresh

# Réinitialiser et exécuter les seeders
php artisan migrate:refresh --seed

# Supprimer toutes les tables et réexécuter les migrations
php artisan migrate:fresh

# Avec seeders
php artisan migrate:fresh --seed

# Vérifier le statut des migrations
php artisan migrate:status
```

### Seeders
```bash
# Exécuter tous les seeders
php artisan db:seed

# Exécuter un seeder spécifique
php artisan db:seed --class=DatabaseSeeder

# Créer un nouveau seeder
php artisan make:seeder NomDuSeeder
```

---

## 🔧 Artisan - Commandes de Génération

### Modèles
```bash
# Créer un modèle
php artisan make:model NomDuModele

# Créer un modèle avec migration
php artisan make:model NomDuModele -m

# Créer un modèle avec migration, factory et seeder
php artisan make:model NomDuModele -mfs

# Créer un modèle avec tout (migration, factory, seeder, controller)
php artisan make:model NomDuModele --all
```

### Contrôleurs
```bash
# Créer un contrôleur
php artisan make:controller NomController

# Créer un contrôleur de ressource
php artisan make:controller NomController --resource

# Créer un contrôleur API
php artisan make:controller NomController --api

# Créer un contrôleur avec modèle
php artisan make:controller NomController --model=NomModele
```

### Migrations
```bash
# Créer une migration
php artisan make:migration create_nom_table

# Créer une migration pour modifier une table
php artisan make:migration add_column_to_table --table=nom_table
```

### Form Requests
```bash
# Créer une Form Request
php artisan make:request NomRequest
```

### Middlewares
```bash
# Créer un middleware
php artisan make:middleware NomMiddleware
```

---

## 🧹 Maintenance et Nettoyage

### Cache
```bash
# Vider le cache de l'application
php artisan cache:clear

# Vider le cache de configuration
php artisan config:clear

# Vider le cache des routes
php artisan route:clear

# Vider le cache des vues
php artisan view:clear

# Vider tous les caches
php artisan optimize:clear

# Mettre en cache la configuration
php artisan config:cache

# Mettre en cache les routes
php artisan route:cache

# Mettre en cache les vues
php artisan view:cache

# Optimiser l'application (cache config, routes, views)
php artisan optimize
```

### Logs
```bash
# Voir les logs en temps réel (nécessite tail)
tail -f storage/logs/laravel.log

# Sur Windows avec PowerShell
Get-Content storage/logs/laravel.log -Wait -Tail 50
```

---

## 🔍 Débogage et Informations

### Routes
```bash
# Lister toutes les routes
php artisan route:list

# Lister les routes avec filtres
php artisan route:list --name=projects

# Lister les routes d'un contrôleur spécifique
php artisan route:list --path=projects
```

### Informations Système
```bash
# Afficher les informations sur l'application
php artisan about

# Vérifier l'environnement
php artisan env

# Lister toutes les commandes disponibles
php artisan list

# Aide sur une commande spécifique
php artisan help migrate
```

### Tinker (Console Interactive)
```bash
# Démarrer Tinker
php artisan tinker

# Exemples d'utilisation dans Tinker :
# Compter les utilisateurs
User::count()

# Trouver un utilisateur
User::find(1)

# Créer un utilisateur
User::create(['name' => 'Test', 'email' => 'test@test.com', 'password' => Hash::make('password'), 'role' => 'etudiant'])

# Lister tous les projets
Project::all()

# Quitter Tinker
exit
```

---

## 📊 Base de Données - Commandes MySQL

### Connexion
```bash
# Se connecter à MySQL
mysql -u root -p

# Se connecter à une base spécifique
mysql -u root -p campusconnect
```

### Commandes SQL Utiles
```sql
-- Afficher toutes les bases de données
SHOW DATABASES;

-- Utiliser une base de données
USE campusconnect;

-- Afficher toutes les tables
SHOW TABLES;

-- Décrire une table
DESCRIBE users;

-- Compter les enregistrements
SELECT COUNT(*) FROM users;

-- Voir tous les utilisateurs
SELECT * FROM users;

-- Voir tous les projets avec leur superviseur
SELECT p.title, u.name as supervisor 
FROM projects p 
JOIN users u ON p.supervisor_id = u.id;

-- Supprimer toutes les données d'une table
TRUNCATE TABLE nom_table;

-- Supprimer une base de données
DROP DATABASE campusconnect;

-- Créer une base de données
CREATE DATABASE campusconnect CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

---

## 🔐 Gestion des Utilisateurs (via Tinker)

```bash
# Démarrer Tinker
php artisan tinker

# Créer un admin
User::create([
    'name' => 'Admin',
    'email' => 'admin@example.com',
    'password' => Hash::make('password'),
    'role' => 'admin'
]);

# Créer un enseignant
User::create([
    'name' => 'Enseignant Test',
    'email' => 'enseignant@example.com',
    'password' => Hash::make('password'),
    'role' => 'enseignant',
    'matricule' => 'ENS999'
]);

# Créer un étudiant
User::create([
    'name' => 'Étudiant Test',
    'email' => 'etudiant@example.com',
    'password' => Hash::make('password'),
    'role' => 'etudiant',
    'matricule' => 'ETU999'
]);

# Changer le mot de passe d'un utilisateur
$user = User::find(1);
$user->password = Hash::make('nouveau_password');
$user->save();

# Changer le rôle d'un utilisateur
$user = User::find(1);
$user->role = 'admin';
$user->save();
```

---

## 📁 Gestion du Stockage

```bash
# Créer le lien symbolique pour le stockage public
php artisan storage:link

# Vérifier que le lien existe
ls -la public/storage  # Linux/Mac
dir public\storage     # Windows

# Supprimer tous les fichiers uploadés (ATTENTION!)
rm -rf storage/app/public/deliverables/*  # Linux/Mac
Remove-Item storage\app\public\deliverables\* -Recurse  # Windows PowerShell
```

---

## 🧪 Tests

```bash
# Exécuter tous les tests
php artisan test

# Exécuter un test spécifique
php artisan test --filter NomDuTest

# Créer un test
php artisan make:test NomDuTest

# Créer un test unitaire
php artisan make:test NomDuTest --unit
```

---

## 🔄 Git (Versioning)

```bash
# Initialiser un dépôt Git
git init

# Ajouter tous les fichiers
git add .

# Créer un commit
git commit -m "Initial commit - CampusConnect"

# Ajouter un remote
git remote add origin https://github.com/username/campusconnect.git

# Pousser vers GitHub
git push -u origin main

# Vérifier le statut
git status

# Voir l'historique
git log --oneline
```

---

## 🚨 Dépannage

### Problèmes Courants

#### Erreur "Class not found"
```bash
composer dump-autoload
```

#### Erreur de permissions (Linux/Mac)
```bash
sudo chmod -R 775 storage bootstrap/cache
sudo chown -R $USER:www-data storage bootstrap/cache
```

#### Erreur de permissions (Windows)
```bash
# Exécuter PowerShell en tant qu'administrateur
icacls storage /grant Users:F /t
icacls bootstrap/cache /grant Users:F /t
```

#### Erreur "No application encryption key"
```bash
php artisan key:generate
```

#### Erreur de connexion à la base de données
```bash
# Vérifier les paramètres dans .env
# Vérifier que MySQL est démarré
# Vérifier que la base de données existe
```

#### Réinitialisation complète
```bash
# Supprimer tous les caches
php artisan optimize:clear

# Réinstaller les dépendances
composer install
npm install

# Réinitialiser la base de données
php artisan migrate:fresh --seed

# Recréer le lien de stockage
php artisan storage:link

# Recompiler les assets
npm run build
```

---

## 📝 Notes Importantes

1. **Toujours sauvegarder** la base de données avant `migrate:fresh`
2. **Ne jamais commiter** le fichier `.env` dans Git
3. **Vider les caches** après modification de configuration
4. **Utiliser `migrate:fresh --seed`** uniquement en développement
5. **Tester localement** avant de déployer en production

---

**Dernière mise à jour :** 28 Octobre 2025

