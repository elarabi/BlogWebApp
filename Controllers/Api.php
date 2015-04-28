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
		if(Request::getAction() == 'comments') {
  			Response::getInstance()->set( Models_Comments::fetchAll()); 
		}
		else {
  			Response::getInstance()->set( Models_Articles::fetchAll()); 
		}
	   Response::getInstance()->json(); 
	}
}
