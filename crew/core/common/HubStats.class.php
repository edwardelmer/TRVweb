<?php
//class HubStats extends Codondata {
//
//
//
//	public function Pilots($hub) { //Pilot details
//
//		$query = "SELECT * FROM ".TABLE_PREFIX."pilots WHERE hub = '".$hub."'";
//
//		return DB::get_results($query);
//
//	}
//
//
//
//	public function CountPilots($hub) { //Number of pilots
//
//		$query = "SELECT * FROM ".TABLE_PREFIX."pilots WHERE hub = '".$hub."'";
//
//		$results = DB::get_results($query);
//
//		return DB::num_rows($results);
//
//	}
//
//
//
//	public function CountFlights($hub) { //Number of flights total
//
//		$query = "SELECT * FROM ".TABLE_PREFIX."pireps WHERE arricao = '".$hub."' OR depicao = '".$hub."'";
//
//		$results = DB::get_results($query);
//
//		return DB::num_rows($results);
//
//	}
//
//
//
//	public function CountFlightsFrom($hub) { //Number of flights departing
//
//		$query = "SELECT * FROM ".TABLE_PREFIX."pireps WHERE depicao = '".$hub."'";
//
//		$results = DB::get_results($query);
//
//		return DB::num_rows($results);
//
//	}
//
//
//
//	public function CountFlightsTo($hub) { //Number of flights arriving
//
//		$query = "SELECT * FROM ".TABLE_PREFIX."pireps WHERE arricao = '".$hub."'";
//
//		$results = DB::get_results($query);
//
//		return DB::num_rows($results);
//
//	}
//
//
//
//	public function FlightsDetails($hub, $limit=10) { //Details of latest (10) flights
//
//		$query = "SELECT * FROM ".TABLE_PREFIX."pireps WHERE depicao = '".$hub."' OR arricao = '".$hub."' ORDER BY submitdate DESC LIMIT ".intval($limit);
//
//		$results = DB::get_results($query);
//
//		return $results;
//
//	}
//
//
//
//	public function CountRoutes($hub) { //Count schedules
//
//		$query = "SELECT * FROM ".TABLE_PREFIX."schedules WHERE depicao = '".$hub."' OR arricao = '".$hub."'";
//
//		$results = DB::get_results($query);
//
//		return DB::num_rows($results);
//
//	}
//
//
//
//	public function CountRoutesFrom($hub) { //Count schedules departing
//
//		$query = "SELECT * FROM ".TABLE_PREFIX."schedules WHERE depicao = '".$hub."'";
//
//		$results = DB::get_results($query);
//
//		return DB::num_rows($results);
//
//	}
//
//
//
//	public function CountRoutesTo($hub) { //Count schedules arriving
//
//		$query = "SELECT * FROM ".TABLE_PREFIX."schedules WHERE arricao = '".$hub."'";
//
//		$results = DB::get_results($query);
//
//		return DB::num_rows($results);
//
//	}
//
//
//
//	public function TotalMiles($hub) { //Count miles flown
//
//		$query = "SELECT SUM(distance) as miles FROM ".TABLE_PREFIX."pireps WHERE depicao = '".$hub."' OR arricao = '".$hub."'";
//
//		$result = DB::get_row($query);
//
//		return $result->miles;
//
//	}
//
//
//
//	public function TotalMilesFrom($hub) { //Count miles flown departing
//
//		$query = "SELECT SUM(distance) as miles FROM ".TABLE_PREFIX."pireps WHERE depicao = '".$hub."'";
//
//		$result = DB::get_row($query);
//
//		return $result->miles;
//
//	}
//
//
//
//	public function TotalMilesTo($hub) { //Count miles flown arriving
//
//		$query = "SELECT SUM(distance) as miles FROM ".TABLE_PREFIX."pireps WHERE arricao = '".$hub."'";
//
//		$result = DB::get_row($query);
//
//		return $result->miles;
//
//	}
//
//
//
//	public function TotalHours($hub) { //Count total hours
//
//		$query = "SELECT SUM(flighttime) as hours FROM ".TABLE_PREFIX."pireps WHERE depicao = '".$hub."' OR arricao = '".$hub."'";
//
//		$result = DB::get_row($query);
//
//		return $result->hours;
//
//	}
//
//
//
//	public function TotalHoursFrom($hub) { //Count total hours departing
//
//		$query = "SELECT SUM(flighttime) as hours FROM ".TABLE_PREFIX."pireps WHERE depicao = '".$hub."'";
//
//		$result = DB::get_row($query);
//
//		return $result->hours;
//
//	}
//
//
//
//	public function TotalHoursTo($hub) { //Count total hours arriving
//
//		$query = "SELECT SUM(flighttime) as hours FROM ".TABLE_PREFIX."pireps WHERE arricao = '".$hub."'";
//
//		$result = DB::get_row($query);
//
//		return $result->hours;
//
//	}
//
//
//
//
//}
//?>
<?php
class HubStats extends Codondata {

public static function Pilots($hub) { //Pilot details
$query = "SELECT * FROM ".TABLE_PREFIX."pilots WHERE hub = '".$hub."'";
return DB::get_results($query);
}

public static function CountPilots($hub) { //Number of pilots
$query = "SELECT COUNT(pilotid) as count FROM ".TABLE_PREFIX."pilots WHERE hub = '".$hub."'";
$results = DB::get_row($query);
return $results->count;
}

public static function CountFlights($hub) { //Number of flights total
$query = "SELECT COUNT(pirepid) as count FROM ".TABLE_PREFIX."pireps WHERE arricao = '".$hub."' OR depicao = '".$hub."'";
$results = DB::get_row($query);
return $results->count;
}

public static function CountFlightsFrom($hub) { //Number of flights departing
$query = "SELECT COUNT(pirepid) as count FROM ".TABLE_PREFIX."pireps WHERE depicao = '".$hub."'";
$results = DB::get_row($query);
return $results->count;
}

public static function CountFlightsTo($hub) { //Number of flights arriving
$query = "SELECT COUNT(pirepid) FROM ".TABLE_PREFIX."pireps WHERE arricao = '".$hub."'";
$results = DB::get_row($query);
return $results->count;
}

public static function FlightsDetails($hub, $limit=10) { //Details of latest (10) flights
$query = "SELECT * FROM ".TABLE_PREFIX."pireps WHERE depicao = '".$hub."' OR arricao = '".$hub."' ORDER BY submitdate DESC LIMIT ".intval($limit);
return DB::get_results($query);
}

public static function CountRoutes($hub) { //Count schedules
$query = "SELECT COUNT(id) as count FROM ".TABLE_PREFIX."schedules WHERE depicao = '".$hub."' OR arricao = '".$hub."'";
$results = DB::get_row($query);
return $results->count;
}

public static function CountRoutesFrom($hub) { //Count schedules departing
$query = "SELECT COUNT(id) as count FROM ".TABLE_PREFIX."schedules WHERE depicao = '".$hub."'";
$results = DB::get_row($query);
return $results->count;
}

public static function CountRoutesTo($hub) { //Count schedules arriving
$query = "SELECT COUNT(id) as count FROM ".TABLE_PREFIX."schedules WHERE arricao = '".$hub."'";
$results = DB::get_results($query);
return $results->count;
}

public static function TotalMiles($hub) { //Count miles flown
$query = "SELECT SUM(distance) as miles FROM ".TABLE_PREFIX."pireps WHERE depicao = '".$hub."' OR arricao = '".$hub."'";
$result = DB::get_row($query);
return $result->miles;
}

public static function TotalMilesFrom($hub) { //Count miles flown departing
$query = "SELECT SUM(distance) as miles FROM ".TABLE_PREFIX."pireps WHERE depicao = '".$hub."'";
$result = DB::get_row($query);
return $result->miles;
}

public static function TotalMilesTo($hub) { //Count miles flown arriving
$query = "SELECT SUM(distance) as miles FROM ".TABLE_PREFIX."pireps WHERE arricao = '".$hub."'";
$result = DB::get_row($query);
return $result->miles;
}

public static function TotalHours($hub) { //Count total hours
$query = "SELECT SUM(flighttime) as hours FROM ".TABLE_PREFIX."pireps WHERE depicao = '".$hub."' OR arricao = '".$hub."'";
$result = DB::get_row($query);
return $result->hours;
}

public static function TotalHoursFrom($hub) { //Count total hours departing
$query = "SELECT SUM(flighttime) as hours FROM ".TABLE_PREFIX."pireps WHERE depicao = '".$hub."'";
$result = DB::get_row($query);
return $result->hours;
}

public static function TotalHoursTo($hub) { //Count total hours arriving
$query = "SELECT SUM(flighttime) as hours FROM ".TABLE_PREFIX."pireps WHERE arricao = '".$hub."'";
$result = DB::get_row($query);
return $result->hours;
}

public static function TotalFuelUsed($hub) { //Count total fuel used arriving
$query = "SELECT SUM(fuelused) as fuel FROM ".TABLE_PREFIX."pireps WHERE arricao = '".$hub."'";
$result = DB::get_row($query);
return $result->fuel;
}
}
?>
