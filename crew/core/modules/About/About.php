<?php
class About extends CodonModule
{
function index ()
{
$this->render('about/about');
}
function mission ()
{
$this->render('about_mission.php');
}

}
?>