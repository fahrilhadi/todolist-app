# To-Do List App

A **minimal To-Do List web application** built with **Laravel 12** and **TailwindCSS**.

## Screenshots

**Index Page (Empty State — No Tasks Yet)**  

<img width="1280" height="712" alt="image" src="https://github.com/user-attachments/assets/61990902-3903-4ea1-b4cc-d7fa67c2c063" /><br>

**Index Page (With Tasks)**

<img width="1280" height="712" alt="image" src="https://github.com/user-attachments/assets/f10884f3-275d-492c-8eb6-a5e9d170ad71" /><br>

**Create Task**  

<img width="1280" height="712" alt="image" src="https://github.com/user-attachments/assets/4b0c3ffe-8fef-4222-8345-ce1e20d48b2b" /><br>  

**Edit Task**  

<img width="1280" height="712" alt="image" src="https://github.com/user-attachments/assets/b0f1fb2f-1ce8-45d1-8015-d5603b4999fd" /><br>  

**Delete Confirmation**  

<img width="1280" height="712" alt="image" src="https://github.com/user-attachments/assets/73ebd938-1f79-4bb5-b30a-678bfb25f69a" /><br>  

## Tech Stack

- **Backend:** Laravel 12  
- **Frontend:** Blade Templates + TailwindCSS  
- **Database:** MySQL 
- **Version Control:** GitHub  

## Quick Start

```bash
# Clone repository
git clone https://github.com/fahrilhadi/todolist-app.git
cd todolist-app

# Install dependencies
composer install
npm install
npm run dev

# Setup environment
cp .env.example .env
php artisan key:generate

# Run migrations
php artisan migrate

# Serve application
php artisan serve
