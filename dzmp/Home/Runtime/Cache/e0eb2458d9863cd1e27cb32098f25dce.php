<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" name="viewport" /> 
</head>
<style type="text/css">
	*
	{
		margin: 0px;
		padding: 0px;
	}

	a
	{
		 text-decoration: none;
	}

	hr
	{
		width: 100%;
		border: 0px;
		border-bottom: 1px solid #ccc;
	}

	body
	{
		width: 100%;
		background: url(__UPLOADS__/bg.jpg);
		overflow-x: hidden;

	}


	.header
	{
		width: 100%;
		display: inline-block;
		overflow: hidden;
	}

	.header img
	{
		max-width:100%;
	}


	.user_img
	{
		max-width: 30%;
		display: inline-block;
		margin-left: 10%
	}

	.user_img img
	{
		max-width: 100%;
		border-radius: 10px;
		border: 2px solid #fff;
	}

	.message
	{
		width: 70%;
		display: inline-block;
		text-align: left;
		line-height: 30px;
	}

	.message h1
	{
		float: left;
	}

	.user_name
	{
		width: 100%;
		display: inline-block;
		text-align: center;
		font-size: 25px;
		font-weight: 900;
		position: relative;
		top: -90px;
		margin-left: 40px;

	}

	.user_name small
	{
		font-size: 13px;
		font-weight: 0;
	}


	.work
	{
		width: 100%;
		height: 30px;
		background-color: black;
		opacity: 0.5;
		position: absolute;
		text-align: center;
		color: #fff;
		line-height: 30px;
		font-weight: 900;
		margin-top: 30px;
	}

	.bottom
	{
		width: 100%;
		height: 45px;
		background-color: #eee;
		border-top: 1px solid #ccc;
		position: fixed;
		bottom: 0px;
		padding-top: 5px;
		overflow: hidden;
	}

	.bottom_bar
	{
		width: 100%;
		height: 55px;
	}
	
	.bottom span
	{
		height: 40px;
		padding: 10px;
		padding-left: 20px;
		padding-right: 20px;
		text-align: center;
		line-height: 40px;
		background-color: #fff;
		color: #666;
		border: 1px solid #ccc;
	}

	.Main
	{
		width: 100%;
		overflow: hidden;
	}


</style>
<body>
<div class="Main">


<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="work">
<?php echo ($vo["company"]); ?>
</div>
<div class="header">
	<a href="http://wap.koudaitong.com/v2/showcase/feature?alias=rnvmd7nj&sf=wx_menu"><img src="__UPLOADS__/thumb3_<?php echo ($vo["background"]); ?>" class="alpha"></a>
</div>
<div class="user_img">
	<img src="__UPLOADS__/thumb4_<?php echo ($vo["img"]); ?>">
</div>

<center>

	<div class="user_name">
		<?php echo ($vo["name"]); ?>
		<small><?php echo ($vo["job"]); ?></small>
	</div>
	<hr>
	<div class="message">
	办公室电话：<?php echo ($vo["tel"]); ?><br/>
	手机：<?php echo ($vo["phone"]); ?><br/>
	传真：<?php echo ($vo["fix"]); ?><br/>

		<div style="width:100%; word-break:break-all">
		个人简介：<?php echo ($vo["personal_text"]); ?>
		</div>
	</div>
</center>

<div class="bottom_bar"></div>
<div class="bottom">
<center>
	<a href="tel:<?php echo ($vo["phone"]); ?>">
	<span>拨号</span>
	</a>
	<a href="http://tfyyc.fangxun.net/index.php">
	<span>官网</span>
	</a>
	<a href="http://wap.koudaitong.com/v2/showcase/feature?alias=rnvmd7nj&sf=wx_menu">
	<span>阿香微店</span>
	</a>
</center>
</div><?php endforeach; endif; else: echo "" ;endif; ?>
<!--


<a href="tel:<?php echo ($vo["tel"]); ?>"></a>

-->

</div>
</body>
</html>