# Laravel Project by Mahmud Ibrahim

## Setup Instructions

1. **Clone this repo**
    ```bash
    git clone https://github.com/rafi021/instructory-laravel-12-intro.git
    cd instructory-laravel-12-intro
    ```

2. **Install PHP dependencies**
    ```bash
    composer install
    ```

3. **Copy environment file**
    ```bash
    cp .env.example .env
    ```

4. **Generate application key**
    ```bash
    php artisan key:generate
    ```

5. **Install Node.js dependencies**
    ```bash
    npm install
    ```

6. **Build frontend assets**
    ```bash
    npm run dev
    ```

7. **Run database migrations**
    ```bash
    php artisan migrate
    ```

8. **Seed the database**
    ```bash
    php artisan db:seed
    ```

9. **Start the development server**
    ```bash
    php artisan serve
    ```

10. **(Optional) Run Composer scripts**
    ```bash
    composer
    ```
