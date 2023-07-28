# Ticket System

Welcome to the Ticket System! This repository contains a web application built using Laravel 9 on the backend and Vue 3 on the frontend. This README will guide you on how to clone the project from GitHub and set it up on your local development environment.

## Please note
This project uses prebuild helper functions to allow for quicker and easier programming. The files not native to this project are located in the resources/js/services/* and resources/js/helpers/* folders. These files are from a framework that Script has set up.

## Table of Contents

1. [Clone the Repository](#clone-the-repository)
2. [Setting up the Backend (Laravel)](#setting-up-the-backend-laravel)
3. [Setting up the Frontend (Vue)](#setting-up-the-frontend-vue)
4. [Starting the Servers](#starting-the-servers)
5. [License](#license)

## 1. Clone the Repository

To get started, first, you need to clone this GitHub repository to your local machine. You can do this using the following steps:

```bash
# Using HTTPS
git clone https://github.com/OurenOosterveen/SupportTicketSystem

# Using SSH (if you have set up SSH keys)
git clone git@github.com:OurenOosterveen/SupportTicketSystem.git
```

## 2. Setting up the Backend (Laravel)

Next, you need to set up the Laravel backend. Before proceeding, ensure you have PHP and Composer installed on your system. Here are the steps:

1. Install PHP dependencies:
In the ticket-system folder open a terminal and run the following commands
```bash
composer install
```

2. Create a .env file:
```bash
cp .env.example .env
```

3. Generate the application keys:
```bash
php artisan key:generate
php artisan jwt:secret
```

4. Configure your database in the .env file and run the migrations:
```bash
php artisan migrate
```

5. Seed the database with sample data:
```bash
php artisan db:seed
```

## 3. Setting up the Frontend (Vue3)
Now, let's set up the Vue frontend:

1. Install Node.js and npm (Node Package Manager) if you haven't already. You can download them from the official Node.js website: https://nodejs.org/

2. Install the project dependencies:
```bash
npm install
```

3. Build the project:
```bash
npm run build
```

## 4. Starting the servers
Great! You've successfully set up the project. Now, you need to run both the Laravel backend and the Vue frontend.

1. Start the Laravel server:
```bash
php artisan serve
```

2. Start the Vue server:
In a new terminal window, run the following command:
```bash
npm run dev
```
## 5. License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).



That's it! You should now have the Ticket System up and running on your local machine. Happy coding!