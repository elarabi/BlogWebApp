<?php
/**
* Author El Arabi
* 
* April 27, 2015
*
* Project Blog Wep App
**/

class Controllers_Api{
	private $model ;
	function __construct() {
		$this->model  = Request::getAction();

    }
    
	function IndexAction(){
        
	}
	function main(){
  	   Response::getInstance()->set( Models_Comments::fetchAll()); 
	   Response::getInstance()->json(); 
	}
}
