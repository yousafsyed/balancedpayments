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
Asuming that you have set the configuration. To set the userdata you can check the documentation of balanced payments. I have configured the minimum requirements that are require to PCI compliance according to the balanced payments. This method will return the customer id. you can save it to your database

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
	$customer_id =Balancedpayments::create_user($userdata);

```

### Tokenize Card
Tokenize the card it will return the card_id that can be stored in database if required and this id can be used to add the card to customer and later on we can charge this card

 ```php

	 /**
	 * Tokenize Card
	 **/
	$card_params = array(
		"card_number"      => "4111111111111111",
		"expiration_month" => "08",
		"expiration_year"  => "2017",
		"security_code"    => "123"
	);
	$card_id = Balancedpayments::tokenize_card($card_params);

```


### Attach card to customer


 ```php
/**
 * Attach card to the customer
 * */
Balancedpayments::add_card($customer_id, $card_id);

```


### Charge Card


 ```php
/**
 * Charge The Card
 * */
 $amount = "100"; // 100 USD
Balancedpayments::charge_card($card_id, $amount);

```



### Author
Name: Yousaf Syed

Email: mmesunny@gmail.com
