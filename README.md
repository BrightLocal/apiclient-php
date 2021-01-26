BrightLocal API
===============

A basic PHP wrapper to make using the BrightLocal API a little easier. It takes care of authentication so you just need to specify which method you want to call and pass parameters.

Installation
------------

It's easiest to install and use the library via [Composer](https://getcomposer.org/).

Step 1: Add to the require section of your composer.json file.

```javascript
"require": {
    "brightlocal/apiclient-php": "0.*"
}
```

Step 2: Install

```
composer install
```

Examples
--------

```php
<?php
require 'vendor/autoload.php';

use BrightLocal\Api;
// setup API wrapper
$api = new Api('<YOUR_API_KEY>', '<YOUR_API_SECRET>');

// get a list of clients
print_r($api->get('/v2/clients/get-all'));

// get a client
print_r($api->get('/v2/clients/get', [
    'client-id' => 1059
]));

// get LSRC report list
print_r($api->get('/v2/lsrc/get-all'));

// get LSRC report
print_r($api->get('/v2/lsrc/get', [
    'campaign-id' => 50
]));

// get CT report list
print_r($api->get('/v2/ct/get-all'));

// get a CT report
print_r($api->get('/v2/ct/get', [
    'report-id' => 259
]));
```

Example Scripts
---------------

Example scripts can be found in /Examples. We'll be adding to these scripts over time.
