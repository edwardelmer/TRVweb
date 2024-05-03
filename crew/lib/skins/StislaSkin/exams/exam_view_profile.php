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

if (isset($message)) {echo '<br />'; echo $message;}
?>
<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<div class="section-header">
	<img src="<?php echo SITE_URL; ?>/lib/skins/StislaSkin/exams/images/academy_logo.png" alt="EXAMCenter &copy; simpilotgroup" width="300"/>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo SITE_URL; ?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="javascript::">Pilot Administration</a></div>
        <div class="breadcrumb-item"><a href="javascript::">Exam Center</a></div>
        <div class="breadcrumb-item">Exam Profile</div>
    </div>
</div>
<center><?php //print_r($data); ?>

<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4>Exam History For : <?php echo Auth::$userinfo->firstname.' '.Auth::$userinfo->lastname.''; ?></h4>
            </div>
    
    <div class="card-body">
        
        <div class="row">
            <table class="table table-hover" width="100%">
                <thead>
                    <!--
                    <tr align="center">
                        <td colspan="3">Exam History</td>
                        <td colspan="2">
                            <table>
                                <tr>
                                    <td><div id="success">Score</div></td>
                                    <td> = Passed</td>
                                    <td><div id="error">Score</div></td>
                                    <td> = Failed</td>
                                </tr>
                            </table>
                        </td>
                    </tr>-->
                
                    <tr align="center">
                        <td><h5>Exam Title</h5></td>
                        <td><h5>Exam Version</h5></td>
                        <td><h5>Date Taken</h5></td>
                        <td><h5>Result</h5></td>
                        <td><h5>Score</h5></td>
                        <td><h5>Status</h5></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!$pilotdata) {echo '<tr align="center"><td colspan="5">You have not taking any exam yet.</td></tr>';}
                    else {
                        foreach($pilotdata as $pilot) {
                            echo'<tr align="center">
                                    <td>'.$pilot->exam_title.'</td>
                                    <td>Ver-'.$pilot->exam_version.'</td>
                                    <td>'.date(DATE_FORMAT, strtotime($pilot->date)).'</td>
                                    <td>';
                                        $div='error';
                                        if ($pilot->passfail == '1') {
                                            $div='success';
                                            $msg='Passed';
                                        }
                                        if ($pilot->passfail == '0') {
                                            $div='failed';
                                            $msg='Failed';
                                        }
                                        echo '<div id="'.$div.'">'.$msg.'</div>';
                                        echo'
                                    </td>
                                    <td>';
                                        $div='error';
                                        if ($pilot->passfail == '1') {
                                            $div='success';
                                        }
                                        echo '<div id="'.$div.'">'.$pilot->result.'</div>';
                                        echo'
                                    </td>
            					    <td>';
                                        $div='pending';
                                        $msg='Pending';
                                        if ($pilot->approved == '1') {
                                            $div='success';
                                            $msg='Validated';
                                        }
                                        if ($pilot->approved == '2') {
                                            $msg='Rejected';
                                            $div='error';
                                        }
                                        echo '<div id="'.$div.'">'.$msg.'</div>';
                                        echo'
                                    </td>
            					</tr>';
                        }
                    }
                    ?>
                </tbody>    
            </table>
        </div>
    </div>
    <form method="link" action="<?php echo SITE_URL ?>/index.php/Exams">
        <input type="submit" class="btn btn-icon icon-left btn-primary btn-round" value="Return To Exam Center"></form>
</center>