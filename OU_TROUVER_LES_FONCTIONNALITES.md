# 📍 Où Trouver Toutes les Fonctionnalités - CampusConnect

## 🏠 Page d'Accueil / Dashboard

**URL :** http://127.0.0.1:8000/dashboard

### Ce que vous voyez :
- ✅ **Statistiques** : Nombre total de projets, projets en cours, projets terminés
- ✅ **Liste des projets** : Vos projets (étudiants) ou projets supervisés (enseignants)
- ✅ **Bouton "Nouveau Projet"** : Visible uniquement pour les étudiants

---

## 📋 Page Liste des Projets

**URL :** http://127.0.0.1:8000/projects

### Ce que vous voyez :
- ✅ **Barre de recherche** : Rechercher par titre ou description
- ✅ **Filtre par statut** : En Attente / En Cours / Terminé
- ✅ **Liste paginée** : Tous les projets avec badges de statut
- ✅ **Indicateur de retard** : Badge rouge si le projet dépasse la date de fin

### Actions disponibles :
- Cliquer sur "Voir les détails" pour accéder à la page du projet

---

## 📄 Page Détails d'un Projet

**URL :** http://127.0.0.1:8000/projects/{id}

### 🎯 C'EST ICI QUE SE TROUVENT TOUTES LES FONCTIONNALITÉS !

### Section 1 : En-tête du Projet
**Ce que vous voyez :**
- Titre du projet
- Encadrant
- Dates de début et fin
- Badge de statut (En Attente / En Cours / Terminé)
- Indicateur de retard (si applicable)

**Boutons disponibles (selon votre rôle) :**

#### Pour les ÉTUDIANTS (membres du projet) :
- ✅ **Bouton "Modifier"** : Modifier le projet
- ✅ **Bouton "Déposer un Livrable"** : Upload de fichiers

#### Pour les ENSEIGNANTS (superviseurs) :
- ✅ **Bouton "Modifier"** : Modifier le projet
- ✅ **Formulaire "Changer le Statut"** : Passer de "En Attente" à "En Cours" à "Terminé"

---

### Section 2 : Description du Projet
- Texte complet de la description

---

### Section 3 : Membres du Projet
**Ce que vous voyez :**
- Liste de tous les membres
- Badge "Chef" pour le chef de projet
- Badge "Membre" pour les autres membres

---

### Section 4 : 📦 LIVRABLES (Fonctionnalité Clé)

**⚠️ IMPORTANT : Cette section est vide si aucun livrable n'a été déposé !**

#### Comment déposer un livrable :
1. Cliquez sur le bouton **"Déposer un Livrable"** (en haut à droite)
2. Remplissez le formulaire :
   - Titre : ex. "Rapport d'avancement"
   - Description : ex. "Premier livrable du projet"
   - Version : ex. "1.0"
   - Fichier : Sélectionnez un fichier (PDF, DOC, DOCX, ZIP, RAR - max 10 Mo)
3. Cliquez sur "Déposer le Livrable"

#### Une fois un livrable déposé, vous verrez :
- **Titre du livrable**
- **Description**
- **Version**
- **Déposé par** : Nom de l'étudiant
- **Date de dépôt**
- **Statut** : Badge coloré (En Attente / Validé / Refusé)
- **Feedback** : Commentaire de l'enseignant (si évalué)

#### Actions disponibles sur un livrable :

**Pour TOUS les membres :**
- ✅ **Bouton "Télécharger"** : Télécharger le fichier

**Pour les ENSEIGNANTS (superviseurs) :**
- ✅ **Bouton "Évaluer"** : Ouvre un modal pour :
  - Changer le statut (Validé / Refusé)
  - Ajouter un feedback

**Pour l'AUTEUR du livrable ou ADMIN :**
- ✅ **Bouton "Supprimer"** : Supprimer le livrable

---

### Section 5 : 💬 DISCUSSION (Commentaires)

**Ce que vous voyez :**
- Liste de tous les commentaires
- Nom de l'auteur
- Date et heure
- Contenu du commentaire

#### Comment ajouter un commentaire :
1. Tapez votre commentaire dans le champ texte
2. Cliquez sur "Commenter"
3. Le commentaire apparaît immédiatement

#### Actions disponibles :
**Pour l'AUTEUR du commentaire ou ADMIN :**
- ✅ **Bouton "Supprimer"** : Supprimer le commentaire

---

### Section 6 : ⭐ ÉVALUATION DU PROJET

**⚠️ Cette section est visible uniquement si le projet a été évalué !**

#### Pour les ENSEIGNANTS (superviseurs) :
**Formulaire d'évaluation visible avec :**
- Champ "Note" : Note sur 20 (ex. 16.5)
- Champ "Commentaire" : Commentaire détaillé
- Bouton "Évaluer le projet" (ou "Mettre à jour l'évaluation" si déjà évalué)
- Bouton "Supprimer l'évaluation" (si déjà évalué)

#### Pour les ÉTUDIANTS et autres :
**Affichage de l'évaluation (si elle existe) :**
- Note sur 20
- Commentaire de l'enseignant
- Nom de l'évaluateur
- Date d'évaluation

---

## ✏️ Page Modification d'un Projet

**URL :** http://127.0.0.1:8000/projects/{id}/edit

### Ce que vous pouvez modifier :
- Titre
- Description
- Date de début
- Date de fin
- Encadrant (liste déroulante des enseignants)
- Membres (cases à cocher des étudiants)
- Statut (pour les enseignants)

### Actions disponibles :
- ✅ **Bouton "Enregistrer"** : Sauvegarder les modifications
- ✅ **Bouton "Supprimer le projet"** : Supprimer le projet (admin ou superviseur uniquement)

---

## 📤 Page Dépôt de Livrable

**URL :** http://127.0.0.1:8000/projects/{id}/deliverables/create

### Formulaire :
- **Titre** : Titre du livrable
- **Description** : Description détaillée
- **Version** : Numéro de version (ex. 1.0, 2.0)
- **Fichier** : Upload de fichier

### Fichiers acceptés :
- PDF (.pdf)
- Word (.doc, .docx)
- Archives (.zip, .rar)
- Taille max : 10 Mo

---

## 🔐 Permissions par Rôle

### 👨‍🎓 ÉTUDIANTS
**Peuvent :**
- ✅ Créer des projets
- ✅ Modifier leurs projets (si membres)
- ✅ Déposer des livrables
- ✅ Télécharger les livrables
- ✅ Commenter sur les projets (si membres)
- ✅ Supprimer leurs propres commentaires
- ✅ Supprimer leurs propres livrables
- ✅ Voir les évaluations

**Ne peuvent PAS :**
- ❌ Évaluer les livrables
- ❌ Noter les projets
- ❌ Modifier le statut des projets

### 👨‍🏫 ENSEIGNANTS
**Peuvent :**
- ✅ Voir tous les projets
- ✅ Modifier les projets qu'ils supervisent
- ✅ Changer le statut des projets supervisés
- ✅ Évaluer les livrables (valider/refuser avec feedback)
- ✅ Noter les projets supervisés (sur 20)
- ✅ Commenter sur tous les projets
- ✅ Télécharger les livrables

**Ne peuvent PAS :**
- ❌ Créer des projets
- ❌ Déposer des livrables

### 👨‍💼 ADMINISTRATEURS
**Peuvent :**
- ✅ TOUT faire
- ✅ Supprimer n'importe quel contenu
- ✅ Modifier n'importe quel projet
- ✅ Accès complet à toutes les fonctionnalités

---

## 🧪 Scénario de Test Complet

### Étape 1 : Connexion Étudiant
1. Connectez-vous : `alice.bernard@campus.com` / `password`
2. Allez sur "Projets"
3. Cliquez sur "Système de Gestion de Bibliothèque"

### Étape 2 : Déposer un Livrable
1. Cliquez sur **"Déposer un Livrable"**
2. Remplissez :
   - Titre : "Rapport d'avancement v1.0"
   - Description : "Premier livrable du projet"
   - Version : "1.0"
   - Fichier : Sélectionnez un fichier PDF
3. Cliquez sur "Déposer le Livrable"
4. ✅ Vous devriez voir le livrable dans la section "Livrables"

### Étape 3 : Ajouter un Commentaire
1. Dans la section "Discussion"
2. Tapez : "Livrable déposé, en attente de validation"
3. Cliquez sur "Commenter"
4. ✅ Le commentaire apparaît

### Étape 4 : Connexion Enseignant
1. Déconnectez-vous
2. Connectez-vous : `marie.dupont@campus.com` / `password`
3. Allez sur le même projet

### Étape 5 : Évaluer le Livrable
1. Dans la section "Livrables"
2. Cliquez sur **"Évaluer"** pour le livrable
3. Dans le modal :
   - Statut : "Validé"
   - Feedback : "Excellent travail, continuez ainsi"
4. Cliquez sur "Enregistrer"
5. ✅ Le statut change à "Validé" avec le feedback

### Étape 6 : Noter le Projet
1. Dans la section "Évaluation du Projet"
2. Remplissez :
   - Note : 16.5
   - Commentaire : "Très bon projet, bien structuré"
3. Cliquez sur "Évaluer le projet"
4. ✅ L'évaluation apparaît

### Étape 7 : Changer le Statut
1. Dans la section "Changer le Statut"
2. Sélectionnez "En Cours"
3. Cliquez sur "Mettre à jour"
4. ✅ Le badge de statut change

---

## ❓ Problèmes Courants

### "Je ne vois pas le bouton Déposer un Livrable"
**Causes possibles :**
- Vous n'êtes pas connecté en tant qu'étudiant
- Vous n'êtes pas membre du projet
- Vous êtes sur la mauvaise page (doit être sur /projects/{id}, pas /projects)

### "Je ne vois pas la section Livrables"
**Cause :** Aucun livrable n'a été déposé encore. La section apparaîtra après le premier dépôt.

### "Je ne peux pas évaluer les livrables"
**Causes possibles :**
- Vous n'êtes pas connecté en tant qu'enseignant
- Vous n'êtes pas le superviseur du projet

### "Je ne vois pas le formulaire d'évaluation du projet"
**Causes possibles :**
- Vous n'êtes pas connecté en tant qu'enseignant
- Vous n'êtes pas le superviseur du projet

---

## 📞 Vérification Rapide

Pour vérifier que tout fonctionne, testez dans cet ordre :

1. ✅ Dashboard affiche les statistiques
2. ✅ Page Projets affiche la liste
3. ✅ Page Détails d'un projet s'affiche
4. ✅ Bouton "Déposer un Livrable" visible (étudiant membre)
5. ✅ Formulaire de dépôt fonctionne
6. ✅ Livrable apparaît dans la liste
7. ✅ Bouton "Télécharger" fonctionne
8. ✅ Commentaires peuvent être ajoutés
9. ✅ Enseignant peut évaluer (bouton "Évaluer" visible)
10. ✅ Enseignant peut noter le projet

---

**Dernière mise à jour :** 28 Octobre 2025

**Note :** Toutes les fonctionnalités sont présentes et fonctionnelles. Si vous ne les voyez pas, c'est probablement une question de permissions (rôle) ou de contexte (membre du projet ou non).

