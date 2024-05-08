# Todo List API

This project is an API for managing a Todo List. It is built using Laravel and uses MySQL for data storage.

## Installation

1. Clone the repository:
    ```
    git clone https://github.com/your-github-username/todoListApi.git
    ```
2. Install Docker Containers:
    ```
    docker-compose up -d --build
    ```
3. enter the docker container   
    ```
    docker exec -it laravel_app sh
    ```
4. Install Composer dependencies:
    ```
    composer install
    ```
5. Run the database migrations:
    ```
    php artisan migrate
    ```

## API Endpoints

- `POST /api/tasks`: Create a new task.
- `GET /api/tasks`: Get a list of all tasks.
- `GET /api/tasks/{id}`: Get details of a specific task.
- `PUT /api/tasks/{id}`: Update details of a specific task.
- `DELETE /api/tasks/{id}`: Delete a specific task.

## Models

### Task

- `id`: Task identifier (primary key).
- `user_id`: Identifier of the user who created the task.
- `parent_id`: Identifier of the parent task (if it's a subtask).
- `title`: Task title.
- `description`: Task description.
- `status`: Task status ('todo' or 'done').
- `priority`: Task priority (values from 1 to 5).
- `completed_at`: Task completion time.
- `created_at`: Task creation time.
- `updated_at`: Time of the last task update.

### User

- `id`: User identifier (primary key).
- `name`: User name.
- `email`: User email.
- `password`: User password.

## Tests

To run the tests, execute the following command:

    php artisan test

## Database Factories

Database factories are used to generate large amounts of database records for testing or seeding purposes. This project uses two factories: `UserFactory` and `TaskFactory`.

### UserFactory

The `UserFactory` generates fake data for `User` model. It sets the `name`, `email`, `email_verified_at`, `password`, and `remember_token` fields. It also has a method `unverified` to set `email_verified_at` to null.

### TaskFactory

The `TaskFactory` generates fake data for `Task` model. It sets the `title`, `description`, `priority`, `status`, `user_id`, `parent_id`, and `completed_at` fields. The `user_id` is randomly selected from existing users and `parent_id` is randomly selected from existing tasks.

## Database Seeders

Database seeders are used to populate your database with records. This project uses two seeders: `UserSeeder` and `TaskSeeder`.

### UserSeeder

The `UserSeeder` uses the `UserFactory` to create 10 new users.

### TaskSeeder

The `TaskSeeder` uses the `TaskFactory` to create 10 new tasks.

To run the seeders, use the following command:

    php artisan db:seed