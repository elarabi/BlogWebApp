'use strict';
var app = angular.module('blogApp', ['ngRoute']);

//Set the app menu
app.factory('menuItems',function(){
      var items = [    
               {title: 'Home', url: '#/home', isActive:true, icon:'glyphicon glyphicon-home'},
               {title: 'About', url: '#/about', isActive:true, icon:'glyphicon glyphicon-book'},
               {title: 'Contact', url: '#/contact', isActive:true, icon:'glyphicon glyphicon-phone'},
               {title: 'Login', url: '#/login', isActive:true, icon:'glyphicon glyphicon-log-in'},
               {title: 'Logout', url: '#/logout', isActive:false, icon:'glyphicon glyphicon-log-out'}
       ];
      return items;
});
app.factory('usersList',function(){
   var guestUser = {name:'Guest',id:0, role:'guest'};
   var authorUser = {name:'Author 1',id:100, role:'writer'};
   var readerUser = {name:'Reader 1',id:101, role:'reader'};
   var users =[guestUser, readerUser, authorUser];
   users.push({name:'Author 2',id:102, role:'writer'});
   users.push({name:'Author 3',id:103, role:'writer'});
   users.push({name:'Reader 2',id:104, role:'reader'});

   return users;
});

app.factory('articlesList',['$http', function($http){
   var articles = [
               {title: 'article-01', contents: 'desc of the article-10', url: '/article/1', publishedon:'2015-Jan-01', id:  1, author:102, comments:[]},
               {title: 'article-02', contents: 'desc of the article-10', url: '/article/2', publishedon:'2015-Feb-02', id:  2, author:100, comments:[]},
               {title: 'article-03', contents: 'desc of the article-10', url: '/article/3', publishedon:'2015-Mar-03', id:  3, author:100, comments:[]},
               {title: 'article-04', contents: 'desc of the article-10', url: '/article/4', publishedon:'2015-Apl-04', id:  4, author:103, comments:[]},
               {title: 'article-05', contents: 'desc of the article-10', url: '/article/5', publishedon:'2015-Apl-05', id:  5, author:102, comments:[]},
               {title: 'article-06', contents: 'desc of the article-10', url: '/article/1', publishedon:'2015-Jan-31', id:  6, author:102, comments:[]},
               {title: 'article-07', contents: 'desc of the article-10', url: '/article/2', publishedon:'2015-Feb-22', id:  7, author:100, comments:[]},
               {title: 'article-08', contents: 'desc of the article-10', url: '/article/3', publishedon:'2015-Mar-13', id:  8, author:100, comments:[]},
               {title: 'article-09', contents: 'desc of the article-10', url: '/article/4', publishedon:'2015-Apl-14', id:  9, author:103, comments:[]},
               {title: 'article-10', contents: 'desc of the article-10', url: '/article/5', publishedon:'2015-Apl-15', id: 10, author:102, comments:[]},
    ];

   return articles;
    
}]);

app.controller('blogCtrl',['$scope', '$http', 'menuItems', 'articlesList','usersList',
                            function($scope, $http, menuItems, articlesList, usersList){
    $scope.menuItems = menuItems;
    $scope.articles = articlesList;
   $http.get('/api/articles',{responseType:'json'})
		.success(function(data, status, headers, config) {
			$scope.articles = angular.fromJson(data);
			//$scope.articles = angular.fromJson(data);
		})
		.error(function(data, status, headers, config) {
			// called asynchronously if an error occurs or server returns response with an error status.
			console.log('Oops an error occurse will looking to get the articles list!', data);
			$scope.articles = []; // Return an empty array
		})
		.then(function(response){
			console.log(response);		
			   $scope.articles = angular.fromJson(response.data);
		}).finally(function(){
			console.log('Get Comments Done!');
		});
	$scope.users = usersList;
	$scope.usersfilter = '';
	$scope.articleComments = [];
	/*$http.get('/api/comments',{responseType:'json'})
		.success(function(data, status, headers, config) {
			$scope.articleComments = angular.fromJson(data);
		})
		.error(function(data, status, headers, config) {
			// called asynchronously if an error occurs or server returns response with an error status.
			console.log('Oops an error occurse will looking to get the articles list!', data);
		})
		.then(function(response){
			console.log(response);		
		}).finally(function(){
			console.log('Get Comments Done!');
		});*/

    $scope.newComment = new Object();
    $scope.newComment.message = '';
    $scope.newComment.save= function(){
		var usr = $scope.user.Info.id;
		var idx = $scope.article.index;
		
		var artComments = $scope.articles[idx].comments;

		var msg = this.message + '(By #' + usr + 'On #' + idx + ')';
        
		$scope.articleComments.push({message:msg, author:usr});
		
		artComments.push({'message': msg, 'author': usr});
		
		console.log($scope.articles[idx].comments);
    };
	$scope.newComment.del= function(idx){
			console.log(' Delete Comment  : ' + idx) 
			var arLeft = $scope.articleComments.slice(0, idx );
			var arRight = $scope.articleComments.slice(idx+1, $scope.articleComments.length+1);
			$scope.articleComments = arLeft.concat(arRight);

			$scope.articles[$scope.article.index].comments = $scope.articleComments;
			console.log(arRight);
	};
	$scope.newComment.isAuthor = function(){
			if(this.authore && $scope.user.Info.id && this.authore == $scope.user.Info.id) 
				return true;
			else 
				return false;
	};
	$scope.newComment.isOwner = function(){
			if($scope.article.Details.author && $scope.user.Info.id && $scope.article.Details.authore == $scope.user.Info.id) 
				return true;
			else 
				return false;
	};
	
	
 //Article Model
 $scope.article = new Object();
//User Model
    $scope.user = new Object();
    //Default user is the guest
    $scope.user.Info = $scope.users[0];
    $scope.user.isWriter = function(){
            if( this.Info && this.Info.role === 'writer')
                return true;
            else 
                return false;
        };
    //2Be used for the comment on the post
    $scope.user.isAuthor = function(post){
        if(this.Info  && this.Info.id === post.author)
            return true;
        else 
            return false;
    };
    $scope.user.isOwner = function(post){
            if( this.Info && this.Info.role === 'writer' && this.Info.id === post.author) 
              {return true} 
            else {
                return false;
            }
        };
        
    $scope.user.set = function(idx){
        this.Info = angular.copy($scope.users[idx]);
        console.log('Showing User IDX= ',this.Info);
    };
    $scope.article.set = function(idx){
		this.index = idx;
        this.Details = angular.copy($scope.articles[idx]);
		$scope.articleComments = this.Details.comments;
        console.log('Selecting Articles IDX= '+idx,this.Details);
    };
//Article Model
    $scope.article.index = 0;    
    $scope.article.Details = $scope.articles[$scope.article.index];

   //Show Article Function
    $scope.article.show = function(idx){
        this.index = idx; 
        this.Details = angular.copy($scope.articles[idx]);//angular.copy(post);//
        $scope.articleComments = this.Details.comments;
        console.log('Showing article details....of #'+idx, $scope.article);
     };
    $scope.article.add = function(){
		   this.index = $scope.articles.length;
		   var dt = new Date();
		   var today = dt.getFullYear()+ '-' + dt.getMonth()+ '-' + dt.getDate();

		   var newPost = {title: $scope.article.Details.title, 
   	                               url: '/article/'+(this.index * 100),
                           publishedon: today,
                                author: $scope.user.Info.id,
			                  contents: $scope.article.Details.contents,
                              comments: []
                  	       };
   	       $scope.articles.push(newPost);
		   $scope.articleComments = newPost.comments;;
		   
    	console.log('Add Article Function...#'+this.index);
    };
    
    $scope.article.edit = function(){
		var idx = this.index;
		if($scope.articles[idx ]){
			$scope.articles[idx ].title = $scope.article.Details.title;
			$scope.articles[idx ].contents = $scope.article.Details.contents;
		}
		 
		console.log('Edit Function...');
		};
    
    $scope.article.del = function(){
		if(!angular.isNumber(this.index)) return;
		
		    var idx = this.index;
			var arLeft = $scope.articles;
			arLeft = arLeft.slice(0, idx );
			var arRight = $scope.articles.slice(idx+1, $scope.articles.length+1);
			$scope.articles = arLeft.concat(arRight);

			$scope.article.clear();

			
			console.log('Del Article Function...#'+	idx);
		
		};
    
    $scope.article.clear = function(){
        console.log('Clear Function..');
        this.Details = {title: 'N/S', 
                          url: '',
                  publishedOn: '', 
                           id: 0,
                       author: 0,
					 contents: '',
                      comments:[]};
		$scope.articleComments = this.Details.comments;
		this.index = $scope.articles.length;
		};
	
}]);

