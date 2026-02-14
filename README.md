# Product Catalog API

A simple **Product Catalog API** built with **Laravel 12**, supporting both **REST** and **GraphQL** endpoints.

This API allows clients to fetch products and add new products to a MySQL/SQLite database.

---

## Features

* REST API

  * `GET /api/products` → List all products
  * `POST /api/products` → Add a new product (`name`, `price`)

* GraphQL API

  * `POST /graphql` → Fetch products via GraphQL
  * GraphQL Playground at `/graphql-playground`

* Database seeding for sample products

---

## Requirements

* PHP >= 8.1
* Composer
* MySQL or SQLite
* Node.js/NPM (optional, if you want to build frontend assets)

---

## Setup Instructions

### 1️⃣ Clone the Repository

```bash
git clone https://github.com/kantsverma/product-catalog-api.git
cd product-catalog-api
```

---

### 2️⃣ Install Dependencies

```bash
composer install
```

---

### 3️⃣ Configure Environment

Copy `.env.example` to `.env`:

```bash
cp .env.example .env
```

Update database credentials:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=product_catalog
DB_USERNAME=root
DB_PASSWORD=secret
```


---

### 4️⃣ Generate Application Key

```bash
php artisan key:generate
```

---

### 5️⃣ Run Migrations

```bash
php artisan migrate
```

---

### 6️⃣ Seed the Database

```bash
php artisan db:seed
```

This will insert sample products like Laptop, Smartphone, Tablet, etc.

---

### 7️⃣ Clear Caches (Optional but Recommended)

```bash
php artisan route:clear
php artisan config:clear
php artisan cache:clear
composer dump-autoload
```

---

### 8️⃣ Run the Application

```bash
php artisan serve
```

Application will run at:

```
http://127.0.0.1:8000
```

---

## REST API Usage

### Get all products

```http
GET http://127.0.0.1:8000/api/products
```

Response:

```json
[
  { "id": 1, "name": "Laptop", "price": 1200.0 },
  { "id": 2, "name": "Smartphone", "price": 699.99 }
]
```

### Add a new product

```http
POST http://127.0.0.1:8000/api/products
Content-Type: application/json

{
  "name": "Smartwatch",
  "price": 199.99
}
```

---

## GraphQL API Usage

### GraphQL Endpoint

```
POST http://127.0.0.1:8000/graphql
```

### Example Query

```json
{
  "query": "{ products { id name price } }"
}
```

Response:

```json
{
  "data": {
    "products": [
      { "id": 1, "name": "Laptop", "price": 1200.0 },
      { "id": 2, "name": "Smartphone", "price": 699.99 }
    ]
  }
}
```

---

### GraphQL Playground

Visit in browser:

```
http://127.0.0.1:8000/graphql-playground
```

Paste your query and run it interactively.

---

## Database Schema

### SQL for `products` table

```sql
CREATE TABLE products (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);
```

---

## Notes

* Laravel 12 no longer uses `RouteServiceProvider.php`. API routes are registered in `bootstrap/app.php`:

```php
return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: base_path('routes/web.php'),
        api: base_path('routes/api.php'),
        apiPrefix: 'api'
    )
    ->create();
```

* GraphQL requests **must include `"query"`** in POST body. Visiting `/graphql` directly will return an error.

---

## Optional: Versioned API

For larger projects, you can move `routes/api.php` to `routes/api/v1/products.php` and register it in `bootstrap/app.php` with `apiPrefix: 'api/v1'`.
