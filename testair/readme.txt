Auto Accept Decline Pirep

Developed by:
Baggelis.com Vangelis Boulasikis
www.baggelis.com

Released under the following license:
Creative Commons Attribution-Noncommercial-Share Alike 3.0 Unported License

Features:
Custom Pirep Criteria
Custom Pilot ID that declines the pirep
Auto mail to admin and pilot if wanted

Installation:
1 - Download Package and place files in your phpVMS install in the proper paths
2 - Load the AutoPirep.sql file in your phpVMS database using phpMYAdmin or similar
3 - In core/common/PIREPData.class.php at line 812 or 813 add  

PirepAcData::search($pirepid);

4 - Place a link to the AutoPirep in your AdminMenu inder line 195 in admin/templates/core_navigation.tpl

<li><a href="<?php echo adminurl('/PirepAutoAccept'); ?>">Auto Pirep</a></li>
        <?php 
        }
        if(PilotGroups::group_has_perm(Auth::$usergroups, EDIT_PIREPS_FIELDS)) 
        {
        ?>


5 - Insert the criteria that you want or enable the preassigned

6 - Let the pilots file their pireps and sit back :)

