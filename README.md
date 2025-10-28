# CampusConnect - Gestion des Projets Étudiants

## 📋 Description du Projet

CampusConnect est une plateforme web développée avec Laravel 11 permettant de gérer les projets étudiants au sein d'une université. Le système facilite la collaboration entre étudiants, enseignants et administrateurs pour le suivi et l'évaluation des projets académiques.

## 🎯 Fonctionnalités Principales

### Pour les Étudiants
- ✅ Créer et gérer des projets
- ✅ Inviter des membres à rejoindre un projet
- ✅ Déposer des livrables (documents, code source)
- ✅ Commenter et discuter sur les projets
- ✅ Consulter les évaluations et feedbacks

### Pour les Enseignants
- ✅ Superviser les projets assignés
- ✅ Évaluer les livrables (valider/refuser)
- ✅ Donner des feedbacks détaillés
- ✅ Noter les projets (sur 20)
- ✅ Modifier le statut des projets

### Pour les Administrateurs
- ✅ Vue d'ensemble de tous les projets
- ✅ Gestion complète du système
- ✅ Statistiques globales

## 🛠️ Technologies Utilisées

- **Framework Backend:** Laravel 11
- **Base de données:** MySQL
- **Frontend:** Blade Templates + TailwindCSS
- **Authentification:** Laravel Breeze
- **Langue:** Français (fr_FR)

## 📦 Installation

### Prérequis
- PHP >= 8.2
- Composer
- MySQL
- Node.js & NPM (pour les assets)

### Étapes d'Installation

1. **Cloner le projet**
```bash
git clone <votre-repo>
cd module3
```

2. **Installer les dépendances PHP**
```bash
composer install
```

3. **Installer les dépendances JavaScript**
```bash
npm install
npm run build
```

4. **Configurer l'environnement**
```bash
cp .env.example .env
php artisan key:generate
```

5. **Configurer la base de données**
Modifier le fichier `.env` avec vos paramètres MySQL :
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=campusconnect
DB_USERNAME=root
DB_PASSWORD=
```

6. **Créer la base de données**
```sql
CREATE DATABASE campusconnect CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

7. **Exécuter les migrations et seeders**
```bash
php artisan migrate:fresh --seed
```

8. **Créer le lien symbolique pour le stockage**
```bash
php artisan storage:link
```

9. **Démarrer le serveur**
```bash
php artisan serve
```

L'application sera accessible sur : http://127.0.0.1:8000

## 👥 Comptes de Test

Après avoir exécuté les seeders, vous pouvez vous connecter avec les comptes suivants :

### Administrateur
- **Email:** admin@campus.com
- **Mot de passe:** password

### Enseignants
- **Email:** marie.dupont@campus.com | **Mot de passe:** password
- **Email:** jean.martin@campus.com | **Mot de passe:** password

### Étudiants
- **Email:** alice.bernard@campus.com | **Mot de passe:** password
- **Email:** bob.durand@campus.com | **Mot de passe:** password
- **Email:** claire.petit@campus.com | **Mot de passe:** password
- **Email:** david.moreau@campus.com | **Mot de passe:** password

## 📊 Structure de la Base de Données

### Tables Principales

1. **users** - Utilisateurs du système
   - Rôles : admin, enseignant, etudiant
   - Champs : name, email, password, role, matricule, phone

2. **projects** - Projets étudiants
   - Statuts : en_attente, en_cours, termine
   - Relations : supervisor (enseignant), members (étudiants)

3. **project_members** - Table pivot pour les membres d'un projet
   - Rôles : chef, membre

4. **deliverables** - Livrables déposés
   - Statuts : en_attente, valide, refuse
   - Stockage des fichiers dans storage/app/public/deliverables

5. **comments** - Commentaires sur les projets

6. **evaluations** - Évaluations des projets par les enseignants
   - Note sur 20 avec commentaire


## 🗂️ Architecture du Projet

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── ProjectController.php
│   │   ├── DeliverableController.php
│   │   ├── CommentController.php
│   │   ├── EvaluationController.php
│   │   └── DashboardController.php
│   └── Requests/
│       ├── StoreProjectRequest.php
│       ├── UpdateProjectRequest.php
│       └── StoreDeliverableRequest.php
├── Models/
│   ├── User.php
│   ├── Project.php
│   ├── ProjectMember.php
│   ├── Deliverable.php
│   ├── Comment.php
│   └── Evaluation.php
database/
├── migrations/
└── seeders/
resources/
├── views/
│   ├── projects/
│   │   ├── index.blade.php
│   │   ├── create.blade.php
│   │   ├── show.blade.php
│   │   └── edit.blade.php
│   ├── deliverables/
│   │   └── create.blade.php
│   └── dashboard.blade.php
routes/
└── web.php
```

## 🔐 Système de Permissions

### Étudiants
- Peuvent créer des projets
- Peuvent modifier leurs propres projets
- Peuvent déposer des livrables
- Peuvent commenter les projets dont ils sont membres

### Enseignants
- Peuvent superviser des projets
- Peuvent évaluer les livrables
- Peuvent noter les projets
- Peuvent modifier le statut des projets supervisés

### Administrateurs
- Accès complet à toutes les fonctionnalités
- Peuvent supprimer n'importe quel contenu

## 📝 Fonctionnalités Détaillées

### Gestion des Projets
- Création avec titre, description, dates, encadrant et membres
- Filtrage par statut et recherche par mots-clés
- Pagination des résultats
- Indicateur de retard pour les projets dépassant la date de fin

### Gestion des Livrables
- Upload de fichiers (PDF, DOC, DOCX, ZIP, RAR - max 10 Mo)
- Versioning des livrables
- Téléchargement sécurisé
- Validation/Refus par l'encadrant avec feedback

### Système de Discussion
- Commentaires en temps réel sur les projets
- Suppression par l'auteur ou l'admin
- Affichage chronologique

### Évaluations
- Note sur 20 avec commentaire détaillé
- Visible par tous les membres du projet
- Modifiable par l'encadrant

## 🚀 Améliorations Futures Possibles

- [ ] Notifications par email pour les deadlines
- [ ] Tableau Kanban pour le suivi des tâches
- [ ] Export des projets en PDF
- [ ] Statistiques avancées pour les enseignants
- [ ] API REST pour une application mobile
- [ ] Intégration avec Git pour le versioning du code
- [ ] Chat en temps réel entre membres

## 📄 Licence

Ce projet est développé dans un cadre académique pour le Module 3 : Gestion des projets étudiants.

## 👨‍💻 Auteur

Développé avec Laravel 11 et TailwindCSS pour CampusConnect.

---

**Note:** Ce projet démontre la maîtrise de Laravel avec :
- Architecture MVC bien structurée
- Relations Eloquent complexes (One-to-Many, Many-to-Many)
- Authentification et autorisation basée sur les rôles
- Validation des formulaires avec Form Requests
- Upload et gestion de fichiers
- Interface utilisateur moderne avec TailwindCSS
- Code propre et bien documenté

