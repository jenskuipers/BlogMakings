# BlogMakings

BlogMakings is a Laravel blog project.

## Prerequisites

- Composer
- Webserver with MySQL and PHP 7.4 (optional)

## Installation

**1) Clone this repository**

**2) Run the following commands in the project root folder (according to your needs)**

If you want to use a webserver:

    cp .env.example .env
    composer install
    php artisan key:generate
    php artisan migrate --seed
    
Restart webserver 

**OR*
    
If you want to use php artisan serve:

    # create a database and a database user with all permissions to this database
    cp .env.testing.example .env.testing
    composer install
    php artisan --env=testing key:generate
    php artisan --env=testing migrate --seed
    php artisan --env=testing serve
    

## Usage

- Admin login:  admin@blogmakings.local		admin
- Author login:	author@blogmakings.local	author

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://choosealicense.com/licenses/mit/)
