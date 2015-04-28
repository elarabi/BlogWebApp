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
			      'publishedon' =>date('Y-m-d',mktime(0, 0,0, 1, 1 ,2015)), 'id' =>  1, 'author' =>102, 'comments' =>array()),
           array('title' => 'article-02', 'contents' => 'Summary description of the article-02', 'url' => '/article/2',
			'publishedon' =>date('Y-m-d',mktime(0, 0,0, 2, 2 ,2015)), 'id' =>  2, 'author' =>100, 'comments' =>array()),
		   array('title' => 'article-03',  'contents' => 'Summary description of the article-03',  'url' => '/article/3',
			'publishedon' =>date('Y-m-d',mktime(0, 0,0, 3, 3 ,2015)),  'id' =>  3, 'author' =>100, 'comments' =>array()),
           array('title' => 'article-04', 'contents' => 'Summary description of the article-04', 'url' => '/article/4',
			'publishedon' =>date('Y-m-d',mktime(0, 0,0, 4, 4 ,2015)), 'id' =>  4, 'author' =>103, 'comments' =>array()),
           array('title' => 'article-05', 'contents' => 'Summary description of the article-05', 'url' => '/article/5', 
			'publishedon' =>date('Y-m-d',mktime(0, 0,0, 4, 5 ,2015)), 'id' =>  5, 'author' =>102, 'comments' =>array()),
           array('title' => 'article-06', 'contents' => 'Summary description of the article-06', 'url' => '/article/6', 
			'publishedon' =>date('Y-m-d',mktime(0, 0,0, 1, 29 ,2015)), 'id' => 6, 'author' =>102, 'comments' =>array()),
           array('title' => 'article-07', 'contents' => 'Summary description of the article-07', 'url' => '/article/7', 
			'publishedon' =>date('Y-m-d',mktime(0, 0,0, 5, 1 ,2015)), 'id' =>  7, 'author' =>100, 'comments' => array()),
           array('title' => 'article-08', 'contents' => 'Summary description of the article-08', 'url' => '/article/8', 
			'publishedon' =>date('Y-m-d',mktime(0, 0,0, 5, 11 ,2015)), 'id' =>  8, 'author' =>100, 'comments' =>array()),
               array('title' => 'article-09', 'contents' => 'Summary description of the article-09', 'url' => '/article/9', 
			'publishedon' =>date('Y-m-d',mktime(0, 0,0, 4, 14 ,2015)), 'id' =>  9, 'author' =>103, 'comments' => array()),
               array('title' => 'article-10', 'contents' => 'Summary description of the article-10', 'url' => '/article/10', 
			'publishedon' =>date('Y-m-d',mktime(0, 0,0, 6, 21 ,2015)), 'id' =>10, 'author' =>102, 'comments' =>array()),
    );
	$comments = array(
			array('message'=>'Message-1 on post-01 by Reader-1 ', 'author' => 101),
			array('message'=>'Message-2 on post-01 by Author-3 ', 'author' => 103),	 
			array('message'=>'Message-3 on post-01 by Reader-2 ', 'author' => 104),
			array('message'=>'Message-4 on post-01 by Owner-Author-2 ', 'author' => 102),
			);

	    $datas[0]['comments'] = $comments;
		uasort($datas, 'Models_Articles::isOlder');
		return $datas;
	}
	public static function isOlder($postA, $postB) {
		if ($postA['publishedon'] >= $postB['publishedon'])
		{
			return true;
		}
		else {
			return false;
		}
	}
}