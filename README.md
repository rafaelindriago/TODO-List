# To-Do app 📘

## Requirements 🚀

 - PHP 8.2 or later.
 - PDO extension for SQLite.
 - Composer.
 - NPM.

## Installation 💻

Clone the repository.

    git clone https://github.com/rafaelindriago/todo-list.git todo-list-app

You can change `todo-list-app` for another folder name.

Navigate into the cloned repository.

    cd todo-list-app 

Install all dependencies with composer.

    composer install --no-dev --optimize-autoloader 

Create your own `.env` copying the example.

    cp .env.example .env

Generate a key for your app copy.

    php artisan key:generate

If you wish, you can run all the test, but you need to install the development dependencies with Composer.

    composer install 

And then.

    php artisan test

If everything is ok, you can now run the migrations to create the database tables.

    php artisan migrate

Build the assets.

    npm install

And then.

    npm run build
 
Now the app is ready to run.

    php artisan serve

## Language 🌎

The app support English and Spanish, you can setup the language in your `.env` file with the option `APP_LOCALE`

 - en
 - es

## Testing 🧪
For testing with PostMan, you can use the published Collection and Environment to make requests to the app.

[TODO List (getpostman.com)](https://documenter.getpostman.com/view/31373625/2sA3dsktat)

## Database schema 🔑

To get a database diagram.
[To-Do List - dbdocs.io](https://dbdocs.io/rafael.indriago93/To-Do-List)


> Written with [StackEdit](https://stackedit.io/).
