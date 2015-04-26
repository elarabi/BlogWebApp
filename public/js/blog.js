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

app.factory('articlesList',function(){
   var articles = [    
               {title: 'article-01', url: '/article/1',publishedon:'2015-Jan-01', id: 1, author:102,comments:[]},
               {title: 'article-02', url: '/article/2',publishedon:'2015-Feb-02', id: 2, author:100,comments:[]},
               {title: 'article-03', url: '/article/3',publishedon:'2015-Mar-03', id: 3, author:100,comments:[]},
               {title: 'article-04', url: '/article/4',publishedon:'2015-Apl-04', id: 4, author:103,comments:[]},
               {title: 'article-05', url: '/article/5',publishedon:'2015-Apl-05', id: 5, author:102,comments:[]},
               {title: 'article-06', url: '/article/1',publishedon:'2015-Jan-31', id: 6, author:102,comments:[]},
               {title: 'article-07', url: '/article/2',publishedon:'2015-Feb-22', id: 7, author:100,comments:[]},
               {title: 'article-08', url: '/article/3',publishedon:'2015-Mar-13', id: 8, author:100,comments:[]},
               {title: 'article-09', url: '/article/4',publishedon:'2015-Apl-14', id: 9, author:103,comments:[]},
               {title: 'article-10', url: '/article/5',publishedon:'2015-Apl-15', id: 10, author:102,comments:[]},
    ];
   return articles;
    //$http({method: 'GET', url: '/todo/list'})
    $http.get('/articles').
       success(function(data, status, headers, config){
       
         console.log('Get articles-list .'+data.length+'.. ');
         return data;
      
  }).
   error(function(data, status, headers, config) {
    // called asynchronously if an error occurs or server returns response with an error status.
   console.log('Oops an error occurse will looking to get the articles list!', data);
   data = []; // Return an empty array
    return data;
  });
return articles;
});

app.controller('blogCtrl',['$scope', '$http', 'menuItems', 'articlesList','usersList',
                            function($scope, $http, menuItems, articlesList, usersList){
    $scope.menuItems = menuItems;
    $scope.articles = articlesList;
    $scope.users = usersList;
    $scope.newComment = new Object();
    $scope.newComment.message = '';
    $scope.newComment.save= function(){
        $scope.articleComments.push({message:this.message,author:$scope.user.Info.id});
    };
 //Article Model
 $scope.article = new Object();
//User Model
    $scope.user = new Object();
    //Default user is the guest
    $scope.user.Info = $scope.users[0];
    $scope.user.isWriter = function(){
            if( this.Info && this.Info.role == 'writer')
                return true;
            else 
                return false;
        };
    $scope.user.isAuthor = function(post){
        if(this.Info && this.Info.role == 'writer' && this.Info.id == post.author)
            return true;
        else 
            return false;
    };
    $scope.user.isOwner = function(post){
            if( this.Info && this.Info.role == 'writer' && this.Info.id == post.author) 
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
        this.Details = angular.copy($scope.articles[idx]);
        console.log('Showing Articles IDX= ',this.Details);
    };
//Article Model
    $scope.article.Details = $scope.articles[0];
   //Show Article Function
    $scope.article.show = function(idx){
         $scope.postDetails = angular.copy($scope.articles[idx]);
        this.Details = angular.copy($scope.articles[idx]);//angular.copy(post);//
        $scope.articleComments = this.Details.comments;
        $scope.articleComments.push({message:'show article details....of By'+$scope.userInfo.id,author:$scope.user.Info.id});
        console.log('show article details....of #',$scope.article);
     };
    $scope.article.add = function(){console.log('Add Function..');};
    
    $scope.article.edit = function(){console.log('Edit Function..');};
    
    $scope.article.del = function(){console.log('Del Function..');};
    
    $scope.article.clear = function(){
        console.log('Clear Function..');
        this.Details = {title: 'N/S', 
                          url: '',
                  publishedOn: '', 
                           id: 0,
                       author: 0,
                      comments:[]};
    };
}]);

