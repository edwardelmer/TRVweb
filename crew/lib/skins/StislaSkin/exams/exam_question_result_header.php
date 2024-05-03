<?php
//simpilotgroup addon module for phpVMS virtual airline system
//
//simpilotgroup addon modules are licenced under the following license:
//Creative Commons Attribution Non-commercial Share Alike (by-nc-sa)
//To view full icense text visit http://creativecommons.org/licenses/by-nc-sa/3.0/
//
//@author David Clark (simpilot)
//@copyright Copyright (c) 2009-2010, David Clark
//@license http://creativecommons.org/licenses/by-nc-sa/3.0/
?>
<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<div class="section-header">
	<img src="<?php echo SITE_URL; ?>/lib/skins/StislaSkin/exams/images/academy_logo.png" alt="EXAMCenter &copy; simpilotgroup" width="300"/>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo SITE_URL; ?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="javascript::">Pilot Administration</a></div>
        <div class="breadcrumb-item"><a href="javascript::">Exam Center</a></div>
        <div class="breadcrumb-item">Result</div>
    </div>
</div>
<center>
    <div class="card">
        <div class="card-body">
            <table>
                <div class="row">
                    <tr align="center"><br /><h3><?php echo $title; ?> result.</h3></tr>