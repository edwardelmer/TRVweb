<?php
///////////////////////////////////////////////
///Rules and Regulations v1.2 by php-mods.eu///
///            Author php-mods.eu           ///
///            Packed at 11/2/2015          ///
///     Copyright (c) 2015, php-mods.eu     ///
///////////////////////////////////////////////

class Ruleregss extends CodonModule {
public function index()
  {				
	  $this->set('categorys', RuleregssData::getAllRuleCat());
	  $this->render('ruleregss.php');
  }  
}

