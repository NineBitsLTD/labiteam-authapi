# Install
### [Install composer](https://getcomposer.org/download/)
### [Install OpenServer](https://ospanel.io/download/)
### [Install chrome extension YARC for test API requests](https://chrome.google.com/webstore/detail/yet-another-rest-client/ehafadccdcdedbhcbddihehiodgcddpl?hl=en)
# Create project
### Laravel project from command line
```
	cd OSPanel/domains
	composer create-project laravel/laravel authapi
	cd authapi
```
### Configure OpenServer and start
```
	Settings/Domains add domain:
		name: authapi
		folder: authapi/public
	Settings/Modules select:
		HTTP: Apache-PHP-7.2
		PHP: PHP-7.2
		MySQL: MySQL-5.7
```
### Create database "authapi"
	http://127.0.0.1/openserver/phpmyadmin
### Change file authapi/.env
```
	DB_DATABASE=authapi
	DB_USERNAME=root
	DB_PASSWORD=
```
### Install additional components from command line
```
	composer require laravel/passport
```
# Deployng
### Deployng passport from command line
```
	php artisan migrate
	php artisan passport:install
```
### Remember console data
```
	Password grant client created successfully.
	Client ID: 2
	Client secret: SECRET_KEY
```
### Create routes - append to file authapi/routes/api.php
	\Laravel\Passport\Passport::routes();
### Check the routes from command line - must be view in rows "POST|api/oauth/token|passport.token"
```
	php artisan route:list
```
# Create user
### Uncomment row in file database/seeds/DatabaseSeeder.php
```php
	// $this->call(UsersTableSeeder::class);
```	
### Create file database/seeds/UsersTableSeeder.php with content
```php
<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        $items = array (
            0 => 
            array (
			  'name' => 'Test',
              'email' => 'test@mail.com',
              'password' => bcrypt('123123'),
            ),
        );
        foreach ($items as $key => $value) DB::table('users')->insert($value);
    }
}
```
### Fill table users in database from command line
```
	php artisan db:seed
```
### Test request throw Google chrome extension "YARC"
```
	URL: http://authapi/api/oauth/token
	Method: POST
	Payload: {
		"client_id": 2,
        "client_secret": "SECRET_KEY",
        "grant_type": "password",
        "password": "123123",
        "username": "test@mail.com"
	}
```
### Good luck!
