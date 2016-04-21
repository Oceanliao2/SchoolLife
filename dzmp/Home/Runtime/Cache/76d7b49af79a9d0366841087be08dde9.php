<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
  <head>
  
   <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <meta name="author" content="" />
    
    <link rel="stylesheet" type="text/css" href="__CSS__/demo.css" />

  
  
  
  
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title>电子名片管理系统</title>
    <meta name="description" content="">
    <meta name="author" content="templatemo">
    
    <link href='http://fonts.useso.com/css?family=Open+Sans:400,300,400italic,700' rel='stylesheet' type='text/css'>
    <link href="__CSS__/font-awesome.min.css" rel="stylesheet">
    <link href="__CSS__/bootstrap.min.css" rel="stylesheet">
    <link href="__CSS__/templatemo-style.css" rel="stylesheet">
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="__JS__/html5shiv.min.js"></script>
      <script src="__JS__/respond.min.js"></script>
    <![endif]-->

    <link href="__CSS__/Untitled-1.css" rel="stylesheet" type="text/css">
  </head>
  <body>  
    <!-- Left column -->
    <div class="templatemo-flex-row">
  
      <div class="templatemo-sidebar" style="position:fixed">
        <header class="templatemo-site-header">
          <div class="square"></div>
          <h1>电子名片管理系统</h1>
        </header>
        <div class="profile-photo-container"></div>  

        <p>
    
        <!-- Search box -->
        </p>
        <p>&nbsp; </p>
        <div class="mobile-menu-icon">
            <i class="fa fa-bars"></i>
        </div>
        <nav class="templatemo-left-nav">          
          <ul>
            <li><a href="index1.html"></i>浏览</a></li>
            <li><a href="index2.html"></i>新增</a></li>
            
            <li><a href="#" class="active"><i class="fa fa-home fa-fw"></i>回收站</a></li>
          </ul>  
        </nav>
      </div>



  <div id="box_relative" style=" width:80%; margin-top:13px;display:inline-block; background:#1f2124;">

<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="message">
      <div class="user_image">
      <img src="__UPLOADS__/thumb_<?php echo ($vo["img"]); ?>">
      </div>
      <div class="mess">
        <h1><?php echo ($vo["name"]); ?></h1>
        <p><?php echo ($vo["job"]); ?></p>
        <p>办公室电话:<?php echo ($vo["tel"]); ?></p>
        <p>手机电话：<?php echo ($vo["phone"]); ?> &nbsp;&nbsp;传真：<?php echo ($vo["fix"]); ?></p>
      </div>

	  <a href="__URL__/save/id/<?php echo ($vo["id"]); ?>">
         <button class="B_look">恢复</button>
      </a>
      <a href="javascript:if(confirm('确实要删除吗?'))location='__URL__/rel_del/id/<?php echo ($vo["id"]); ?>'">
        <button class="B_delete">彻底删除</button>
      </a>
    </div><?php endforeach; endif; else: echo "" ;endif; ?>
  </div> 


</div>  
</body>
</html>