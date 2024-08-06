# PHP API EXAMPLE

## Introduction

This project is an example PHP application with Dependency Injection (DI), Repository Pattern, and Basic Authentication. The application handles User entity. It supports JSON files data source, and it uses collections for returning entities in responses.

## Features

- Basic Authentication using HTTP Basic Auth headers.
- Dependency Injection for service management.
- Repository Pattern for data access.
- JSON files support as data sources.
- Collections for handling multiple instances of entities.
- Middleware for authentication.
- PSR-4 Autoloading with Composer.
- Singletone pattern implementation for classes: Router and Container.
- Support of overriding of default configuration values with .env file.


## Installation

### Prerequisites

- PHP 8.3.9 or higher
- Git
- Docker (optional)

### Steps

1. **Clone the repository.**
```bash
git clone git@github.com:skliar-vi/test-assignment.git
```
2.  **Start server via PHP built-in server**
```bash
php -S localhost:8080
```
Alternatively, you can use Docker to run the application. Run the following command to build and start the Docker container:

```bash
docker-compose up -d
```

## API

The API has the following endpoints:

**GET /api/ping** - returns a simple response to check if the API is running.

**GET /api/users** - returns a list of users. (Requires authentication)

**GET /api/users/{id}** - returns a user by ID. (Requires authentication)

## Authentication

The API uses Basic Authentication. You need to provide the username and password in the Authorization header. As username can be used emails of users from ``data/users.json`` file.
Password is 123456.

## Postman Collection

For testing the API, you can use the Postman collection located in the `doc` directory.

## Additional Configuration
**ConfigProvider**: The `ConfigProvider` class will load configuration values from the `.env` file. Ensure the `.env` file exists and contains the correct configuration values.
Here's an example `.env` file configuration:
```dotenv
DEBUG=0
USER_DATA_SOURCE_PATH=data/users.json
ROUTES_PATH=src/Http/Routes/api.php
```

## Notes

One of the points of the assignment was to make the application 
independent, allowing the user to run it with a single command. 
I know this is not ideal, but for this approach, I have included
the vendor directory with Composer autoload files in the Git 
repository.

Additionally, I've added a Dockerfile and docker-compose.yml 
files to the project. This way, the application can also be started with 
just one command.