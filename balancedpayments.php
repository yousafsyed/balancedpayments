<?php
require ("helper/BalancedHTTP.php");

class Balancedpayments {
	private static $market_place;
	private static $apikey;
	private static $statement_appear_as;
	private static $payment_description;
	public static $cards = 'https://api.balancedpayments.com/cards';
	public static $users = 'https://api.balancedpayments.com/customers';
	public static $banks = 'https://api.balancedpayments.com/bank_accounts';

	public static function config($config) {
		self::$apikey              = $config['apikey'];
		self::$statement_appear_as = $config['statement_appear_as'];
		self::$payment_description = $config['payment_description'];
	}

	public static function create_user($userdata) {

		$response  = BalancedHTTP::post(self::$users, null, $userdata, self::$apikey, '');
		$user_data = json_decode($response->raw_body, true);

		return $user_data;
	}

	public static function tokenize_card($cards_parameter) {

		$response  = BalancedHTTP::post(self::$cards, null, $cards_parameter, self::$apikey, '');
		$card_data = json_decode($response->raw_body, true);

		return $card_data;

	}

	public static function add_card($customer_id, $card_id) {
		$user_parameter = array('customer' => '/customers/' . $customer_id);

		$response  = BalancedHTTP::put(self::$cards . '/' . $card_id, null, $user_parameter, self::$apikey, '');
		$user_data = json_decode($response->raw_body, true);
		return $user_data;

	}

	public static function charge_card($card_id, $amount) {
		$biling_parameters = array('appears_on_statement_as' => self::$statement_appear_as, 'amount' => $amount * 100, 'description' => self::$payment_description);
		$response          = BalancedHTTP::post(self::$cards . '/' . $card_id . '/debits', null, $biling_parameters, self::$apikey, '');
		$debited           = json_decode($response->raw_body, true);

		return $debited;
	}

	public static function delete_user($customer_id) {
		$response = BalancedHTTP::post(self::$users . '/' . $customer_id, null, null, self::$apikey, '');
		$deleted  = json_decode($response->raw_body, true);
		return $deleted;
	}

	public static function delete_card($card_id) {
		$response = BalancedHTTP::delete(self::$cards . '/' . $card_id, null, null, self::$apikey, '');
		$deleted  = json_decode($response->raw_body, true);

		return $deleted;
	}

	public static function list_cards() {
		$response = BalancedHTTP::get(self::$cards, null, null, self::$apikey, '');
		$cards    = json_decode($response->raw_body, true);
		return $cards;
	}

	public static function get_card($card_id) {
		$response = BalancedHTTP::get(self::$cards . '/' . $card_id, null, null, self::$apikey, '');
		$cards    = json_decode($response->raw_body, true);
		return $cards;
	}

	public static function creatBankAccountDirect($bankDetails) {
		$response  = BalancedHTTP::post(self::$banks, null, $bankDetails, self::$apikey, '');
		$bank_data = json_decode($response->raw_body, true);

		return $bank_data;
	}
	public static function getBankAccountById($bankAccountId) {
		$response  = BalancedHTTP::get(self::$banks . '/' . $bankAccountId, null, null, self::$apikey, '');
		$bank_data = json_decode($response->raw_body, true);

		return $bank_data;
	}

	public static function getAllBankAccounts($limitOffset) {
		$response  = BalancedHTTP::get(self::$banks, null, $limitOffset, self::$apikey, '');
		$bank_data = json_decode($response->raw_body, true);

		return $bank_data;
	}

	public static function updateBankAccount($bankData, $bankAccountId) {
		$response  = BalancedHTTP::put(self::$banks . '/' . $bankAccountId, null, $bankData, self::$apikey, '');
		$bank_data = json_decode($response->raw_body, true);

		return $bank_data;
	}

	public static function addBankToCustomer($bankAccountId, $customer_link) {
		$response  = BalancedHTTP::put(self::$banks . '/' . $bankAccountId, null, $customer_link, self::$apikey, '');
		$bank_data = json_decode($response->raw_body, true);

		return $bank_data;
	}

	public static function deleteBankAccount($bankAccountId) {
		$response  = BalancedHTTP::delete(self::$banks . '/' . $bankAccountId, null, null, self::$apikey, '');
		$bank_data = json_decode($response->raw_body, true);
		return $bank_data;

	}
	public static function debitBankAccount($bankAccountId, $debitDetails) {
		$response  = BalancedHTTP::post(self::$banks . '/' . $bankAccountId . '/debits', null, $debitDetails, self::$apikey, '');
		$bank_data = json_decode($response->raw_body, true);
		return $bank_data;

	}

}
