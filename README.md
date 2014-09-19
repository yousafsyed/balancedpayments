Blanaced Payments Php Library
================

Balanced Payments Php Library. This library is free to use for commercial and personal usage. Just download it and include into your project. Feel free to extend and commit on this library. I will approve the new changes if they are really good. 

### Todo
---
1. Composer
2. ~~More Examples .~~ ---- Done
3. ~~Bank Account Functionality.~~ --- Done
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
		"meta[user_id]" => "123" // for more meta data you can see the documentation in balanced api
	);
	$customer_data_array =Balancedpayments::create_user($userdata); // this will return an array

```

### Tokenize Card
Tokenize the card it will return the card_id that can be stored in database if required and this id can be used to add the card to customer and later on we can charge this card

 ```php

	 /**
	 * Tokenize Card
	 **/
	$card_params = array(
		"number"      => "4111111111111111",
		"expiration_month" => "08",
		"expiration_year"  => "2017",
		"security_code"    => "123"
	);
	$card_data_array = Balancedpayments::tokenize_card($card_params);

```


### Attach card to customer


 ```php
/**
 * Attach card to the customer
 * */
Balancedpayments::add_card($customer_id, $card_id); // this returns and array

```


### Charge Card


 ```php
/**
 * Charge The Card
 * */
 $amount = "100"; // 100 USD
Balancedpayments::charge_card($card_id, $amount); // this will return an array

```



### Creat bank Account


 ```php
/**
 * Creat bank Account
 * */
$bankDetails = array(
	"account_number"        => "9900000002",
	"account_type"          => "checking",
	"name"                  => "Syed Yousaf Ehsan Navqi Bank Test",
	"routing_number"        => "021000021",
	"address[city]"         => "Tenerife",
	"address[line1]"        => "Av Juan Carlos",
	"address[line2]"        => "",
	"address[state]"        => "Santa Cruz De Tenerife",
	"address[postal_code]"  => "38650",
	"address[country_code]" => "ES",
);
$bank_data_array = Balancedpayments::creatBankAccountDirect($bankDetails);
print_r($bank_data_array);

```



### Get bank account by id


 ```php

$bankAccountId   = "BA1oi3o5CoTt94I8sKHSTFo9";
$bankAcountArray = Balancedpayments::getBankAccountById($bankAccountId);
print_r($bankAcountArray);

```

### Get All bank Accounts 


 ```php

$limitOffset = array(
	'limit'  => "10",
	'offset' => '0',
);

$bankAcountArray = Balancedpayments::getAllBankAccounts($limitOffset);
print_r($bankAcountArray);

```


### Update the Bank Account


 ```php

$updateBankDetails = array(
	"links[customer]"                  => "CU4SUGO6YhgivR19Ze121ybr", // customer id
	"links[bank_account_verification]" => "BZ1NndEHupZUuYDNPf75qXPv", // verfication id
	// in meta data you can add any thing that you want as follows
	"meta[user_id]"  => "182381",
	"meta[facebook]" => "facebook.com/link",

);
$bank_account_id = "BA1oi3o5CoTt94I8sKHSTFo9";// bank account id that you want to edit
$bank_data_array = Balancedpayments::updateBankAccount($updateBankDetails, $bank_account_id);
print_r($bank_data_array);

```


### Add the Bank Account to customer


 ```php

$customer_data = array(
	"customer" => "/customers/CU4SUGO6YhgivR19Ze121ybr"// customer Link
);
$bank_account_id = "BA15jLxp4neimaQLn1QPB73D";// bank account id that you want to edit
$responseArray   = Balancedpayments::addBankToCustomer($bank_account_id, $customer_data);
print_r($responseArray);

```

### Delete bank Account


 ```php


$bank_account_id = "BA1oi3o5CoTt94I8sKHSTFo9";// bank account id that you want to edit
$responseArray   = Balancedpayments::deleteBankAccount($bank_account_id);
print_r($responseArray);

```




### Debit bank Account


 ```php


$debit_details = array(
	"amount"                  => "10000", // integer
	"appears_on_statement_as" => "My Company Name",
	"description"             => "Description Goes here",
	"meta[userid]"            => "1231234123",
);
$bank_account_id = "BA15jLxp4neimaQLn1QPB73D";// bank account id that you want to edit
$responseArray   = Balancedpayments::debitBankAccount($bank_account_id, $debit_details);
print_r($responseArray);

```

### Author
Name: Yousaf Syed
|| Emails: mmesunny@gmail.com, me@yousafsyed.com


