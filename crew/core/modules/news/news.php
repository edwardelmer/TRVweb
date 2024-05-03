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

class News extends CodonModule
{
	public function index()
	{
	    if(!Auth::LoggedIn()) {
          $this->set('message', 'You must be logged in to access this feature!');
          $this->render('core_error.php');
          return;
        }
		$this->ShowNewsFront(5);
	}
	
	// This function gets called directly in the template
	public function ShowNewsFront($count=5)
	{
		$sql='SELECT id, subject, body, postedby, UNIX_TIMESTAMP(postdate) AS postdate
				FROM ' . TABLE_PREFIX .'news 
				ORDER BY postdate DESC 
				LIMIT '.$count;
		
		$res = DB::get_results($sql);
		
		if(!$res)
			return;
			
		foreach($res as $row)
		{
			//TODO: change the date format to a setting in panel
			$this->set('subject', $row->subject);
			$this->set('body', $row->body);
			$this->set('postedby', $row->postedby);
			$this->set('postdate', date(DATE_FORMAT, $row->postdate));
		
			$this->show('news_newsitem.php');
		}
	}
}