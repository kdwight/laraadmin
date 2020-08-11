#### [Laravel 7](https://laravel.com/docs) ➡ [VueJS 2](https://vuejs.org/v2/guide/) ➡ [Vuetify](https://vuetifyjs.com/en/)

# Specs

> composer
- laravel/framework: 7.0
- php: 7.2,

> npm
- axios: 0.19
- vue: 2.5.17
- vue-router: 3.3.4
- vuex: 3.5.1
- vuetify: 2.3.2

# Setup
## terminal commands
- `cp .env.example .env`
- `composer install`
- `php artisan key:generate`
- `php artisan storage:link`
- `npm install & npm run dev`
- update `APP_URL` from `.env` file

>after setting up `.env` file create a database then `php artisan migrate --seed` on terminal.
<br>
*(when seeding you should comment **`line:35 on Category.php`** and **`line:65 on User.php`**)*


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
- make .htaccess on root directory based on server config
- storage link storage/app/public to public/storage

### Files that needs extra URI when deploying to Beta
- bootstrap.js (:10, :27)
- AdminRoutes.js (prepend in all path URLs)
- Notification.vue (:53)
- OrdersIndex.vue (:92)
- OrderTable.vue (:72)
- Preloader.vue (:3)
- PreviewImageInput.vue (:29)
- UsersTable.vue (:91)
- webpack.mix.js
- .env (:5)
