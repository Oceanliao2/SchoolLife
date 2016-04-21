<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" name="viewport" /> 
</head>
<body>
<center>
<h1>欢迎登录电子名片管理系统</h1>
	<form id="form" name="form" method="post" action="__URL__/login_pass" enctype="multipart/form-data">
		用户名：<input type="text" name="username"><br><br>
		密码： &nbsp<input type="password" name="password"><br><br>

		<input type="submit" value="登录">

	</form>
</center>
</body>
</html>