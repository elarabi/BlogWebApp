<?php
/**
* Author El Arabi
* 
* April 26, 2015
*
* Adapted to be used for the Blog Web App
**/

class Request {
    private static $request = null;
    private static $params = array();
	private static $datas;

	private static $url = null;

    private static $controller = null;
    private static $action = null;

    private static $instance = null;

    private function __construct() {
		return $this;
    }
	public static function getInstance(){
        if(!self::$instance instanceof Request){
            self::$instance = new self();
        }
        return self::$instance;
		
	}
    private static function parse(){
        
            $uri = $_SERVER['REQUEST_URI'];
            $query = $_SERVER['REQUEST_QUERY'];
            $path = str_replace('?'.$query, '', $uri);
            $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ?'https':'http';
            $host = $_SERVER['HTTP_HOST'];
            $url = $scheme.'://'.$host.$uri;
            
            $params = explode('/', trim($path,'/'));

			#Should Be Fixed!  || Request::isXMLHttpRequest()
			if( preg_match('/\/api\/\w+/i',$_SERVER['REQUEST_URI']) ){
	            
				self::$controller = 'Api';
				unset($params[0]);
			
			} else {

				self::$controller = 'Blog';
			}
			self::$action = empty($params[0])?'index':strtolower($params[0]);
            
			if(self::filter(self::$action) !== self::$action){
               self::$action = 'error'; 
            }
            
            self::$request = array( 'uri' => $uri,
                             'query' => $query,
                              'path' => $path,
                        'controller' => self::$controller,
                            'action' => self::$action,
                             'url' => self::$url);
            
			if (self::isGet()) 
				self::$datas = 	array_merge((array)$_REQUEST,(array)$_GET);
			elseif (self::isPost()) 
				self::$datas = array_merge((array)$_GET,(array)$_POST);
			else {
				#2DO - add args and argv if it is thae case. Not Needed for the sample.
				self::$datas = $_REQUEST;
			}			

            #self::$params = array_merge((array)$_COOKIE,(array)$_GET);
            
			// TODO : Define the appropriate regular expression to handel a clean url!!!!!
            if (count($params) > 2 ) 
			{
                for ($i = 2; $i < count($params) ; $i += 2) {
                    if(preg_match('/^([\w]+)/i', $params[$i], $matcheds) &&  $params[$i] == $matcheds[0] ) 
					{
                        self::$params["{$params[$i]}"] = isset($params[$i+1])?urldecode($params[$i+1]):null;
                    }
                }
            }
        
        
        return self::$request;
    }

    public static function isPost(){
    	return ($_SERVER['REQUEST_METHOD'] === 'POST');	
    }

    public static function isGet(){
    	return ($_SERVER['REQUEST_METHOD'] === 'GET');	
    }

    public static function isXMLHttpRequest(){
        return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === "XMLHttpRequest");
    }
    
    public static function getController(){
		
        if(!self::$controller){
            self::parse();
        }
        return self::$controller;
    }
    public static function getAction(){
         if(!self::$action){
            self::parse();
        }
        return self::$action;
    }
    public static function getUri(){
        return $_SERVER['REQUEST_URI'];
    }

   public static function set($fieldName, $value){
       self::$datas[$fieldName] = $value;
       return self::$datas[$fieldName];
   }
    public static function get($fieldName, $default=null){
        return (isset(self::$datas[$fieldName]))?self::$datas[$fieldName]:$default;
    }
    public static function getInt($field, $default=0){
        return (isset(self::$datas[$fieldName]))?(int)self::$datas[$fieldName]:(int)$default;
    }
	public static function filter($str){
	    if(preg_match('/^([\w]+)/i', $str, $matcheds))
			return  $matcheds[0];
		else 
			return '';
	}
   /***
    * Function to be callad by the array_fillter as callback function..
    * The call of empty is not permited! Since empty() is not a function but a language construct. 
    * 
	* This a way to solve the php exception  
	*     "you can not use the standard php function empty as a callback function"
    * 
    */
   public static function isEmpty($var){
    return empty($var);
   }
}