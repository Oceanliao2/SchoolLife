<?php if (!defined('THINK_PATH')) exit();?><ion-header-bar class="bar-positive" style="background-color: #009999;">
  <a class="bank" href="#/tab/home"><i class="ion-ios-arrow-back"></i></a>              
  <div class="top_center">
    详细信息
  </div>
  <span class="ion-android-menu usermenu_ico" data-pack="android" data-tags=""></span>
</ion-header-bar>

<ion-view>
  <ion-content>
    <div ng-repeat="x in messageMore" class="messageMore"> 
        <img onerror="this.src='__IMAGES__/img_error_2.png'" src="__UPLOADS__/thumb2_{{x.image}}"> 
        <div class="messageMoreBody">
          {{x.message_tittle}}<br>
          {{x.span_1}} 发布时间：{{x.time}}<br>
          {{x.span_2}}<br>
          相关信息:{{x.span_3}}{{x.span_3}}<br>
          浏览次数:{{x.look_number}}<br>　
          评论次数:{{x.comment}}<br>　
          发布者信息<br>
          {{x.qq}}<br>
          {{x.tel}}<br>
          {{x.message_more}}<br>
        </div>
    </div>
  </ion-content>
</ion-view>