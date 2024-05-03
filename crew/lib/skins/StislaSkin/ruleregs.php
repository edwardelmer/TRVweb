<?php
///////////////////////////////////////////////
///Rules and Regulations v1.2 by php-mods.eu///
///            Author php-mods.eu           ///
///            Packed at 11/2/2015          ///
///     Copyright (c) 2015, php-mods.eu     ///
///////////////////////////////////////////////

?>


<head>
<script type="text/javascript">

function theChecker()
{
if(document.theForm.theCheck.checked==false)
{
document.theForm.theButton.disabled=true;
}
else
{
document.theForm.theButton.disabled=false;
}
}
</script>
</head>
<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>


<div class="section-header">
	<h1><?php echo SITE_NAME; ?> Rules and Regulations</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo SITE_URL; ?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="javascript::">Resources & Support</a></div>
        <div class="breadcrumb-item"><a href="javascript::">Company</a></div>
        <div class="breadcrumb-item">Rules & Regulations</div>
    </div>
</div>
<div class"card">
    <div class="card-body" onLoad="document.theForm.theButton.disabled=true">
        <div class="contenth"></div>
        <?php
        if(!$category)
            {
                echo 'There are no any rules categories!';
            }
        else
            {
            $count = 1;
            foreach($category as $cat)
                { 
                ?>
                <b><u>
                <div class="section-title mt-0">Section <?php echo $countcat = $count; $count++;?> - <?php echo $cat->title; ?></u></b></div>
                
                <?php 
                $rules = RuleregsData::rulesincat($cat->id); 
                if(!$rules)
                    {
                        echo 'There are no any rules in this category.';
                    }
                else
                    {
                    $countrl = 1;
                    foreach($rules as $rule)
                        {
                        ?>
                        
                        <?php echo $countcat; ?>.<?php echo $countrl; $countrl++;?>. <?php echo $rule->rule; ?><br /><br />
                        <?php } } ?><hr />
                        <?php } } ?>
                        <?php
                        if(Auth::LoggedIn())
                			{
                			    
                			}
                            else
                                { 
                                ?>
                                    If you agree with our Rules and Regulations, you may continue to fill out the Application by clicking below.<br />
                                    <form name="theForm" action="<?php echo SITE_URL ?>/index.php/Registration" method="post">
                                        <p align="center">
                                        <input type="checkbox" name="theCheck" onClick="theChecker()" value="">I agree to the terms of use.<br />
                                        <input type="submit" name="theButton" value="Continue">
                                        </p>
                                    </form>
                                <?php } ?>
                            <p align="right">Copyright &copy; <?php echo date('Y'); ?> - phpmods</p>    
                            

    </div>
</div>
