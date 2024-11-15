# Laravel Limit Columns

This package is designed to work with Laravel's Eloquent ORM by using the fillable fields of a model to limit the selected fields, rather than using ```SELECT *```.

## Installation

You can install the package using composer.

```shell
composer require ayup-creative/laravel-limit-columns
```

There is no service provider to register or be discovered.

## Usage

To make use of the package, include the ```Ayup\LaravelLimitColumns\LimitColumns``` trait in your model class.

```php

use Ayup\LaravelLimitColumns\src\LimitColumns;

class MyModel extends Model
{
    use LimitColumns;
    
    // ...
```

Database ```select```s will be limited to fillable fields (including primary key), unless an explicit ```select``` call
is made with columns passed.
