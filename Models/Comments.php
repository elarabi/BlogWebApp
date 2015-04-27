<?php
/**
* Author El Arabi
* 
* April 27, 2015
*
* Project Blog Wep App
**/
class Models_Comments{

	public static function fetchAll(){
	
		$datas = array(
			array('message'=>'Message-1 from the server ', 'author' => 0),
			array('message'=>'Message-2 from the server ', 'author' => 0),	 
			array('message'=>'Message-3 from the server ', 'author' => 0),
			);
	
		return $datas;
	}
}