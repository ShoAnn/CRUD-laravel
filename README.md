
# Laravel CRUD App

This is a simple Laravel CRUD (Create, Read, Update, Delete) application that allows you to manage [replace_with_your_resource].

## Features

- Create
- Read
- Update
- Delete

## Getting Started

These instructions will help you set up and run the project on your local machine.

### Prerequisites

- PHP >= 8.2
- Composer
- Node.js & npm
- Laravel CLI

### Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/ShoAnn/Anwar-belajar-laravel.git
   ```

2. Navigate to the project directory:

   ```bash
   cd Anwar-belajar-laravel
   ```

3. Install PHP dependencies:

   ```bash
   composer install
   ```
   
4. Copy the `.env.example` file to `.env` and update the database configuration:

   ```bash
   cp .env.example .env
   ```

   Update the database configuration in the `.env` file:

   ```ini
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_database_username
   DB_PASSWORD=your_database_password
   ```

6. Generate an application key:

   ```bash
   php artisan key:generate
   ```

7. Run the database migrations and seed:

   ```bash
   php artisan migrate --seed
   ```

8. Start the development server:

   ```bash
   php artisan serve
   ```

   Your application will be accessible at [http://localhost:8000](http://localhost:8000).


## Contributing

If you'd like to contribute, please fork the repository and create a new branch. Pull requests are welcome!
```
