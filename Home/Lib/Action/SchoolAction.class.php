<?php
// +----------------------------------------------------------------------
// | 校园生活 [ shzlife.com ]
// +----------------------------------------------------------------------
// | Copyright http://www.shzlife.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed: ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Oceanliao <1576701411@qq.com>
// +----------------------------------------------------------------------
import('ORG.Util.Session');
class SchoolAction extends Action 
{

	
	/*
	// +----------------------------------------------------------------------
	// |                       校园社区主页模块                              |
	// +----------------------------------------------------------------------
	*/

	public function index()
	{
            $username=$_SESSION['username'];//用户账号
            $userdata=M("user")->where("usernumber='$username'")->select();//找到用户数据
            $this->assign('userdata',$userdata);
            $this->assign('username',$username); 

			$community=M('community')->where(" only_me='0'")->order("good desc")->select();//校园话题
			$n=M('community')->where(" only_me='0'")->count();
			if($n<4)
			{
			    for($i=0;$i<$n;$i++)
				{
					$str = $community[$i]['message_more'];
					preg_match_all('/[\x{4e00}-\x{9fff}]+/u', $str, $matches);//过滤非汉字的字符
					$community[$i]['message_more'] = implode('', $matches[0]);
				}
				$this->assign('community',  $community);
			}

			else
			{
				for($i=0;$i<4;$i++)//返回赞数最多的前3条
				{
					$str = $community[$i]['message_more'];
					preg_match_all('/[\x{4e00}-\x{9fff}]+/u', $str, $matches);//过滤非汉字的字符
					$community[$i]['message_more'] = implode('', $matches[0]);
				}
				$this->assign('community',  $community);
			}


			$essay=M('essay')->where(" only_me='0'")->order("good desc")->select();//校园话题
			$n=M('essay')->where(" only_me='0'")->count();
			if($n<4)
			{
			    for($i=0;$i<$n;$i++)
				{
					$str = $essay[$i]['message_more'];
					preg_match_all('/[\x{4e00}-\x{9fff}]+/u', $str, $matches);//过滤非汉字的字符
					$essay[$i]['message_more'] = implode('', $matches[0]);
				}
				$this->assign('essay',  $essay);
			}

			else
			{
				for($i=0;$i<4;$i++)//返回赞数最多的前3条
				{
					$str = $essay[$i]['message_more'];
					preg_match_all('/[\x{4e00}-\x{9fff}]+/u', $str, $matches);//过滤非汉字的字符
					$essay[$i]['message_more'] = implode('', $matches[0]);
				}
				$this->assign('essay',  $essay);
			}





			$study=M('study')->where(" only_me='0'")->order("good desc")->select();//校园话题
			$n=M('study')->where(" only_me='0'")->count();
			if($n<4)
			{
			    for($i=0;$i<$n;$i++)
				{
					$str = $study[$i]['message_more'];
					preg_match_all('/[\x{4e00}-\x{9fff}]+/u', $str, $matches);//过滤非汉字的字符
					$study[$i]['message_more'] = implode('', $matches[0]);
				}
				$this->assign('study',  $study);
			}

			else
			{
				for($i=0;$i<4;$i++)//返回赞数最多的前3条
				{
					$str = $study[$i]['message_more'];
					preg_match_all('/[\x{4e00}-\x{9fff}]+/u', $str, $matches);//过滤非汉字的字符
					$study[$i]['message_more'] = implode('', $matches[0]);
				}
				$this->assign('study',  $study);
			}


			$video=M('video')->where(" only_me='0'")->order("good desc")->select();//校园话题
			$n=M('video')->where(" only_me='0'")->count();
			if($n<4)
			{
			    for($i=0;$i<$n;$i++)
				{
					$str = $video[$i]['message_more'];
					preg_match_all('/[\x{4e00}-\x{9fff}]+/u', $str, $matches);//过滤非汉字的字符
					$video[$i]['message_more'] = implode('', $matches[0]);
				}
				$this->assign('video',  $video);
			}

			else
			{
				for($i=0;$i<4;$i++)//返回赞数最多的前3条
				{
					$str = $video[$i]['message_more'];
					preg_match_all('/[\x{4e00}-\x{9fff}]+/u', $str, $matches);//过滤非汉字的字符
					$video[$i]['message_more'] = implode('', $matches[0]);
				}
				$this->assign('video',  $video);
			}

			$this->display();
	}

	/*
	// +----------------------------------------------------------------------
	// |                       校园社区子页模块                              |
	// +----------------------------------------------------------------------
	*/


	public function community()//校园话题
	{
            $username=$_SESSION['username'];//用户账号
            $userdata=M("user")->where("usernumber='$username'")->select();//找到用户数据
            $this->assign('userdata',$userdata);
            $this->assign('username',$username); 

	  		import("ORG.Util.AjaxPage");// 导入分页类  注意导入的是自己写的AjaxPage类
	        $credit = M('community')->where(" only_me='0'");//校园话题
	        $count = $credit->count(); //计算记录数
	        $limitRows = 16; // 设置每页记录数
	       
	        $p = new AjaxPage($count, $limitRows,"user"); //第三个参数是你需要调用换页的ajax函数名
	        $limit_value = $p->firstRow . "," . $p->listRows;
	       
	        //$data = $credit->where(" span_1='失物招领'")->order('id desc')->limit($limit_value)->select(); // 查询数据
			
			$data2=M('community')->where(" only_me='0'")->order('id DESC')->limit($limit_value)->select();//校园话题
			for($i=0;$i<sizeof($data2);$i++)
			{
				$str = $data2[$i]['message_more'];
				preg_match_all('/[\x{4e00}-\x{9fff}]+/u', $str, $matches);//过滤非汉字的字符
				$data2[$i]['message_more'] = implode('', $matches[0]);
				$data[$i]=$data2[$i];
			}
	        $page = $p->show(); // 产生分页信息，AJAX的连接在此处生成	       
			$this->assign('data',  $data);
			$this->assign('page',$page);
			$this->display();
	}


	public function essay()//文章随笔
	{
            $username=$_SESSION['username'];//用户账号
            $userdata=M("user")->where("usernumber='$username'")->select();//找到用户数据
            $this->assign('userdata',$userdata);
            $this->assign('username',$username); 

	  		import("ORG.Util.AjaxPage");// 导入分页类  注意导入的是自己写的AjaxPage类
	        $credit = M('essay')->where(" only_me='0'");//校园话题
	        $count = $credit->count(); //计算记录数
	        $limitRows = 16; // 设置每页记录数
	       
	        $p = new AjaxPage($count, $limitRows,"user"); //第三个参数是你需要调用换页的ajax函数名
	        $limit_value = $p->firstRow . "," . $p->listRows;
	       
	        //$data = $credit->where(" span_1='失物招领'")->order('id desc')->limit($limit_value)->select(); // 查询数据
			
			$data2=M('essay')->where(" only_me='0'")->order('id DESC')->limit($limit_value)->select();//校园话题
			for($i=0;$i<sizeof($data2);$i++)
			{
				$str = $data2[$i]['message_more'];
				preg_match_all('/[\x{4e00}-\x{9fff}]+/u', $str, $matches);//过滤非汉字的字符
				$data2[$i]['message_more'] = implode('', $matches[0]);
				$data[$i]=$data2[$i];
			}
	        $page = $p->show(); // 产生分页信息，AJAX的连接在此处生成	       
			$this->assign('data',  $data);
			$this->assign('page',$page);
			$this->display();
	}


	public function video()//校园视频
	{
            $username=$_SESSION['username'];//用户账号
            $userdata=M("user")->where("usernumber='$username'")->select();//找到用户数据
            $this->assign('userdata',$userdata);
            $this->assign('username',$username); 

	  		import("ORG.Util.AjaxPage");// 导入分页类  注意导入的是自己写的AjaxPage类
	        $credit = M('video')->where(" only_me='0'");//校园话题
	        $count = $credit->count(); //计算记录数
	        $limitRows = 16; // 设置每页记录数
	       
	        $p = new AjaxPage($count, $limitRows,"user"); //第三个参数是你需要调用换页的ajax函数名
	        $limit_value = $p->firstRow . "," . $p->listRows;
	       
	        //$data = $credit->where(" span_1='失物招领'")->order('id desc')->limit($limit_value)->select(); // 查询数据
			
			$data2=M('video')->where(" only_me='0'")->order('id DESC')->limit($limit_value)->select();//校园话题
			for($i=0;$i<sizeof($data2);$i++)
			{
				$str = $data2[$i]['message_more'];
				preg_match_all('/[\x{4e00}-\x{9fff}]+/u', $str, $matches);//过滤非汉字的字符
				$data2[$i]['message_more'] = implode('', $matches[0]);
				$data[$i]=$data2[$i];
			}
	        $page = $p->show(); // 产生分页信息，AJAX的连接在此处生成	       
			$this->assign('data',  $data);
			$this->assign('page',$page);
			$this->display();
	}


	public function study()//学习分享
	{
            $username=$_SESSION['username'];//用户账号
            $userdata=M("user")->where("usernumber='$username'")->select();//找到用户数据
            $this->assign('userdata',$userdata);
            $this->assign('username',$username); 

	  		import("ORG.Util.AjaxPage");// 导入分页类  注意导入的是自己写的AjaxPage类
	        $credit = M('study')->where(" only_me='0'");//校园话题
	        $count = $credit->count(); //计算记录数
	        $limitRows = 16; // 设置每页记录数
	       
	        $p = new AjaxPage($count, $limitRows,"user"); //第三个参数是你需要调用换页的ajax函数名
	        $limit_value = $p->firstRow . "," . $p->listRows;
	       
	        //$data = $credit->where(" span_1='失物招领'")->order('id desc')->limit($limit_value)->select(); // 查询数据
			
			$data2=M('study')->where(" only_me='0'")->order('id DESC')->limit($limit_value)->select();//校园话题
			for($i=0;$i<sizeof($data2);$i++)
			{
				$str = $data2[$i]['message_more'];
				preg_match_all('/[\x{4e00}-\x{9fff}]+/u', $str, $matches);//过滤非汉字的字符
				$data2[$i]['message_more'] = implode('', $matches[0]);
				$data[$i]=$data2[$i];
			}
	        $page = $p->show(); // 产生分页信息，AJAX的连接在此处生成	       
			$this->assign('data',  $data);
			$this->assign('page',$page);
			$this->display();
	}


	/*
	// +----------------------------------------------------------------------
	// |                       校园社区发布模块                              |
	// +----------------------------------------------------------------------
	*/

	function community_add()//话题发布
	{
			$this->display();
	}


	function community_add_pass()
	{

		    import('ORG.Net.UploadFile');//引入上传类
            $upload = new UploadFile();// 实例化上传类
            $upload->maxSize  = 3145728 ;// 设置附件上传大小
            $upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->savePath =  './Uploads/';// 设置附件上传目录
            $upload->thumb= ture; //设置缩略图
            $upload->thumbPrefix = 'thumb2_,thumb_';//生产2张缩略图
            $upload->thumbMaxWidth      = '730,300'; //设置缩略图最大宽度
            $upload->thumbMaxHeight     = '292,100';//设置缩略图最大高度           
            $upload->upload();
            $info =  $upload->getUploadFileInfo();
            // 保存表单数据 包括附件数据
            $username = session('username');//获取当前登陆用户名
            $User = M("community"); //连接表         
            $User->create(); //通过表中的字段名称与表单提交的名称对应关系自动封装数据实例             
            $User->mess_user = $username;//将当前用户名保存到username字段中
            $User->time = date("Y-m-d");            //保存当前时间
            if($info[0]['savename']!="")
            {
            	$User->img = $info[0]['savename']; // 保存上传的照片根据需要自行组装
        	}
            $i=$User->add(); // 写入用户数据到数据库
            if($i>0)
            {
                $this->redirect('../School/community'); 
            }
            else
            {
                $this->error('系统临时出了点小问题，请稍候再试');
            }
	}


   /*****************************************************/


	function essay_add()//文章发布
	{
			$this->display();
	}
	

	function essay_add_pass()
	{

		    import('ORG.Net.UploadFile');//引入上传类
            $upload = new UploadFile();// 实例化上传类
            $upload->maxSize  = 3145728 ;// 设置附件上传大小
            $upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->savePath =  './Uploads/';// 设置附件上传目录
            $upload->thumb= ture; //设置缩略图
            $upload->thumbPrefix = 'thumb2_,thumb_';//生产2张缩略图
            $upload->thumbMaxWidth      = '730,300'; //设置缩略图最大宽度
            $upload->thumbMaxHeight     = '292,100';//设置缩略图最大高度           
            $upload->upload();
            $info =  $upload->getUploadFileInfo();
            // 保存表单数据 包括附件数据
            $username = session('username');//获取当前登陆用户名
            $User = M("essay"); //连接表         
            $User->create(); //通过表中的字段名称与表单提交的名称对应关系自动封装数据实例             
            $User->mess_user = $username;//将当前用户名保存到username字段中
            $User->time = date("Y-m-d");//保存当前时间
            if($info[0]['savename']!="")
            {
            	$User->img = $info[0]['savename'];//保存上传的照片根据需要自行组装
        	}
            $i=$User->add(); // 写入用户数据到数据库
            if($i>0)
            {
                $this->redirect('../School/essay'); 
            }
            else
            {
                $this->error('系统临时出了点小问题，请稍候再试');
            }
	}


	/***********************************************************************/


	function video_add()
	{
			$this->display();
	}
	

	function video_add_pass()
	{
			import('ORG.Net.UploadFile');//引入上传类
            $upload = new UploadFile();// 实例化上传类
            $upload->maxSize  = 3145728 ;// 设置附件上传大小
            $upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->savePath =  './Uploads/';// 设置附件上传目录
            $upload->thumb= ture; //设置缩略图
            $upload->thumbPrefix = 'thumb2_,thumb_';//生产2张缩略图
            $upload->thumbMaxWidth      = '730,300'; //设置缩略图最大宽度
            $upload->thumbMaxHeight     = '292,100';//设置缩略图最大高度           
            $upload->upload();
            $info =  $upload->getUploadFileInfo();


            $username = session('username');//获取当前登陆用户名
            $User = M("video"); //连接表         
            $User->create(); //通过表中的字段名称与表单提交的名称对应关系自动封装数据实例   
            $video = substr($_POST['video'],29,15);
            $User->video=$video;          
            $User->mess_user = $username;//将当前用户名保存到username字段中
            $User->time = date("Y-m-d");            //保存当前时间
            if($info[0]['savename']!="")
            {
            	$User->img = $info[0]['savename'];//保存上传的照片根据需要自行组装
        	}            
            $i=$User->add(); // 写入用户数据到数据库
            if($i>0)
            {
                $this->redirect('../School/video'); 
            }
            else
            {
                $this->error('系统临时出了点小问题，请稍候再试');
            }
	}


	/*******************************************************************************/

	function study_add()
	{
			$this->display();
	}
	

	function study_add_pass()
	{

		    import('ORG.Net.UploadFile');//引入上传类
            $upload = new UploadFile();// 实例化上传类
            $upload->maxSize  = 3145728 ;// 设置附件上传大小
            $upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->savePath =  './Uploads/';// 设置附件上传目录
            $upload->thumb= ture; //设置缩略图
            $upload->thumbPrefix = 'thumb2_,thumb_';//生产2张缩略图
            $upload->thumbMaxWidth      = '730,300'; //设置缩略图最大宽度
            $upload->thumbMaxHeight     = '292,100';//设置缩略图最大高度           
            $upload->upload();
            $info =  $upload->getUploadFileInfo();
            // 保存表单数据 包括附件数据
            $username = session('username');//获取当前登陆用户名
            $User = M("study"); //连接表         
            $User->create(); //通过表中的字段名称与表单提交的名称对应关系自动封装数据实例             
            $User->mess_user = $username;//将当前用户名保存到username字段中
            $User->time = date("Y-m-d");            //保存当前时间
            if($info[0]['savename']!="")
            {
            	$User->img = $info[0]['savename']; // 保存上传的照片根据需要自行组装
        	}
            $i=$User->add(); // 写入用户数据到数据库
            if($i>0)
            {
                $this->redirect('../School/study'); 
            }
            else
            {
                $this->error('系统临时出了点小问题，请稍候再试');
            }
	}

	/*
	// +----------------------------------------------------------------------
	// |                       校园社区查看详细内容模块                      |
	// +----------------------------------------------------------------------
	*/


		function community_more()
		{
            $username=$_SESSION['username'];//用户账号
            $userdata=M("user")->where("usernumber='$username'")->select();//找到用户数据
            $this->assign('userdata',$userdata);
            $this->assign('username',$username); 

			$User = M("community"); //连接表
			$mes_id=$_GET['id'];
			Session::set('community_more_id',$mes_id);//将message_id存入session;
			$data = M('community')->where(" id='$mes_id'")->select();  //获得所有行

			$mess_user=$data[0]['mess_user'];//获得用户昵称
			$mess_user=M("user")->where("usernumber='$mess_user'")->getField('username');
			$data[0]['mess_user']=$mess_user;
			$this->assign('data',  $data);


	        $look = $User->where(" id='$mes_id'")->getField('look');  //获得浏览次数 
	        $User->look=$look+1;
	        $User->where(" id='$mes_id'")->save();	

			$this->display();

		}

		function essay_more()
		{
            $username=$_SESSION['username'];//用户账号
            $userdata=M("user")->where("usernumber='$username'")->select();//找到用户数据
            $this->assign('userdata',$userdata);
            $this->assign('username',$username); 

			$User = M("essay"); //连接表
			$mes_id=$_GET['id'];
			Session::set('essay_more_id',$mes_id);//将message_id存入session;
			$data = M('essay')->where(" id='$mes_id'")->select();  //获得所有行
			
			$mess_user=$data[0]['mess_user'];//获得用户昵称
			$mess_user=M("user")->where("usernumber='$mess_user'")->getField('username');
			$data[0]['mess_user']=$mess_user;
			$this->assign('data',  $data);

	        $look = $User->where(" id='$mes_id'")->getField('look');  //获得浏览次数 
	        $User->look=$look+1;
	        $User->where(" id='$mes_id'")->save();	

			$this->display();

		}

		function video_more()
		{
			$username=$_SESSION['username'];//用户账号
            $userdata=M("user")->where("usernumber='$username'")->select();//找到用户数据
            $this->assign('userdata',$userdata);
            $this->assign('username',$username); 

			$User = M("video"); //连接表
			$mes_id=$_GET['id'];
			Session::set('video_more_id',$mes_id);//将message_id存入session;
			$data = M('video')->where(" id='$mes_id'")->select();  //获得所有行
			
			$mess_user=$data[0]['mess_user'];//获得用户昵称
			$mess_user=M("user")->where("usernumber='$mess_user'")->getField('username');
			$data[0]['mess_user']=$mess_user;			
			$this->assign('data',  $data);

	        $look = $User->where(" id='$mes_id'")->getField('look');  //获得浏览次数 
	        $User->look=$look+1;
	        $User->where(" id='$mes_id'")->save();				
			$this->display();

		}

		function study_more() 
		{



            $username=$_SESSION['username'];//用户账号
            $userdata=M("user")->where("usernumber='$username'")->select();//找到用户数据
            $this->assign('userdata',$userdata);
            $this->assign('username',$username); 

			$User = M("study"); //连接表
			$mes_id=$_GET['id'];
			Session::set('study_more_id',$mes_id);//将message_id存入session;
			$data = M('study')->where(" id='$mes_id'")->select();  //获得所有行

			$mess_user=$data[0]['mess_user'];//获得用户昵称
			$mess_user=M("user")->where("usernumber='$mess_user'")->getField('username');
			$data[0]['mess_user']=$mess_user;				
			$this->assign('data',  $data);

	        $look = $User->where(" id='$mes_id'")->getField('look');  //获得浏览次数 
	        $User->look=$look+1;
	        $User->where(" id='$mes_id'")->save();	

			$this->display();
		}						


	/*
    // +----------------------------------------------------------------------
    // |                       校园社区话题发布评论模块                      |
    // +----------------------------------------------------------------------
    */   

    public function comment_community()//详细信息界面　留言
    {
    	if(htmlspecialchars($_GET['message'])=="")
    	{
    		$this->ajaxReturn($_GET,'内容为空',2);     
    	}

    	else
    	{

            $usernumber=session('username');
            $community_more_id=session('community_more_id');
            $evl=M("community")->where("id='$community_more_id'")->getField('evl');//获得当前消息评论次数
            M("community")->evl=$evl+1;
            M("community")->where("id='$community_more_id'")->save();//存入评论次数
            $img=M("user")->where("usernumber='$usernumber'")->getField('img'); //获得留言用户头像 
            $nickname=M("user")->where("usernumber='$usernumber'")->getField('username');//获得昵称



            $m=M("comment_community");
            $m->username = session('username');
            $m->message_id= session('community_more_id');
            $m->img=$img;
            $m->nickname=$nickname;            
            $m->message= htmlspecialchars($_GET['message']);
            $m->time= date("Y-m-d");

            if($m->add())
            {       
                $this->ajaxReturn($_GET,'添加信息成功',1);     
            }
            else
            {  
                $this->ajaxReturn(0,'添加信息失败',0);   
            }   
        }
    }


    public function look_community()//显示留言
    {
	        $message_id= session('community_more_id');
	        $data=M("comment_community")->where(" message_id = '$message_id' ")->order('id desc')->select();
	        $n=M('comment_community')->where(" message_id = '$message_id' ")->count();
	        for ($i=0; $i<$n; $i++) { 
	        	$data[$i]['message']=htmlspecialchars_decode($data[$i]['message']);
	        }
	        $this->ajaxReturn($data);
    }   




    public function comment_essay()//详细信息界面　留言
    {
    	if(htmlspecialchars($_GET['message'])=="")
    	{
    		$this->ajaxReturn($_GET,'内容为空',2);     
    	}

    	else
    	{

            $usernumber=session('username');
            $essay_more_id=session('essay_more_id');
            $evl=M("essay")->where("id='$essay_more_id'")->getField('evl');//获得当前消息评论次数
            M("essay")->evl=$evl+1;
            M("essay")->where("id='$essay_more_id'")->save();//存入评论次数
            $img=M("user")->where("usernumber='$usernumber'")->getField('img'); //获得留言用户头像 
            $nickname=M("user")->where("usernumber='$usernumber'")->getField('username');//获得昵称



            $m=M("comment_essay");
            $m->username = session('username');
            $m->message_id= session('essay_more_id');
            $m->img=$img;
            $m->nickname=$nickname;            
            $m->message= htmlspecialchars($_GET['message']);
            $m->time= date("Y-m-d");

            if($m->add())
            {       
                $this->ajaxReturn($_GET,'添加信息成功',1);     
            }
            else
            {  
                $this->ajaxReturn(0,'添加信息失败',0);   
            }   
        }
    }


    public function look_essay()//显示留言
    {
	        $message_id= session('essay_more_id');
	        $data=M("comment_essay")->where(" message_id = '$message_id' ")->order('id desc')->select();
	        $n=M('comment_essay')->where(" message_id = '$message_id' ")->count();
	        for ($i=0; $i<$n; $i++) { 
	        	$data[$i]['message']=htmlspecialchars_decode($data[$i]['message']);
	        }
	        $this->ajaxReturn($data);
    }   




    public function comment_study()//详细信息界面　留言
    {
    	if(htmlspecialchars($_GET['message'])=="")
    	{
    		$this->ajaxReturn($_GET,'内容为空',2);     
    	}

    	else
    	{

            $usernumber=session('username');
            $study_more_id=session('study_more_id');
            $evl=M("study")->where("id='$study_more_id'")->getField('evl');//获得当前消息评论次数
            M("study")->evl=$evl+1;
            M("study")->where("id='$study_more_id'")->save();//存入评论次数
            $img=M("user")->where("usernumber='$usernumber'")->getField('img'); //获得留言用户头像 
            $nickname=M("user")->where("usernumber='$usernumber'")->getField('username');//获得昵称



            $m=M("comment_study");
            $m->username = session('username');
            $m->message_id= session('study_more_id');
            $m->img=$img;
            $m->nickname=$nickname;            
            $m->message= htmlspecialchars($_GET['message']);
            $m->time= date("Y-m-d");

            if($m->add())
            {       
                $this->ajaxReturn($_GET,'添加信息成功',1);     
            }
            else
            {  
                $this->ajaxReturn(0,'添加信息失败',0);   
            }   
        }
    }


    public function look_study()//显示留言
    {
	        $message_id= session('study_more_id');
	        $data=M("comment_study")->where(" message_id = '$message_id' ")->order('id desc')->select();
	        $n=M('comment_study')->where(" message_id = '$message_id' ")->count();
	        for ($i=0; $i<$n; $i++) { 
	        	$data[$i]['message']=htmlspecialchars_decode($data[$i]['message']);
	        }
	        $this->ajaxReturn($data);
    } 




    public function comment_video()//详细信息界面　留言
    {
    	if(htmlspecialchars($_GET['message'])=="")
    	{
    		$this->ajaxReturn($_GET,'内容为空',2);     
    	}

    	else
    	{

            $usernumber=session('username');
            $video_more_id=session('video_more_id');
            $evl=M("video")->where("id='$video_more_id'")->getField('evl');//获得当前消息评论次数
            M("video")->evl=$evl+1;
            M("video")->where("id='$video_more_id'")->save();//存入评论次数
            $img=M("user")->where("usernumber='$usernumber'")->getField('img'); //获得留言用户头像 
            $nickname=M("user")->where("usernumber='$usernumber'")->getField('username');//获得昵称



            $m=M("comment_video");
            $m->username = session('username');
            $m->message_id= session('video_more_id');
            $m->img=$img;
            $m->nickname=$nickname;            
            $m->message= htmlspecialchars($_GET['message']);
            $m->time= date("Y-m-d");

            if($m->add())
            {       
                $this->ajaxReturn($_GET,'添加信息成功',1);     
            }
            else
            {  
                $this->ajaxReturn(0,'添加信息失败',0);   
            }   
        }
    }


    public function look_video()//显示留言
    {
	        $message_id= session('video_more_id');
	        $data=M("comment_video")->where(" message_id = '$message_id' ")->order('id desc')->select();
	        $n=M('comment_video')->where(" message_id = '$message_id' ")->count();
	        for ($i=0; $i<$n; $i++) { 
	        	$data[$i]['message']=htmlspecialchars_decode($data[$i]['message']);
	        }
	        $this->ajaxReturn($data);
    }      
	/*
    // +----------------------------------------------------------------------
    // |                        赞模块                                       |
    // +----------------------------------------------------------------------
    */
    public function good_community()//校园话题
    {
        $User=M("community");//实例化表
        $id=$_SESSION['community_more_id'];//获得当前消息ID
        $good = $User->where("  id = '$id'  ")->getField('good');  //获得浏览次数 
        $User->find($id); // 查找主键为$id的数据
        $User->good=$good+1;
        $i=$User->save();

        if(!$i)
        {
            $data=0;
            $this->ajaxReturn($data);
        }

        else
        {
             $data=$good+1;
             $this->ajaxReturn($data);
        }
    } 

    public function good_essay()//校园文章
    {
        $User=M("essay");//实例化表
        $id=$_SESSION['essay_more_id'];//获得当前消息ID
        $good = $User->where("  id = '$id'  ")->getField('good');  //获得浏览次数 
        $User->find($id); // 查找主键为$id的数据
        $User->good=$good+1;
        $i=$User->save();

        if(!$i)
        {
            $data=0;
            $this->ajaxReturn($data);
        }

        else
        {
             $data=$good+1;
             $this->ajaxReturn($data);
        }
    } 


    public function good_study()//校园文章
    {
        $User=M("study");//实例化表
        $id=$_SESSION['study_more_id'];//获得当前消息ID
        $good = $User->where("  id = '$id'  ")->getField('good');  //获得浏览次数 
        $User->find($id); // 查找主键为$id的数据
        $User->good=$good+1;
        $i=$User->save();

        if(!$i)
        {
            $data=0;
            $this->ajaxReturn($data);
        }

        else
        {
             $data=$good+1;
             $this->ajaxReturn($data);
        }
    }


    public function good_video()//校园文章
    {
        $User=M("video");//实例化表
        $id=$_SESSION['video_more_id'];//获得当前消息ID
        $good = $User->where("  id = '$id'  ")->getField('good');  //获得浏览次数 
        $User->find($id); // 查找主键为$id的数据
        $User->good=$good+1;
        $i=$User->save();

        if(!$i)
        {
            $data=0;
            $this->ajaxReturn($data);
        }

        else
        {
             $data=$good+1;
             $this->ajaxReturn($data);
        }
    }                   	

}

?>