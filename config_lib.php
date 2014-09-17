<?php
//posserver_config_save();
//posserver_status_update('192.99.46.141','script2','False');
//echo posserver_config_get("192.99.46.141");
//posserver_config_delete("192.99.46.141");
class Configuration_Manager {
	function global_config_get($purpose) {
		try {
			$connection = new MongoClient();
			$database   = $connection->Config_library;
			$collection = $database->global_config;
		}
		 catch (MongoConnectionException $e) {
			die("Failed to connect to database ".$e->getMessage());
		}
		$data   = array();
		$cursor = $collection->find(array('server_role' => $purpose));
		while ($cursor->hasNext()) {
			$single_object = $cursor->getNext();
			$data[]        = $single_object;
		}
		return json_encode($data);
	}

	function global_config_save($raw_request) {
		try {

			$connection = new Mongo();
			$database   = $connection->selectDB('Config_library');
			$collection = $database->selectCollection('global_config');
			$request    = json_decode($raw_request, true);

			if ($collection->insert($request)) {
				echo 'Success';
			}
		}
		 catch (MongoConnectionException $e) {
			die("Failed to connect to database ".$e->getMessage());
		}
		 catch (MongoException $e) {
			die('Failed to insert data '.$e->getMessage());
		}
	}

	function posserver_config_get($server_id) {
		try {
			$connection = new MongoClient();
			$database   = $connection->Config_library;
			$collection = $database->pos_config;
		}
		 catch (MongoConnectionException $e) {
			die("Failed to connect to database ".$e->getMessage());
		}
		$data   = array();
		$cursor = $collection->find(array('_id' => $server_id));
		while ($cursor->hasNext()) {
			$single_object = $cursor->getNext();
			$data[]        = $single_object;
		}
		return json_encode($data);
	}
	function posserver_status_update($ip, $script, $status) {
		try {
			$connection = new MongoClient();
			$database   = $connection->Config_library;
			$collection = $database->pos_config;
		}
		 catch (MongoConnectionException $e) {
			die("Failed to connect to database ".$e->getMessage());
		}
		$newdata = array('$set' => array($script.'.script_process' => $status));
		if ($collection->update(array('_id' => $ip), $newdata)) {
			echo "Updated";
		}
	}
	function posserver_config_delete($ip) {
		try {
			$connection = new MongoClient();
			$database   = $connection->Config_library;
			$collection = $database->pos_config;
		}
		 catch (MongoConnectionException $e) {
			die("Failed to connect to database ".$e->getMessage());
		}
		if ($collection->remove(array('_id' => $ip))) {
			echo 'Deleted';
		}
	}

	function posserver_config_save() {

		try {

			$raw_request = '{
            "_id":"192.99.46.141",
            "serever_desc": "abcd",
            "string": "Hello World",
            "server_name": "Nicks server",
            "cpanel_cred": {
              "username": "price5",
              "pass": "Tixonomy16"
            },
            "db_details": {
            },
            "script1": {
              "limit": "8000",
              "offset": "0",
              "script_process": "True",
              "user_ids": [
                1,
                2,
                3,
                4
              ]
            },"script2": {
              "limit": "8000",
              "offset": "8000",
              "script_process": "True",
              "user_ids": [
                1,
                2,
                3,
                4
              ]
            },"script3": {
              "limit": "8000",
              "offset": "16000",
              "script_process": "False",
              "user_ids": [
                1,
                2,
                3,
                4
              ]
            }
          }';
			$connection = new MongoClient();
			$database   = $connection->Config_library;
			$collection = $database->pos_config;
			$request    = json_decode($raw_request, true);

			if ($collection->insert($request)) {
				echo 'Success';
			}
		}
		 catch (MongoConnectionException $e) {
			die("Failed to connect to database ".$e->getMessage());
		}
		 catch (MongoException $e) {
			die('Failed to insert data '.$e->getMessage());
		}
	}
	function user_config_get($api_key) {
		try {
			$connection = new MongoClient();
			$database   = $connection->Config_library;
			$collection = $database->user_config;
		}
		 catch (MongoConnectionException $e) {
			die("Failed to connect t o database ".$e->getMessage());
		}
		$data   = array();
		$cursor = $collection->find(array('api_key' => $api_key));
		while ($cursor->hasNext()) {
			$single_object = $cursor->getNext();
			$data[]        = $single_object;

		}
		return json_encode($data);
	}
	function user_config_save($raw_request) {
		try {
			/**
			 * $raw_request = '{
			 *   "_id":"1234",
			 *   "api_key": "123qwew123weq",
			 *   "stubhub_details": {
			 *     "email": "nabeel@brokergenius.com",
			 *     "password": "nabeel",
			 *     "consumer_key": "tonyblair",
			 *     "consumer_secret": "dabaramla"
			 *   },
			 *   "sql_db_details": {
			 *     "server_name": "lota",
			 *     "database_user": "computer",
			 *     "database_password": "Tixonomy13",
			 *     "database_name": "pagli"
			 *   },
			 *   "listing_capacity": "20k"
			 * }';
			 */
			$connection = new Mongo();
			$database   = $connection->selectDB('Config_library');
			$collection = $database->selectCollection('user_config');
			$request    = json_decode($raw_request, true);

			if ($collection->insert($request)) {
				echo 'Success';
			}
		}
		 catch (MongoConnectionException $e) {
			die("Failed to connect to database ".$e->getMessage());
		}
		 catch (MongoException $e) {
			die('Failed to insert data '.$e->getMessage());
		}
	}
	function marketdata_config_get($server_id) {
		try {
			$connection = new MongoClient();
			$database   = $connection->Config_library;
			$collection = $database->user_config;
		}
		 catch (MongoConnectionException $e) {
			die("Failed to connect to database ".$e->getMessage());
		}
		$data   = array();
		$cursor = $collection->find(array('_id' => $server_id));
		while ($cursor->hasNext()) {
			$single_object = $cursor->getNext();
			$data[]        = $single_object;

		}
		return json_encode($data);
	}
	function marketdata_config_save($raw_request) {
		try {
			/**
			 * $raw_request = '{
			 *   "_id":"1234",
			 *   "server_id":"vironica",
			 *   "server_name": "lota",
			 *   "server_desc": "abcd",
			 *   "api_key": "123qwew123weq",
			 *   "db_details": {
			 *     "server_ip": "192.168.24.1",
			 *     "username": "nabeel",
			 *     "pass": "Tixonomy",
			 *     "db": "mongodb"
			 *   },
			 *   "script": {
			 *     "limit": "23",
			 *     "offset": "1",
			 *     "script_process": "True"},
			 *   "server_ips": ["122.213.23.2","112.331.31.2"],
			 *   "cpanel_cred": {
			 *     "username": "nabeel",
			 *     "pass": "Tixonomy"
			 *   }
			 * }';
			 */
			$connection = new Mongo();
			$database   = $connection->selectDB('Config_library');
			$collection = $database->selectCollection('market_config');
			$request    = json_decode($raw_request, true);

			if ($collection->insert($request)) {
				echo 'Success';
			}
		}
		 catch (MongoConnectionException $e) {
			die("Failed to connect to database ".$e->getMessage());
		}
		 catch (MongoException $e) {
			die('Failed to insert data '.$e->getMessage());
		}
	}
}

?>