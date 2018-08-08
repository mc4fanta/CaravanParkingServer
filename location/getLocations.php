<?php

require_once 'ILocations.php';
require_once 'ILocationDatabase.php';

class getLocations implements ILocations, ILocationDatabase {
	private $locations = array();
	
	public function __construct($db) {
		$db->bind("sw_lat", $_POST[ILocations::SOUTH_WEST_LAT]);
		$db->bind("nh_lat", $_POST[ILocations::NORTH_HEAST_LAT]);
		$db->bind("sw_long", $_POST[ILocations::SOUTH_WEST_LONG]);
		$db->bind("nh_long", $_POST[ILocations::NORTH_HEAST_LONG]);
		
		// get locations from database
		$dbLocations = $db->query("SELECT ".ILocationDatabase::DB_LATITUDE.", ".ILocationDatabase::DB_LONGITUDE
									." FROM ".ILocationDatabase::DB_TABLE_NAME
									." WHERE ".ILocationDatabase::DB_LATITUDE." >= :sw_lat"
										." AND ".ILocationDatabase::DB_LATITUDE." <= :nh_lat"
										." AND ".ILocationDatabase::DB_LONGITUDE." >= :sw_long"
										." AND ".ILocationDatabase::DB_LONGITUDE." <= :nh_long");
		
		// save result in $locations array
		foreach ($dbLocations as $row) {
			$location = array();
			$location[ILocations::LATITUDE] = $row[ILocationDatabase::DB_LATITUDE];
			$location[ILocations::LONGITUDE] = $row[ILocationDatabase::DB_LONGITUDE];
			$this->locations[] = $location;
		}
	}
	
	/**
	 * @return query result
	 */
	public function getItems() {
		return $this->locations;
	}
}


?>