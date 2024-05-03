<?php

//////////////////////////////////////////////////////////////////////
//simpilotgroup Tour 1.0 module for phpVMS virtual airline system   //
//@author David Clark (simpilot)                                    //
//@copyright Copyright (c) 2011, David Clark, All Rights Reserved   //
//////////////////////////////////////////////////////////////////////

class TourData extends CodonData    {

    public static function get_schedules($depicao, $arricao)   {
        $query = "SELECT * FROM ".TABLE_PREFIX."schedules
                    WHERE depicao='$depicao'
                    AND arricao='$arricao'
                    AND enabled='1'";

        return DB::get_results($query);
    }

    public static function check_schedules($depicao, $arricao)   {
        $query = "SELECT COUNT(*)AS total FROM ".TABLE_PREFIX."schedules
                    WHERE depicao='$depicao'
                    AND arricao='$arricao'";

        return DB::get_row($query);
    }

    public static function available_flights($depicao)    {
        $query = "SELECT DISTINCT arricao FROM ".TABLE_PREFIX."schedules
                WHERE depicao='$depicao'
                AND enabled='1'";

        return DB::get_results($query);
    }

    public static function save_tour($tour)    {

        $flights = array();
        $flights = serialize($_SESSION['flights']);
        $title = $tour['title'];
        $description = $tour['description'];
        $image = $tour['image'];
        $active = $tour['active'];

        $query = "INSERT INTO ".TABLE_PREFIX."tours (flights, title, description, image, active)
                VALUES ('$flights', '$title', '$description', '$image', '$active')";

        DB::query($query);
    }

    public static function get_tours() {
        $query = "SELECT * FROM ".TABLE_PREFIX."tours ORDER BY active ASC, id ASC";

        return DB::get_results($query);
    }

    public static function get_tour($id)   {
        $query = "SELECT * FROM ".TABLE_PREFIX."tours WHERE id='$id'";

        return DB::get_row($query);
    }

    public static function edit_tour($title, $description, $image, $active, $id)  {
        $query = "UPDATE ".TABLE_PREFIX."tours SET
                title='$title',
                description='$description',
                image='$image',
                active='$active'
                WHERE id='$id'";

        DB::query($query);
    }

    public static function delete_tour($id)    {
        $query = "DELETE FROM ".TABLE_PREFIX."tours WHERE id='$id'";

        DB::query($query);
    }

    public static function pilot_signup($pilotid, $id, $data)  {
        $query = "INSERT INTO ".TABLE_PREFIX."tours_pilotdata (pilotid, tourid, data)
                            VALUES('$pilotid', '$id', '$data')";

        DB::query($query);
    }

    public static function delete_pilot_data($id)  {
        $query = "DELETE FROM ".TABLE_PREFIX."tours_pilotdata WHERE id='$id'";

        DB::query($query);
    }

    public static function check_pilotsignup($tourid)  {
        $pilotid = Auth::$userinfo->pilotid;
        
        $query = "SELECT COUNT(id) AS total FROM ".TABLE_PREFIX."tours_pilotdata
                    WHERE pilotid='$pilotid'
                    AND tourid='$tourid'";

        $check =  DB::get_row($query);

        return $check->total;
    }

    //get pilots that have participated in any tour
    public static function get_pilots_participated()   {
        $query = "SELECT DISTINCT(pilotid) FROM ".TABLE_PREFIX."tours_pilotdata";

        return DB::get_results($query);
    }

    //count how many signups there are for a tour
    public static function participants($tourid)  {
        $query = "SELECT COUNT(id) AS total FROM ".TABLE_PREFIX."tours_pilotdata
                    WHERE tourid='$tourid'";

        $check =  DB::get_row($query);

        return $check->total;
    }

    //get pilotdata for certain tour
    public static function get_pilot_data($id) {
        $query = "SELECT * FROM ".TABLE_PREFIX."tours_pilotdata
                WHERE tourid='$id'
                ORDER BY id ASC";

        return DB::get_results($query);
    }

    //get pilotdata for all tours signed up for
    public static function get_pilot_tours($pilotid)   {
        $query = "SELECT * FROM ".TABLE_PREFIX."tours_pilotdata
                WHERE pilotid='$pilotid'";

        return DB::get_results($query);
    }

    public static function get_rebuild_data($pilotid, $tourid) {
        $query = "SELECT * FROM ".TABLE_PREFIX."tours_pilotdata
                WHERE tourid='$tourid'
                AND pilotid='$pilotid'";

        return DB::get_row($query);
    }

    //find pireps for tour flight for rebuild data
    public static function get_tour_pirep($pilotid, $flightnum)    {
        $query = "SELECT * FROM ".TABLE_PREFIX."pireps
                WHERE flightnum='$flightnum'
                AND pilotid='$pilotid'
                ORDER BY submitdate ASC
                LIMIT 1";

        return DB::get_row($query);
    }

    //more rebuild data
    public static function get_pirep_data($pirepid)    {
        $query = "SELECT * FROM ".TABLE_PREFIX."pireps
                 WHERE pirepid='$pirepid'
                 ORDER BY submitdate ASC
                 LIMIT 1";

        return DB::get_row($query);
    }

    //update pilots tour progress
    public static function update_pilot_tourdata($id, $data)   {
        $query = "UPDATE ".TABLE_PREFIX."tours_pilotdata SET data='$data'
                    WHERE id='$id'";

        DB::query($query);
        if(!DB::$errno){return TRUE;}
    }

}