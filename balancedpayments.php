<?php
require ("helper/BalancedHTTP.php");

class Balancedpayments {
	private static $market_place;
	private static $apikey;
	private static $statement_appear_as;
	private static $payment_description;
	public static $cards = 'https://api.balancedpayments.com/cards';
	public static $users = 'https://api.balancedpayments.com/customers';

	public static function config($config) {
		self::$apikey              = $config['apikey'];
		self::$statement_appear_as = $config['statement_appear_as'];
		self::$payment_description = $config['payment_description'];
	}

	public static function create_user($userdata) {
		if (is_array($userdata)) {
			if (key_exists('name', $userdata)) {

				$response  = BalancedHTTP::post(self::$users, null, $userdata, self::$apikey, '');
				$user_data = json_decode($response->raw_body, true);
				if (key_exists('customers', $user_data)) {
					return $user_data['customers'][0]['id'];
				} else {
					echo $user_data['errors'][0]['description'];
					return false;
				}
			} else {
				return false;
			}
		} else {
			echo "ERROR: Parameter passed to Balancedpayments::create_user must be an array";
		}
	}

	public static function tokenize_card($cards_parameter) {
		if (key_exists('card_number', $cards_parameter) && key_exists('expiration_month', $cards_parameter) && key_exists('expiration_year', $cards_parameter) && key_exists('security_code', $cards_parameter)) {

			$response  = BalancedHTTP::post(self::$cards, null, $cards_parameter, self::$apikey, '');
			$card_data = json_decode($response->raw_body, true);

			if (key_exists('uri', $card_data)) {
				return $card_data['uri'];
			} else {
				return array('error' => $card_data['description']);
			}
		} else {
			return false;
		}
	}

	public static function add_card($customer_id, $card_id) {
		$user_parameter = array('customer' => '/customers/'.$customer_id);

		$response  = BalancedHTTP::put(self::$cards.'/'.$card_id, null, $user_parameter, self::$apikey, '');
		$user_data = json_decode($response->raw_body, true);

		if (!key_exists('errors', $user_data)) {
			return $user_data['cards'][0]['links']['customer'];
		} else {

			return array('error' => $user_data['errors'][0]['description']);
		}
	}

	public static function charge_card($card_id, $amount) {
		$biling_parameters = array('appears_on_statement_as' => self::$statement_appear_as, 'amount' => $amount*100, 'description' => self::$payment_description);
		$response          = BalancedHTTP::post(self::$cards.'/'.$card_id.'/debits', null, $biling_parameters, self::$apikey, '');
		$debited           = json_decode($response->raw_body, true);

		if (!key_exists('errors', $debited)) {
			return true;
		} else {

			return array('error' => $debited['errors'][0]['description']);
		}
	}

	public static function delete_user($customer_id) {
		$response = BalancedHTTP::post(self::$users.'/'.$customer_id, null, null, self::$apikey, '');
		$deleted  = json_decode($response->raw_body, true);
		if (key_exists('status', $deleted)) {
			if ($debited['status'] == 'succeeded') {
				return true;
			} else {
				return array('error' => $deleted['description']);
			}
		} else {
			return false;
		}
	}

	public static function delete_card($card_id) {
		$response = BalancedHTTP::delete(self::$cards.'/'.$card_id, null, null, self::$apikey, '');
		$deleted  = json_decode($response->raw_body, true);

		//print_r($deleted);

		return true;
	}

	public static function list_cards() {
		$response = BalancedHTTP::get(self::$cards, null, null, self::$apikey, '');
		$cards    = json_decode($response->raw_body, true);
		return $cards['cards'];
	}

	public static function get_card($card_id) {
		$response = BalancedHTTP::get(self::$cards.'/'.$card_id, null, null, self::$apikey, '');
		$cards    = json_decode($response->raw_body, true);
		return $cards['cards'][0];
	}
}
