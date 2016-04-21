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
class PartAction extends Action 
{

    /*
    // +----------------------------------------------------------------------
    // |                        校园活动首页显示模块                          |
    // +----------------------------------------------------------------------
    */
    public function index()
    {
		$username=$_SESSION['username'];//用户账号
        $userdata=M("user")->where("usernumber='$username'")->select();//找到用户数据
        $this->assign('userdata',$userdata);
        $this->assign('username',$username); 
   
        //往期精彩活动        
        $data3 = M('part')->where("pass=1")->select();  //获得所有行
        $b=0;
        for($i=0; $i< M('part')->where("pass=1")->count(); $i++)
        {            
             if(strtotime($data3[$i]["part_over_date"] ) < strtotime(date('Y-m-d')))
             {  
                /*复制数组*/   
                $data4[$b] = $data3[$i];
                $b=$b+1;
             }
        }
        $this->assign('data3', $data4);//往期精彩活动


        //最新发布活动
        $data5 = M('part')->where("pass=1")->select();  //获得所有行
        $c=0;
        for($i=0; $i< M('part')->where("pass=1")->count(); $i++)
        {                      
             if(strtotime($data5[$i]["part_over_date"] ) >= strtotime(date('Y-m-d')))
             {
   
                $data6[$c]= $data5[$i];
                $c=$c+1;

             }
        }
        $this->assign('data',  $data6);//最新发布活动       
		$this->display();
    }


    public function new_part()
    {
		$username=$_SESSION['username'];//用户账号
        $userdata=M("user")->where("usernumber='$username'")->select();//找到用户数据
        $this->assign('userdata',$userdata);
        $this->assign('username',$username); 
   


        //最新发布活动
        $data5 = M('part')->where("pass=1")->select();  //获得所有行
        $c=0;
        for($i=0; $i< M('part')->where("pass=1")->count(); $i++)
        {                      
             if(strtotime($data5[$i]["part_over_date"] ) >= strtotime(date('Y-m-d')))
             {
   
                $data6[$c]= $data5[$i];
                $c=$c+1;

             }
        }
        $this->assign('data',  $data6);//最新发布活动       
		$this->display();    	
    }


    public function old_part()
    {
		$username=$_SESSION['username'];//用户账号
        $userdata=M("user")->where("usernumber='$username'")->select();//找到用户数据
        $this->assign('userdata',$userdata);
        $this->assign('username',$username); 
   
        //往期精彩活动        
        $data3 = M('part')->where("pass=1")->select();  //获得所有行
        $b=0;
        for($i=0; $i< M('part')->where("pass=1")->count(); $i++)
        {            
             if(strtotime($data3[$i]["part_over_date"] ) < strtotime(date('Y-m-d')))
             {  
                /*复制数组*/   
                $data4[$b] = $data3[$i];
                $b=$b+1;
             }
        }
        $this->assign('data3', $data4);//往期精彩活动     
		$this->display();
    }

    /*
    // +----------------------------------------------------------------------
    // |                        活动发布模块                                 |
    // +----------------------------------------------------------------------
    */


    public function add()
    {
        if($_SESSION['username']==""){$this->error('你还未登陆');}
    	$username=$_SESSION['username'];
		$this->assign('username',$username);
		$this->display();
    }


    public function add_pass()
    {
            import('ORG.Net.UploadFile');//引入上传类
            $upload = new UploadFile();// 实例化上传类
            $upload->maxSize  = 3145728 ;// 设置附件上传大小
            $upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->savePath =  './Uploads/';// 设置附件上传目录
            $upload->thumb= ture; //设置缩略图
            $upload->thumbPrefix = 'thumb2_,thumb_';//生产2张缩略图
            $upload->thumbMaxWidth      = '800,320'; //设置缩略图最大宽度
            $upload->thumbMaxHeight     = '400,200';//设置缩略图最大高度
           
            if(!$upload->upload())
             {// 上传错误提示错误信息
                $this->error($upload->getErrorMsg());
             }
            else
             {   // 上传成功 获取上传文件信息
                 $info =  $upload->getUploadFileInfo();
             }   


            // 保存表单数据 包括附件数据
            $User = M("part"); //连接表
            $User->create(); //通过表中的字段名称与表单提交的名称对应关系自动封装数据实例
            $User->part_image = $info[0]['savename']; // 保存上传的照片根据需要自行组装
            $username = session('username');//获取当前登陆用户名
            $User->username = $username;//将当前用户名保存到username字段中
            $i=$User->add(); // 写入用户数据到数据库
            if($i>0)
            {
                $this->success('发布成功！','index');
            }
            else
            {
                $this->error('系统临时出了点小问题，请稍候再试');
            }
            
    }


    /*
    // +----------------------------------------------------------------------
    // |                        详细活动信息界面                             |
    // +----------------------------------------------------------------------
    */


    public function message_more()
    {
		$username=$_SESSION['username'];//用户账号
        $userdata=M("user")->where("usernumber='$username'")->select();//找到用户数据
        $this->assign('userdata',$userdata);
        $this->assign('username',$username); 

        $id=$_GET['id'];//获得当前消息ID
        Session::set('part_message_id',$_GET['id']);//将message_id存入session;
        $User=M("part");//实例化表
        $data = $User->where(" id = '$id' ")->select(); //通过当前消息id查找对应信息
        $this->assign('data', $data);//将数据传入模板
        $this->display();//显示页面

        $look = $User->where("  id = '$id'  ")->getField('look');  //获得浏览次数 
        $User->find($id); // 查找主键为$id的数据
        $User->look=$look+1;
        $User->save();
    }

    /*
    // +----------------------------------------------------------------------
    // |                        赞模块                                       |
    // +----------------------------------------------------------------------
    */
    public function good()
    {
        $User=M("part");//实例化表
        $id=$_SESSION['part_message_id'];//获得当前消息ID
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

    /*
    // +----------------------------------------------------------------------
    // |                        动态留言模块                                 |
    // +----------------------------------------------------------------------
    */
    public function comment()//添加留言
    {

        if($_GET['message']!="")
        {
            $usernumber=session('username');
            $part_message_id=session('part_message_id');
            $evl=M("part")->where("id='$part_message_id'")->getField('evl');//获得当前消息评论次数
            M("part")->evl=$evl+1;
            M("part")->where("id='$part_message_id'")->save();//存入评论次数
            $img=M("user")->where("usernumber='$usernumber'")->getField('img'); //获得留言用户头像 
            $nickname=M("user")->where("usernumber='$usernumber'")->getField('username');//获得昵称
            
            $m=M("comment_part");
            $m->username = session('username');
            $m->message_id= session('part_message_id');
            $m->message= $_GET['message'];
            $m->img=$img;
            $m->nickname=$nickname;
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
         
         else
         {
            $this->ajaxReturn($_GET,'添加信息失败',2);
         }   

    }


    public function look()//显示留言
    {
        $message_id= session('part_message_id');
        $data=M("comment_part")->where(" message_id = '$message_id' ")->order('id desc')->select();
        $this->ajaxReturn($data);
    }


    /*
    // +----------------------------------------------------------------------
    // |                        详细活动信息界面                             |
    // +----------------------------------------------------------------------
    */

    public function part_bank()
    {
		$username=$_SESSION['username'];//用户账号
        $userdata=M("user")->where("usernumber='$username'")->select();//找到用户数据
        $this->assign('userdata',$userdata);
        $this->assign('username',$username); 

        $id=$_GET['id'];//获得当前消息ID

        $m=M("part_look_back");        
        $data2 = $m->where(" part_id = '$id' ")->select(); //通过当前消息id查找对应信息
        $this->assign('data2', $data2);//将数据传入模板

        Session::set('part_message_id',$_GET['id']);//将message_id存入session;
        $User=M("part");//实例化表
        $data = $User->where(" id = '$id' ")->select(); //通过当前消息id查找对应信息
        $this->assign('data', $data);//将数据传入模板


        $this->display();//显示页面

        $look = $User->where("  id = '$id'  ")->getField('look');  //获得浏览次数 
        $User->find($id); // 查找主键为$id的数据
        $User->look=$look+1;
        $User->save();
    }

    /*
    // +----------------------------------------------------------------------
    // |                        技术交流或疑问加QQ:1576701411                |
    // +----------------------------------------------------------------------
    */

}