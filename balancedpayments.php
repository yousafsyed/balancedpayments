<?php
require ("helper/unirest.php");

class Balancedpayments
{
    private $market_place;
    private $apikey;
    private $statement_appear_as;
    private $payment_description;
    public static $cards = 'https://api.balancedpayments.com/cards';
    public static $users = 'https://api.balancedpayments.com/customers';
    
    
    function __construct($config) {
        $this->apikey = $config['apikey'];
        $this->statement_appear_as = $config['statement_appear_as'];
        $this->payment_description = $config['payment_description'];
    }
    
    public function create_user($userdata) {
        if (key_exists('name', $userdata) && key_exists('email', $userdata) && key_exists('meta[user_id]', $userdata)) {
            
            $response = Unirest::post(self::$users, null, $userdata, $this->apikey, '');
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
    }
    
    public function tokenize_card($cards_parameter) {
        if (key_exists('card_number', $cards_parameter) && key_exists('expiration_month', $cards_parameter) && key_exists('expiration_year', $cards_parameter) && key_exists('security_code', $cards_parameter)) {
            
            $response = Unirest::post(self::$cards, null, $cards_parameter, $this->apikey, '');
            $card_data = json_decode($response->raw_body, true);
            
            //print_r($card_data);
            if (key_exists('uri', $card_data)) {
                return $card_data['uri'];
            } else {
                return array('error' => $card_data['description']);
            }
        } else {
            return false;
        }
    }
    
    public function add_card($customer_id, $card_id) {
        $user_parameter = array('customer' => '/customers/' . $customer_id);
        
        $response = Unirest::put(self::$cards . '/' . $card_id, null, $user_parameter, $this->apikey, '');
        $user_data = json_decode($response->raw_body, true);
        
        if (!key_exists('errors', $user_data)) {
            return $user_data['cards'][0]['links']['customer'];
        } else {
            
        
            return array('error' => $user_data['errors'][0]['description']);
        }
    }
    
    public function charge_card($card_id, $amount) {
        $biling_parameters = array('appears_on_statement_as' => $this->statement_appear_as, 'amount' => $amount * 100, 'description' => $this->payment_description);
        $response = Unirest::post(self::$cards . '/' . $card_id . '/debits', null, $biling_parameters, $this->apikey, '');
        $debited = json_decode($response->raw_body, true);

        if (!key_exists('errors', $debited)) {
            return true;
        } else {
            
            return array('error' => $debited['errors'][0]['description']);
        }
    }
    
    public function delete_user($customer_id) {
        $response = Unirest::post(self::$users . '/' . $customer_id, null, null, $this->apikey, '');
        $deleted = json_decode($response->raw_body, true);
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
    
    public function delete_card($card_id) {
        $response = Unirest::delete(self::$cards . '/' . $card_id, null, null, $this->apikey, '');
        $deleted = json_decode($response->raw_body, true);
        
        //print_r($deleted);
        
        return true;
    }
    
    public function list_cards() {
        $response = Unirest::get(self::$cards, null, null, $this->apikey, '');
        $cards = json_decode($response->raw_body, true);
        return $cards['cards'];
    }
    
    public function get_card($card_id) {
        $response = Unirest::get(self::$cards . '/' . $card_id, null, null, $this->apikey, '');
        $cards = json_decode($response->raw_body, true);
        return $cards['cards'][0];
    }
}
