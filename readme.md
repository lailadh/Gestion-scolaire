# Gestion_scolaire

Application web de gestion scolaire développée en **PHP**, **MySQL** et **Bootstrap** permettant de gérer les élèves, les classes, les enseignants, les matières, les inscriptions et les affectations.

---

## 📌 Fonctionnalités

### 👨‍🎓 Gestion des élèves

- Ajouter un élève
- Modifier un élève
- Supprimer un élève
- Consulter la liste des élèves

### 🏫 Gestion des classes

- Ajouter une classe
- Modifier une classe
- Supprimer une classe
- Définir la capacité maximale
- Gérer l'année scolaire

### 👨‍🏫 Gestion des enseignants

- Ajouter un enseignant
- Modifier un enseignant
- Supprimer un enseignant
- Gestion du matricule et de l'email

### 📚 Gestion des matières

- Ajouter une matière
- Modifier une matière
- Supprimer une matière
- Définir le coefficient

### 📝 Gestion des inscriptions

- Inscrire un élève dans une classe
- Modifier une inscription
- Supprimer une inscription
- Vérification de la capacité maximale
- Un seul élève par classe et par année scolaire

### 📖 Gestion des affectations

- Affecter un enseignant à une classe et une matière
- Modifier une affectation
- Supprimer une affectation
- Gestion des affectations par année scolaire

---

# 🛠️ Technologies utilisées

- PHP 8
- MySQL
- HTML5
- CSS3
- Bootstrap
- PDO

---

# 📂 Structure du projet

```
gestion_scolaire/
│
├── affectations/
├── classes/
├── eleves/
├── enseignants/
├── inscriptions/
├── matieres/
│
├── config/
│   └── db.php
│
├── includes/
│   ├── header.php
│   ├── navbar.php
│   ├── footer.php
│   └── functions.php
│
├── assets/
│
└── index.php
```

---

# 🗄️ Base de données

Nom de la base de données :

```
gestion_scolaire
```

Tables principales :

- eleves
- classes
- enseignants
- matieres
- inscriptions
- affectations

---

# Validation des données

L'application effectue plusieurs validations :

- Tous les champs obligatoires.
- Validation du format des emails.
- Validation de l'année scolaire (AAAA-AAAA).
- Vérification des doublons.
- Respect des clés étrangères.
- Contrôle de la capacité maximale des classes.
- Vérification qu'un élève ne peut être inscrit qu'une seule fois par année scolaire.

---

# Installation

1. Cloner le projet

```
git clone <repository>
```

2. Copier le projet dans le dossier **htdocs** de XAMPP.

3. Créer la base de données :

```
gestion_scolaire
```

4. Importer le fichier SQL.

5. Configurer la connexion dans :

```
config/db.php
```

6. Démarrer :

- Apache
- MySQL

7. Ouvrir :

```
http://localhost/gestion_scolaire
```

---

# 👨‍💻 Auteur

Projet réalisé dans le cadre de la formation Développement Digital.

Développé avec PHP, MySQL et Bootstrap.
