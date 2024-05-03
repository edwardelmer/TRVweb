<?php include_once'../crew/core/codon.config.php';?>


<?php echo "stats";?>
<?php echo "stats".StatsData::TotalHours;?>
<?php echo number_format(StatsData::TotalPaxCarried());?>