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
Balancedpayments::create_user($userdata);