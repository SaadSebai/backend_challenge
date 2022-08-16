# Backend Challenge

Backend Challenge is a Product management project made to implement some of Laravel features,
You can create and delete Products and there Categories through CLI and also it is possible
to manage Products in web using the VueJs for the front-end part.

## Installation

To start working with the project you should run the following commands:

```bash
composer install
npm install
```

Then migrate your database and seed it with:

```bash
php artisan migrate --seed
```

## Usage

### CLI

Categories can be managed with the following commands:

```bash
# create Category
php artisan category:create

# delete Category
php artisan category:delete id
```

The following commands are for managing Products:

```bash
# create Category
php artisan product:create

# delete Category
php artisan product:delete id
```

### API

List of Products:

```http
GET /api/products
```
| Parameter | Type | Description |
| :--- | :--- | :--- |
| `sortField` | `string` | **Nullable**. The field you want to sort with |
| `sortOrder` | `string` | **Nullable**. The sorting order |
| `filters[category_id]` | `integer` | **Nullable**. Filtering with a category |

Create Product:

```http
POST /api/products
```
| Parameter | Type | Description |
| :--- | :--- | :--- |
| `name` | `string` | **Required**. Name of Product |
| `description` | `string` | **Required**. Description of Product |
| `price` | `float` | **Required**. Price of Product |
| `image` | `string` | **Required**. Image of product |
| `category_id` | `integer` | **Nullable**. Category of product |

List of Categories:

```http
GET /api/categories

```

## Resources

- **[Laravel](https://laravel.com/)**
- **[VueJS](https://vuejs.org/)**
- **[Vue Router](https://router.vuejs.org/)**
