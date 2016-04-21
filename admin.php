<?php

	/**
 	* 系统调试设置
 	* 项目正式部署后请设置为false
 	*/
	define ( 'APP_DEBUG', true );

    //定义项目名称
    define('APP_NAME', 'Admin');
    //定义项目路径
    define('APP_PATH', './Admin/');
    //加载框架入文件
    require './ThinkPHP/ThinkPHP.php';