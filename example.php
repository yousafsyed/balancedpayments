<?php

require ("balancedpayments.php");

$config = array(
	"apikey"              => "", // set your api key
	"payment_description" => "", // set the payment description
	"statement_appear_as" => ""// set the statement

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