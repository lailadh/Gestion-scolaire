# README – Projet Gestion Scolaire (SchoolManager)

## 1. Présentation du projet

SchoolManager est une application web de gestion scolaire permettant de centraliser les informations administratives d’un établissement scolaire.

L’objectif est de remplacer les fichiers Excel et la gestion papier par une solution numérique facilitant la gestion des élèves, classes, enseignants, matières, inscriptions et affectations.

### Technologies utilisées :

- PHP
- PDO
- MySQL
- HTML / CSS
- XAMPP
- MERISE (MCD / MLD)

---

## 2. Problématique

L’établissement utilise plusieurs fichiers Excel et documents papier pour gérer ses activités administratives.

Cette méthode provoque :

- Dispersion des informations
- Données dupliquées
- Difficulté de suivi des inscriptions
- Gestion manuelle des affectations
- Temps élevé pour rechercher les informations

L’application SchoolManager vise à résoudre ces problèmes.

---

## 3. Objectifs

- Centraliser les données scolaires
- Gérer les élèves
- Gérer les classes
- Gérer les enseignants
- Gérer les matières
- Gérer les inscriptions
- Gérer les affectations
- Garantir la cohérence des données
- Sécuriser l’application
- Faciliter le travail administratif

---

## 4. Acteurs du système

### Administrateur

- Gestion des élèves
- Gestion des classes
- Gestion des enseignants
- Gestion des matières
- Gestion des inscriptions
- Gestion des affectations

### Enseignant

- Consulter les classes affectées
- Consulter les matières enseignées

### Élève

- Consulter ses informations scolaires
- Consulter sa classe

### Parent

- Consulter les informations scolaires de son enfant

---

## 5. Règles de gestion

- Un élève peut avoir plusieurs inscriptions.
- Une inscription concerne un seul élève.
- Une classe peut contenir plusieurs élèves.
- Une affectation associe un enseignant, une classe et une matière.
- Les identifiants sont uniques.
- Les contraintes d’intégrité doivent être respectées.

---

## 6. Base de données

### Entités principales

#### ELEVE

- id_eleve (PK)
- nom
- prenom
- date_naissance
- adresse
- telephone

#### CLASSE

- id_classe (PK)
- nom_classe
- niveau
- capacite

#### ENSEIGNANT

- id_enseignant (PK)
- nom
- prenom
- specialite
- telephone

#### MATIERE

- id_matiere (PK)
- nom_matiere
- coefficient

#### INSCRIPTION

- id_inscription (PK)
- date_inscription
- annee_scolaire
- id_eleve (FK)
- id_classe (FK)

#### AFFECTATION

- id_affectation (PK)
- annee_scolaire
- id_enseignant (FK)
- id_classe (FK)
- id_matiere (FK)

### Contraintes utilisées

- PRIMARY KEY
- FOREIGN KEY
- NOT NULL
- UNIQUE

---

## 7. Implémentation technique

### Sécurité

- Connexion PDO sécurisée
- Requêtes préparées
- Validation des formulaires
- Protection SQL Injection
- Protection XSS
- Gestion des erreurs

---

## 8. Livrables

- Lien Jira
- Schéma MCD
- Schéma MLD
- Script SQL
- config.php
- Application PHP fonctionnelle
- Pages CRUD
- Dépôt GitHub

---

## Auteur

Projet réalisé dans le cadre de la formation Développeur Web et Web Mobile.
