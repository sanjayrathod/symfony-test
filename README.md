# ShopHub - Symfony E-commerce Platform

A modern e-commerce platform built with Symfony 6, featuring a responsive design and RESTful API.

## Features

- Product Management System
- Category-based Filtering
- RESTful API Endpoints
- Image Upload Functionality
- Responsive Bootstrap 5 Design
- Flash Messages for User Feedback
- Pagination
- Professional Form Validation
- Unit Tests

## Technical Stack

- PHP 8.1
- Symfony 6.x
- MySQL/MariaDB
- Bootstrap 5
- PHPUnit for Testing
- PHPStan for Static Analysis

## Installation

1. Clone the repository:
```bash
git clone https://github.com/sanjayrathod/symfony-test.git
```

2. Install dependencies:
```bash
composer install
```

3. Configure your database in `.env`:
```
DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name"
```

4. Create database and run migrations:
```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

5. Load fixtures (optional):
```bash
php bin/console doctrine:fixtures:load
```

6. Start the Symfony server:
```bash
symfony server:start
```

## API Endpoints

- `GET /api/products` - List all products (paginated)
- `GET /api/products/{id}` - Get single product details

## Testing

Run the test suite:
```bash
php bin/phpunit
```

Run static analysis:
```bash
php -d memory_limit=512M vendor/bin/phpstan analyse
```

## Design Decisions

- Used Bootstrap 5 for responsive design
- Implemented RESTful API for future mobile app integration
- Added image upload functionality for product management
- Included comprehensive form validation
- Implemented flash messages for better UX

## Future Enhancements

- User Authentication
- Shopping Cart Functionality
- Order Management
- Payment Integration
- Admin Dashboard
- Product Reviews and Ratings
- Advanced Search Functionality

## License

MIT License

## Author

Sanjay Rathod
