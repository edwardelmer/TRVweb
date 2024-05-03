<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<?php
    //Destinations Map exclusively made for TRV
?>
<?php
    {
        $bases=OperationsData::getAllHubs();
        $basess=HubData::get_hub();
        
    }
?>
<!-- $pairs = SchedulesData::getArrivalAiports(,'TVA'); -->

<div class="card"></div>
<?php 
    {
        foreach ($bases as $base)
        { ?>
            <h5><?php echo $base->icao;?></h5>
                <?php
                $pairs = SchedulesData::getArrivalAiports($base,$airlinecode);
                foreach ($pairs as $pair)
                {
                    echo $pair->icao." ";
                }
        }
    }
?>
</div>