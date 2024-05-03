<?php
class Circulars extends CodonModule
{
    function index ()
        {
            $this->render('circulars');
        }
    
    function getNotam()
        {
            $this->set('notams',SiteData::getAllNews());
            $this->show('circulars');
        }
    
   
}
?>