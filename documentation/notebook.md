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

## Eloquent ORM and Data Modeling

Instead of creating manually the model class, it is possible to execute the command `make:model <model_name>` to create a file with a model boilerplate. The generated file is located on `app/Models` directory under the name `<model_name>.php`. The generated file looks like this:

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Repository extends Model
{
}
```

Inside the class, it is possible to define some special properties that will configure how this model is going to be represented in the database. By setting the `$table` variable, for example, it is possible to control how the table related to this model will be named. By default, _Eloquent_ will use a snake-case plural form of the model's name.

As a reference, I have created a model `Repository` and gave the inital configuration as follow:

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class Repository extends Model
{
    use HasUlids;

    /**
     * Customized names for created_at and updated_at default timestamps.
     *
     */
    const CREATED_AT = "createdAt";
    const UPDATED_AT = "updatedAt";

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "repositories";

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;


    /**
     * The data type of the primary key ID.
     *
     * @var string
     */
    protected $keyType = "string";

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = "id";
}
```

In this case, I decided to use ULID instead of incremental primary key, hence the declaration `use HasUlids`. To enforce the use of ULIDs I disabled auto-increment `$incrementing = false` and set the primary key to string as `$keyType = "string"`.

The `$primaryKey = "id"` used to define the name of the primary key is useless in this case, since it is already `id` by default.

At last, I redefined the names for timestamps `created_at` and `updated_at` to fit in my naming convention that is camelCase.

### References

* [Eloquent: Getting Started - Laravel 12.x - The PHP Framework For Web Artisans](https://laravel.com/docs/12.x/eloquent), accessed on march 19, 2025;

## Creating migrations

Running migrations

```sh
php artisan migrate
```

Rolling back migrations

```sh
php artisan migrate:reset
```

### References

* [Database: Migrations - Laravel 12.x - The PHP Framework For Web Artisans](https://laravel.com/docs/12.x/migrations), accessed on march 19, 2025;