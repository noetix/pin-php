# About

[Pin][1] is Australia’s first all-in-one payment API.

* PHP 5.3+ Library
* Curl Transport (via [Buzz][2])

# Example

```php
<?php

// create our request handler
$service = new Pin\Handler(array('key' => ''));

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

[1]: https://pin.net.au/
[2]: https://github.com/kriswallsmith/Buzz