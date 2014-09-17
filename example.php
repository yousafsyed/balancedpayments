<?php
require ("balancedpayments.php");

$config = array("apikey" => "ak-test-1iyjUQ7UcMu6N20Aub323834502349203409352",

// set your api key
	"payment_description" => " Charging the card",

// set the payment description
	"statement_appear_as" => "Example Company"

// set the statement

);

Balancedpayments::config($config);

/**
 * Create customer example
 *
 */
$userdata       = array("name" => "Sunny Ehsan", "email" => "me@yousafsyed.com", "adddres" => "NY street 1", "meta[user_id]" => "123");
$customer_array = Balancedpayments::create_user($userdata);
$customer_id    = $customer_array['customers'][0]['id'];
print_r($customer_id);

/**
 * Tokenize Card
 *
 */
$card_params = array(
	"number"           => "4111111111111111",
	"expiration_month" => "08",
	"expiration_year"  => "2017",
	"security_code"    => "123",
);
$card_info_array = Balancedpayments::tokenize_card($card_params);
$card_id         = $card_info_array['cards'][0]['id'];
print_r($card_info_array);

/**
 * Attach card to the customer
 *
 */
$addcard = Balancedpayments::add_card($customer_id, $card_id);

//print_r($addcard);

/**
 * Charge The Card
 *
 */
$amount = "2100";

// 100 USD
$response = Balancedpayments::charge_card($card_id, $amount);
print_r($response);
