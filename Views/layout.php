<!DOCTYPE html>
<html>
<head>
  <title>Blog Web App</title>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<!-- Optional theme -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
<!-- Style Sheet For the Blog Web App -->
<link rel="stylesheet" href="/public/css/blog.css">
</head>
<body data-ng-app="blogApp" data-ng-controller="blogCtrl">
<header>
<div class="row">
   <h2 class="col-lg-6 pull-left"><i class="glyphicon glyphicon-education"></i>Blog Wep App</h2>
   <div class="col-lg-6 pull-right">
   </div>
</div>
   <nav class="navbar navbar-default navbar-static-top" data-role="navigation">
     <ul class="nav nav-pills navbar-right">
        <li data-ng-repeat="item in menuItems" data-ng-show="{{item.isActive}}"><a href={{item.url}}><i class="{{item.icon}}"></i> {{item.title}}</a></li>
     </ul>
   </nav>
</header>
<div class="row app-container">
<aside class="col-lg-3 pull-left">
    <div class="panel panel-primary ">
        <h3 class="panel-heading" ><span class="panel-title"><i class="glyphicon glyphicon-list-alt"></i> Articles <span>{{articles.length}}</span></span></h3>
<ul  class="panel-body list-group">
 <li  class="list-group-item" data-ng-repeat="art in articles">
     <i class="glyphicon glyphicon-flag" ng-show="user.isOwner(art)"></i>
     <a href="#" data-ng-click="article.show($index)">{{art.publishedon}} {{art.title}}</a>
 </li>
 <li  class="list-group-item" data-ng-show="articles.length <1 ">Sorry There is No Article Published at this time!!</li>
</ul>
    </div>
</aside>
<div class="col-lg-6"> 
	<?php include 'frm.article.php'; ?>
     
    <div class="panel panel-primary">
        <h3 class="panel-heading">
		<span class="panel-title"><i class="glyphicon glyphicon-comment"></i> Comments{{articleComments.length}}</span>
		</h3>
        <ul  class="panel-body list-group">
            <li  class="list-group-item" data-ng-repeat="comment in articleComments">
            	<p  ng-hide="comment.editor">
			<span><i class="glyphicon glyphicon-trash" ng-show="comment.author == user.Info.id || article.Details.author == user.Info.id" ng-click="newComment.del($index)"></i>  
			<i class="glyphicon glyphicon-pencil" ng-show="comment.author == user.Info.id" ng-click="comment.editor = true"></i>
			</span>
			#{{comment.author}} {{comment.message}}
		</p>
		<p ng-show="comment.editor" class="input-group">
		    <input type=text  ng-model="comment.message" class="form-control input-element-lg" style="width:100%;"><span class="input-group-addon"><i class="glyphicon glyphicon-ok" ng-click="comment.editor = !newComment.edit($index)"></i></span>
		 </p>
	    </li>
            <li class="list-group-item" data-ng-show="(!articleComments || articleComments.length < 1) && article.Details.id >0 ">Be the first commenting this article!!!!</li>
        </ul>
    </div>


</div>
<aside class="col-lg-3 pull-right">
    <div class="panel panel-primary ">
        <h3 class="panel-heading" >
		<span class="panel-title"> 
		    <span class="btn-group" role="group" aria-label="...">
                        <span class="btn btn-info" ng-click=" usersfilter = ''">   <input type="radio" value="" ng-model="usersfilter" checked><i class="glyphicon glyphicon-list-alt"></i> All Users</span>
                        <span class="btn btn-info" ng-click=" usersfilter = 'reader'"> <input type="radio" value="reader" ng-model="usersfilter">Readers</span>
                        <span class="btn btn-info"  ng-click=" usersfilter = 'writer'">   <input type="radio" value="writer" ng-model="usersfilter">Authors</span>
                    </span>
		</span>
	</h3>
        <ul  class="panel-body list-group">
            <li  class="list-group-item" data-ng-repeat="usr in users" ng-show="usersfilter == '' || usr.role == usersfilter">
                <i class="glyphicon glyphicon-user" ng-show="usr.id == user.Info.id"></i><a href="#/user/:{{usr.id}}" data-ng-click="user.set($index)">{{usr.name}} {{usr.role}}</a>
            </li>
        </ul>
    </div>
	<div class="panel panel-primary">
       <h3 class="panel-heading">
	   <span class="panel-title"><i class="glyphicon glyphicon-comment"></i>Comment on this Post</span>
	   </h3>
	   <div class="panel-body list-group">
       <textarea data-ng-model="newComment.message" class="input-element-message" cols=35 rows=5 required></textarea>
       <span class="btn btn-primary" data-ng-click="newComment.save()"><i class="glyphicon glyphicon-send"></i>Send</span>
	   </div>
    </div>


</aside>
</div><hr>
<footer> 
<small>Blog Web App just as a sample Project Built with angularJS And Bootstrap. <a href="https://github.com/elarabi/BlogWebApp/">View the GitHub Projrct</a></small>
 </footer>

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.25/angular.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.25/angular-route.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script src="/public/js/blog.js"></script>
</body>
</html>
<?php
