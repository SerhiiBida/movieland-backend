# 🎬 Movie Service - Backend API & Admin Panel

## About the Project

Backend part of a movie streaming service, including an API for the frontend application and an admin panel.

This project is developed in collaboration with the frontend developer:  
[Frontend SPA](https://github.com/YevgenyBida/movieland-frontend) — @YevgenyBida

The backend is responsible for authentication, user management, movies, comments, ratings, free/paid movie access, and an admin panel with CRUD functionality.

## 🚀 Features

- User registration and authentication
- REST API for frontend
- Movie management
- User management
- Comments management
- Ratings management
- Admin panel
- CRUD operations for movies, users and other entities
- Session and cache storage with Redis
- Fast movie search with Elasticsearch
- MySQL database integration

## Tech Stack

- Symfony
- MySQL
- Redis
- Elasticsearch
- Twig
- Alpine.js
- Symfony UX Live Components
- Doctrine ORM

<p align="left">
  <img src="https://skillicons.dev/icons?i=symfony,mysql,redis,elasticsearch,php" />
</p>

---

## ⚙️ Installation

```shell
git clone https://github.com/username/backend-repository.git
cd backend-repository
composer install
```

## Environment Configuration
Create .env.local file:
```shell
DATABASE_URL="mysql://user:password@127.0.0.1:3306/movie_service"
REDIS_URL="redis://localhost:6379"
ELASTICSEARCH_URL="http://localhost:9200"
FRONTEND_URL="https://frontend.example.com"
```

## Database Setup

```shell
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

## Run Development Server
```shell
symfony server:start
```