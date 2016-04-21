<?php if (!defined('THINK_PATH')) exit();?>

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
    <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="two">
          <img onerror="this.src='__IMAGES__/img_error.png'" src="__UPLOADS__/thumb_<?php echo ($vo['image']); ?>">
          <p style="font-weight:900;"><?php echo (subtext($vo['message_tittle'],5)); ?></p>
          <small style="color:#666;"><?php echo (subtext($vo['message_more'],25)); ?></small>
          <p style="font-weight:900;color:#009999;"><?php echo ($vo['span_2']); ?></p>            
        </div><?php endforeach; endif; else: echo "" ;endif; ?>
  </ion-content>
</ion-view>