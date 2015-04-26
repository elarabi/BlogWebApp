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
   <h2 class="col-lg-6 pull-left"><i class="glyphicon glyphicon-education"></i>Blog Wep App Sample Project</h2>
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
<div>{{user.Info.role}}#{{user.Info.id}}-Welcome ! Dear! {{user.Info.name}}</div>
<aside class="col-lg-3 pull-left">
    <div class="panel panel-primary ">
        <h3 class="panel-heading" ><span class="panel-title"><i class="glyphicon glyphicon-list-alt"></i> Brows Articles <span>{{articles.length}}</span></span></h3>
<ul  class="panel-body list-group">
 <li  class="list-group-item" data-ng-repeat="art in articles">
     <i class="glyphicon glyphicon-flag" ng-show="art.id == article.Details.id"></i>
     <a href="#" data-ng-click="article.show($index)">{{art.publishedon}} {{art.title}}</a>
 </li>
 <li  class="list-group-item" data-ng-show="articles.length <1 ">Sorry There is No Article Published at this time!!</li>
</ul>
    </div>
</aside>
<div class="col-lg-6"> 

    <div class="well main-container">
    <h3>Post Details</h3>
    <hr style="color:#eee;">
    <form name="articleDetailsForm">
        <div class="row">
            <div class="col-lg-7 ">
                <div class="input-group ">
                    <label class="input-label">Write By</label>
                    <input type="hidden" ng-model="article.Details.author">
                    <select aria-label="Article-Writer" placeholder="Write by" class="input-element-lg">
                     <option>N/S</option>
                     <option ng-repeat="usr in users " ng-selected="usr.id == article.Details.author">{{usr.name}}-{{usr.role}}</option>
                   </select>
                </div>
            </div>
            <div class="col-lg-5 ">
                <div class="input-group">
                    <label>Published On</label>
                    <input type="text" name="publishedon" data-ng-model="article.Details.publishedon" class="input-element-date"readOnly>
                </div>
            </div>
        </div>
        <div class="row">
                <div class="input-group ">
                    <label>Title</label>
                    <input type="text" class="input-element-lg" data-ng-model="article.Details.title" name="title" required>
                </div>
        </div>
        <div class="row">
            <div class="input-group">
                <label>Description</label>
                <textarea name="description"  data-ng-model="article.Details.description" class="input-element-lg" cols="60" rows="10" required></textarea>
            </div>
        </div>
        <br>
        <footer>
            <div class="row" data-ng-show="user.isWriter()">
                <button data-ng-click="article.add()" data-ng-hide="user.isOwner(article.Details)" class="btn btn-primary"><i class="glyphicon glyphicon-disk"></i>Add</button>
                <button data-ng-click="article.edit()" data-ng-show="user.isOwner(article.Details)" class="btn btn-primary"><i class="glyphicon glyphicon-pencil"></i>Edit</button>
                <button data-ng-click="article.del()" data-ng-show="user.isOwner(article.Details)" class="btn btn-danger"><i class="glyphicon glyphicon-pencil"></i>Delete</button>
                <button data-ng-click="article.clear()" class="btn btn-default" type="reset"><i class="glyphicon glyphicon-pencil"></i>Cancel</button>
            </div>
        </footer>
</form>
</div>
    <div class="well well-lg">
       <h4>Post a comment on this Post</h4>
       <input type="text" data-ng-model="newComment.message" size="70" class="input-element-lg">
       <span class="btn btn-primary" data-ng-click="newComment.save()"><i class="glyphicon glyphicon-disk"></i>Post</span>
    </div>

</div>
<aside class="col-lg-3 pull-right">
    <div class="panel panel-primary ">
        <h3 class="panel-heading" ><span class="panel-title"><i class="glyphicon glyphicon-list-alt"></i> Users </span></h3>
        <ul  class="panel-body list-group">
            <li  class="list-group-item" data-ng-repeat="usr in users">
                <i class="glyphicon glyphicon-user" ng-show="usr.id == user.Info.id"></i><a href="#/user/:{{usr.id}}" data-ng-click="user.set($index)">{{usr.name}} {{usr.role}}</a>
            </li>
        </ul>
    </div>
    <div class="panel panel-primary ">
        <h3 class="panel-heading" ><span class="panel-title"><i class="glyphicon glyphicon-list-alt"></i> Comments{{articleComments.length}}</span></h3>
        <ul  class="panel-body list-group">
            <li  class="list-group-item" data-ng-repeat="comment in articleComments">{{comment.message}} ({{comment.author}})</li>
            <li  class="list-group-item" data-ng-show="!articleComments || articleComments.length < 1 ">Be the first commenting this article!!!!</li>
        </ul>
    </div>
</aside>
</div>
<footer> </footer>

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.25/angular.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.25/angular-route.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script src="/public/js/blog.js"></script>
</body>
</html>
<?php
