# BlogMakings

BlogMakings is a Laravel blog project.

## Prerequisites

- Composer
- Mysql
- Webserver (with php7.4)

## Installation

**1) Clone this repository**

**2) Run the following commands in the project root folder**

    cp .env.example .env #Add a mysql database to this file
    composer install
    php artisan key:generate
    php artisan migrate --seed

**3) Restart webserver**
    

## Usage

- Go to:        http://127.0.0.1:8000/
- Admin login:  admin@blogmakings.local		admin
- Author login:	author@blogmakings.local	author


## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://choosealicense.com/licenses/mit/)
