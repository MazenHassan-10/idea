# Idea Management Web Application

A web application built with Laravel and PHP for creating and managing ideas, following the MVC architecture. Built while following the *Laravel From Scratch 2026* course by Jeffrey Way, then [extended with: add your own features here].

## Features

- User authentication (register, login, logout)
- Authorization using policies, so users can only manage their own ideas
- Full CRUD for ideas and related data
- Form validation using Form Request classes
- Eloquent relationships between models
- Database migrations and factories for seeding test data
- Automated tests written with Pest
- Responsive UI styled with Tailwind CSS and DaisyUI
- [Add any extra feature you built, e.g. categories, voting, comments]

## Tech Stack

| Layer | Technology |
|-------|-----------|
| Backend | PHP, Laravel |
| Database | [MySQL / SQLite] |
| ORM | Eloquent |
| Frontend | Blade, Tailwind CSS, DaisyUI |
| Testing | Pest |
| Version Control | Git & GitHub |

## Getting Started

### Prerequisites

- PHP 8.2+
- Composer
- Node.js & npm
- [MySQL, if used]

### Installation

# Clone the repository
git clone https://github.com/[your-username]/[repo-name].git
cd [repo-name]

# Install dependencies
composer install
npm install

# Set up environment
cp .env.example .env
php artisan key:generate

# Run migrations (with seed data)
php artisan migrate --seed

# Build assets
npm run dev

# Start the server
php artisan serve
The app will be available at http://localhost:8000.

## Running Tests

php artisan test
# or
./vendor/bin/pest
## Project Structure

app/
├── Http/
│   ├── Controllers/    # Request handling
│   ├── Middleware/     # Custom middleware
│   └── Requests/       # Form Request validation
├── Models/             # Eloquent models & relationships
└── Policies/           # Authorization rules
database/
├── factories/          # Model factories
└── migrations/         # Database schema
resources/views/        # Blade templates
tests/                  # Pest tests


## What I Learned

- Structuring a Laravel app with MVC
- Authentication, policies, and middleware
- Designing database relationships with Eloquent
- Writing automated tests with Pest

## Acknowledgements

Based on the [Laravel From Scratch](https://laracasts.com) course by Jeffrey Way.

## License

This project is open-source and available under the [MIT License](LICENSE).
