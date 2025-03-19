# Notebook

## Laravel initial configuration

Before running the application for the first time, some configuration are needed in order to execute it without errors. In the root directory there is a `.env.example` file that it is a example of how to write a `.env` file to store all the environment variables.

When I tried to run Laravel for the first time, I had the following error shown on browser:

```txt
Internal Server Error

Illuminate\Encryption\MissingAppKeyException

No application encryption key has been specified.
```

```sh
[logs] ┌ 00:58:47 Illuminate\Encryption\MissingAppKeyException  vendor/laravel/.../Enc... ┐
[logs] │ No application encryption key has been specified.                            │
[logs] └───────────────────────────────────────────────────── GET: / • Auth ID: guest ┘
```

This error happened because in the configuration expect a `APP_KEY` environment variable that might not exist if `.env` file was not configurated previously. To generate this secret key, Laravel recomends to run the following command:

```sh
php artisan key:generate
```

This command will locate the `.env` file and will add or modify `APP_KEY` with a new value.

Next, since I am not using _Sqlite_ as a database I have to run the migrations command to generate the base tables required to run the application. First, to configure the database access I set the following variables:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=7030
DB_DATABASE=matrix
DB_USERNAME=root
DB_PASSWORD=root
```

Then execute the following command to populate the database with the initial migrations:

```sh
php artisan migrate
```

After doing these to tasks it should be fine to execute the application by running the command:

```sh
php artisan serve
```

### References

* [Encryption - Laravel 12.x - The PHP Framework For Web Artisans](https://laravel.com/docs/12.x/encryption), accessed on March 19, 2025;
* [Installation - Laravel 12.x - The PHP Framework For Web Artisans](https://laravel.com/docs/12.x/installation#databases-and-migrations), accessed on March 19, 2025;
