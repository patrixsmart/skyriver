

## About Skyriver

A progressive backend implementation of Laravel authentication system for both api and web with bells and whistle.

## Installation

Require the `patrixsmart/skyriver` package in your `composer.json` and update your dependencies:
```sh
composer require patrixsmart/skyriver laravel/passport laravel/socialite
```

### Skyriver install command

You will need to run the command below to publish skyriver controllers and resources:
```sh
php artisan skyriver:install 
```

### Publish Config files

You will need to publish the config file for you to update it details:
```sh
php artisan vendor:publish --tag="skyriver-config"
```

### Skyriver routes

You will need to require skyriver web and api routes file path into yours respectively. 
in default Laravel scaffolded app web and api file:

#### Web routes
```sh
// Web routes
require __DIR__.'/skyriver/web.php';

// Web redirect to api routes 
require __DIR__.'/skyriver/webredirect.php';
```
#### Api routes
```sh
// Api routes
require __DIR__.'/skyriver/api.php';
```
#### Passport routes
```sh
// Passport routes
require __DIR__.'/skyriver/passport.php';
```
# Socialite routes
```sh
// Socialite routes
require __DIR__.'/skyriver/passport.php';
```

## Passport and Socialite Installations

Skyriver requires [Laravel PassPort](https://laravel.com/docs/8.x/passport) and 
[Laravel Socialite](https://laravel.com/docs/8.x/socialite) for api and social authentications respectively.
We have tried to make the installations and implementations of these packages easier; add this provider in your 
config/app.php providers list.
```sh
App\Providers\SkyriverServiceProvider::class,
```
and use this trait in your User model

```sh
 use HasApiTokens, HasSocialAccounts;
```
### Needed Environment Variables

You need to provide the following environment variables in your .env file.

```sh
# Skyriver Settings
SKYRIVER_PASSPORT_PASSWORD_GRANT_CLIENT_ID=
SKYRIVER_PASSPORT_PASSWORD_GRANT_CLIENT_SECRET=

SKYRIVER_PASSPORT_AUTHORIZATION_ENDPOINT="${APP_URL}/oauth/authorize?"
SKYRIVER_PASSPORT_TOKEN_ENDPOINT="${APP_URL}/oauth/token"
SKYRIVER_PASSPORT_COOKIE_NAME=laravel_token
###

# Passport Settings
PASSPORT_PERSONAL_ACCESS_CLIENT_ID=
PASSPORT_PERSONAL_ACCESS_CLIENT_SECRET=

PASSPORT_PRIVATE_KEY=
PASSPORT_PUBLIC_KEY=
###
```
### Passport Install Command 

You will need to run the passport install command below to publish resources and generate default keys:
```sh
php artisan passport:install --uuids
```
## Skyriver Sponsors

We would appreciate your sponsorship for the development of Skyriver. If you are interested in becoming a sponsor, please contact PatriXsmarT LLC. via [package@patrixsmart.com](mailto:package@patrixsmart.com).


## Contributing

Thank you for considering contributing to the PatriXsmarT Skyriver!.

## Security Vulnerabilities

If you discover a security vulnerability within Skyriver, please send an e-mail to PatriXsmarT LLC. via [package@patrixsmart.com](mailto:package@patrixsmart.com). All security vulnerabilities will be promptly addressed.

## License

PatriXsmarT Skyriver is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
