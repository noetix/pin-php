[![Latest Stable Version](https://poser.pugx.org/noetix/pin-php/v/stable)](https://packagist.org/packages/noetix/pin-php)
[![Latest Unstable Version](https://poser.pugx.org/noetix/pin-php/v/unstable)](https://packagist.org/packages/noetix/pin-php)
[![Total Downloads](https://poser.pugx.org/noetix/pin-php/downloads)](https://packagist.org/packages/noetix/pin-php)
[![Build Status](https://scrutinizer-ci.com/g/noetix/pin-php/badges/build.png?b=master)](https://scrutinizer-ci.com/g/noetix/pin-php/build-status/master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/noetix/pin-php/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/noetix/pin-php/?branch=master)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/a1ab2385-88ec-4069-96e2-3042cc074deb/mini.png)](https://insight.sensiolabs.com/projects/a1ab2385-88ec-4069-96e2-3042cc074deb)
[![License](https://poser.pugx.org/noetix/pin-php/license)](https://packagist.org/packages/noetix/pin-php)

# About

[Pin][1] is Australia’s first all-in-one payment API.

* PHP 5.3+ Library
* Curl Transport (via [Buzz][2])

# Installation

Download the project from GitHub. Once downloaded, you'll need to use [Composer][5].

Make sure to include the class autoload file.

```php
include 'vendor/autoload.php';
```

# Examples

## Charges

This example will charge $4.00 (API requires amount to be provided in cents) against a test credit card on the *live* API. To use the testing/sandbox API, see the example below.

This is an example using the Pin Payments [Charges API][3]:

```php
<?php

// create our request handler
$service = new Pin\Handler(array('key' => 'secret_API_key'));

// build a new charge request
$request = new Pin\Charge\Create(array(
    'amount'      => 400,
    'description' => 'test charge',
    'email'       => 'roland@pin.net.au',
    'ip_address'  => '203.192.1.172',
    'card'        => array(
        'number'           => '5520000000000000',
        'expiry_month'     => '05',
        'expiry_year'      => '2013',
        'cvc'              => '123',
        'name'             => 'Roland Robot',
        'address_line1'    => '42 Sevenoaks St',
        'address_city'     => 'Lathlain',
        'address_postcode' => '6454',
        'address_state'    => 'WA',
        'address_country'  => 'AU'),
));

// send it
$response = $service->submit($request);
```

## Refunds

This is a simple example on how to process refunds.

This uses the Pin Payments [Refund API][4]:

```php
$request = new Pin\Charge\Refund('charge_token_here', array('amount'=>'900'));
```

## Live API vs the Test API

This example shows how to add an option so you use the test API (test-api.pin.net.au) instead of the live one.

```php
<?php

$service = new Pin\Handler(array('key' => 'secret_API_key', 'test' => true));

```


[1]: https://pin.net.au/
[2]: https://github.com/kriswallsmith/Buzz
[3]: https://pin.net.au/docs/api/charges
[4]: https://pin.net.au/docs/api/refunds
[5]: http://getcomposer.org/
