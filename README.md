Blanaced Payments Php Library
================

Balanced Payments Php Library. This library is free to use for commercial and personal usage. Just download it and include into your project.

### Todo
---
1. Composer
2. More Examples
3. Bank Account Functionality
4. Documentation for the library

### Usage
Just download the zip from github and include the balancedpayments.php as follows

```php

require("balancedpayments.php");

$config = array(
	"apikey"=>"" ,  // set your api key
	"payment_description"=>"", // set the payment description
	"statement_appear_as"=>"" // set the statement

	);

$balanced = new Balancedpayments($config);

/**
 * Create customer example
 * */
$userdata = array(
	"name"=>"yousaf",
	"email"=>"mmesunny@gmail.com",
	"meta[user_id]"=>"123"
	);
$balanced->create_user($userdata);
```
### Author
Name: Yousaf Syed
Email: mmesunny@gmail.com
