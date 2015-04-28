<?php
/**
* Author El Arabi
* 
* April 26, 2015
*
* Project Blog Wep App
**/

class Response {
    private $datas = array();

	private static $_instance;
    
    private function __construct(){
	
	}
	public function getInstance(){
		if(!self::$_instance)
	        self::$_instance = new self();
        return  self::$_instance;
	}
    public function set($datas){
        $this->datas = $datas;
    }
    public function get(){
        return $this->datas;
    }
    public function json(){
	  header('Content-Type: application/json');
	
      $options = array(
		 'Content-type: application/json',
		// 'Content-Length: ' . strlen($this->get()),
	  );
     	echo json_encode($this->get()); 
    }
    public function html(){

		include APPLICATION_ROOT_PATH.'Views/layout.php'; 
    }
    /**
     * Provide the class the default output method 
     */
    public function __toString() {
       
       return json_encode($this->datas);
    }
}