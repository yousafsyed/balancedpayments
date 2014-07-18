Blanaced Payments Php Library
================

Balanced Payments Php Library. This library is free to use for commercial and personal usage. Just download it and include into your project.

### Todo
---
1. Composer
2. More Examples
3. Bank Account Functionality
4. Documentation for the library

Usage
-----

### Config
Just download the zip from github and include the balancedpayments.php as follows

```php

require ("balancedpayments.php");

$config = array(
	"apikey"              => "ak-test-23923840140fisdfjsodfjd9fjks22sdww", // set your api key secret
	"payment_description" => " Charging the card", // set the payment description
	"statement_appear_as" => "Example Company"// set the statement

);

Balancedpayments::config($config); // pass the config array

```
### Create Customer
Asuming that you have set the configuration. To set the userdata you can check the documentation of balanced payments. I have configured the minimum requirements that are require to PCI compliance according to the balanced payments

```php

/**
 * Create customer example
 * */
$userdata = array(
	"name"          => "yousaf",
	"email"         => "mmesunny@gmail.com",
	"adddres"       => "NY street 1",
	"meta[user_id]" => "123"
);
Balancedpayments::create_user($userdata);

```

### Author
Name: Yousaf Syed

Email: mmesunny@gmail.com
