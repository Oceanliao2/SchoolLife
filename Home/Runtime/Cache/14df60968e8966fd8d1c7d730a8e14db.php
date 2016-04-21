<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
   <title>石河子大学校园生活网</title>
   <meta name="keywords" content="二手信息,失物招领,寻物启事,其他信息,校园活动,校园话题,文章随笔,视频分享,学习分享" />
   <meta name="description" content="校园生活网是集二手信息,失物招领,寻物启事,其他信息,校园活动,校园话题,文章随笔,视频分享,学习分享等信息发布平台。享受最便捷的校园生活服务" />

   <meta name="baidu-site-verification" content="aV4t8MQNt7" />
   <meta property="qc:admins" content="11365763666302416563757" />
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
   <metahttp-equiv="X-UA-Compatible"content="IE=9; IE=8; IE=7; IE=EDGE">
   <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
   <meta name="renderer" content="webkit">
   <link href="__MOBEL__/ionic/css/ionicons.min.css" rel="stylesheet">
   <link href="__CSS__/index.css" rel="stylesheet">
   <link rel="shortcut icon" href="__IMAGES__/logo.ico">
   <script src="__JS__/jquery.min.js"></script>
<script type="text/javascript">
/*百度抓取*/
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?20cd0f2b5487fe3553f387cd9ac3c967";
  var s = document.getElementsByTagName("script")[0];
  s.parentNode.insertBefore(hm, s);
})();

function cutString(str, len) {

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
}
/*................*/

      $.get("__URL__/username",'',function(data){
        if(data==1)
        {
        	$(".user").css("display","block");
        	$(".show").css("display","none");
			$(".user").click(function(){
			    $(".scroll_block2").slideToggle();
			});
        }

        else
        {

            $(".show").css("display","block");
        	$(".user").css("display","none");
			$(".show").click(function(){
			    $(".scroll_block").slideToggle();
			});
        }
      },'json');

</script>
</head>
<body>
<center>
	<div class="header">
		<div class="header_bar">
		<ul>
			<li ><a href="__APP__/Message/two.html" class="active">二手</a></li>
			<li><a href="__APP__/Message/lose.html">失物</a></li>
			<li><a href="__APP__/Message/find.html">寻物</a></li>
			<li><a href="__APP__/Message/other.html">其他</a></li>
			<li><a href="__APP__/Part">活动</a></li>
			<li><a href="__APP__/School/community">话题</a></li>
			<li><a href="__APP__/School/essay">随笔</a></li>
			<li><a href="__APP__/School/video">视频</a></li>
			<li><a href="__APP__/School/study">学习</a></li>
			<li style="margin-left:60px; width:180px;">
			<form method="post" action='__APP__/Search/search' id="form2">
				<input type="text" placeholder="搜索" style="padding-left:10px; color:#fff" class="search">
				<span class="ion-ios-search-strong"></span>
				<input type="submit" style="display:none">
			</form>
			</li>
			<li style="margin-left:20px;" class="show">
				<span style="font-size:30px;" class="ion-android-person"></span>
			</li>
			<li class="user">
				<img  id="img" onerror="this.src='__IMAGES__/35.jpg'"  src="__UPLOADS__/thumb_<?php echo ($userdata[0]['img']); ?>">
			</li>
		</ul>
		</div>
	</div>
	<div class="scroll">
	<div class="scroll_center" id="NoLogin">
		<div class="scroll_block">
			<ul>
			   <a href="__APP__/User/login"> <li>登录</li></a>
			   <a href="__APP__/User/add">   <li>注册</li></a>
			   <a href="__APP__/First/essay"><li>关于我们</li></a>
			</ul>
		</div>
		<div class="scroll_center" id="Login">
			<div class="scroll_block2">
				<ul>
				   <a href="__APP__/Usercenter"> <li>个人中心</li></a>
				   <a href="#"><li>消息中心</li></a>
				   <a href="__APP__/User/logout"><li>退出登录</li></a>
				</ul>
			</div>
		</div>
	</div>
	</div>

	<div class="content">
		<div class="content_left">
			<?php if(is_array($part)): $i = 0; $__LIST__ = array_slice($part,0,1,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="content_left_img">
			    <a href="__APP__/Part/message_more/id/<?php echo ($vo['id']); ?>">
				<img src="__UPLOADS__/thumb2_<?php echo ($vo['part_image']); ?>">
				</a>
			</div>
			<a href="__APP__/Part/message_more/id/<?php echo ($vo['id']); ?>">
			<h1><?php echo (subtext($vo['part_name'],10)); ?></h1>
			</a>
			<p><?php echo (subtext($vo['part_message'],100)); ?></p>

			<p style="margin-top:40px;">
			<a href="__APP__/Part/message_more/id/<?php echo ($vo['id']); ?>">
				查看详情
			</a>
			<span class="ion-ios-redo" style="font-size:15px;"></span>
			&nbsp &nbsp &nbsp
			<span class="ion-ios-chatboxes-outline" style="font-size:15px;"></span>
			评论：21
			&nbsp
			<span class="ion-ios-eye" style="font-size:15px;"></span>
			浏览：23
			</p><?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
		<div class="content_right">
		    <?php if(is_array($part)): $i = 0; $__LIST__ = array_slice($part,0,1,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="content_right_message">
				   <a href="__APP__/Part/message_more/id/<?php echo ($vo['id']); ?>">
				   <img src="__UPLOADS__/thumb_<?php echo ($vo['part_image']); ?>">
				   </a>
				   <a href="__APP__/Part/message_more/id/<?php echo ($vo['id']); ?>">
				   <h1><?php echo (subtext($vo['part_name'],5)); ?></h1>
				   </a>
				   <p><?php echo (subtext($vo['part_message'],30)); ?></p>
				   <p style="color:#666">
				   <a href="__APP__/Part/message_more/id/<?php echo ($vo['id']); ?>">
				   查看详情
				   </a>
			       <span class="ion-ios-redo" style="font-size:15px;"></span>
				   </p>
				</div><?php endforeach; endif; else: echo "" ;endif; ?>
			<?php if(is_array($part2)): $i = 0; $__LIST__ = array_slice($part2,0,1,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="content_right_message">
				    <a href="__APP__/Part/message_more/id/<?php echo ($vo['id']); ?>">
					<img src="__UPLOADS__/thumb_<?php echo ($vo['part_image']); ?>">
					</a>
					<a href="__APP__/Part/message_more/id/<?php echo ($vo['id']); ?>">
					<h1><?php echo (subtext($vo['part_name'],5)); ?></h1>
					</a>

				   <p><?php echo (subtext($vo['part_message'],30)); ?></p>
				   <p style="color:#666">
				   <a href="__APP__/Part/message_more/id/<?php echo ($vo['id']); ?>">
				   查看详情
				   </a>
			       <span class="ion-ios-redo" style="font-size:15px;"></span>
				   </p>
				</div><?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
	</div>

	<div class="main">
		<div class="main_title">
		校园最新文章
		</div>
		<div class="main_title2"></div>
		<ul>
		<?php if(is_array($essay)): $i = 0; $__LIST__ = array_slice($essay,0,2,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
			<a href="__APP__/School/essay_more/id/<?php echo ($vo['id']); ?>">
		    <img src="__UPLOADS__/thumb_<?php echo ($vo['img']); ?>">
		    </a>
		    <a href="__APP__/School/essay_more/id/<?php echo ($vo['id']); ?>">
			<p><?php echo (subtext($vo['message_tittle'],13)); ?></p>
			</a>
			<small><?php echo (subtext($vo['message_more'],38)); ?></small>

			<small style="margin-top:10px; color:#000">
			<a href="__APP__/School/essay_more/id/<?php echo ($vo['id']); ?>">
			查看详情
			</a>
			<span class="ion-ios-redo" style="font-size:15px;"></span>
			&nbsp
			<span class="ion-ios-chatboxes-outline" style="font-size:15px;"></span>
			评论：21
			&nbsp
			<span class="ion-ios-eye" style="font-size:15px;"></span>
			浏览：23
			</small>
		</li><?php endforeach; endif; else: echo "" ;endif; ?>

		<?php if(is_array($community)): $i = 0; $__LIST__ = array_slice($community,0,2,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
			<a href="__APP__/School/community_more/id/<?php echo ($vo['id']); ?>">
		    <img src="__UPLOADS__/thumb_<?php echo ($vo['img']); ?>">
		    </a>
		    <a href="__APP__/School/community_more/id/<?php echo ($vo['id']); ?>">
			<p><?php echo (subtext($vo['message_tittle'],13)); ?></p>
			</a>
			<small><?php echo (subtext($vo['message_more'],38)); ?></small>
			<small style="margin-top:10px; color:#000">
			<a href="__APP__/School/community_more/id/<?php echo ($vo['id']); ?>">
			查看详情
			</a>
			<span class="ion-ios-redo" style="font-size:15px;"></span>
			&nbsp
			<span class="ion-ios-chatboxes-outline" style="font-size:15px;"></span>
			评论：21
			&nbsp
			<span class="ion-ios-eye" style="font-size:15px;"></span>
			浏览：23
			</small>
		</li><?php endforeach; endif; else: echo "" ;endif; ?>
		</ul>
	</div>

	<div class="hot">
		<div class="hot_left">
			<div class="hot_left_title">失物招领/寻物启事</div>
			<div class="hot_left_title2"></div>
			<ul>
			<?php if(is_array($school_info)): $i = 0; $__LIST__ = array_slice($school_info,0,3,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="__APP__/Message/message_more/id/<?php echo ($vo['id']); ?>">
				<li><img onerror="this.src='__IMAGES__/img_error.png'" src="__UPLOADS__/thumb_<?php echo ($vo['image']); ?>"></li>
				</a><?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
			<ol>
				<?php if(is_array($school_info)): $i = 0; $__LIST__ = array_slice($school_info,3,4,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
					<span class="list">1</span>
					<a href="__APP__/Message/message_more/id/<?php echo ($vo['id']); ?>">
					<p>最新<?php echo ($vo['span_1']); ?>：<?php echo (subtext($vo['message_tittle'],5)); ?>
						&nbsp
						<span class="ion-ios-chatboxes-outline" style="font-size:15px;"></span>
						评论：21
						&nbsp
						<span class="ion-ios-eye" style="font-size:15px;"></span>
						浏览：23
					</p>
					</a>
				</li>
				<hr><?php endforeach; endif; else: echo "" ;endif; ?>
			</ol>
		</div>
		<div class="hot_right">
			<div class="hot_left_title">二手交易/其他信息</div>
			<div class="hot_left_title2"></div>
			<ul>
			<?php if(is_array($school_info)): $i = 0; $__LIST__ = array_slice($school_info,7,3,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="__APP__/Message/message_more/id/<?php echo ($vo['id']); ?>">
				<li><img onerror="this.src='__IMAGES__/img_error.png'" src="__UPLOADS__/thumb_<?php echo ($vo['image']); ?>"></li>
				</a><?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
			<ol>
				<?php if(is_array($school_info)): $i = 0; $__LIST__ = array_slice($school_info,11,4,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
					<span class="list">1</span>
					<a href="__APP__/Message/message_more/id/<?php echo ($vo['id']); ?>">
					<p>最新<?php echo ($vo['span_1']); ?>：<?php echo (subtext($vo['message_tittle'],5)); ?>
						&nbsp
						<span class="ion-ios-chatboxes-outline" style="font-size:15px;"></span>
						评论：21
						&nbsp
						<span class="ion-ios-eye" style="font-size:15px;"></span>
						浏览：23
					</p>
					</a>
				</li>
				<hr><?php endforeach; endif; else: echo "" ;endif; ?>
			</ol>
		</div>
	</div>

	<div class="message">
		<div class="message_left">
			<div class="message_left_l">
				<div class="message_left_t"></div>
				<h1>分享</h1>
				<hr>
				<small>同学们可以在这<br>里分享你们的学习经验</small>
			</div>
			<?php if(is_array($study)): $i = 0; $__LIST__ = array_slice($study,0,1,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="__APP__/School/study_more/id/<?php echo ($vo['id']); ?>">
				<div class="message_left_r1">
					<p><?php echo (subtext($vo["message_tittle"],8)); ?></p>
					<small><?php echo (subtext($vo["message_more"],52)); ?></small>
					<hr>
					<small>

						<span class="ion-ios-chatboxes-outline" style="font-size:15px;"></span>
						评论：21
						&nbsp
						<span class="ion-ios-eye" style="font-size:15px;"></span>
						浏览：23
					</small>
				</div>
			</a><?php endforeach; endif; else: echo "" ;endif; ?>
			<?php if(is_array($study)): $i = 0; $__LIST__ = array_slice($study,1,1,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="__APP__/School/study_more/id/<?php echo ($vo['id']); ?>">
			<div class="message_left_r2">
					<p><?php echo (subtext($vo["message_tittle"],8)); ?></p>
					<small><?php echo (subtext($vo["message_more"],52)); ?></small>
					<hr>
					<small>

						<span class="ion-ios-chatboxes-outline" style="font-size:15px;"></span>
						评论：21
						&nbsp
						<span class="ion-ios-eye" style="font-size:15px;"></span>
						浏览：23
					</small>
			</div>
			</a><?php endforeach; endif; else: echo "" ;endif; ?>
			<?php if(is_array($study)): $i = 0; $__LIST__ = array_slice($study,2,1,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="__APP__/School/study_more/id/<?php echo ($vo['id']); ?>">
			<div class="message_left_r3">
					<p><?php echo (subtext($vo["message_tittle"],8)); ?></p>
					<small><?php echo (subtext($vo["message_more"],52)); ?></small>
					<hr>
					<small>

						<span class="ion-ios-chatboxes-outline" style="font-size:15px;"></span>
						评论：21
						&nbsp
						<span class="ion-ios-eye" style="font-size:15px;"></span>
						浏览：23
					</small>
			</div>
			</a><?php endforeach; endif; else: echo "" ;endif; ?>
			<?php if(is_array($study)): $i = 0; $__LIST__ = array_slice($study,3,1,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="__APP__/School/study_more/id/<?php echo ($vo['id']); ?>">
			<div class="message_left_r4">
					<p><?php echo (subtext($vo["message_tittle"],8)); ?></p>
					<small><?php echo (subtext($vo["message_more"],52)); ?></small>
					<hr>
					<small>

						<span class="ion-ios-chatboxes-outline" style="font-size:15px;"></span>
						评论：21
						&nbsp
						<span class="ion-ios-eye" style="font-size:15px;"></span>
						浏览：23
					</small>
			</div>
			</a><?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
		<div class="message_center">
				<div class="message_center_t"></div>
				<h1>视频</h1>
				<hr>
				<small>同学们可以在这<br>里分享你们的学习经验</small>
		</div>
		<div class="message_right">
				<div class="message_right_t"></div>
				<h1>美图</h1>
				<hr>
				<small>同学们可以在这<br>里分享你们的学习经验</small>
		</div>
	</div>

	<div class="footer">
	<div class="footer_center">

	<p>校园生活网从建设以来立志为同学们提供最便捷的校园生活服务;
网站如今由石河子大学信息科学与技术学院软件开发部开发与维护,
我们非常欢迎有兴趣的同学前来加入我们，一起进步；</p>
	<a href="__APP__/First/essay">
	<p>
		关于我们 /  源码下载 /  联系我们 /  意见反馈
	</p>
	</a>
	<a href="http://www.rkshzu.cn/wp/">
	<p>
		友情链接：石大软件开发部
	</p>
	</a>
	</div>
	</div>

</center>
</body>
</html>