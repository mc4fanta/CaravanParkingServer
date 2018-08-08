<?php

new Main();

class Main {
	public function __construct() {
		// TODO do it in an own class
		$hostname = 'localhost';
		$database = 'caravan_parking';
		$username = 'caravan_parking';
		$password = 'test';
		
		// create database connection
		require_once 'Database.php';
		$db = new PDOWrapper\Database($hostname, $database, $username, $password);
		
		$post_data = array();
		$post_data["data"] = array();
		
		switch($_POST["request_code"]) {
			case "get_locations":
				require_once 'location/getLocations.php';
				$location = new getLocations($db);
				$post_data["data"]["locations"] = $location->getItems();
				break;
		}
		
		echo json_encode($post_data);
	}
}




?>