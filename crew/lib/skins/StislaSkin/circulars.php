<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<div class="section-header">
	<h1>Red Circulars</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo SITE_URL; ?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="javascript::">Resources & Support</a></div>
        <div class="breadcrumb-item"><a href="javascript::">Company</a></div>
        <div class="breadcrumb-item">Circulars</div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="alert alert-primary">Red Briefing</div>
                        <table class="table">
                            <tr><td><a href="<?php echo url('/pages/flightoperationcircularno:1'); ?>" <span>No. 1 - Jul/2021</span></a></td></tr>
                            <tr><td><a href="<?php echo url('/pages/redbriefingeditionno2:august20"') ?>" <span>No. 2 - Aug/2021</span></a><tr><td>
                        </table>
                    </div>

                    <div class="col-md-6">
                        <div class="alert alert-primary">Red Notam</div>
                        <table class="table">
                            <?php
                                $news = PopUpNewsData::get_news_list(20);
                                foreach($news as $item) {
                                    echo '<tr><td><a href="'.SITE_URL.'/index.php/PopUpNews/popupnewsitem/'.$item->id.'">'.$item->subject.'</a> - '.date(DATE_FORMAT, $item->postdate).'</td></tr>';
                                }
                                ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</div>