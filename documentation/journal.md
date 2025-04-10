# Journal

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

Create a migration file

```sh
php artisan make:migration <migration_name>
```

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

## Debugging Laravel application

I found that debugging in PHP is not that easy like it is in javascript. And to be fair I am having a hard time figuring out what is the best way to do a 'console.log' like in this language.

Following a tutorial, on the internet I decided to use `dd()` function to debug my api. It returns a full html styled document showing the structure of the object passed to the function.

### References

* [Echoing: dd() vs var_dump() vs print_r()](https://laraveldaily.com/post/echoing-dd-vs-var_dump-vs-print_r), accessed on March 25, 2025;

## Reading user input from Request object

There are two valid ways of reading input from request's body: by using `request->input(property)` or `request->property`.

```php
public function insert(Request $request)
{
    $newUser = new User([
        "name" => $request->input("name"),
        "email" => $request->input("email"),
        "password" => $request->input("password")
    ]);

    ...
}
```

```php
public function insert(Request $request)
{
    $newUser = new User([
        "name" => $request->name,
        "email" => $request->email,
        "password" => $request->password
    ]);

    ...
}
```

Since the former way is the one documented on Laravel docs I have decided to go with that. A personal opinion, but I thing the later way of retrieving from body is somewhat confusing. The request object is supposed to have other properties other than the body values. That is why the `$request->input()` makes more sense to me.

### References

* [LARAVEL 11 Crash Course for Beginners 2024 | #6 Controllers &amp; Forms (Web Developer Path) - YouTube](https://www.youtube.com/watch?v=mO1HNpHmMbM&list=PL38wFHH4qYZXH8Gb7PIbmyjdsWdEJLImp&index=6), accessed on March 25, 2025;
* [HTTP Requests - Laravel 12.x - The PHP Framework For Web Artisans](https://laravel.com/docs/12.x/requests#retrieving-input), accessed on March 25, 2025;

## Livewire component usage example

_Livewire_ is a _Laravel_ framework for building interactive UI components without extensive use of Javascript. It works like Blazor for the .NET or like the server-side rendering of Next.js.

_Livewire_ has a official component library called _Flux_ that uses Tailwind underneath for styling its components.

There were some configurations that had to be made before _Livewire_ and _Flux_ became ready to use. But I had some troubles with the style of _Flux_ components. Turns out that I did not had Tailwind being loaded in the layout file. And since I was loading the stylesheet with a Vite directive a `manifest.json` file was needed but did not existed when I ran the first time.

To solve this I had to build the Node project by running `npm run build`. After running this command, the required `manifest.json` file is generated, thus sending the required files to the page.

At the end, I've decided not to use _Flux_ because most of the components are only available if I subscribe to the PRO version.

### References

* [Quickstart | Laravel Livewire](https://livewire.laravel.com/docs/quickstart), accessed on March 27, 2025;
* [Installation · Flux](https://fluxui.dev/docs/installation), accessed on March 27, 2025;

## One class per file convention

The following error started to appear on console when after doing requests to the server:

```txt
[logs] ┌ 14:27:07 Illuminate\Contracts\Container\BindingResolutionException  vendor/... ┐
[logs] │ Target class [App\Services\UserServiceImpl] does not exist.                  │
[logs] └──────────────────────────────────────────── GET: /api/users • Auth ID: guest ┘
```

In this particular moment of the application I just had modified User and Repository controllers separating business logic in a service class. Decided to make those services injectable dependencies by using Laravel's container manager. So, I created a interface and a implementation class on the same file.

After doing that the errors started to appear stating that the concrete class did not existed, even though it did.

The problem is that, even if PHP allows two classes to be defined in the same file, _autoloader_ cannot find other classes because it expects that the file contains a class with file's name. Example: for a `UserService.php` file there is a `UserService` class inside it.

### References

* [Is PHP the only programming language that applies the one-class-per-file manifest? If yes, why? - Quora](https://www.quora.com/Is-PHP-the-only-programming-language-that-applies-the-one-class-per-file-manifest-If-yes-why#:~:text=PHP%20does%20not%20mandate%20one,class%20between%20files%20if%20needed.), accessed on March 29, 2025;
* [symfony - PHP - Symfony2.4 Can I have multiple classes in single file? - Stack Overflow](https://stackoverflow.com/questions/24200044/php-symfony2-4-can-i-have-multiple-classes-in-single-file), accessed on March 29, 2025;
* [PHP: Autoloading Classes - Manual](https://www.php.net/manual/en/language.oop5.autoload.php), accessed on March 29, 2025;
