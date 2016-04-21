<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title>无标题文档</title>


<style type="text/css">
*
{ 
	margin:0; 
	padding:0;
}

body
{
	/*background:url(__UPLOADS__/2.jpg); */
	background-size:100%;
	overflow-x:hidden;
}

.body
{
	position: absolute;
	top: 0px;
	left: 0px;
	width: 100%;
	height: 100%;
	z-index: -1;
}

.body img
{
	width: 100%;
	height: 100%;
	z-index: -1;
	-webkit-filter: blur(10px); /* Chrome, Opera */
    -moz-filter: blur(10px);
    -ms-filter: blur(10px);    
    filter: blur(10px);
    filter: progid:DXImageTransform.Microsoft.Blur(PixelRadius=10, MakeShadow=false); /* IE6~IE9 */

}


#head
{
	height:65px; 
	width:100%; 
	color: #fff;
	background-color: #000;
	opacity: 0.5;
	line-height: 65px;
	font-size:0.7em;
}

#main
{
	width:100%; 
	display: inline-block;
	margin-top: 10px;
}


#phpo
{
	width: 136px;
	height: 180px;
	border: 2px solid #fff;
	border-radius: 10px;
}

#message
{
	width: 60%;
	line-height: 30px;
	font-weight: 900;
	color: #333;
	margin-left: 20px;
	text-align: left;
	margin-top: 10px;
}

#foot
{ 
	height:65px; 
	width:100%;
	opacity: 0.5;
	background:#000; 
	position:fixed; 
	bottom:0;
}
button
{
	height:40px;
	margin-top: 15px;
	border: 0px;
	padding-left: 10px;
	padding-right: 10px;
	background-color: #666;
	color: #fff;
}
</style>

</head>
<body>
<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="body">
	<img src="__UPLOADS__/<?php echo ($vo["background"]); ?>">
</div>


<div id="head">
	<center>
		<h2>石河子市新思路农业科技有限公司</h2>
	</center>
</div>

<div id="main">
<center>
	<img src="__UPLOADS__/thumb2_<?php echo ($vo["img"]); ?>" id="phpo">

	<div id="message">
		<p>姓名：<?php echo ($vo["name"]); ?></p>
		<p>工作：<?php echo ($vo["job"]); ?></p>
		<p>办公室电话：<?php echo ($vo["tel"]); ?></p>
		<p>手机：<?php echo ($vo["phone"]); ?></p>
		<p>传真<?php echo ($vo["fix"]); ?></p>
	</div>
	</center>	
</div>
<!--
<div id="main">
	<center><img src="__UPLOADS__/thumb2_<?php echo ($vo["img"]); ?>" /></center><br/>
	<center><h3><?php echo ($vo["name"]); ?></h3></center><br/>
	<center><h3><?php echo ($vo["job"]); ?></h3></center><br/>
	&nbsp;&nbsp;办公室电话：<?php echo ($vo["tel"]); ?><br/>
	&nbsp;&nbsp;手机电话：<?php echo ($vo["phone"]); ?><br/>
	&nbsp;&nbsp;传真：<?php echo ($vo["fix"]); ?><br/>
</div>
-->
<div id="foot">
	<center>
	<a href="tel:<?php echo ($vo["tel"]); ?>">
		<button>拨号</button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

		<button>官网</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<button>地图导航</button>
	</center>
</div><?php endforeach; endif; else: echo "" ;endif; ?>
</body>
</html>