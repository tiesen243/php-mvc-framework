# PHP MVC Framework

A lightweight, modern PHP MVC framework with a clean architecture and developer-friendly tools.

## Features

- **MVC Architecture** - Clean separation of concerns with Model-View-Controller pattern
- **Flexible Routing** - Simple and intuitive URL routing system
- **Database Abstraction** - Easy database operations with built-in abstraction layer
- **Modern Styling** - Tailwind CSS integration for rapid UI development
- **Code Quality** - Prettier formatting for consistent code style
- **Docker Support** - Containerized development environment

## Quick Start

### 1. Clone and Install

```bash
git clone git@github.com:tiesen243/php-mvc-framework.git
cd php-mvc-framework
composer install
npm install
```

### 2. Environment Setup

```bash
cp .env.example .env
# Edit .env with your configuration
```

### 3. Database Setup

```bash
# Start database container
docker compose up -d

# Run migrations
php scripts/migrate.php
```

### 4. Start Development

```bash
composer dev
```

This command will:

- Start PHP development server on `localhost:8000`
- Watch for Tailwind CSS changes and rebuild automatically

### 5. Open Application

Visit [http://localhost:8000](http://localhost:8000) in your browser.
