<?php

require("vendor/autoload.php");

$config = array("apikey"=>"asdfasdasd" , "payment_description"=>"balanced","statement_appear_as"=>"help");
$balanced = new Balanced\Balancedpayments($config);

$userdata = array(
	"name"=>"yousaf",
	"email"=>"mmesunny@gmail.com",
	"meta[user_id]"=>"123"
	);
$balanced->create_user($userdata);