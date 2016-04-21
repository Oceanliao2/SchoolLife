<?php
// +----------------------------------------------------------------------
// | 校园生活 [ shzulife.com ]
// +----------------------------------------------------------------------
// | Copyright http://www.shzulife.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed: ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Oceanliao <1576701411@qq.com>
// +----------------------------------------------------------------------
import('ORG.Util.Session');
class UsercenterAction extends Action //用户登录注册模块
{


	function index()
	{    

        if($_SESSION['username']==""){$this->error('你还未登陆');}

		$m=M("user");
		$U=$_SESSION['username'];//用户账号
		$data=$m->where("usernumber='$U'")->select();//找到用户数据
		$this->assign('data',$data);


		$school_info=M("message_2")->where("message_username='$U'")->count();
		$this->assign('school_info',$school_info);

		$school_part=M("part")->where("username='$U'")->count();
		$this->assign('school_part',$school_part);

		$school_community=M("community")->where("mess_user='$U'")->count();
		$school_essay=M("essay")->where("mess_user='$U'")->count();
		$school_video=M("video")->where("mess_user='$U'")->count();
		$school_study=M("study")->where("mess_user='$U'")->count();

		$school=$school_community+$school_essay+$school_video+$school_study;
		$this->assign('school',$school);
		$this->display();

	}  

	function user_updata()//用户基本信息修改
	{
		if($_SESSION['username']==""){$this->error('你还未登陆');}
		$m=M("user");
		$U=$_SESSION['username'];//用户账号
		$data=$m->where("usernumber='$U'")->select();//找到用户数据
		$this->assign('data',$data);
		$this->display();
	}

	function user_updata_pass()//用户基本信息修改验证
	{
		if($_SESSION['username']==""){$this->error('你还未登陆');}
	    $Dao = M("user");

	    // 需要更新的数据
	    $data['username'] = $_POST['username'];
	    $data['tel'] = $_POST['tel'];
	    $data['qq'] = $_POST['qq'];
	    $data['s_year'] = $_POST['s_year'];
	    // 更新的条件
	    $condition['usernumber'] = $_SESSION['username'];
	    $result = $Dao->where($condition)->save($data);
	    //或者：$resul t= $Dao->where($condition)->data($data)->save();


	    if($result !== false)
	    {
	        $this->redirect('../Usercenter/index');
	    }

	    else
	    {
	        $this->error('系统临时出了点小问题，请稍候再试');
	    }
	}


    /*
    // +----------------------------------------------------------------------
    // |                       校园信息个人中心                              |
    // +----------------------------------------------------------------------
    */   

	public function school_info()
	{
		$m=M("message_2");
		$U=$_SESSION['username'];//用户账号
		$inf_two = $m->where(" span_1='二手交易' AND message_username='$U'")->order('id DESC')->select();  //获得所有行
		$inf_lose = $m->where(" span_1='失物招领' AND message_username='$U'")->order('id DESC')->select();  //获得所有行
		$inf_find = $m->where(" span_1='寻物启事' AND message_username='$U'")->order('id DESC')->select();  //获得所有行
		$inf_other = $m->where(" span_1='其他' AND message_username='$U'")->order('id DESC')->select();  //获得所有行
		$this->assign('inf_two',$inf_two);
		$this->assign('inf_lose',$inf_lose);
		$this->assign('inf_find',$inf_find);
		$this->assign('inf_other',$inf_other);
		$this->display();
	}

	public function info_updata_two()//显示二手信息修改页面
	{
		$id=$_GET["id"];
		Session::set('info_updata_two_id',$id);//将id存入session;

		$m=M("message_2");
		$data=$m->where("id='$id'")->select();
		$data[0]['span_3'] = substr($data[0]['span_3'],15);
		$data[0]['span_2'] = substr($data[0]['span_2'],3);
		$data[0]['span_4'] = substr($data[0]['span_4'],9);
		$this->assign('data',$data);
		$this->display();
	}

	public function info_updata_two_pass()//二手信息修改验证
	{


		if($_SESSION['username']==""){$this->error('你还未登陆');}
		    
	    import('ORG.Net.UploadFile');//引入上传类
        $upload = new UploadFile();// 实例化上传类
        $upload->maxSize  = 3145728 ;// 设置附件上传大小
        $upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->savePath =  './Uploads/';// 设置附件上传目录
        $upload->thumb= ture; //设置缩略图
        $upload->thumbPrefix = 'thumb2_,thumb_';//生产2张缩略图
        $upload->thumbMaxWidth      = '400,200'; //设置缩略图最大宽度
        $upload->thumbMaxHeight     = '400,200';//设置缩略图最大高度 
        $upload->upload();//上传
        $info =  $upload->getUploadFileInfo();//获得上传信息

	    // 需要更新的数据
 	    $Dao = M("message_2");
	    $Dao->create();//组装数据
		if($info[0]['savename']!=$img[0]['image'])
        {
            $Dao->image = $info[0]['savename']; // 保存上传的照片根据需要自行组装
        }

        if($info[1]['savename']!=$img[0]['img2'])
        {
            $Dao->img2 = $info[1]['savename']; // 保存上传的照片根据需要自行组装
        }

        if($info[2]['savename']!=$img[0]['img3'])
        {
            $Dao->img3 = $info[2]['savename']; // 保存上传的照片根据需要自行组装
        }

        if($info[3]['savename']!=$img[0]['img4'])
        {
            $Dao->img4 = $info[3]['savename']; // 保存上传的照片根据需要自行组装
        }

		
		$Dao->span_2 = '￥'.$_POST['span_2']; 
        $Dao->span_3 = '新旧程度：'.$_POST['span_3']; 
        $Dao->span_4 = '原价：'.$_POST['span_4']; 


	    // 更新的条件
	    $condition['id'] = $_SESSION['info_updata_two_id'];
	    //更新
	    $result = $Dao->where($condition)->save();

	    if($result !== false)
	    {
	        $this->redirect('../Usercenter/school_info');
	    }

	    else
	    {
	        $this->error('系统临时出了点小问题，请稍候再试');
	    }
	}

	public function info_updata_find()//寻物启事修改页面
	{
		if($_SESSION['username']==""){$this->error('你还未登陆');}
		$id=$_GET["id"];
		Session::set('info_updata_two_id',$id);//将id存入session;
		$m=M("message_2");
		$data=$m->where("id='$id'")->select();
		$data[0]['span_3'] = substr($data[0]['span_3'],15);
		$data[0]['span_2'] = substr($data[0]['span_2'],15);
		$data[0]['span_4'] = substr($data[0]['span_4'],18);
		$this->assign('data',$data);
		$this->display();
	}

	public function info_updata_find_pass()//寻物启事修改验证
	{
		if($_SESSION['username']==""){$this->error('你还未登陆');}

		import('ORG.Net.UploadFile');//引入上传类
        $upload = new UploadFile();// 实例化上传类
        $upload->maxSize  = 3145728 ;// 设置附件上传大小
        $upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->savePath =  './Uploads/';// 设置附件上传目录
        $upload->thumb= ture; //设置缩略图
        $upload->thumbPrefix = 'thumb2_,thumb_';//生产2张缩略图
        $upload->thumbMaxWidth      = '400,200'; //设置缩略图最大宽度
        $upload->thumbMaxHeight     = '400,200';//设置缩略图最大高度 
        $upload->upload();//上传
        $info =  $upload->getUploadFileInfo();//获得上传信息

		//连接表
		$Dao = M("message_2");

		//组装数据
		$Dao->create();
		if($info[0]['savename']!=$img[0]['image'])
        {
            $Dao->image = $info[0]['savename']; // 保存上传的照片根据需要自行组装
        }

        if($info[1]['savename']!=$img[0]['img2'])
        {
            $Dao->img2 = $info[1]['savename']; // 保存上传的照片根据需要自行组装
        }

        if($info[2]['savename']!=$img[0]['img3'])
        {
            $Dao->img3 = $info[2]['savename']; // 保存上传的照片根据需要自行组装
        }

        if($info[3]['savename']!=$img[0]['img4'])
        {
            $Dao->img4 = $info[3]['savename']; // 保存上传的照片根据需要自行组装
        }

        $Dao->span_2 = '丢失地点：'.$_POST['span_2']; 
        $Dao->span_3 = '酬谢方式：'.$_POST['span_3']; 
        $Dao->span_4 = '物品价值：￥'.$_POST['span_4']; 
        

        //更新条件
 		$condition['id'] = $_SESSION['info_updata_two_id'];

 		//更新
	    $result = $Dao->where($condition)->save();
		if($result !== false)
	    {
	        $this->redirect('../Usercenter/school_info');
	    }

	    else
	    {
	        $this->error('系统临时出了点小问题，请稍候再试');
	    }
	}

	public function info_updata_lose()//失物招领页面显示
	{
		if($_SESSION['username']==""){$this->error('你还未登陆');}
		$id=$_GET["id"];
		Session::set('info_updata_two_id',$id);//将id存入session;
		$m=M("message_2");
		$data=$m->where("id='$id'")->select();
		$data[0]['span_3'] = substr($data[0]['span_3'],15);
		$data[0]['span_2'] = substr($data[0]['span_2'],15);
		$data[0]['span_4'] = substr($data[0]['span_4'],18);
		$this->assign('data',$data);
		$this->display();		
	}


	public function info_updata_lose_pass()//失物招领修改验证
	{
		if($_SESSION['username']==""){$this->error('你还未登陆');}

		import('ORG.Net.UploadFile');//引入上传类
        $upload = new UploadFile();// 实例化上传类
        $upload->maxSize  = 3145728 ;// 设置附件上传大小
        $upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->savePath =  './Uploads/';// 设置附件上传目录
        $upload->thumb= ture; //设置缩略图
        $upload->thumbPrefix = 'thumb2_,thumb_';//生产2张缩略图
        $upload->thumbMaxWidth      = '400,200'; //设置缩略图最大宽度
        $upload->thumbMaxHeight     = '400,200';//设置缩略图最大高度 
        $upload->upload();//上传
        $info =  $upload->getUploadFileInfo();//获得上传信息

		//连接表
		$Dao = M("message_2");

		//组装数据
		$Dao->create();
		if($info[0]['savename']!=$img[0]['image'])
        {
            $Dao->image = $info[0]['savename']; // 保存上传的照片根据需要自行组装
        }

        if($info[1]['savename']!=$img[0]['img2'])
        {
            $Dao->img2 = $info[1]['savename']; // 保存上传的照片根据需要自行组装
        }

        if($info[2]['savename']!=$img[0]['img3'])
        {
            $Dao->img3 = $info[2]['savename']; // 保存上传的照片根据需要自行组装
        }

        if($info[3]['savename']!=$img[0]['img4'])
        {
            $Dao->img4 = $info[3]['savename']; // 保存上传的照片根据需要自行组装
        }

        $Dao->span_2 = '拾取地点：'.$_POST['span_2']; 
        $Dao->span_3 = '酬谢方式：'.$_POST['span_3']; 
        $Dao->span_4 = '物品价值：￥'.$_POST['span_4']; 
        

        //更新条件
 		$condition['id'] = $_SESSION['info_updata_two_id'];

 		//更新
	    $result = $Dao->where($condition)->save();
		if($result !== false)
	    {
	        $this->redirect('../Usercenter/school_info');
	    }

	    else
	    {
	        $this->error('系统临时出了点小问题，请稍候再试');
	    }
	}


	public function info_updata_other()//修改其他信息页面显示
	{
		if($_SESSION['username']==""){$this->error('你还未登陆');}
		$id=$_GET["id"];
		Session::set('info_updata_two_id',$id);//将id存入session;
		$m=M("message_2");
		$data=$m->where("id='$id'")->select();
		$data[0]['span_2'] = substr($data[0]['span_2'],15);
		$data[0]['span_3'] = substr($data[0]['span_3'],10);
		$data[0]['span_4'] = substr($data[0]['span_4'],10);
		$this->assign('data',$data);
		$this->display();		
	}


	public function info_updata_other_pass()//其他信息修改验证
	{
		if($_SESSION['username']==""){$this->error('你还未登陆');}

		import('ORG.Net.UploadFile');//引入上传类
        $upload = new UploadFile();// 实例化上传类
        $upload->maxSize  = 3145728 ;// 设置附件上传大小
        $upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->savePath =  './Uploads/';// 设置附件上传目录
        $upload->thumb= ture; //设置缩略图
        $upload->thumbPrefix = 'thumb2_,thumb_';//生产2张缩略图
        $upload->thumbMaxWidth      = '400,200'; //设置缩略图最大宽度
        $upload->thumbMaxHeight     = '400,200';//设置缩略图最大高度 
        $upload->upload();//上传
        $info =  $upload->getUploadFileInfo();//获得上传信息

		//连接表
		$Dao = M("message_2");

		//组装数据
		$Dao->create();
		if($info[0]['savename']!=$img[0]['image'])
        {
            $Dao->image = $info[0]['savename']; // 保存上传的照片根据需要自行组装
        }

        if($info[1]['savename']!=$img[0]['img2'])
        {
            $Dao->img2 = $info[1]['savename']; // 保存上传的照片根据需要自行组装
        }

        if($info[2]['savename']!=$img[0]['img3'])
        {
            $Dao->img3 = $info[2]['savename']; // 保存上传的照片根据需要自行组装
        }

        if($info[3]['savename']!=$img[0]['img4'])
        {
            $Dao->img4 = $info[3]['savename']; // 保存上传的照片根据需要自行组装
        }

        $Dao->span_2 = '主要标签：'.$_POST['span_2']; 
        $Dao->span_3 = '标签1：'.$_POST['span_3']; 
        $Dao->span_4 = '标签2：'.$_POST['span_4']; 
        

        //更新条件
 		$condition['id'] = $_SESSION['info_updata_two_id'];

 		//更新
	    $result = $Dao->where($condition)->save();
		if($result !== false)
	    {
	        $this->redirect('../Usercenter/school_info');
	    }

	    else
	    {
	        $this->error('系统临时出了点小问题，请稍候再试');
	    }
	}


	function del()//删除模块
	{
		if($_SESSION['username']==""){$this->error('你还未登陆');}
		$id=$_GET["id"];


	    $Dao = M("message_2");

	    $result = $Dao->where("id = '$id'")->delete();

	    if($result !== false){
	        $this->redirect('../Usercenter/school_info');
	    }else{
	        $this->error('系统临时出了点小问题，请稍候再试');
	    }
	}

	/*
    // +----------------------------------------------------------------------
    // |                       校园社区个人中心                              |
    // +----------------------------------------------------------------------
    */   

	public function school_area()
	{
		if($_SESSION['username']==""){$this->error('你还未登陆');}
		$U=$_SESSION['username'];//用户账号
		$community=M("community");//校园话题
		$essay =M("essay");//校园文章、随笔
		$video=M("video");//校园视频
		$study=M("study");//校园学习分享

		$inf_community = $community->where("mess_user='$U'")->order('id DESC')->select();  //获得所有行
		
		for($i=0;$i<M("community")->where("mess_user='$U'")->count();$i++)
		{
			$str = $inf_community[$i]['message_more'];
			preg_match_all('/[\x{4e00}-\x{9fff}]+/u', $str, $matches);//过滤非汉字的字符
			$inf_community[$i]['message_more'] = implode('', $matches[0]);
			if($inf_community[$i]['only_me']==1)
			{
				$inf_community[$i]['only_me'] ="仅自己可见";
			}

			else if($inf_community[$i]['only_me']==0)
			{
				$inf_community[$i]['only_me'] ="所有人可见";
			}
		}


		$inf_essay = $essay->where("mess_user='$U'")->order('id DESC')->select();  //获得所有行

		for($i=0;$i<M("essay")->where("mess_user='$U'")->count();$i++)
		{
			$str = $inf_essay[$i]['message_more'];
			preg_match_all('/[\x{4e00}-\x{9fff}]+/u', $str, $matches);//过滤非汉字的字符
			$inf_essay[$i]['message_more'] = implode('', $matches[0]);
			if($inf_essay[$i]['only_me']==1)
			{
				$inf_essay[$i]['only_me'] ="仅自己可见";
			}

			else if($inf_essay[$i]['only_me']==0)
			{
				$inf_essay[$i]['only_me'] ="所有人可见";
			}			
		}


		$inf_video = $video->where("mess_user='$U'")->order('id DESC')->select();  //获得所有行
		$inf_study = $study->where("mess_user='$U'")->order('id DESC')->select();  //获得所有行

		for($i=0;$i<M("study")->where("mess_user='$U'")->count();$i++)
		{
			$str = $inf_study[$i]['message_more'];
			preg_match_all('/[\x{4e00}-\x{9fff}]+/u', $str, $matches);//过滤非汉字的字符
			$inf_study[$i]['message_more'] = implode('', $matches[0]);
			if($inf_study[$i]['only_me']==1)
			{
				$inf_study[$i]['only_me'] ="仅自己可见";
			}

			else if($inf_study[$i]['only_me']==0)
			{
				$inf_study[$i]['only_me'] ="所有人可见";
			}			
		}

		$this->assign('inf_community',$inf_community);
		$this->assign('inf_essay',$inf_essay);
		$this->assign('inf_video',$inf_video);
		$this->assign('inf_study',$inf_study);
		$this->display();


	}

	function area_update_community()//修改话题
	{
		if($_SESSION['username']==""){$this->error('你还未登陆');}
		$community=M("community");//校园话题
		$id=$_GET['id'];
		Session::set('area_update_community_id',$id);//将id存入session;
		$data=$community->where("id='$id'")->select();
		$this->assign('data',$data);
		$this->display();
	}

	function area_update_community_pass()////修改话题验证
	{
		    if($_SESSION['username']==""){$this->error('你还未登陆');}
  			import('ORG.Net.UploadFile');//引入上传类
            $upload = new UploadFile();// 实例化上传类
            $upload->maxSize  = 3145728 ;// 设置附件上传大小
            $upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->savePath =  './Uploads/';// 设置附件上传目录
            $upload->thumb= ture; //设置缩略图
            $upload->thumbPrefix = 'thumb2_,thumb_';//生产2张缩略图
            $upload->thumbMaxWidth      = '1000,300'; //设置缩略图最大宽度
            $upload->thumbMaxHeight     = '400,100';//设置缩略图最大高度           
            $upload->upload();
            $info =  $upload->getUploadFileInfo();



            $User = M("community"); //连接表         
            $User->create(); //组装数据

		    if($_POST['only_me']!=1)
		    {
		    	$User->only_me=0;
		    }

            if($info[0]['savename']!="")
            {
            	$User->img = $info[0]['savename'];//保存上传的照片根据需要自行组装
        	}

	        //更新条件
	 		$condition['id'] = $_SESSION['area_update_community_id'];

	 		//更新
		    $result = $User->where($condition)->save();
			if($result !== false)
		    {
		        $this->redirect('../Usercenter/school_area');
		    }

		    else
		    {
		        $this->error('系统临时出了点小问题，请稍候再试');
		    }		
	}

	function del_community()//删除话题
	{
		if($_SESSION['username']==""){$this->error('你还未登陆');}
		$id=$_GET["id"];


	    $Dao = M("community");

	    $result = $Dao->where("id = '$id'")->delete();

	    if($result !== false){
	        $this->redirect('../Usercenter/school_area');
	    }else{
	        $this->error('系统临时出了点小问题，请稍候再试');
	    }
	}


	public function area_update_essay()//修改文章，随笔
	{
		if($_SESSION['username']==""){$this->error('你还未登陆');}
		$community=M("essay");//校园话题   
		$id=$_GET['id'];
		Session::set('area_update_essay_id',$id);//将id存入session;
		$data=$community->where("id='$id'")->select();
		$this->assign('data',$data);
		$this->display();
	}

	function area_update_essay_pass()//修改文章，随笔验证
	{
	    if($_SESSION['username']==""){$this->error('你还未登陆');}
		import('ORG.Net.UploadFile');//引入上传类
        $upload = new UploadFile();// 实例化上传类
        $upload->maxSize  = 3145728 ;// 设置附件上传大小
        $upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->savePath =  './Uploads/';// 设置附件上传目录
        $upload->thumb= ture; //设置缩略图
        $upload->thumbPrefix = 'thumb2_,thumb_';//生产2张缩略图
        $upload->thumbMaxWidth      = '1000,300'; //设置缩略图最大宽度
        $upload->thumbMaxHeight     = '400,100';//设置缩略图最大高度           
        $upload->upload();
        $info =  $upload->getUploadFileInfo();



        $User = M("essay"); //连接表         
        $User->create(); //组装数据
        	   
        if($_POST['only_me']!=1)
        {
        	$User->only_me=0;
        }


        if($info[0]['savename']!="")
        {
        	$User->img = $info[0]['savename'];//保存上传的照片根据需要自行组装
    	}

        //更新条件
 		$condition['id'] = $_SESSION['area_update_essay_id'];

 		//更新
	    $result = $User->where($condition)->save();
		if($result !== false)
	    {
	        $this->redirect('../Usercenter/school_area');
	    }

	    else
	    {
	        $this->error('系统临时出了点小问题，请稍候再试');
	    }	
	}


	function del_essay()//删除话题
	{
		if($_SESSION['username']==""){$this->error('你还未登陆');}
		$id=$_GET["id"];


	    $Dao = M("essay");

	    $result = $Dao->where("id = '$id'")->delete();

	    if($result !== false){
	        $this->redirect('../Usercenter/school_area');
	    }else{
	        $this->error('系统临时出了点小问题，请稍候再试');
	    }
	}




	public function area_update_video()//修改视频
	{
		if($_SESSION['username']==""){$this->error('你还未登陆');}
		$community=M("video");//校园话题   
		$id=$_GET['id'];
		Session::set('area_update_video_id',$id);//将id存入session;
		$data=$community->where("id='$id'")->select();
		$this->assign('data',$data);
		$this->display();
	}

	function area_update_video_pass()//修改视频验证
	{
	    if($_SESSION['username']==""){$this->error('你还未登陆');}
		import('ORG.Net.UploadFile');//引入上传类
        $upload = new UploadFile();// 实例化上传类
        $upload->maxSize  = 3145728 ;// 设置附件上传大小
        $upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->savePath =  './Uploads/';// 设置附件上传目录
        $upload->thumb= ture; //设置缩略图
        $upload->thumbPrefix = 'thumb2_,thumb_';//生产2张缩略图
        $upload->thumbMaxWidth      = '1000,300'; //设置缩略图最大宽度
        $upload->thumbMaxHeight     = '400,100';//设置缩略图最大高度           
        $upload->upload();
        $info =  $upload->getUploadFileInfo();



        $User = M("video"); //连接表         
        $User->create(); //组装数据
        	   
        if($_POST['only_me']!=1)
        {
        	$User->only_me=0;
        }


        if($info[0]['savename']!="")
        {
        	$User->img = $info[0]['savename'];//保存上传的照片根据需要自行组装
    	}

        //更新条件
 		$condition['id'] = $_SESSION['area_update_video_id'];

 		//更新
	    $result = $User->where($condition)->save();
		if($result !== false)
	    {
	        $this->redirect('../Usercenter/school_area');
	    }

	    else
	    {
	        $this->error('系统临时出了点小问题，请稍候再试');
	    }	
	}


	function del_video()//删除视频
	{
		if($_SESSION['username']==""){$this->error('你还未登陆');}
		$id=$_GET["id"];
	    $Dao = M("video");
	    $result = $Dao->where("id = '$id'")->delete();
	    if($result !== false)
	    {
	        $this->redirect('../Usercenter/school_area');
	    }
	    else
	    {
	        $this->error('系统临时出了点小问题，请稍候再试');
	    }
	}





	public function area_update_study()//修改文章，随笔
	{
		if($_SESSION['username']==""){$this->error('你还未登陆');}
		$community=M("study");//校园话题   
		$id=$_GET['id'];
		Session::set('area_update_essay_id',$id);//将id存入session;
		$data=$community->where("id='$id'")->select();
		$this->assign('data',$data);
		$this->display();
	}

	function area_update_study_pass()//修改学习分享
	{
	    if($_SESSION['username']==""){$this->error('你还未登陆');}
		import('ORG.Net.UploadFile');//引入上传类
        $upload = new UploadFile();// 实例化上传类
        $upload->maxSize  = 3145728 ;// 设置附件上传大小
        $upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->savePath =  './Uploads/';// 设置附件上传目录
        $upload->thumb= ture; //设置缩略图
        $upload->thumbPrefix = 'thumb2_,thumb_';//生产2张缩略图
        $upload->thumbMaxWidth      = '1000,300'; //设置缩略图最大宽度
        $upload->thumbMaxHeight     = '400,100';//设置缩略图最大高度           
        $upload->upload();
        $info =  $upload->getUploadFileInfo();



        $User = M("study"); //连接表         
        $User->create(); //组装数据
        	   
        if($_POST['only_me']!=1)
        {
        	$User->only_me=0;
        }


        if($info[0]['savename']!="")
        {
        	$User->img = $info[0]['savename'];//保存上传的照片根据需要自行组装
    	}

        //更新条件
 		$condition['id'] = $_SESSION['area_update_essay_id'];

 		//更新
	    $result = $User->where($condition)->save();
		if($result !== false)
	    {
	        $this->redirect('../Usercenter/school_area');
	    }

	    else
	    {
	        $this->error('系统临时出了点小问题，请稍候再试');
	    }	
	}


	function del_study()//删除话题
	{
		if($_SESSION['username']==""){$this->error('你还未登陆');}
		$id=$_GET["id"];


	    $Dao = M("study");

	    $result = $Dao->where("id = '$id'")->delete();

	    if($result !== false){
	        $this->redirect('../Usercenter/school_area');
	    }else{
	        $this->error('系统临时出了点小问题，请稍候再试');
	    }
	}

	/*
    // +----------------------------------------------------------------------
    // |                       校园活动个人中心                              |
    // +----------------------------------------------------------------------
    */   

	public function school_part()
	{
		if($_SESSION['username']==""){$this->error('你还未登陆');}
		$U=$_SESSION['username'];//用户账号
		$m=M("part");
		$data = $m->where("username='$U'")->order('id DESC')->select();  //获得所有行
		for($i=0;$i<M("part")->where("username='$U'")->count();$i++)
		{
			$str = $data[$i]['part_message'];
			preg_match_all('/[\x{4e00}-\x{9fff}]+/u', $str, $matches);//过滤非汉字的字符
			$data[$i]['part_message'] = implode('', $matches[0]);		
		}		
		
		$this->assign('data',$data);
		$this->display();
	}


	public function part_update()//修改活动信息显示页面
	{
		$m=M("part");
		if($_SESSION['username']==""){$this->error('你还未登陆');}
		
		$data = $m->where("id='$id'")->order('id DESC')->select();  //获得所有行
		$this->assign('data',$data);
		$this->display();
	}


	public function part_look_back()//添加活动回顾页面
	{
		if($_SESSION['username']==""){$this->error('你还未登陆');}
		$m=M("part_look_back");
		$id=$_GET["id"];
		Session::set('part_look_back_id',$id);//将id存入session;
		$data = $m->where("part_id='$id'")->select();  //获得所有行
		$this->assign('data',$data);
		$this->display();
	} 

	public function part_look_back_pass()//添加活动回顾页面
	{
		if($_SESSION['username']==""){$this->error('你还未登陆');}
		$m=M("part_look_back");
		$part_id=$_SESSION['part_look_back_id'];
	    $m->create(); //组装数据
	    $m->part_id=$part_id;
	    if($m->where("part_id='$part_id'")->count()==0)
	    {
	   		 $result = $m->add();
		}
		else
		{
 			$result = $m->where("part_id='$part_id'")->save();
		}
		if($result !== false)
	    {
	        $this->redirect('../Usercenter/school_part');
	    }
	    else
	    {
	        $this->error('系统临时出了点小问题，请稍候再试');
	    }

	}

	function up_user_ico()
	{
		import('ORG.Net.UploadFile');//引入上传类
        $upload = new UploadFile();// 实例化上传类
        $upload->maxSize  = 3145728 ;// 设置附件上传大小
        $upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->savePath =  './Uploads/';// 设置附件上传目录
        $upload->thumb= ture; //设置缩略图
        $upload->thumbPrefix = 'thumb2_,thumb_';//生产2张缩略图
        $upload->thumbMaxWidth      = '150,50'; //设置缩略图最大宽度
        $upload->thumbMaxHeight     = '150,50';//设置缩略图最大高度    
        $upload->upload();
        $info =  $upload->getUploadFileInfo();
        $User = M("user"); // 连接表
        $username = session('username');
        $User->img = $info[0]['savename']; // 保存上传的照片根据需要自行组装
        $User->where("usernumber='$username'")->save();
		$this->redirect("index"); //直接跳转，不带计时后跳转
	}

}
?>
