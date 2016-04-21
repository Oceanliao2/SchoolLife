<?php if (!defined('THINK_PATH')) exit();?><html ng-app="ionicApp">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">
    <title>欢迎来到校园生活网</title> 
    <script src="__JS__/jquery.min.js"></script>   
    <script src="__MOBEL__/ionic/js/ionic.bundle.min.js"></script>
    <link href="__MOBEL__/ionic/css/ionic.min.css" rel="stylesheet">
    <link href="__MOBEL__/mobel.css" rel="stylesheet">
    <script src="__MOBEL__/mobel.js"></script>   
  </head>
  <body>          
    <ion-nav-view></ion-nav-view><!-- 封装了滑动切换效果-->
  </body>

  <!-- ===============
  底部导航
  =================-->
    <script id="templates/tabs.html" type="text/ng-template">
<ion-side-menus>

<!-- //中间内容 -->
<ion-side-menu-content>
      <ion-tabs class="tabs-icon-top">
        <ion-tab title="主页" icon-on="ion-ios-home" icon-off="ion-ios-home-outline" href="#/tab/home">
          <ion-nav-view name="home-tab"></ion-nav-view>
        </ion-tab>

        <ion-tab title="社区" icon-on="ion-ios-paw" icon-off="ion-ios-paw-outline" href="#/tab/part">
          <ion-nav-view name="part-tab"></ion-nav-view>
        </ion-tab>

        <ion-tab title="发布" icon-on="ion-social-instagram" icon-off="ion-social-instagram-outline" href="#/tab/add">
          <ion-nav-view name="add-tab"></ion-nav-view>
        </ion-tab>

        <ion-tab title="我的" icon-on="ion-ios-person" icon-off="ion-ios-person-outline" href="#/tab/my">
          <ion-nav-view name="my-tab"></ion-nav-view>
        </ion-tab>
      </ion-tabs>
</ion-side-menu-content>


  <!-- //左侧菜单 -->
  <ion-side-menu side="left">
        <ion-content class="has-header">
          <ion-list>
            <ion-item nav-clear menu-close href="#/app/search">
                 设置    
            </ion-item>
            <ion-item nav-clear menu-close href="#/app/browse">
              关于我们
            </ion-item>
            <ion-item nav-clear menu-close href="#/app/playlists">
              意见反馈
            </ion-item>
          </ion-list>
        </ion-content>
  </ion-side-menu>

</ion-side-menus>

    </script>
  <!-- ===============
  主页
  =================-->
    <script id="templates/home.html" type="text/ng-template">
      <ion-view>
      <ion-header-bar class="bar-positive" style="background-color: #009999;">
        <a menu-toggle="left">
        <span class="ion-android-menu usermenu_ico" data-pack="android" data-tags=""></span>             
        </a>
       <!-- //<a menu-toggle="left" class="button icon ion-navicon"></a>-->

        <div class="top_center">主页</div>        
        <span class="ion-ios-search-strong search_ico"></span>     
      </ion-header-bar>

        <ion-content class="ico">
        <ion-refresher pulling-text="下拉刷新" spinner="lines" on-refresh="doRefresh()"></ion-refresher>
        <!--/* <ul>
         <li><div class="ico_div"></div><div class="ico_div_2"><span class=""></span></div></li>
         <li><div class="ico_div"></div><div class="ico_div_2"><span class=""></span></div></li>
         <li><div class="ico_div"></div><div class="ico_div_2"><span class=""></span></div></li>
         <li><div class="ico_div"></div><div class="ico_div_2"><span class=""></span></div></li>
         <li><div class="ico_div"></div><div class="ico_div_2"><span class=""></span></div></li>
         <li><div class="ico_div"></div><div class="ico_div_2"><span class=""></span></div></li>
         <li><div class="ico_div"></div><div class="ico_div_2"><span class=""></span></div></li>
         <li><div class="ico_div"></div><div class="ico_div_2"><span class=""></span></div></li>
         </ul>*/-->
          <ul>
            <a  href="#/tab/two">
            <li><img src="__IMAGES__/ico_two.png"></li>
            </a>
            <a  href="#/tab/lose">
            <li><img src="__IMAGES__/ico_lose.png"></li>
            </a>
            <a  href="#/tab/find">
            <li><img src="__IMAGES__/ico_find.png"></li>
            </a>
            <a  href="#/tab/play">
            <li><img src="__IMAGES__/ico_part.png"></li>
            </a>
            <a  href="#/tab/talk">
            <li><img src="__IMAGES__/ico_talk.png"></li>
            </a>
            <a  href="#/tab/essay">
            <li><img src="__IMAGES__/ico_essay.png"></li>
            </a>
            <a  href="#/tab/video">
            <li><img src="__IMAGES__/ico_video.png"></li>
            </a>
            <a  href="#/tab/study">
            <li><img src="__IMAGES__/ico_study.png"></li>
            </a>
          </ul>  

          <div class="barr"></div>

          <div class="title">校园活动</div>
          <hr/>
          <div class="PartBody">
          <div class="part">
            <img src="__UPLOADS__/thumb_{{new_part[0].part_image}}">
            <p>{{cutString(new_part[0].part_name,10)}}</p>         
          </div>
          <div class="part2">
            <img src="__UPLOADS__/thumb_{{new_part[1].part_image}}">
            <p>{{cutString(new_part[1].part_name,10)}}</p>                      
            <!--/*<p ng-bind-html = "x.part_message">{{x.part_message}}</p> */   -->                        
          </div>
          </div>

          <div class="barr"></div>

          <div class="title">二手交易</div>
          <hr/>
          <div ng-repeat="x in two"> 
            <a href="#/tab/message_more" ng-click="message_more('{{x.id}}')" class="link">
              <div class="two" >
                <img onerror="this.src='__IMAGES__/img_error.png'" src="__UPLOADS__/thumb_{{x.image}}">
                <p style="font-weight:900;">{{cutString(x.message_tittle,10)}}</p>
                <small style="color:#666;">{{cutString(x.message_more,50)}}</small>
                <p style="font-weight:900;color:#009999;">{{cutString(x.span_2,20)}}</p>  
              </div>
            </a>
          </div>

          <div class="title">失物招领</div>
          <hr/>
          <div ng-repeat="x in lose"> 
            <a href="#/tab/message_more" ng-click="message_more('{{x.id}}')" class="link">
              <div class="two" >
                <img onerror="this.src='__IMAGES__/img_error.png'" src="__UPLOADS__/thumb_{{x.image}}">
                <p style="font-weight:900;">{{cutString(x.message_tittle,10)}}</p>
                <small style="color:#666;">{{cutString(x.message_more,50)}}</small>
                <p style="font-weight:900;color:#009999;">{{x.span_2}}</p>  
              </div>
            </a>
          </div>


          <div class="title">寻物启事</div>
          <hr/>
          <div ng-repeat="x in find"> 
            <a href="#/tab/message_more" ng-click="message_more('{{x.id}}')" class="link">
              <div class="two" >
                <img onerror="this.src='__IMAGES__/img_error.png'" src="__UPLOADS__/thumb_{{x.image}}">
                <p style="font-weight:900;">{{cutString(x.message_tittle,10)}}</p>
                <small style="color:#666;">{{cutString(x.message_more,50)}}</small>
                <p style="font-weight:900;color:#009999;">{{x.span_2}}</p>  
              </div>
            </a>
          </div>


          <div class="title">其他信息</div>
          <hr/>
          <div ng-repeat="x in other"> 
            <a href="#/tab/message_more" ng-click="message_more('{{x.id}}')" class="link">
              <div class="two" >
                <img onerror="this.src='__IMAGES__/img_error.png'" src="__UPLOADS__/thumb_{{x.image}}">
                <p style="font-weight:900;">{{cutString(x.message_tittle,10)}}</p>
                <small style="color:#666;">{{cutString(x.message_more,50)}}</small>
                <p style="font-weight:900;color:#009999;">{{x.span_2}}</p>  
              </div>
            </a>
          </div>
        </ion-content>
      </ion-view>
    </script> 
</html>