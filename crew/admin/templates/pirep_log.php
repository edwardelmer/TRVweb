<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<div style="padding: 5px;">
    <h4>Log for PIREP #<?php echo $report->pirepid?><br>Flight : <?php echo $report->code . $report->flightnum." ". $report->depicao."-".$report->arricao?></h4>
    <div style="overflow: scroll; height: 300px">
    <?php
    # Simple, each line of the log ends with *
    # Just explode and loop.
    $log = explode('*', $report->log);
    foreach($log as $line)
    {
        echo $line .'<br />';
    }
    ?>
    </div>
</div>