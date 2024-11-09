# Voting Application Backend

This is the backend for a simple voting application, built with Laravel. The app allows users to vote on different options within categories, with the ability to update or change their vote. Authentication is not required.

## Features

- View a list of categories.
- View a list of options within a selected category.
- Vote for a specific option in a category.
- Change or update a vote, which replaces the previous one.
- Refresh functionality to view the latest voting updates.

## Getting Started

### Prerequisites

- PHP >= 8.0
- Composer
- MySQL or SQLite database
- Laravel 8+

### Installation

1. **Clone the repository:**

   ```bash
   git clone <repository-url>
   cd voting-app-backend
   ```

2. **Install dependencies:**

   ```bash
   composer install
   ```

3. **Set up the environment:**

   Rename the `.env.example` file to `.env` and update the database configuration:

   ```plaintext
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=vote
   DB_USERNAME=root
   DB_PASSWORD=
   ```

4. **Generate an application key:**

   ```bash
   php artisan key:generate
   ```

5. **Run the database migrations:**

   ```bash
   php artisan migrate
   ```

6. **Seed the database** (optional, if you want to prepopulate with categories and options):

   ```bash
   php artisan db:seed
   ```

### Running the Application

To start the Laravel development server, run:

```bash
php artisan serve
```

The application should now be accessible at `http://localhost:8000`.

## API Endpoints

### Categories

- **Get all categories**

  ```
  GET /api/categories
  ```

- **Get options for a specific category**

  ```
  GET /api/categories/{category}/options
  ```

### Voting

- **Submit or Update a Vote**

  ```
  POST /api/votes
  ```

  **Request body:**
  ```json
  {
    "user_id":"string",
    "category_id":"1integer",
    "option_id":"1integer"
  }
  ```

  - `category_id`: The ID of the category for which the user is voting.
  - `option_id`: The ID of the selected option within the category.
  - `user_identifier`: A unique identifier for the user (e.g., user email or generated UUID).

- **Refresh to See Latest Votes**

  ```
  GET /api/votes/{vote}
  ```

  This will return the latest vote counts and status for each option within all categories.

## Database Schema

- **Categories**: Stores information about categories (e.g., ID, name).
- **Options**: Stores options for each category, including an ID, name, and category reference.
- **Votes**: Records votes, storing category, option, and user identifier. Each user can have only one vote per category, which is updated when a new vote is cast.

## Built With

- [Laravel](https://laravel.com/) - The PHP framework for building the API.
  

## License

This project is licensed under the MIT License.
```
