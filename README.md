# Barbearia Alves System

This is the final project for the Software Engineering course, developed to manage a barbershop's operations, including user authentication, scheduling, payments, and reporting. The entire project was built using [Cursor](https://www.cursor.so/) to demonstrate the "vibe coding" workflow, where AI assists in all development steps.

## About the Project

Barbearia Alves System is a web application for managing:
- **Clients**: Registration, editing, and management
- **Barbers**: Registration, editing, and management
- **Procedures**: Scheduling, editing, and tracking of services
- **Payments**: Registering and tracking payments for procedures
- **Reports**: Generating reports for business insights
- **Authentication**: Role-based access for admin, barbers, and clients

## Features
- Role-based authentication (admin, barber, client)
- CRUD for clients, barbers, procedures, procedure types, and payments
- Search and filtering for listings
- Dashboard and reporting
- All code and structure generated and maintained using Cursor AI

## Project Structure

```
sistema-barbearia-alves/
├── app/                # Application logic (Controllers, Models, Middleware, Providers)
├── bootstrap/          # Laravel bootstrap files
├── config/             # Configuration files
├── database/           # Migrations, seeders, factories
├── public/             # Public assets and entry point
├── resources/          # Views, language files, assets
├── routes/             # Route definitions
├── storage/            # Logs, cache, file uploads
├── tests/              # Unit and feature tests
├── vendor/             # Composer dependencies
├── .env                # Environment variables
├── artisan             # Laravel CLI
├── composer.json       # Composer dependencies
├── package.json        # Node dependencies
├── README.md           # Project documentation
```

## How to Run

1. **Clone the repository:**
   ```bash
   git clone <repo-url>
   cd sistema-barbearia-alves
   ```
2. **Install PHP dependencies:**
   ```bash
   composer install
   ```
3. **Install Node dependencies:**
   ```bash
   npm install
   ```
4. **Copy and configure environment:**
   ```bash
   cp .env.example .env
   # Edit .env with your database and app settings
   ```
5. **Generate application key:**
   ```bash
   php artisan key:generate
   ```
6. **Run migrations and seeders:**
   ```bash
   php artisan migrate --seed
   ```
7. **Start the development server:**
   ```bash
   php artisan serve
   ```
8. **(Optional) Compile assets:**
   ```bash
   npm run dev
   ```

## Technologies Used
- Laravel (PHP)
- Blade (templating)
- MySQL/PostgreSQL (database)
- Node.js (for asset compilation)
- Cursor (AI-powered coding)

## About Cursor & Vibe Coding
This project was entirely developed using [Cursor](https://www.cursor.so/), an AI-powered code editor. All code, structure, and documentation were generated with the help of AI, demonstrating the "vibe coding" approach—where the developer and AI collaborate in real time for rapid, high-quality software delivery.

## License
MIT
