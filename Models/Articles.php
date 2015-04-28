<?php
/**
* Author El Arabi
* 
* April 27, 2015
*
* Project Blog Wep App
**/
class Models_Articles{

	public static function fetchAll(){
	
		$datas = array( 
			array('title' => 'article-01', 'contents' => 'Summary description of the article-01', 'url' => '/article/1', 
			      'publishedon' =>'2015-Jan-01', 'id' =>  1, 'author' =>102, 'comments' =>array()),
           array('title' => 'article-02', 'contents' => 'Summary description of the article-02', 'url' => '/article/2',
			'publishedon' =>'2015-Feb-02', 'id' =>  2, 'author' =>100, 'comments' =>array()),
		   array('title' => 'article-03',  'contents' => 'Summary description of the article-03',  'url' => '/article/3',
			'publishedon' =>'2015-Mar-03',  'id' =>  3, 'author' =>100, 'comments' =>array()),
           array('title' => 'article-04', 'contents' => 'Summary description of the article-04', 'url' => '/article/4',
			'publishedon' =>'2015-Apl-04', 'id' =>  4, 'author' =>103, 'comments' =>array()),
           array('title' => 'article-05', 'contents' => 'Summary description of the article-05', 'url' => '/article/5', 
			'publishedon' =>'2015-Apl-05', 'id' =>  5, 'author' =>102, 'comments' =>array()),
           array('title' => 'article-06', 'contents' => 'Summary description of the article-06', 'url' => '/article/6', 
			'publishedon' =>'2015-Jan-31', 'id' => 6, 'author' =>102, 'comments' =>array()),
           array('title' => 'article-07', 'contents' => 'Summary description of the article-07', 'url' => '/article/7', 
			'publishedon' =>'2015-Feb-22', 'id' =>  7, 'author' =>100, 'comments' => array()),
           array('title' => 'article-08', 'contents' => 'Summary description of the article-08', 'url' => '/article/8', 
			'publishedon' =>'2015-Mar-13', 'id' =>  8, 'author' =>100, 'comments' =>array()),
               array('title' => 'article-09', 'contents' => 'Summary description of the article-09', 'url' => '/article/9', 
			'publishedon' =>'2015-Apl-14', 'id' =>  9, 'author' =>103, 'comments' => array()),
               array('title' => 'article-10', 'contents' => 'Summary description of the article-10', 'url' => '/article/10', 
			'publishedon' =>'2015-Apl-15', 'id' =>10, 'author' =>102, 'comments' =>array()),
    );
	$comments = array(
			array('message'=>'Message-1 from the server '.Request::getAction(), 'author' => 0),
			array('message'=>'Message-2 from the server '.Request::getAction(), 'author' => 0),	 
			array('message'=>'Message-3 from the server '.Request::getAction(), 'author' => 0),
			);
	    $datas[0]['comments'] = $comments;
		return $datas;
	}
}