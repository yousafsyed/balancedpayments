<?php

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