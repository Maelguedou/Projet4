# Guide de Test - CampusConnect

## 🧪 Scénarios de Test

### 1. Test de l'Authentification

#### Test 1.1 : Connexion Étudiant
1. Ouvrir http://127.0.0.1:8000
2. Se connecter avec :
   - Email : `alice.bernard@campus.com`
   - Mot de passe : `password`
3. ✅ Vérifier : Redirection vers le dashboard
4. ✅ Vérifier : Affichage des statistiques (projets, en cours, terminés)
5. ✅ Vérifier : Bouton "Nouveau Projet" visible

#### Test 1.2 : Connexion Enseignant
1. Se déconnecter
2. Se connecter avec :
   - Email : `marie.dupont@campus.com`
   - Mot de passe : `password`
3. ✅ Vérifier : Dashboard affiche les projets supervisés
4. ✅ Vérifier : Pas de bouton "Nouveau Projet"

#### Test 1.3 : Connexion Admin
1. Se déconnecter
2. Se connecter avec :
   - Email : `admin@campus.com`
   - Mot de passe : `password`
3. ✅ Vérifier : Dashboard affiche tous les projets

---

### 2. Test de Gestion des Projets

#### Test 2.1 : Création d'un Projet (Étudiant)
1. Se connecter en tant qu'étudiant (alice.bernard@campus.com)
2. Cliquer sur "Nouveau Projet"
3. Remplir le formulaire :
   - Titre : "Test Projet Laravel"
   - Description : "Projet de test pour valider les fonctionnalités"
   - Date début : Aujourd'hui
   - Date fin : Dans 30 jours
   - Encadrant : Sélectionner "Dr. Marie Dupont"
   - Membres : Cocher "Bob Durand"
4. Cliquer sur "Créer le Projet"
5. ✅ Vérifier : Message de succès
6. ✅ Vérifier : Redirection vers la page du projet
7. ✅ Vérifier : Alice est marquée comme "Chef"
8. ✅ Vérifier : Bob est membre

#### Test 2.2 : Consultation d'un Projet
1. Aller sur "Projets" dans le menu
2. Cliquer sur "Système de Gestion de Bibliothèque"
3. ✅ Vérifier : Affichage des détails du projet
4. ✅ Vérifier : Liste des membres
5. ✅ Vérifier : Section livrables
6. ✅ Vérifier : Section commentaires
7. ✅ Vérifier : Section évaluation (si disponible)

#### Test 2.3 : Modification d'un Projet (Étudiant)
1. Sur la page d'un projet dont vous êtes membre
2. Cliquer sur "Modifier"
3. Modifier la description
4. Cliquer sur "Enregistrer"
5. ✅ Vérifier : Message de succès
6. ✅ Vérifier : Modifications enregistrées

#### Test 2.4 : Filtrage et Recherche
1. Aller sur "Projets"
2. Utiliser la barre de recherche : taper "Bibliothèque"
3. ✅ Vérifier : Seuls les projets correspondants s'affichent
4. Sélectionner le filtre "En Cours"
5. ✅ Vérifier : Seuls les projets en cours s'affichent
6. Cliquer sur "Réinitialiser"
7. ✅ Vérifier : Tous les projets s'affichent

---

### 3. Test de Gestion des Livrables

#### Test 3.1 : Dépôt d'un Livrable (Étudiant)
1. Se connecter en tant qu'étudiant (alice.bernard@campus.com)
2. Aller sur un projet dont vous êtes membre
3. Cliquer sur "Déposer un Livrable"
4. Remplir le formulaire :
   - Titre : "Rapport d'avancement"
   - Description : "Premier rapport du projet"
   - Version : "1.0"
   - Fichier : Sélectionner un fichier PDF de test
5. Cliquer sur "Déposer le Livrable"
6. ✅ Vérifier : Message de succès
7. ✅ Vérifier : Livrable apparaît dans la liste
8. ✅ Vérifier : Statut "En Attente"

#### Test 3.2 : Téléchargement d'un Livrable
1. Sur la page du projet
2. Cliquer sur "Télécharger" pour un livrable
3. ✅ Vérifier : Le fichier se télécharge correctement

#### Test 3.3 : Évaluation d'un Livrable (Enseignant)
1. Se déconnecter et se connecter en tant qu'enseignant (marie.dupont@campus.com)
2. Aller sur un projet que vous supervisez
3. Cliquer sur "Évaluer" pour un livrable
4. Dans le modal :
   - Statut : Sélectionner "Validé"
   - Feedback : "Bon travail, continuez ainsi"
5. Cliquer sur "Enregistrer"
6. ✅ Vérifier : Statut du livrable change à "Validé"
7. ✅ Vérifier : Feedback s'affiche

#### Test 3.4 : Refus d'un Livrable (Enseignant)
1. Cliquer sur "Évaluer" pour un autre livrable
2. Sélectionner "Refusé"
3. Feedback : "Merci de revoir la structure du document"
4. ✅ Vérifier : Statut "Refusé" avec feedback

---

### 4. Test du Système de Commentaires

#### Test 4.1 : Ajout d'un Commentaire (Étudiant)
1. Se connecter en tant qu'étudiant
2. Aller sur un projet dont vous êtes membre
3. Dans la section "Discussion", taper un commentaire
4. Cliquer sur "Commenter"
5. ✅ Vérifier : Commentaire apparaît immédiatement
6. ✅ Vérifier : Nom de l'auteur et date affichés

#### Test 4.2 : Ajout d'un Commentaire (Enseignant)
1. Se connecter en tant qu'enseignant
2. Aller sur un projet supervisé
3. Ajouter un commentaire
4. ✅ Vérifier : Commentaire visible pour tous

#### Test 4.3 : Suppression d'un Commentaire
1. Sur votre propre commentaire
2. Cliquer sur "Supprimer"
3. Confirmer
4. ✅ Vérifier : Commentaire supprimé

---

### 5. Test du Système d'Évaluation

#### Test 5.1 : Évaluation d'un Projet (Enseignant)
1. Se connecter en tant qu'enseignant (marie.dupont@campus.com)
2. Aller sur un projet supervisé
3. Dans la section "Évaluation du Projet"
4. Remplir :
   - Note : 16.5
   - Commentaire : "Excellent travail d'équipe. Interface bien conçue."
5. Cliquer sur "Évaluer le projet"
6. ✅ Vérifier : Évaluation enregistrée
7. ✅ Vérifier : Note affichée

#### Test 5.2 : Modification d'une Évaluation (Enseignant)
1. Sur un projet déjà évalué
2. Modifier la note et le commentaire
3. Cliquer sur "Mettre à jour l'évaluation"
4. ✅ Vérifier : Modifications enregistrées

#### Test 5.3 : Consultation d'une Évaluation (Étudiant)
1. Se connecter en tant qu'étudiant
2. Aller sur un projet évalué
3. ✅ Vérifier : Section "Évaluation" visible
4. ✅ Vérifier : Note et commentaire affichés
5. ✅ Vérifier : Pas de bouton de modification

---

### 6. Test de Changement de Statut

#### Test 6.1 : Changement de Statut (Enseignant)
1. Se connecter en tant qu'enseignant
2. Aller sur un projet supervisé
3. Dans la section "Changer le Statut"
4. Sélectionner "En Cours"
5. Cliquer sur "Mettre à jour"
6. ✅ Vérifier : Statut change
7. ✅ Vérifier : Badge de statut mis à jour

#### Test 6.2 : Modification via Edit (Enseignant)
1. Cliquer sur "Modifier"
2. Changer le statut à "Terminé"
3. Cliquer sur "Enregistrer"
4. ✅ Vérifier : Statut mis à jour

---

### 7. Test des Permissions

#### Test 7.1 : Étudiant ne peut pas évaluer
1. Se connecter en tant qu'étudiant
2. Aller sur un projet
3. ✅ Vérifier : Pas de bouton "Évaluer" sur les livrables
4. ✅ Vérifier : Pas de formulaire d'évaluation du projet

#### Test 7.2 : Enseignant ne peut pas créer de projet
1. Se connecter en tant qu'enseignant
2. ✅ Vérifier : Pas de bouton "Nouveau Projet" sur le dashboard
3. ✅ Vérifier : Pas de lien vers la création de projet

#### Test 7.3 : Étudiant ne peut modifier que ses projets
1. Se connecter en tant qu'étudiant (claire.petit@campus.com)
2. Aller sur un projet dont vous n'êtes PAS membre
3. ✅ Vérifier : Pas de bouton "Modifier"
4. ✅ Vérifier : Pas de bouton "Déposer un Livrable"

---

### 8. Test de l'Interface Utilisateur

#### Test 8.1 : Navigation
1. ✅ Vérifier : Menu de navigation présent sur toutes les pages
2. ✅ Vérifier : Lien "Tableau de bord" fonctionne
3. ✅ Vérifier : Lien "Projets" fonctionne
4. ✅ Vérifier : Menu utilisateur (dropdown) fonctionne

#### Test 8.2 : Responsive Design
1. Réduire la taille de la fenêtre
2. ✅ Vérifier : Interface s'adapte aux petits écrans
3. ✅ Vérifier : Menu hamburger apparaît sur mobile

#### Test 8.3 : Messages de Feedback
1. ✅ Vérifier : Messages de succès en vert
2. ✅ Vérifier : Messages d'erreur en rouge
3. ✅ Vérifier : Messages disparaissent ou peuvent être fermés

---

## 📋 Checklist Finale

### Fonctionnalités Principales
- [ ] Authentification (login/logout)
- [ ] Dashboard avec statistiques
- [ ] Création de projets (étudiants)
- [ ] Modification de projets (membres)
- [ ] Suppression de projets (admin/superviseur)
- [ ] Filtrage et recherche de projets
- [ ] Dépôt de livrables
- [ ] Téléchargement de livrables
- [ ] Évaluation de livrables (enseignants)
- [ ] Suppression de livrables
- [ ] Ajout de commentaires
- [ ] Suppression de commentaires
- [ ] Évaluation de projets (enseignants)
- [ ] Changement de statut (enseignants)

### Permissions
- [ ] Étudiants : créer projets, déposer livrables, commenter
- [ ] Enseignants : superviser, évaluer, noter
- [ ] Admins : accès complet

### Interface
- [ ] Design cohérent avec TailwindCSS
- [ ] Navigation claire
- [ ] Messages de feedback
- [ ] Responsive design

### Données
- [ ] Migrations exécutées sans erreur
- [ ] Seeders créent les données de test
- [ ] Relations Eloquent fonctionnent
- [ ] Validation des formulaires

---

## 🎯 Résultats Attendus

Après avoir complété tous les tests, l'application devrait :
1. ✅ Permettre la gestion complète des projets étudiants
2. ✅ Respecter les permissions basées sur les rôles
3. ✅ Offrir une interface utilisateur moderne et intuitive
4. ✅ Gérer correctement les fichiers (upload/download)
5. ✅ Faciliter la communication (commentaires)
6. ✅ Permettre l'évaluation et le suivi des projets

---

**Note :** Cochez chaque test au fur et à mesure de sa réalisation. En cas de problème, notez les erreurs rencontrées pour correction.

