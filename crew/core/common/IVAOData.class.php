<?php

class IVAOData extends CodonData {
    
    
    public static function get_online_pilots($data) {
        $whazzup_data = file_get_contents('https://api.ivao.aero/v2/tracker/whazzup');
        $ivao_data = json_decode($whazzup_data, true);
        $ivao_pilots = $ivao_data['clients']['pilots'];
        
        return $ivao_pilots;
    }
}



?>