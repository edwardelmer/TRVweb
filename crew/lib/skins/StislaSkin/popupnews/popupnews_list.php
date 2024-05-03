<?php
//simpilotgroup addon module for phpVMS virtual airline system
//
//simpilotgroup addon modules are licenced under the following license:
//Creative Commons Attribution Non-commercial Share Alike (by-nc-sa)
//To view full icense text visit http://creativecommons.org/licenses/by-nc-sa/3.0/
//
//@author David Clark (simpilot)
//@copyright Copyright (c) 2009-2012, David Clark
//@license http://creativecommons.org/licenses/by-nc-sa/3.0/
?>
<div class="section-header">
	
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo SITE_URL; ?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="javascript::">Company</a></div>
        <div class="breadcrumb-item">News</div>
    </div>
</div>
<table>
<?php
    foreach($news as $item) {
        echo '<tr>';
        echo '<td><a href="'.SITE_URL.'/index.php/PopUpNews/popupnewsitem/'.$item->id.'">'.$item->subject.'</a> - '.date(DATE_FORMAT, $item->postdate).'</td>';
        echo '</tr>';
    }
?>
</table>