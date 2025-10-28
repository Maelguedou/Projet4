# 🔧 Guide de Débogage - Boutons Manquants

## 🚨 Problème : "Je ne vois pas les boutons Nouveau Projet et Déposer un Livrable"

---

## ✅ SOLUTION ÉTAPE PAR ÉTAPE

### Étape 1 : Vérifier que vous êtes connecté en tant qu'ÉTUDIANT

#### Option A : Via l'interface web
1. Ouvrez http://127.0.0.1:8000/test-auth
2. Vous devriez voir quelque chose comme :
```json
{
  "authenticated": true,
  "user": {
    "id": 4,
    "name": "Alice Bernard",
    "email": "alice.bernard@campus.com",
    "role": "etudiant"
  },
  "checks": {
    "isEtudiant": true,
    "isEnseignant": false,
    "isAdmin": false
  },
  "can_create_project": true
}
```

#### ⚠️ Si vous voyez `"role": "enseignant"` ou `"role": "admin"` :
**C'EST LE PROBLÈME !** Les enseignants et admins ne peuvent PAS créer de projets.

**SOLUTION :** Déconnectez-vous et reconnectez-vous avec un compte étudiant :
- Email: `alice.bernard@campus.com`
- Mot de passe: `password`

---

### Étape 2 : Vérifier le Dashboard

1. Allez sur http://127.0.0.1:8000/dashboard
2. **Si vous êtes ÉTUDIANT**, vous DEVEZ voir en haut à droite :

```
┌────────────────────────────────────────────┐
│  Tableau de bord - CampusConnect           │
│                    [+ Nouveau Projet] ←ICI │
└────────────────────────────────────────────┘
```

3. **Si vous êtes ENSEIGNANT ou ADMIN**, vous verrez :

```
┌────────────────────────────────────────────┐
│  Tableau de bord - CampusConnect           │
│                    (pas de bouton)         │
└────────────────────────────────────────────┘
```

---

### Étape 3 : Vérifier la page d'un projet (pour le bouton Déposer un Livrable)

1. Allez sur http://127.0.0.1:8000/projects
2. Cliquez sur **"Système de Gestion de Bibliothèque"**
3. **Si vous êtes ÉTUDIANT ET MEMBRE du projet**, vous DEVEZ voir :

```
┌────────────────────────────────────────────────────┐
│  Détails du Projet                                 │
│  [Modifier] [Déposer un Livrable] ← ICI           │
└────────────────────────────────────────────────────┘
```

4. **Si vous êtes ÉTUDIANT mais PAS MEMBRE**, vous verrez :
```
┌────────────────────────────────────────────────────┐
│  Détails du Projet                                 │
│  (pas de boutons)                                  │
└────────────────────────────────────────────────────┘
```

5. **Si vous êtes ENSEIGNANT SUPERVISEUR**, vous verrez :
```
┌────────────────────────────────────────────────────┐
│  Détails du Projet                                 │
│  [Modifier] (pas de bouton Déposer un Livrable)   │
└────────────────────────────────────────────────────┘
```

---

## 🔍 DIAGNOSTIC COMPLET

### Test 1 : Vérifier votre compte actuel

**Commande :**
```bash
php test_users.php
```

**Résultat attendu :**
Vous devriez voir la liste de tous les utilisateurs avec leurs rôles.

---

### Test 2 : Vérifier l'authentification

**URL :** http://127.0.0.1:8000/test-auth

**Si vous voyez `"authenticated": false` :**
- Vous n'êtes PAS connecté
- Allez sur http://127.0.0.1:8000/login
- Connectez-vous avec alice.bernard@campus.com / password

**Si vous voyez `"can_create_project": false` :**
- Vous êtes connecté mais PAS en tant qu'étudiant
- Déconnectez-vous et reconnectez-vous avec un compte étudiant

---

### Test 3 : Vérifier les membres du projet

Pour voir si Alice est membre du projet "Système de Gestion de Bibliothèque" :

**Commande :**
```bash
php artisan tinker
```

Puis dans Tinker :
```php
$project = \App\Models\Project::find(1);
$project->members->pluck('name', 'id');
// Devrait afficher les membres du projet

$alice = \App\Models\User::where('email', 'alice.bernard@campus.com')->first();
$project->hasMember($alice);
// Devrait retourner true si Alice est membre
```

---

## 🛠️ SOLUTIONS AUX PROBLÈMES COURANTS

### Problème 1 : "Je suis connecté en tant qu'enseignant"

**Solution :**
1. Cliquez sur votre nom en haut à droite
2. Cliquez sur "Se déconnecter"
3. Reconnectez-vous avec :
   - Email: `alice.bernard@campus.com`
   - Mot de passe: `password`

---

### Problème 2 : "Je suis étudiant mais je ne vois pas le bouton"

**Causes possibles :**

#### Cause A : Cache du navigateur
**Solution :**
1. Appuyez sur `Ctrl + Shift + R` (Windows) ou `Cmd + Shift + R` (Mac)
2. Ou videz le cache du navigateur

#### Cause B : Cache Laravel
**Solution :**
```bash
php artisan optimize:clear
php artisan view:clear
```

#### Cause C : Problème de session
**Solution :**
1. Déconnectez-vous complètement
2. Fermez le navigateur
3. Rouvrez et reconnectez-vous

---

### Problème 3 : "Je ne vois pas le bouton Déposer un Livrable"

**Vérifications :**

1. **Êtes-vous sur la bonne page ?**
   - ❌ Mauvais : http://127.0.0.1:8000/projects (liste)
   - ✅ Bon : http://127.0.0.1:8000/projects/1 (détails)

2. **Êtes-vous membre du projet ?**
   - Le bouton n'apparaît QUE si vous êtes membre
   - Vérifiez dans la section "Membres du Projet"

3. **Êtes-vous étudiant ?**
   - Les enseignants ne peuvent PAS déposer de livrables

---

## 📋 CHECKLIST DE VÉRIFICATION

Cochez chaque élément :

### Authentification
- [ ] Je suis connecté (pas sur la page de login)
- [ ] Je suis connecté en tant qu'ÉTUDIANT (vérifié via /test-auth)
- [ ] Mon rôle est bien "etudiant" (pas "enseignant" ou "admin")

### Dashboard
- [ ] J'ai accédé à http://127.0.0.1:8000/dashboard
- [ ] Je vois les statistiques (Total Projets, En Cours, Terminés)
- [ ] Je vois le bouton "Nouveau Projet" en haut à droite

### Page Projet
- [ ] J'ai cliqué sur un projet spécifique
- [ ] Je suis sur l'URL /projects/{id} (pas juste /projects)
- [ ] Je suis membre de ce projet (mon nom apparaît dans "Membres")
- [ ] Je vois le bouton "Déposer un Livrable" en haut à droite

---

## 🎯 TEST FINAL

### Scénario complet pour vérifier que tout fonctionne :

1. **Déconnexion complète**
   ```
   - Cliquez sur votre nom → "Se déconnecter"
   - Fermez le navigateur
   ```

2. **Connexion en tant qu'étudiant**
   ```
   - Ouvrez http://127.0.0.1:8000
   - Email: alice.bernard@campus.com
   - Mot de passe: password
   - Cliquez sur "Se connecter"
   ```

3. **Vérification de l'authentification**
   ```
   - Allez sur http://127.0.0.1:8000/test-auth
   - Vérifiez que "can_create_project": true
   ```

4. **Test du bouton Nouveau Projet**
   ```
   - Allez sur http://127.0.0.1:8000/dashboard
   - Cherchez le bouton bleu "Nouveau Projet" en haut à droite
   - Cliquez dessus
   - Vous devriez arriver sur /projects/create
   ```

5. **Test du bouton Déposer un Livrable**
   ```
   - Allez sur http://127.0.0.1:8000/projects
   - Cliquez sur "Système de Gestion de Bibliothèque"
   - Cherchez le bouton vert "Déposer un Livrable" en haut à droite
   - Cliquez dessus
   - Vous devriez arriver sur /projects/1/deliverables/create
   ```

---

## 🆘 SI RIEN NE FONCTIONNE

### Solution de dernier recours : Réinitialisation complète

```bash
# 1. Vider tous les caches
php artisan optimize:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

# 2. Réinitialiser la base de données
php artisan migrate:fresh --seed

# 3. Redémarrer le serveur
# Arrêtez le serveur (Ctrl+C)
php artisan serve

# 4. Vider le cache du navigateur
# Appuyez sur Ctrl+Shift+Delete et videz tout

# 5. Reconnexion
# Allez sur http://127.0.0.1:8000
# Connectez-vous avec alice.bernard@campus.com / password
```

---

## 📸 CAPTURES D'ÉCRAN TEXTUELLES

### Dashboard - Vue Étudiant
```
╔════════════════════════════════════════════════════════╗
║  Tableau de bord - CampusConnect    [+ Nouveau Projet] ║
╠════════════════════════════════════════════════════════╣
║                                                        ║
║  ┌──────────────┐  ┌──────────────┐  ┌──────────────┐ ║
║  │ Total Projets│  │   En Cours   │  │   Terminés   │ ║
║  │      3       │  │      2       │  │      0       │ ║
║  └──────────────┘  └──────────────┘  └──────────────┘ ║
║                                                        ║
║  Mes Projets                                          ║
║  ┌────────────────────────────────────────────────┐   ║
║  │ Système de Gestion de Bibliothèque  [En Cours]│   ║
║  │ Encadrant: Dr. Marie Dupont                   │   ║
║  └────────────────────────────────────────────────┘   ║
║                                                        ║
╚════════════════════════════════════════════════════════╝
```

### Page Projet - Vue Étudiant Membre
```
╔════════════════════════════════════════════════════════╗
║  Détails du Projet                                     ║
║                    [Modifier] [Déposer un Livrable]    ║
╠════════════════════════════════════════════════════════╣
║  Système de Gestion de Bibliothèque      [En Cours]   ║
║  Encadrant: Dr. Marie Dupont                          ║
║  Début: 01/10/2025  |  Fin: 30/11/2025                ║
║                                                        ║
║  👥 Membres du Projet                                  ║
║  • Alice Bernard [Chef] ← VOUS ÊTES ICI               ║
║  • Bob Durand [Membre]                                ║
║                                                        ║
║  📦 Livrables                                          ║
║  (vide pour l'instant)                                ║
║                                                        ║
║  💬 Discussion                                         ║
║  [Zone de commentaire]                                ║
╚════════════════════════════════════════════════════════╝
```

---

**Date de création :** 28 Octobre 2025
**Dernière mise à jour :** 28 Octobre 2025

