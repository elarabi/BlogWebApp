<?php 
/**
* Author El Arabi
* 
* April 26, 2015
*
* Project Blog Wep App
**/

include_once 'Library/Init.php';


if (Request::getController() === 'Api')
{

   $app = new Controllers_Api();

} else {
   
	$app = new Controllers_Blog();   

}
//Run the application to return the response
$app->main();
