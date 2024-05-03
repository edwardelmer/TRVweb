<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<div class="section-header">
	<h1>Downloads</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo SITE_URL; ?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="javascript::">Resources & Support</a></div>
        <div class="breadcrumb-item">Downloads</div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="alert alert-success alert-has-icon">
            <div class="alert-icon">
                <i class="far fa-lightbulb"></i>
            </div>
            <div class="alert-body">
                <div class="alert-title">Redirecting!</div>
                Your download will start in a few seconds, or <a href="<?php echo $download->link;?>" target="_blank">click here to manually start.</a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript"> 
    window.location = "<?php echo $download->link;?>";
</script>