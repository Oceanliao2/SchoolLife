<?php if (!defined('THINK_PATH')) exit();?>
<style type="text/css">
  .bank
  {
    width: 30px;
    height: 30px;
    background-color: #107272;
    color:#fff;
    text-decoration:none;
    padding: 3px;
    font-size: 16px;
    text-align: center;
    padding-top:7px; 
    border-radius: 5px;
  }

</style>

<ion-header-bar class="bar-positive" style="background-color: #009999;">
  <a class="bank" href="#/tab/home"><i class="ion-ios-arrow-back"></i></a>              
  <div style="margin-left:auto; margin-right:auto; height:20px; width:50%;">
    <span class="ion-ios-search-strong search_ico"></span>
    <form action="http://www.baidu.com/s?">
      <input class="ion-ios-search-strong" type="text" placeholder="二手信息/失物招领">
      <input type="submit" style="display:none">                 
    </form>
  </div>
  <span class="ion-android-menu usermenu_ico" data-pack="android" data-tags=""></span>
</ion-header-bar>


<ion-view>
  <ion-content class="padding">
   文章随笔
   <a class="button icon ion-home" href="#/tab/home"> Home</a>
  </ion-content>
</ion-view>