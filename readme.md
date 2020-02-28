[Documentation](https://laravel.com/docs) | [VueJS 2](https://vuejs.org/v2/guide/) | [Laracasts](https://laracasts.com) | [Image Intervention](http://image.intervention.io/) | [Laravel File Manager](https://github.com/alexusmai/laravel-file-manager) | [Laravel Excel](https://laravel-excel.maatwebsite.nl/)

# Specs

> composer
- laravel/framework: 6.2
- php: 7.2,
- intervention/image: 2.5
- maatwebsite/excel: 3.1
- alexusmai/laravel-file-manager: 2.4
- darryldecode/cart: 4.1
- pusher/pusher-php-server: 4.1

> npm
- axios: 0.19
- vue: 2.5.17
- vue-router: 3.1.5
- @tinymce/tinymce-vue: 2.6.10
- bootstrap-vue: 2.3.0
- laravel-echo: 1.6.1
- pusher-js: 5.0.3
- moment: 2.24.0

# Setup
## terminal commands
- `cp .env.example .env`
- `composer install`
- `php artisan key:generate`
- `php artisan storage:link`
- `npm install & npm run dev`
- update `APP_URL` from `.env` file

>after setting up `.env` file create a database then `php artisan migrate --seed` on terminal

# Creating new role's access using middleware

- `php artisan make:middleware FilenameAccess`
- update `$routeMiddleware` from App\Http\Kernel.php
- then on your controller file call the middleware on construct by `$this->middleware('filename_access') ;`

# Deployment

- `php artisan config:cache`
- `php artisan route:cache`
- `php artisan migrate:fresh`
- `composer install --optimize-autoloader --no-dev`
- `npm run prod`
- change APP_ENV=`local` from `.env` file into ``staging`` or ``production``
- change APP_DEBUG=`true` from `.env` file into ``false``
