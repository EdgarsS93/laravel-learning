# Laravel Learning

A Laravel 12 practice project running in Docker (PHP 8.2-FPM, Nginx, MySQL 8), with Tailwind CSS 4 compiled by Vite.

Built while following the Udemy course [Laravel From Scratch](https://www.udemy.com/course/laravel-from-scratch).

## Requirements

- [Docker](https://www.docker.com/) with Docker Compose
- [Node.js](https://nodejs.org/) 20.19+ or 22.12+ (needed by Vite 7) — runs on your machine, not in Docker
- `make` (preinstalled on macOS and most Linux systems)

## Getting started

```bash
git clone https://github.com/EdgarsS93/laravel-learning.git
cd laravel-learning

# 1. Environment file
cp src/.env.example src/.env

# 2. Start the containers (app, nginx, db)
make up

# 3. Install PHP dependencies, generate the app key, set up the database
docker compose exec app composer install
make artisan cmd=key:generate
make migrate

# 4. Install frontend dependencies (on your machine)
cd src
npm install
```

> The database settings come from `docker-compose.yml` (MySQL), so you don't need to change the `DB_*` values in `.env`.

## Frontend (Vite + Tailwind)

CSS and JS live in `src/resources/css` and `src/resources/js`. Vite compiles them, including Tailwind, and Blade loads them with `@vite(...)`.
**Without a running Vite server or a build, pages load with no styles.**

Run Vite from the `src` folder on your machine:

```bash
cd src

# While developing: a dev server with hot reload (keep it running)
npm run dev

# Or a one-off build into public/build (no server needed)
npm run build
```

## Open the app

With the containers running (plus `npm run dev` or a build), open **http://localhost:8000**.

## Useful commands

| Command | What it does |
| --- | --- |
| `make up` | Start the containers |
| `make down` | Stop the containers |
| `make shell` | Open a shell in the PHP container |
| `make artisan cmd="route:list"` | Run any artisan command |
| `make migrate` | Run migrations |
| `make migrate-fresh` | Rebuild the database and seed it |
| `make logs` | Follow the container logs |

MySQL is also reachable from your machine at `localhost:3306` (user `laravel`, password `secret`, database `laravel`). These are local development credentials only.
