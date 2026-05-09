# Tutoriel Git - Projet Régime (CodeIgniter)







## Flux de travail principal

### Cycle de développement typique

```
1. Créer une branche feature → 2. Développer → 3. Commit → 4. Push → 5. Merge en dev
```

#### Étape 1 : Créer une branche pour votre feature
```bash
# Mettre à jour la branche dev
git checkout dev
git pull origin dev

# Créer et basculer sur une nouvelle branche
git checkout -b feature/nom-de-la-feature
```

#### Étape 2 : Verifier les changements
```bash
# Voir le statut des fichiers modifiés
git status

```

#### Étape 3 : Ajouter et committer les changements
```bash
# Ajouter tous les fichiers modifiés
git add .

# Ajouter des fichiers spécifiques
git add app/Controllers/Home.php app/Views/welcome_message.php

# Vérifier les fichiers à committer
git status

# Créer un commit avec un message descriptif
git commit -m "Feat: ajouter la validation du formulaire d'inscription"
```

#### Étape 4 : Pousser vers le serveur
```bash
git push origin feature/nom-de-la-feature
```

#### Étape 5 : Créer une Pull Request et merger

####  aller dans github (Meilleur pratique)
---

## Branches

### Convention de nommage des branches

```
feature/description       # Nouvelles fonctionnalités
bugfix/description       # Corrections de bugs
hotfix/description       # Correctifs urgents en production
refactor/description     # Refactorisation du code
docs/description         # Documentation
test/description         # Tests
```
#### NB: Nommage non obligatoire
### Exemples concrets
```bash
# Créer une branche pour une nouvelle feature
git checkout -b feature/authentification-utilisateurs

# Créer une branche pour corriger un bug
git checkout -b bugfix/login-error-message

# Créer une branche pour un correctif urgent
git checkout -b hotfix/database-connection-issue
```

### Lister les branches
```bash
# Branches locales
git branch

# Branches locales avec la dernière activité
git branch -v

# Branches distantes
git branch -r

# Toutes les branches (locales + distantes)
git branch -a
```

### Supprimer une branche
```bash
# Localement
git branch -d feature/nom-de-la-feature

# Forcer la suppression (même si non merged)
git branch -D feature/nom-de-la-feature

# À distance
git push origin --delete feature/nom-de-la-feature
```

### Renommer une branche
```bash
# Renommer la branche courante
git branch -m nouveau-nom

# Renommer une autre branche
git branch -m ancien-nom nouveau-nom
```

