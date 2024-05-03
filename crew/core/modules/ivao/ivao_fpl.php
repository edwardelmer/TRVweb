<?php


    class ivao_fpl extends CodonModule
    {


        public $title = 'ivao_fpl';
        public function index()
        {
        echo 'Module Loads';
        $this->render('/ivao/ivao_fpl.php');
        }
    }




?>
