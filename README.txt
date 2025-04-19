Laravel TODO List App

Features
- Add tasks with:
  - Description
  - Custom date
  - `From` and `To` time
- Edit or delete tasks anytime during the session
- Check off completed tasks
- Tasks automatically sorted by the **closest upcoming time**
- Session-based: data resets when the browser is closed or inactive for too long (no login needed)

Tools & Technologies
- Laravel (PHP Framework)
- Blade Templates
- PHP Sessions
- HTML/CSS
- Composer - composer install

Setup Instructions
1. git clone https://github.com/kelvinkhuan1/JOBSTORE.git
2. cd laravel-todo-session
3. cp .env.example .env
4. php artisan key:generate
5. php artisan serve
6. Open Link default (http://127.0.0.1:8000)

Folder 
1. routes/web.php               // All routes (add, edit, delete, toggle)
2. app/Http/Controllers/TodoController.php  // Main controller logic
3. resources/views/todo.blade.php           // Main Blade view
