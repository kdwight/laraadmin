[Documentation](https://laravel.com/docs) | [Laracasts](https://laracasts.com) | [Image Intervention](http://image.intervention.io/) | [Laravel File Manager](https://unisharp.github.io/laravel-filemanager/) | [Laravel Excel](https://laravel-excel.maatwebsite.nl/)

## setup
> terminal commands
- `cp .env.example .env`
- `composer install`
- `php artisan key:generate`
- `php artisan storage:link`
- `npm install`
- `npm run dev`
- update `APP_URL` from `.env` file with the project's URL

after setting up `.env` file create a database then `php artisan migrate --seed` on terminal

## specs

- laravel/framework: 6.0
- php: ^7.2,
- vue: ^2.5.17,

## creating new role's access using middleware

- `php artisan make:middleware FilenameAccess`
- update `$routeMiddleware` from App\Http\Kernel.php
- then on your routes/web.php wrap the routes with a middleware group closure.