<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>

																	<?php 
if(!$allcategories)
{
	echo 'There are no downloads available!';
	return;
}

foreach($allcategories as $category)
{
?>
	<div class="col-12">
									<div class="card card-default" data-scroll-height="500">
										<div class="card-header justify-content-between align-items-center card-header-border-bottom">
											<h2><?php echo $category->name?></h2>
										</div>

										<div class="card-body slim-scroll">
																					<?php	
	# This loops through every download available in the category
	$alldownloads = DownloadData::GetDownloads($category->id);
	
	if(!$alldownloads)
	{
		echo 'There are no downloads under this category';
		$alldownloads = array();
	}
	
	foreach($alldownloads as $download)
	{
?>
											<div class="media py-3 align-items-center justify-content-between">
												<div class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-primary text-white">
													<i class="mdi mdi-cloud-download font-size-20"></i>
												</div>
												<div class="media-body pr-3 ">
													<p class="mt-0 mb-1 font-size-15 text-dark"><?php echo $download->name?></p>
													<p><?php echo $download->description?></p>
												</div>
												<span class=" font-size-12 d-inline-block"> <a href="<?php echo url('/downloads/dl/'.$download->id);?>" class="mb-1 btn btn-sm btn-outline-primary">Download</a></span>
												
											</div>
																																													<?php
	}
?>

											

										</div>

									</div>
																																	
																													
								</div>
									<?php
}
?>
																				

								
