<?php
/**
* Author El Arabi
* 
* April 26, 2015
*
* Project Blog Wep App
**/

date_default_timezone_set('America/Edmonton');
define('APPLICATION_ROOT_PATH',  realpath(dirname(__FILE__).DIRECTORY_SEPARATOR.'..').DIRECTORY_SEPARATOR);
#Register the autoloade function
spl_autoload_register("__autoload");
#Define autoload function 
function __autoload($class_name) {
	$count = 0;
    #File nemae
	$fileName = APPLICATION_ROOT_PATH.str_replace("_",DIRECTORY_SEPARATOR, (string)$class_name ,$count).'.php';
    if($count >0 && is_file($fileName)){
		@require_once $fileName;
    } else{
		$fileName = APPLICATION_ROOT_PATH.'Library'.DIRECTORY_SEPARATOR.$class_name.'.php';
        if(is_file($fileName)) {
           @require_once $fileName;
        } else {
           throw (new Exception("Class loader $class_name, File not found $fileName"));
        }
     } 
    #Check that the class exist Or call autoload default
    if(class_exists($class_name)) {
        return TRUE;
    } else {
        throw( new Exception('Classe not found '.$class_name));
        return FALSE;
    }
}
