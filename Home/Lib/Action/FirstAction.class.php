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
class FirstAction extends Action //主页
{

	public function index()
	{
		$U=$_SESSION['username'];//用户账号
	    $userdata=M("user")->where("usernumber='$U'")->select();//找到用户数据
	    $this->assign('userdata',$userdata);

		
		$username=M("user")->where("usernumber='$U'")->select();//找到用户昵称所在行
		$this->assign('username',$username[0]['username']);


		$search=M("search")->order("count desc")->select();//热词搜索
		$this->assign('search',$search);


		//最新的活动..............................................................
        $part4 = M('part')->where("pass=1")->order('id DESC')->select();  //获得所有行
        $b=0;
        for($i=0; $i< M('part')->where("pass=1")->count(); $i++)
        {            
             if(strtotime($part4[$i]["part_over_date"] ) >= strtotime(date('Y-m-d')))
             {  
                /*复制数组*/   
                $part[$b] = $part4[$i];
                $b=$b+1;
             }
        }
		for($i=0;$i<sizeof($part);$i++)
		{
			$str = $part[$i]['part_message'];
			preg_match_all('/[\x{4e00}-\x{9fff}]+/u', $str, $matches);//过滤非汉字的字符
			$part[$i]['part_message'] = implode('', $matches[0]);
		}		
        $this->assign('part', $part);//往期精彩活动



        //往期精彩活动 ............................................................       
        $part3 = M('part')->where("pass=1")->order('id DESC')->select();  //获得所有行
        $b=0;
        for($i=0; $i< M('part')->where("pass=1")->count(); $i++)
        {            
             if(strtotime($part3[$i]["part_over_date"] ) <strtotime(date('Y-m-d')))
             {  
                /*复制数组*/   
                $part2[$b] = $part3[$i];
                $b=$b+1;
             }
        }
		for($i=0;$i<sizeof($part2);$i++)
		{
			$str = $part2[$i]['part_message'];
			preg_match_all('/[\x{4e00}-\x{9fff}]+/u', $str, $matches);//过滤非汉字的字符
			$part2[$i]['part_message'] = implode('', $matches[0]);
		}		
        $this->assign('part2', $part2);//往期精彩活动



        //文章随笔.......................................................................
        $essay=M('essay')->where(" only_me='0' AND img!=''")->order("good desc")->select();//校园话题
        for($i=0;$i<M('essay')->where(" only_me='0' AND img!=''")->count();$i++)
		{
			$str = $essay[$i]['message_more'];
			preg_match_all('/[\x{4e00}-\x{9fff}]+/u', $str, $matches);//过滤非汉字的字符
			$essay[$i]['message_more'] = implode('', $matches[0]);
		}	
        $this->assign('essay', $essay);



		//校园信息发布.......................................................................
	/*	$two=M("message_2")->where("span_1='二手交易'")->order('id DESC')->select();
		$this->assign('two', $two);

		$lose=M("message_2")->where("span_1='失物招领'")->order('id DESC')->select();
		$this->assign('lose', $lose);

		$find=M("message_2")->where("span_1='寻物启事'")->order('id DESC')->select();
		$this->assign('find', $find);

		$other=M("message_2")->where("span_1='其他'")->order('id DESC')->select();
		$this->assign('other', $other);*/

		$school_info=M("message_2")->order('id DESC')->select();
		$this->assign('school_info', $school_info);

	//校园视频.......................................................................	
        $video=M('video')->where(" only_me='0' AND img!=''")->order("good desc")->select();//校园话题
        $this->assign('video', $video);
    //校园话题...................................................................	    
		$community=M('community')->where(" only_me='0' AND img!=''")->order("good desc")->select();//校园话题
        for($i=0;$i<M('community')->where(" only_me='0' AND img!=''")->count();$i++)
		{
			$str = $community[$i]['message_more'];
			preg_match_all('/[\x{4e00}-\x{9fff}]+/u', $str, $matches);//过滤非汉字的字符
			$community[$i]['message_more'] = implode('', $matches[0]);
		}	
        $this->assign('community', $community);
    //学习分享...................................................................	        
		$study=M('study')->where(" only_me='0' AND img!=''")->order("good desc")->select();//校园话题
        for($i=0;$i<M('study')->where(" only_me='0' AND img!=''")->count();$i++)
		{
			$str = $study[$i]['message_more'];
			preg_match_all('/[\x{4e00}-\x{9fff}]+/u', $str, $matches);//过滤非汉字的字符
			$study[$i]['message_more'] = implode('', $matches[0]);
		}	
        $this->assign('study', $study);

      	$this->display();//显示页面
	}


	public function index_night()//夜间
	{
		$username=$_SESSION['username'];
		$this->assign('username',$username);
      	$this->display();//显示页面
	}
 

	public function index2()
	{


		$U=$_SESSION['username'];//用户账号
	    $userdata=M("user")->where("usernumber='$U'")->select();//找到用户数据
	    $this->assign('userdata',$userdata);

		
		$username=M("user")->where("usernumber='$U'")->select();//找到用户昵称所在行
		$this->assign('username',$username[0]['username']);


		$search=M("search")->order("count desc")->select();//热词搜索
		$this->assign('search',$search);


		//最新的活动..............................................................
        $part4 = M('part')->where("pass=1")->order('id DESC')->select();  //获得所有行
        $b=0;
        for($i=0; $i< M('part')->where("pass=1")->count(); $i++)
        {            
             if(strtotime($part4[$i]["part_over_date"] ) >= strtotime(date('Y-m-d')))
             {  
                /*复制数组*/   
                $part[$b] = $part4[$i];
                $b=$b+1;
             }
        }
		for($i=0;$i<sizeof($part);$i++)
		{
			$str = $part[$i]['part_message'];
			preg_match_all('/[\x{4e00}-\x{9fff}]+/u', $str, $matches);//过滤非汉字的字符
			$part[$i]['part_message'] = implode('', $matches[0]);
		}		
        $this->assign('part', $part);//往期精彩活动



        //往期精彩活动 ............................................................       
        $part3 = M('part')->where("pass=1")->order('id DESC')->select();  //获得所有行
        $b=0;
        for($i=0; $i< M('part')->where("pass=1")->count(); $i++)
        {            
             if(strtotime($part3[$i]["part_over_date"] ) <strtotime(date('Y-m-d')))
             {  
                /*复制数组*/   
                $part2[$b] = $part3[$i];
                $b=$b+1;
             }
        }
		for($i=0;$i<sizeof($part2);$i++)
		{
			$str = $part2[$i]['part_message'];
			preg_match_all('/[\x{4e00}-\x{9fff}]+/u', $str, $matches);//过滤非汉字的字符
			$part2[$i]['part_message'] = implode('', $matches[0]);
		}		
        $this->assign('part2', $part2);//往期精彩活动



        //文章随笔.......................................................................
        $essay=M('essay')->where(" only_me='0' AND img!=''")->order("good desc")->select();//校园话题
        for($i=0;$i<M('essay')->where(" only_me='0' AND img!=''")->count();$i++)
		{
			$str = $essay[$i]['message_more'];
			preg_match_all('/[\x{4e00}-\x{9fff}]+/u', $str, $matches);//过滤非汉字的字符
			$essay[$i]['message_more'] = implode('', $matches[0]);
		}	
        $this->assign('essay', $essay);



		//校园信息发布.......................................................................
	/*	$two=M("message_2")->where("span_1='二手交易'")->order('id DESC')->select();
		$this->assign('two', $two);

		$lose=M("message_2")->where("span_1='失物招领'")->order('id DESC')->select();
		$this->assign('lose', $lose);

		$find=M("message_2")->where("span_1='寻物启事'")->order('id DESC')->select();
		$this->assign('find', $find);

		$other=M("message_2")->where("span_1='其他'")->order('id DESC')->select();
		$this->assign('other', $other);*/

		$school_info=M("message_2")->order('id DESC')->select();
		$this->assign('school_info', $school_info);

	//校园视频.......................................................................	
        $video=M('video')->where(" only_me='0' AND img!=''")->order("good desc")->select();//校园话题
        $this->assign('video', $video);
    //校园话题...................................................................	    
		$community=M('community')->where(" only_me='0' AND img!=''")->order("good desc")->select();//校园话题
        for($i=0;$i<M('community')->where(" only_me='0' AND img!=''")->count();$i++)
		{
			$str = $community[$i]['message_more'];
			preg_match_all('/[\x{4e00}-\x{9fff}]+/u', $str, $matches);//过滤非汉字的字符
			$community[$i]['message_more'] = implode('', $matches[0]);
		}	
        $this->assign('community', $community);
    //学习分享...................................................................	        
		$study=M('study')->where(" only_me='0' AND img!=''")->order("good desc")->select();//校园话题
        for($i=0;$i<M('study')->where(" only_me='0' AND img!=''")->count();$i++)
		{
			$str = $study[$i]['message_more'];
			preg_match_all('/[\x{4e00}-\x{9fff}]+/u', $str, $matches);//过滤非汉字的字符
			$study[$i]['message_more'] = implode('', $matches[0]);
		}	
        $this->assign('study', $study);

      	$this->display();//显示页面
	}


	public function username()
	{
		$username=$_SESSION['username'];

		if($username!='')
		{
			$data=1;
			$this->ajaxReturn($data);
		}

		else
		{
			$data=0;
			$this->ajaxReturn($data);
		}
	}

	public function admin_first()
	{
		$User = M("admin_first"); // 连接表
        $User->create(); //通过表中的字段名称与表单提交的名称对应关系自动封装数据实例
         $User->add();
        $this->success("成功，非常感谢您的反馈");
	}


}

?>