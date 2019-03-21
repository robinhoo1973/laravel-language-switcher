
[![GitHub release](https://img.shields.io/github/release/robinhoo1973/laravel-language-switcher.svg)]()
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/robinhoo1973/laravel-language-switcher/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/robinhoo1973/laravel-language-switcher/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/robinhoo1973/laravel-language-switcher/badges/build.png?b=master)](https://scrutinizer-ci.com/g/robinhoo1973/laravel-language-switcher/build-status/master)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/robinhoo1973/laravel-language-switcher/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)
[![License](https://img.shields.io/packagist/l/topview-digital/laravel-lang-switcher.svg)]()
[![Total Downloads](https://img.shields.io/packagist/dt/topview-digital/laravel-lang-switcher.svg)](https://packagist.org/packages/topview-digital/laravel-lang-switcher)
[![HitCount](http://hits.dwyl.io/robinhoo1973/https://github.com/robinhoo1973/laravel-language-switcher.svg)](http://hits.dwyl.io/robinhoo1973/https://github.com/robinhoo1973/laravel-language-switcher)
# Laravel Language Switcher


#### Middleware for Language Switcher and Helper for Locale Switch.

Implementations of middleware for language switch and helper for locale switch feature.
## Requirements

-   PHP >= 7.0
-   MySQL >= 5.7
-   [Laravel](https://laravel.com/) >= 5.5


## Installation

Require the package via Composer:

```
composer require topview-digital/laravel-language-switch
```
Laravel will automatically register the [ServiceProvider](https://github.com/robinhoo1973/laravel-language-switcher/blob/master/src/LangSwitcherServiceProvider.php).

### Publish Package
After installation, please publish the assets by below commands
```
php artisan lang-switch:publish
```

### Configure Package
Please config your settings in config/lang-switch.php file, it should looks like below

```
<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel-Language-Switcher Database Settings
    |--------------------------------------------------------------------------
    |
    | Here are database settings for Laravel-Language-Switcher builtin tables connction.
    |
    */

    'database' => [
        // Database connection for guards tables.
        'connection' => '',

    ],

    //the field name of the storage in  cookie
    'field' => 'locale',
];

```

Once you confired your settings, you may run  install command to setup the tables for the package.
```
php artisan lang-switch:install
```

### Configure Global Middleware
Global usage
To allow middleware automatically set your locale for all your routes, add the LangSwwitcher middleware in the $middleware property of app/Http/Kernel.php class:
```
    protected $middlewareGroups = [
        'web' => [
            // ...
            \TopviewDigital\LangSwitcher\Middleware\LangSwitcher::class,
        ],
        //...
```
### Register Your Guard Middleware

In the bootstrap or your service provider

```
//Auth::user() is the guard method to get login user model, which could access the user field for setting locale
\TopviewDigital\LangSwitcher\Model\LangSwitcher::registerGuard(['class'=>'Auth','method'=>'user','middleware'=>'web']);
```
or you may reference the below sample language switcher controller to register your guard

```
<?php

namespace App\Backend\Controllers\API;

use App\User;
use Encore\Admin\Facades\Admin;
use App\Http\Controllers\Controller;
use TopviewDigital\LangSwitcher\Model\LangSwitcher;

class LanguageSelector extends Controller
{

    public function index()
    {
        LangSwitcher::registerGuard(['class' => 'Admin', 'method' => 'user', 'middleware' => 'admin']);
        LangSwitcher::switchLocale();
        return back();
    }
}
```

Hope you enjoy it! Thanks!


## License

The MIT License (MIT). Please see [License File](https://github.com/robinhoo1973/laravel-language-switcher/blob/master/LICENSE.md) for more information.
