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
        <div class="breadcrumb-item">History</div>
    </div>
</div>
    
<div class="card card-primary">
    <div class="col-12">
        <div class="row">
            <div class="col-6"><br />Your current fund :  <b><font color="#FF0000">v$<?php echo Auth::$userinfo->totalpay; ?></font></b></div>
            <div class="col-4" align="right"><br /><form method="link" action="<?php echo SITE_URL ?>/index.php/Exams/view_profile"><input type="submit" class="btn btn-icon icon-left btn-primary btn-round" value="View My Exam History"></form></div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <h4>Available Exams : </h4>
    </div>
    <div class="card-body">        
        <div class="row">
            <table class="table table-hover" cellpadding="15px">
                <div class="row">
                    <thead>
                        <?php
                        /*if (isset($message)) {echo '<tr><td colspan="3" >'.$message.'</td></tr>';}*/
                
                        if (!$exams) {
                            echo '<tr><td colspan="3"><div id="error">There are currently no active exams.</div></td></tr>';
                        }
                        else {
                            $assign = ExamsData::get_setting_info('5');
                            if ($assign->value == '1') {echo '<tr>
                                        <td colspan="3">Currently the exam administrator must assign exams to pilots using the EXAMCenter.<br />
                                        Use the request exam link to request an exam assignment.</td></tr>';
                            } ?>
                        
                        <tr align="center">
                            <td><b>Exam</b></td>
                            <td><b>Exam Cost</b></td>
                            <td><b>Option</b></td>
                            <td>&nbsp;</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($exams as $data) {
                                echo 	'<tr align="center">
                                            <td>'.$data->exam_description.'</td>
                                            <td>$'.$data->cost.'</td>
                                            <td>';
                                                if ($assign->value == '0') {echo '<a href="'.SITE_URL.'/index.php/Exams/buy_exam?id='.$data->id.'" class="btn btn-primary btn-md" >Register</a>';}
                                                else {
                                                    $assigned = ExamsData::check_exam_assigned(Auth::$userinfo->pilotid, $data->id);
                                                    $total=ExamsData::check_for_request(Auth::$userinfo->pilotid, $data->id);
                                                    if ($assigned->total == '0') {
                                                        if ($total->total >= '1') { echo '<font color="#FF6600">Exam Request Pending</font>'; }
                                                        else { echo '<a href="'.SITE_URL.'/index.php/Exams/request_exam?id='.$data->id.'"><font color="#FF0000">Request Exam</font></a>';}
                                                    }
                                                    else {echo '<a href="'.SITE_URL.'/index.php/Exams/buy_exam?id='.$data->id.'"><font color="#006600">Exam Available</font></a>';}
                                                }
                                echo '      </td>
                    		            <tr>';
                        }
                        ?>
                    </tbody>
                </div>
            </table>
        </div>
    </div>
</div>
    
<?php
}
?>