<?php

new Main();

class Main {
	public function __construct() {
		$hostname = 'localhost';
		$database = 'caravan_parking';
		$username = 'caravan_parking';
		$password = 'test';
		
		
		require_once 'Database.php';
		$db = new PDOWrapper\Database($hostname, $database, $username, $password);
		
		
		$post_data = array();
		$locations = array();
		
		
		$dbLocations = $db->query("SELECT * FROM locations");
		
		foreach ($dbLocations as $row) {
			$location = array();
			$location["lat"] = $row["latitude"];
			$location["long"] = $row["longitude"];
			$locations[] = $location;
		}
		
		
		$location = array();
		$location["lat"] = "48.135125";
		$location["long"] = "11.581980";
		$locations[] = $location;
		
		$location = array();
		$location["lat"] = "50.110922";
		$location["long"] = "8.682127";
		$locations[] = $location;
		
		$location = array();
		$location["lat"] = $_POST["nh_lat"];
		$location["long"] = $_POST["nh_long"];
		$locations[] = $location;
		
		$location = array();
		$location["lat"] = $_POST["sw_lat"];
		$location["long"] = $_POST["sw_long"];
		$locations[] = $location;
		
		
		$post_data["data"]["locations"] = $locations;
		
		echo json_encode($post_data);
	}
}




?>