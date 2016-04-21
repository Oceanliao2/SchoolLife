
    var ionicApp = angular.module('ionicApp', ['ionic'])
    .config(function($stateProvider, $urlRouterProvider,$ionicConfigProvider) {


 $ionicConfigProvider.platform.ios.tabs.style('standard'); 
        $ionicConfigProvider.platform.ios.tabs.position('bottom');
        $ionicConfigProvider.platform.android.tabs.style('standard');
        $ionicConfigProvider.platform.android.tabs.position('standard');

        $ionicConfigProvider.platform.ios.navBar.alignTitle('center'); 
        $ionicConfigProvider.platform.android.navBar.alignTitle('left');

        $ionicConfigProvider.platform.ios.backButton.previousTitleText('').icon('ion-ios-arrow-thin-left');
        $ionicConfigProvider.platform.android.backButton.previousTitleText('').icon('ion-android-arrow-back');        

        $ionicConfigProvider.platform.ios.views.transition('ios'); 
        $ionicConfigProvider.platform.android.views.transition('android');













      $stateProvider
        .state('tabs', {
          url: "/tab",
          abstract: true,
          templateUrl: "templates/tabs.html"
        })

        .state('tabs.home', { //主页
          url: "/home",
          views: {
            'home-tab': {
              templateUrl: "templates/home.html",
              controller: 'HomeTabCtrl'
            }
          }
        })

        .state('tabs.part', { //社区
          url: "/part",
          views: {
            'part-tab': {
              templateUrl: "part.html",
              controller: 'HomeTabCtrl'
            }
          }
        })

        .state('tabs.add', { //发布
          url: "/add",
          views: {
            'add-tab': {
              templateUrl: "add.html",
              controller: 'HomeTabCtrl'
            }
          }
        })


        .state('tabs.my', { //我的
          url: "/my",
          views: {
            'my-tab': {
              templateUrl: "my.html",
              controller: 'HomeTabCtrl'
            }
          }
        })


        .state('tabs.two', {  //二手信息
          url: "/two",
          views: {
            'home-tab': {
              templateUrl: "two.html"
            }
          }
        })


        .state('tabs.lose', {  //失物招领
          url: "/lose",
          views: {
            'home-tab': {
              templateUrl: "lose.html"
            }
          }
        })


        .state('tabs.find', {  //寻物启事
          url: "/find",
          views: {
            'home-tab': {
              templateUrl: "find.html"
            }
          }
        })

        .state('tabs.play', {  //校园活动
          url: "/play",
          views: {
            'home-tab': {
              templateUrl: "play.html"
            }
          }
        })

        .state('tabs.talk', {  //校园话题
          url: "/talk",
          views: {
            'home-tab': {
              templateUrl: "talk.html"
            }
          }
        })

        .state('tabs.essay', {  //文章
          url: "/essay",
          views: {
            'home-tab': {
              templateUrl: "essay.html"
            }
          }
        })


        .state('tabs.video', {  //视频
          url: "/video",
          views: {
            'home-tab': {
              templateUrl: "video.html"
            }
          }
        })


        .state('tabs.study', {  //学习
          url: "/study",
          views: {
            'home-tab': {
              templateUrl: "study.html"
            }
          }
        })

        .state('tabs.message_more', {  //详细信息          
          cache: false,
          url: "/message_more",
          views: {
            'home-tab': {
              templateUrl: "message_more.html"
            }
          }
        })


       $urlRouterProvider.otherwise("/tab/home");//通知框架刷新完成
    })

    .controller('HomeTabCtrl', function($scope,$http,$rootScope,$ionicSideMenuDelegate) {
      console.log('HomeTabCtrl');


      $scope.toggleLeft = function() {//侧栏菜单
        $ionicSideMenuDelegate.toggleLeft();
      };



       $rootScope.message_more = function(id) {//查看详细信息
            $http.get('/index.php/MobelFirst/look_message_more', {params: {id:id}
            }).success(function(data) {
                //加载成功之后做一些事
                $rootScope.messageMore=data;
            }).error(function(data) {
                //处理错误
                $rootScope.messageMore=0;
            });
        };

        $scope.cutString = function(str, len){
            //length属性读出来的汉字长度为1

            if(str.length*2 <= len) {
                return str;
            }
            var strlen = 0;
            var s = "";
            for(var i = 0;i < str.length; i++) {
                s = s + str.charAt(i);
                if (str.charCodeAt(i) > 128) {
                    strlen = strlen + 2;
                    if(strlen >= len){
                        return s.substring(0,s.length-1) + "...";
                    }
                } else {
                    strlen = strlen + 1;
                    if(strlen >= len){
                        return s.substring(0,s.length-2) + "...";
                    }
                }
            }
            return s;
        };






        $scope.doRefresh = function() {    //下拉刷新函数
          $http.get('/index.php/MobelFirst/new_lose')//失物招领
          .success(function(data) {
                //加载成功之后做一些事
                $scope.lose=data;
            }).error(function(data) {
                //处理错误
                $scope.lose=0;
          });


          $http.get('/index.php/MobelFirst/new_two')//二手交易
          .success(function(data) {
                //加载成功之后做一些事
                $scope.two=data;
            }).error(function(data) {
                //处理错误
                $scope.two=0;
          });

          $http.get('/index.php/MobelFirst/new_part')//最近活动
          .success(function(data) {
                //加载成功之后做一些事
                $scope.new_part=data;
            }).error(function(data) {
                //处理错误
                $scope.new_part=0;
          });

          $http.get('/index.php/MobelFirst/new_find')//寻物启事
          .success(function(data) {
                //加载成功之后做一些事
                $scope.find=data;
            }).error(function(data) {
                //处理错误
                $scope.find=0;
          });

          $http.get('/index.php/MobelFirst/new_other')//其他
          .success(function(data) {
                //加载成功之后做一些事
                $scope.other=data;
            }).error(function(data) {
                //处理错误
                $scope.other=0;
          }); 


          $scope.$broadcast('scroll.refreshComplete');
          };


          $http.get('/index.php/MobelFirst/new_lose')//失物招领
          .success(function(data) {
                //加载成功之后做一些事
                $scope.lose=data;
            }).error(function(data) {
                //处理错误
                $scope.lose=0;
          });


          $http.get('/index.php/MobelFirst/new_two')//二手交易
          .success(function(data) {
                //加载成功之后做一些事
                $scope.two=data;
            }).error(function(data) {
                //处理错误
                $scope.two=0;
          });

          $http.get('/index.php/MobelFirst/new_part')//最近活动
          .success(function(data) {
                //加载成功之后做一些事
                $scope.new_part=data;
            }).error(function(data) {
                //处理错误
                $scope.new_part=0;
          });

          $http.get('/index.php/MobelFirst/new_find')//寻物启事
          .success(function(data) {
                //加载成功之后做一些事
                $scope.find=data;
            }).error(function(data) {
                //处理错误
                $scope.find=0;
          });

          $http.get('/index.php/MobelFirst/new_other')//其他
          .success(function(data){
                //加载成功之后做一些事
                $scope.other=data;
            }).error(function(data) {
                //处理错误
                $scope.other=0;
          });   

  });
