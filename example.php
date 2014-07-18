<?php

require ("balancedpayments.php");

$config = array(
	"apikey"              => "ak-test-1iyjUQ7UcMu6N20Aub3GayZsSARhLygoR", // set your api key
	"payment_description" => " Charging the card", // set the payment description
	"statement_appear_as" => "Example Company"// set the statement

);

Balancedpayments::config($config);

/**
 * Create customer example
 * */
$userdata = array(
	"name"          => "yousaf",
	"email"         => "mmesunny@gmail.com",
	"adddres"       => "NY street 1",
	"meta[user_id]" => "123"
);
$customer_id = Balancedpayments::create_user($userdata);

/**
 * Tokenize Card
 * */
$card_params = array(
	"card_number"      => "4111111111111111",
	"expiration_month" => "08",
	"expiration_year"  => "2017",
	"security_code"    => "123"
);
$card_id = Balancedpayments::tokenize_card($card_params);

/**
 * Attach card to the customer
 * */
Balancedpayments::add_card($customer_id, $card_id);
