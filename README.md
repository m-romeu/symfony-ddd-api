
This project is an implementation of a Domain-Driven Design (DDD) architecture using Symfony. It provides a RESTful API that serves as a base for building complex systems while adhering to DDD principles.

## Features

* **DDD principles**: Clean separation of concerns, domain-centric design.
* **REST API**: Provides standard RESTful endpoints for CRUD operations.
* **Symfony Framework**: The backend is built using Symfony, following best practices and standards.
* **Persistence with Doctrine**: Uses Doctrine ORM for database interactions.
* **CQRS**: Implements Command Query Responsibility Segregation (CQRS).

## Installation

### Prerequisites

* PHP 8.0 or higher
* Composer
* Symfony 5.x or higher
* MySQL or PostgreSQL (as supported databases)

### Steps to Install

1. Clone the repository:

   ```bash
   git clone https://github.com/m-romeu/symfony-ddd-api.git
   cd symfony-ddd-api
   ```

2. Install the dependencies:

   ```bash
   composer install
   ```

3. Set up your environment variables by creating a `.env.local` file or modifying the existing `.env` file. For example, configure the database URL:

   ```bash
   DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name
   ```

4. Create the database and run the migrations:

   ```bash
   php bin/console doctrine:database:create
   php bin/console doctrine:migrations:migrate
   ```

5. Optionally, load sample data:

   ```bash
   php bin/console doctrine:fixtures:load
   ```

6. Start the Symfony server:

   ```bash
   symfony server:start
   ```

   The API will now be accessible at [http://localhost:8000](http://localhost:8000).

## API Endpoints

### Bikes

* **GET** `/api/bikes` - Get a list of all bikes.

* **POST** `/api/bikes` - Add a new bike.

  **Request**:

  ```json
  {
    "name": "Bike Name",
    "trademark": "Trademark Name",
    "model": "Model of the bike",
    "price": 1999.99
  }
  ```

  **Response**:

  ```json
  {
    "id": 1,
    "name": "Bike Name",
    "trademark": "Trademark Name",
    "model": "Model of the bike",
    "price": 1999.99
  }
  ```

* **GET** `/api/bikes/{id}` - Get a specific bike by ID.

* **PUT** `/api/bikes/{id}` - Update bike details.

* **DELETE** `/api/products/{id}` - Delete a bike by ID.

## Development

### Running Tests

To run the tests, use the following command:

```bash
php bin/phpunit
```

