<?php
/**
 * phpVMS - Virtual Airline Administration Software
 * Copyright (c) 2008 Nabeel Shahzad
 * For more information, visit www.phpvms.net
 *	Forums: https://www.phpvms.net/forum
 *	Documentation: https://www.phpvms.net/docs
 *
 * phpVMS is licenced under the following license:
 *   Creative Commons Attribution Non-commercial Share Alike (by-nc-sa)
 *   View license.txt in the root, or visit https://creativecommons.org/licenses/by-nc-sa/3.0/
 *
 * @author Nabeel Shahzad
 * @copyright Copyright (c) 2008, Nabeel Shahzad
 * @link https://www.phpvms.net
 * @license https://creativecommons.org/licenses/by-nc-sa/3.0/
 */
 
class FrontBids extends CodonModule
{

	public function index()
	{
	    if(!Auth::LoggedIn()) {
          $this->set('message', 'You must be logged in to access this feature!');
          $this->render('core_error.php');
          return;
        }
		$this->RecentFrontPage();
	}
	
    public function RecentFrontPage($total=5)
	{

		$this->set('lastbids', SchedulesData::GetLatestBids($total));
		$this->render('frontpage_recentbids.php');
	}
}