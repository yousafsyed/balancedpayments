<?php
require ("balancedpayments.php");

$config = array("apikey" => "ak-test-1iyjUQ7UcMu6N20Aub3GayZsSARhLygoR",

// set your api key
	"payment_description" => " Charging the card",

// set the payment description
	"statement_appear_as" => "Example Company"

// set the statement

);

Balancedpayments::config($config);

/**************Create the customer*********************/
// $userdata       = array("name" => "Sunny Ehsan", "email" => "me@yousafsyed.com", "adddres" => "NY street 1", "meta[user_id]" => "123");
// $customer_array = Balancedpayments::create_user($userdata);
// $customer_id    = $customer_array['customers'][0]['id'];
// print_r($customer_id);

/**************Tokenize the card*********************/
// $card_params = array(
// 	"number"           => "4111111111111111",
// 	"expiration_month" => "08",
// 	"expiration_year"  => "2017",
// 	"security_code"    => "123",
// );
// $card_info_array = Balancedpayments::tokenize_card($card_params);
// $card_id         = $card_info_array['cards'][0]['id'];
// print_r($card_info_array);

/**************Attach the card to the customer*********************/
// $addcard = Balancedpayments::add_card($customer_id, $card_id);

// //print_r($addcard);

/************** Charge the Card*********************/

// $amount = "2100";

// $response = Balancedpayments::charge_card($card_id, $amount);
// print_r($response);

/************** Creat bank Account *********************/
// $bankDetails = array(
// 	"account_number"        => "9900000002",
// 	"account_type"          => "checking",
// 	"name"                  => "Syed Yousaf Ehsan Navqi Bank Test",
// 	"routing_number"        => "021000021",
// 	"address[city]"         => "Tenerife",
// 	"address[line1]"        => "Av Juan Carlos",
// 	"address[line2]"        => "",
// 	"address[state]"        => "Santa Cruz De Tenerife",
// 	"address[postal_code]"  => "38650",
// 	"address[country_code]" => "ES",
// );
// $bank_data_array = Balancedpayments::creatBankAccountDirect($bankDetails);
// print_r($bank_data_array);

/************** Get bank account by id *********************/
// get bank account by id
// $bankAccountId   = "BA1oi3o5CoTt94I8sKHSTFo9";
// $bankAcountArray = Balancedpayments::getBankAccountById($bankAccountId);
// print_r($bankAcountArray);

/************** Get All bank Accounts *********************/
// $limitOffset = array(
// 	'limit'  => "10",
// 	'offset' => '0',
// );

// $bankAcountArray = Balancedpayments::getAllBankAccounts($limitOffset);
// print_r($bankAcountArray);

/************************ update bank Account ***************************/
// $updateBankDetails = array(
// 	"links[customer]"                  => "CU4SUGO6YhgivR19Ze121ybr", // customer id
// 	"links[bank_account_verification]" => "BZ1NndEHupZUuYDNPf75qXPv", // verfication id
// 	// in meta data you can add any thing that you want as follows
// 	"meta[user_id]"  => "182381",
// 	"meta[facebook]" => "facebook.com/link",

// );
// $bank_account_id = "BA1oi3o5CoTt94I8sKHSTFo9";// bank account id that you want to edit
// $bank_data_array = Balancedpayments::updateBankAccount($updateBankDetails, $bank_account_id);
// print_r($bank_data_array);

/************************ Add the bank account to customer ***************************/
// $customer_data = array(
// 	"customer" => "/customers/CU4SUGO6YhgivR19Ze121ybr"// customer Link
// );
// $bank_account_id = "BA15jLxp4neimaQLn1QPB73D";// bank account id that you want to edit
// $responseArray   = Balancedpayments::addBankToCustomer($bank_account_id, $customer_data);
// print_r($responseArray);

/************************ Delete bank Acount ***************************/

// $bank_account_id = "BA1oi3o5CoTt94I8sKHSTFo9";// bank account id that you want to edit
// $responseArray   = Balancedpayments::deleteBankAccount($bank_account_id);
// print_r($responseArray);

/************************ Debit bank Acount ***************************/

// $debit_details = array(
// 	"amount"                  => "10000", // integer
// 	"appears_on_statement_as" => "My Company Name",
// 	"description"             => "Description Goes here",
// 	"meta[userid]"            => "1231234123",
// );
// $bank_account_id = "BA15jLxp4neimaQLn1QPB73D";// bank account id that you want to edit
// $responseArray   = Balancedpayments::debitBankAccount($bank_account_id, $debit_details);
// print_r($responseArray);
