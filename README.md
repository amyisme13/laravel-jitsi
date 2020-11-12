# Laravel Jitsi

[![Latest Version on Packagist](https://img.shields.io/packagist/v/amyisme13/laravel-jitsi.svg?style=flat-square)](https://packagist.org/packages/amyisme13/laravel-jitsi)
[![Build Status](https://img.shields.io/travis/amyisme13/laravel-jitsi/master.svg?style=flat-square)](https://travis-ci.org/amyisme13/laravel-jitsi)
[![Total Downloads](https://img.shields.io/packagist/dt/amyisme13/laravel-jitsi.svg?style=flat-square)](https://packagist.org/packages/amyisme13/laravel-jitsi)

A package to generate view of a Jitsi Meet room using Jitsi Meet IFrame API.

## Jitsi Meet Prerequisites

Your Jitsi Meet host must use the token authentication. Currently this package also require your Jitsi Host to allow anonymous user to join by configuring the anonymousdomain (might change later).

If you are self-hosting your Jitsi Meet instance, here are some article that might help:

-   [JWT token authentication Prosody plugin](https://github.com/jitsi/lib-jitsi-meet/blob/master/doc/tokens.md)
-   [Rocket Chat part 3: Installing Jitsi with JWT for secure video conferencing](https://medium.com/@szewong/rocket-chat-part-3-installing-jitsi-with-jwt-for-secure-video-conferencing-b6f909e7f92c)
-   [Here’s how you should install jitsi-meet-tokens on debian 10 (luajwtjitsi problem)](https://community.jitsi.org/t/heres-how-you-should-install-jitsi-meet-tokens-on-debian-10/59606)
-   [Compile your own lua_cjson](https://community.jitsi.org/t/jwt-token-authentication-broken-on-debian-10-with-openssl-1-1/31027/5)
-   [Prosody token + anonymous authentication config](https://github.com/jitsi/jitsi-meet/pull/5025#issuecomment-580013383)

## Installation

You can install the package via composer:

```bash
composer require amyisme13/laravel-jitsi
```

Add these variables to your .env file

```bash
# Domain of the jitsi meet instance
JITSI_APP_DOMAIN=
# App id
JITSI_APP_ID=
# Secret key used to generate jwt
JITSI_APP_SECRET=
```

Add the trait `\Amyisme13\LaravelJitsi\Traits\HasJitsiAttributes` to your **User** model.

```php
use Amyisme13\LaravelJitsi\Traits\HasJitsiAttributes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    <...>
    use HasJitsiAttributes;
    <...>
}
```

## Simple Usage

In your `web.php` route file, call the `jitsi` route macro.

```php
Route::jitsi();
```

Then visit `/jitsi/<room name>` to join a conference call. Visiting this url when you are authenticated will set your display name, email, avatar and also grant you the moderator role.

## TODO: More Usage

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email amy.azmim@gmail.com instead of using the issue tracker.

## Credits

-   [Azmi Makarima](https://github.com/amyisme13)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
