# MY CINEMA - Gestion de Cinéma

Application web pour gérer les films, salles et séances de cinéma.

## Installation

1. Cloner le projet
2. Créer une base de données MySQL
3. Exécuter le script SQL : `script.sql`

## Configuration

1. Créer un fichier `config.ini` :

## Lancement

```bash
php -S 127.0.0.1:8000
```

Accéder à : <http://127.0.0.1:8000/?url=/movie>

## API Endpoints

### Films

- GET /movie - Lister les films
- GET /movie/:id - Détails d'un film
- POST /movie/add - Créer un film
- POST /movie/update/:id - Modifier un film
- GET /movie/delete/:id - Supprimer un film

### Salles

- GET /rooms - Lister les salles
- GET /room/:id - Détails d'une salle
- POST /room/add - Créer une salle
- POST /room/update/:id - Modifier une salle
- GET /room/delete/:id - Supprimer une salle

### Séances

- GET /screenings - Lister les séances
- GET /screening/:id - Détails d'une séance
- POST /screening/add - Créer une séance
- POST /screening/update/:id - Modifier une séance
- GET /screening/delete/:id - Supprimer une séance
