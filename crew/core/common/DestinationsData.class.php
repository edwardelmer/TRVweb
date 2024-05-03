<?php
class DestinationsData extends CodonData {
	 public static function findpairs($arricao, $depicao, $airline) {
		$sql = "SELECT ".TABLE_PREFIX."schedules.*,
			".TABLE_PREFIX."aircraft.name AS aircraft,
			".TABLE_PREFIX."aircraft.registration,
			".TABLE_PREFIX."aircraft.id AS aircraftid,
			".TABLE_PREFIX."aircraft.icao AS aircrafticao,
			".TABLE_PREFIX."aircraft.ranklevel AS aircraftlevel
			FROM ".TABLE_PREFIX."schedules, ".TABLE_PREFIX."aircraft
			WHERE ".TABLE_PREFIX."schedules.depicao LIKE '$depicao'
			AND ".TABLE_PREFIX."schedules.arricao LIKE '$arricao'
			AND ".TABLE_PREFIX."schedules.code LIKE '$airline'
			AND ".TABLE_PREFIX."aircraft.id LIKE ".TABLE_PREFIX."schedules.aircraft";

		return DB::get_results($sql);
  	 }

	 public static function getAllHubs($airline, $icao) {
		  $sql = "SELECT * FROM ".TABLE_PREFIX."hubs
			WHERE `icao` = '$hubicao'
			AND `airline` = '$airline'
			ORDER BY airline, ASC";

		  $all_dests = DB::get_results($sql);
		  if(!$all_dests) { $all_dests = array(); }

		  return $all_dests;
	 }
	 public static function getairlinebase($airline) {
		$sql = "SELECT hubicao FROM ".TABLE_PREFIX."hubs WHERE airline = '$airline'";
		return DB::get_results($sql);
	 }
	 
	 public static function getdestinations() {
	    $sql = "SELECT ".TABLE_PREFIX."schedules.code,
	    ".TABLE_PREFIX."schedules.depicao,
	    ".TABLE_PREFIX."schedules.arricao
	    FROM ".TABLE_PREFIX."schedules,".TABLE_PREFIX."airports
	    WHERE ".TABLE_PREFIX."schedules.depicao = ".TABLE_PREFIX."airports.icao
	    AND ".TABLE_PREFIX."airports.hub = 1
	    GROUP BY ".TABLE_PREFIX."schedules.depicao,
	    ".TABLE_PREFIX."schedules.arricao,
	    ".TABLE_PREFIX."schedules.code";
	    
	    return DB::get_results($sql);
	 }

}