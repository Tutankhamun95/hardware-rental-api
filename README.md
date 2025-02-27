# Hardware Rental API

A scalable and optimized API for a Hardware Rental Service built with Laravel. This project demonstrates a real-world solution that supports product rentals with regional pricing variations, filtering, pagination, and comprehensive testing.

## Table of Contents

- [Overview](#overview)
- [Features](#features)
- [Database Schema](#database-schema)
- [Installation](#installation)
- [Setup Instructions](#setup-instructions)
- [Running Migrations and Seeders](#running-migrations-and-seeders)
- [API Endpoints](#api-endpoints)
- [Testing](#testing)
- [Deployment](#deployment)
- [Additional Notes](#additional-notes)
- [License](#license)

## Overview

This project implements a Product Rental API that allows users to:
- Retrieve complete product details including attributes, rental periods, and regional pricing.
- Filter products based on region, rental period, category, and availability.
- Paginate large datasets for optimal performance.

The API is designed for scalability and optimized performance, reflecting real-world engineering challenges.

## Features

- **Efficient Database Schema:**  
  Supports products, attributes (with values), rental periods (3, 6, and 12 months), regions (e.g., Singapore and Malaysia), and product pricing.
  
- **Robust Eloquent Models & Relationships:**  
  Models include Product, Attribute, AttributeValue, RentalPeriod, Region, and ProductPricing with properly defined relationships (one-to-many, many-to-many).

- **Optimized API Endpoints:**  
  Implements endpoints in `routes/api.php` with eager loading, filtering, and pagination to efficiently handle huge datasets.

- **Advanced Filtering:**  
  Allows filtering of products by region, rental period, category, and availability.

- **Comprehensive Testing:**  
  Includes unit and feature tests to validate API behavior.

- **Detailed Documentation & Deployment Instructions:**  
  Comes with complete setup instructions and an advanced README file.

## Database Schema

The database is designed to be highly normalized and scalable. Key tables include:

- **products:**  
  Stores product details (name, description, SKU, category, etc.).
  
- **attributes & attribute_values:**  
  Allow each product to have multiple attributes with specific values (e.g., a laptop may have RAM, HDD Size, Screen Size, and CPU).

- **rental_periods:**  
  Define available rental durations (3, 6, and 12 months).

- **regions:**  
  Represent geographical regions (e.g., Singapore, Malaysia) with different pricing rules.

- **product_pricing:**  
  Associates products with rental periods and regions, defining rental prices.

- **inventory:**  
  Tracks product availability per region.

For complete column definitions, please refer to the migration files in the `database/migrations` directory.

## Installation

1. **Clone the Repository:**

   ```bash
   git clone https://github.com/Tutankhamun95/hardware-rental-api.git
   cd hardware-rental-api
   ```

2. **Install Dependencies:**

   ```bash
   composer install
   ```

3. **Environment Setup:**

   - Copy the `.env.example` file to `.env`:
     ```bash
     cp .env.example .env
     ```
   - Update the `.env` file with your database credentials and other necessary configurations.
   - Generate the application key:
     ```bash
     php artisan key:generate
     ```

## Setup Instructions

1. **Database Setup:**

   - Create a new database (e.g., `hardware_rental_api`) on your MySQL server.
   - Update your `.env` file with the database name, username, and password.

2. **Run Migrations:**

   ```bash
   php artisan migrate
   ```

3. **Seed the Database:**

   This project includes seeders that populate the database with 30 products and a wide variety of rental pricing scenarios (including different availability across regions and rental periods).

   ```bash
   php artisan db:seed
   ```

## API Endpoints

The API endpoints are defined in the `routes/api.php` file and are automatically prefixed with `/api`.

### List Products

- **Endpoint:** `GET /api/products`
- **Description:** Retrieves a paginated list of products with filtering options.
- **Query Parameters (Optional):**
  - `region`: Filter by region ID.
  - `rental_period`: Filter by rental period ID.
  - `category`: Filter by category ID.
  - `availability`: Filter by inventory status (`available` or `out_of_stock`).
  - `query`: Search term for product name, SKU, or description.

- **Example Request:**

  ```bash
  curl -X GET "http://localhost:8000/api/products?region=1&rental_period=1"
  ```

- **Sample Response:**

  ```json
  {
    "status": "success",
    "message": "Products retrieved successfully",
    "data": {
      "products": [
        {
          "id": 1,
          "name": "Product 1",
          "description": "Description for Product 1",
          "sku": "SKU-1",
          "attributes": [
            {
              "id": 1,
              "name": "RAM",
              "pivot_value": "16GB"
            },
            // More attributes...
          ],
          "pricing": [
            {
              "id": 1,
              "price": "108.00",
              "rental_period": {
                "id": 1,
                "duration": 3,
                "label": "3 months"
              },
              "region": {
                "id": 2,
                "name": "Malaysia"
              }
            }
            // More pricing...
          ],
          "inventory": [
            {
              "id": 1,
              "quantity": 48,
              "status": "out_of_stock"
            }
            // More inventory...
          ],
          "created_at": "2025-02-26T23:04:29.000000Z",
          "updated_at": "2025-02-26T23:04:29.000000Z"
        }
        // More products...
      ],
      "pagination": {
        "total": 30,
        "per_page": 10,
        "current_page": 1,
        "last_page": 3
      }
    }
  }
  ```

### Get Single Product

- **Endpoint:** `GET /api/products/{id}`
- **Description:** Retrieves detailed information about a specific product.

- **Example Request:**

  ```bash
  curl -X GET "http://localhost:8000/api/products/1"
  ```

- **Sample Response:**

  ```json
  {
    "status": "success",
    "message": "Product retrieved successfully",
    "data": {
      "id": 1,
      "name": "Product 1",
      "description": "Description for Product 1",
      "sku": "SKU-1",
      "attributes": [ /* attribute details */ ],
      "pricing": [ /* pricing details */ ],
      "inventory": [ /* inventory details */ ],
      "created_at": "2025-02-26T23:04:29.000000Z",
      "updated_at": "2025-02-26T23:04:29.000000Z"
    }
  }
  ```

## Testing

This project includes both unit and feature tests.

1. **Run the Test Suite:**

   ```bash
   php artisan test
   ```

2. **Test Coverage:**
   - **Feature Tests:** Validate API endpoints (ProductControllerTest).
   - **Unit Tests:** Test business logic in ProductService and transformation logic in ProductResource.

## Deployment

For production deployment, consider these steps:

- **Environment:**  
  Set environment variables in your production `.env` file.
  
- **HTTPS:**  
  Use HTTPS for secure communication.
  
- **Scaling:**  
  Consider using load balancers and read replicas if your API experiences high traffic.
  
- **Deployment Platforms:**  
  Platforms like [Laravel Forge](https://forge.laravel.com/), [Heroku](https://www.heroku.com/), or Docker containers can be used for deployment.
  
- **Monitoring & Logging:**  
  Integrate tools like Laravel Telescope, Sentry, or ELK stack for monitoring performance and logging errors.

## Additional Notes

- **Caching:**  
  Use Laravel’s caching mechanisms (e.g., Redis) to cache frequently accessed data.
  
- **Query Optimization:**  
  Utilize eager loading, selective column retrieval, and proper indexing on your database tables.
  
- **API Versioning:**  
  Consider versioning your API endpoints (e.g., `/api/v1/products`) to manage future changes without breaking existing clients.

- **Continuous Integration:**  
  Set up CI/CD pipelines for automated testing and deployment.