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
class MessageAction extends Action //校园信息模块
{

    /*
    // +----------------------------------------------------------------------
    // |                       校园信息发布主页模块                          |
    // +----------------------------------------------------------------------
    */

    public function index()//显示最新发布信息
    {
            $username=$_SESSION['username'];//用户账号
            $userdata=M("user")->where("usernumber='$username'")->select();//找到用户数据
            $this->assign('userdata',$userdata);
            $this->assign('username',$username);

            $data = M('message_2')->where(" span_1='二手交易'")->order('id DESC')->limit('8')->select();  //获得所有行

            $this->assign('data', $data);/*二手交易*/

            $data2 = M('message_2')->where(" span_1='寻物启事'")->order('id DESC')->limit('8')->select();  //获得所有行

            $this->assign('data2', $data2);/*最新寻物启事*/

            $data3 = M('message_2')->where(" span_1='失物招领'")->order('id DESC')->limit('8')->select();  //获得所有行

            $this->assign('data3', $data3);/*最新失物招领*/

            $data4 = M('message_2')->where(" span_1='其他'")->order('id DESC')->limit('8')->select();  //获得所有行

            $this->assign('data4', $data4);/*最新其他信息*/
            $this->display();

    }

    /*
    // +----------------------------------------------------------------------
    // |                       校园信息发布子页面模块                        |
    // +----------------------------------------------------------------------
    */

    public function lose()
    {
        $username=$_SESSION['username'];//用户账号
        $userdata=M("user")->where("usernumber='$username'")->select();//找到用户数据
        $this->assign('userdata',$userdata);
        $this->assign('username',$username);

        import("ORG.Util.AjaxPage");// 导入分页类  注意导入的是自己写的AjaxPage类
        $credit = M('message_2')->where(" span_1='失物招领'");
        $count = $credit->count(); //计算记录数
        $limitRows = 16; // 设置每页记录数

        $p = new AjaxPage($count, $limitRows,"user"); //第三个参数是你需要调用换页的ajax函数名
        $limit_value = $p->firstRow . "," . $p->listRows;

        $data = $credit->where(" span_1='失物招领'")->order('id desc')->limit($limit_value)->select(); // 查询数据
        $page = $p->show(); // 产生分页信息，AJAX的连接在此处生成

        $this->assign('data',$data);
        $this->assign('page',$page);
        $this->display();
    }

    public function two()
    {
        $username=$_SESSION['username'];//用户账号
        $userdata=M("user")->where("usernumber='$username'")->select();//找到用户数据
        $this->assign('userdata',$userdata);
        $this->assign('username',$username);



        import("ORG.Util.AjaxPage");// 导入分页类  注意导入的是自己写的AjaxPage类
        $credit = M('message_2')->where(" span_1='二手交易'");
        $count = $credit->count(); //计算记录数
        $limitRows = 16; // 设置每页记录数

        $p = new AjaxPage($count, $limitRows,"user"); //第三个参数是你需要调用换页的ajax函数名
        $limit_value = $p->firstRow . "," . $p->listRows;

        $data = $credit->where(" span_1='二手交易'")->order('id desc')->limit($limit_value)->select(); // 查询数据
        $page = $p->show(); // 产生分页信息，AJAX的连接在此处生成

        $this->assign('data',$data);
        $this->assign('page',$page);
        $this->display();
    }

    public function find()
    {
        $username=$_SESSION['username'];//用户账号
        $userdata=M("user")->where("usernumber='$username'")->select();//找到用户数据
        $this->assign('userdata',$userdata);
        $this->assign('username',$username);

        import("ORG.Util.AjaxPage");// 导入分页类  注意导入的是自己写的AjaxPage类
        $credit = M('message_2')->where(" span_1='寻物启事'");
        $count = $credit->count(); //计算记录数
        $limitRows = 16; // 设置每页记录数

        $p = new AjaxPage($count, $limitRows,"user"); //第三个参数是你需要调用换页的ajax函数名
        $limit_value = $p->firstRow . "," . $p->listRows;

        $data = $credit->where(" span_1='寻物启事'")->order('id desc')->limit($limit_value)->select(); // 查询数据
        $page = $p->show(); // 产生分页信息，AJAX的连接在此处生成

        $this->assign('data',$data);
        $this->assign('page',$page);
        $this->display();
    }

    public function other()
    {
        $username=$_SESSION['username'];//用户账号
        $userdata=M("user")->where("usernumber='$username'")->select();//找到用户数据
        $this->assign('userdata',$userdata);
        $this->assign('username',$username);

        import("ORG.Util.AjaxPage");// 导入分页类  注意导入的是自己写的AjaxPage类
        $credit = M('message_2')->where(" span_1='其他'");
        $count = $credit->count(); //计算记录数
        $limitRows = 16; // 设置每页记录数

        $p = new AjaxPage($count, $limitRows,"user"); //第三个参数是你需要调用换页的ajax函数名
        $limit_value = $p->firstRow . "," . $p->listRows;

        $data = $credit->where(" span_1='其他'")->order('id desc')->limit($limit_value)->select(); // 查询数据
        $page = $p->show(); // 产生分页信息，AJAX的连接在此处生成

        $this->assign('data',$data);
        $this->assign('page',$page);
        $this->display();
    }


    /*
    // +----------------------------------------------------------------------
    // |                       校园信息发布模块                              |
    // +----------------------------------------------------------------------
    */

	public function add_two()
	{
            $username=$_SESSION['username'];
            if($username=="")
            {
                $this->error('你还未登陆');
            }
            $this->assign('username',$username);
            $this->display();//显示页面
	}

	public function message_add_two()  //二手信息发布
	{
        $username=session('username');
        if($username=="")
        {
            $this->error('你还未登陆');
        }

        import('ORG.Net.UploadFile');//引入上传类
        $upload = new UploadFile();// 实例化上传类
        $upload->maxSize  = 3145728 ;// 设置附件上传大小
        $upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->savePath =  './Uploads/';// 设置附件上传目录
        $upload->thumb= ture; //设置缩略图
        $upload->thumbPrefix = 'thumb2_,thumb_';//生产2张缩略图
        $upload->thumbMaxWidth      = '400,200'; //设置缩略图最大宽度
        $upload->thumbMaxHeight     = '400,200';//设置缩略图最大高度

        $upload->upload();
        $info =  $upload->getUploadFileInfo();




		$User = M("message_2"); // 连接表
        $User->create(); //通过表中的字段名称与表单提交的名称对应关系自动封装数据实例
        if($info[0]['savename']!="")
        {
            $User->image = $info[0]['savename']; // 保存上传的照片根据需要自行组装
        }

        if($info[1]['savename']!="")
        {
             $User->img2 = $info[1]['savename']; // 保存上传的照片根据需要自行组装
        }

        if($info[2]['savename']!="")
        {
             $User->img3 = $info[2]['savename']; // 保存上传的照片根据需要自行组装
        }

        if($info[3]['savename']!="")
        {
            $User->img4 = $info[3]['savename']; // 保存上传的照片根据需要自行组装
        }

		$User->message_username = $username;
        $User->span_1 = '二手交易';
        $User->span_2 = '￥'.$_POST['span_2'];
        $User->span_3 = '新旧程度：'.$_POST['span_3'];
        $User->span_4 = '原价：'.$_POST['span_4'];

		    $User->time             = date("Y-m-d");            //保存当前时间
		    $i=$User->add();                                    // 把数据对象添加到数据库

  	  	if($i==0)
  		  {
  			     $this->error('系统错误,发布失败');
  		  }

		    else
		    {
			       $this->redirect('../Message/two');
		    }

	}

/******************************************************/

    public function add_find()//寻物启事添加页面
    {
            $username=$_SESSION['username'];
            if($username=="")
            {
                $this->error('你还未登陆');
            }
            $this->assign('username',$username);
            $this->display();//显示页面
    }

    public function message_add_find()  //寻物启事信息发布
    {
        $username=session('username');
        if($username=="")
        {
            $this->error('你还未登陆');
        }

        import('ORG.Net.UploadFile');//引入上传类
        $upload = new UploadFile();// 实例化上传类
        $upload->maxSize  = 3145728 ;// 设置附件上传大小
        $upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->savePath =  './Uploads/';// 设置附件上传目录
        $upload->thumb= ture; //设置缩略图
        $upload->thumbPrefix = 'thumb2_,thumb_';//生产2张缩略图
        $upload->thumbMaxWidth      = '400,200'; //设置缩略图最大宽度
        $upload->thumbMaxHeight     = '400,200';//设置缩略图最大高度

        $upload->upload();
        $info =  $upload->getUploadFileInfo();




        $User = M("message_2"); // 连接表
        $User->create(); //通过表中的字段名称与表单提交的名称对应关系自动封装数据实例
         if($info[0]['savename']!="")
        {
            $User->image = $info[0]['savename']; // 保存上传的照片根据需要自行组装
        }

        if($info[1]['savename']!="")
        {
             $User->img2 = $info[1]['savename']; // 保存上传的照片根据需要自行组装
        }

        if($info[2]['savename']!="")
        {
             $User->img3 = $info[2]['savename']; // 保存上传的照片根据需要自行组装
        }

        if($info[3]['savename']!="")
        {
            $User->img4 = $info[3]['savename']; // 保存上传的照片根据需要自行组装
        }

        $User->message_username = $username;
        $User->span_1 = '寻物启事';
        $User->span_2 = '丢失地点：'.$_POST['span_2'];
        $User->span_3 = '酬谢方式：'.$_POST['span_3'];
        $User->span_4 = '物品价值：￥'.$_POST['span_4'];

        $User->time             = date("Y-m-d");            //保存当前时间
        $i=$User->add();                                    // 把数据对象添加到数据库

        if($i==0)
        {
            $this->error('系统错误,发布失败');
        }

        else
        {
             $this->redirect('../Message/find');
        }

    }
/******************************************************/

    public function add_lose()//失物招领发布页面
    {
            $username=$_SESSION['username'];
            if($username=="")
            {
                $this->error('你还未登陆');
            }
            $this->assign('username',$username);
            $this->display();//显示页面
    }

    public function message_add_lose()  //失物招领信息发布
    {
        $username=session('username');
        if($username=="")
        {
            $this->error('你还未登陆');
        }

        import('ORG.Net.UploadFile');//引入上传类
        $upload = new UploadFile();// 实例化上传类
        $upload->maxSize  = 3145728 ;// 设置附件上传大小
        $upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->savePath =  './Uploads/';// 设置附件上传目录
        $upload->thumb= ture; //设置缩略图
        $upload->thumbPrefix = 'thumb2_,thumb_';//生产2张缩略图
        $upload->thumbMaxWidth      = '400,200'; //设置缩略图最大宽度
        $upload->thumbMaxHeight     = '400,200';//设置缩略图最大高度

        $upload->upload();
        $info =  $upload->getUploadFileInfo();




        $User = M("message_2"); // 连接表
        $User->create(); //通过表中的字段名称与表单提交的名称对应关系自动封装数据实例
        if($info[0]['savename']!="")
        {
            $User->image = $info[0]['savename']; // 保存上传的照片根据需要自行组装
        }

        if($info[1]['savename']!="")
        {
             $User->img2 = $info[1]['savename']; // 保存上传的照片根据需要自行组装
        }

        if($info[2]['savename']!="")
        {
             $User->img3 = $info[2]['savename']; // 保存上传的照片根据需要自行组装
        }

        if($info[3]['savename']!="")
        {
            $User->img4 = $info[3]['savename']; // 保存上传的照片根据需要自行组装
        }

        $User->message_username = $username;
        $User->span_1 = '失物招领';
        $User->span_2 = '拾取地点：'.$_POST['span_2'];
        $User->span_3 = '酬谢方式：'.$_POST['span_3'];
        $User->span_4 = '物品价值：￥'.$_POST['span_4'];


        $User->time             = date("Y-m-d");            //保存当前时间
        $i=$User->add();                                    // 把数据对象添加到数据库

        if($i==0)
        {
            $this->error('系统错误,发布失败');
        }

        else
        {
             $this->redirect('../Message/lose');
        }

    }

/******************************************************/

    public function add_other()//其他信息发布页面
    {
            $username=$_SESSION['username'];
            if($username=="")
            {
                $this->error('你还未登陆');
            }
            $this->assign('username',$username);
            $this->display();//显示页面
    }

    public function message_add_other()  //其他信息发布
    {
        $username=session('username');
        if($username=="")
        {
            $this->error('你还未登陆');
        }

        import('ORG.Net.UploadFile');//引入上传类
        $upload = new UploadFile();// 实例化上传类
        $upload->maxSize  = 3145728 ;// 设置附件上传大小
        $upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->savePath =  './Uploads/';// 设置附件上传目录
        $upload->thumb= ture; //设置缩略图
        $upload->thumbPrefix = 'thumb2_,thumb_';//生产2张缩略图
        $upload->thumbMaxWidth      = '400,200'; //设置缩略图最大宽度
        $upload->thumbMaxHeight     = '400,200';//设置缩略图最大高度

        $upload->upload();
        $info =  $upload->getUploadFileInfo();




        $User = M("message_2"); // 连接表
        $User->create(); //通过表中的字段名称与表单提交的名称对应关系自动封装数据实例
         if($info[0]['savename']!="")
        {
            $User->image = $info[0]['savename']; // 保存上传的照片根据需要自行组装
        }

        if($info[1]['savename']!="")
        {
             $User->img2 = $info[1]['savename']; // 保存上传的照片根据需要自行组装
        }

        if($info[2]['savename']!="")
        {
             $User->img3 = $info[2]['savename']; // 保存上传的照片根据需要自行组装
        }

        if($info[3]['savename']!="")
        {
            $User->img4 = $info[3]['savename']; // 保存上传的照片根据需要自行组装
        }

        $User->message_username = $username;
        $User->span_1 = '其他';
        $User->span_2 = '主要标签：'.$_POST['span_2'];
        $User->span_3 = '标签1：'.$_POST['span_3'];
        $User->span_4 = '标签2：'.$_POST['span_4'];

        $User->time             = date("Y-m-d");            //保存当前时间
        $i=$User->add();                                    // 把数据对象添加到数据库

        if($i==0)
        {
            $this->error('系统错误,发布失败');
        }

        else
        {
             $this->redirect('../Message/other');
        }

    }



    /*
    // +----------------------------------------------------------------------
    // |                       校园信息查看详细信息页面                      |
    // +----------------------------------------------------------------------
    */

    function message_more()//查看详细信息
    {
        $username=$_SESSION['username'];//用户账号
        $userdata=M("user")->where("usernumber='$username'")->select();//找到用户数据
        $this->assign('userdata',$userdata);
        $this->assign('username',$username);

        $id=$_GET['id'];//获得当前消息ID
        Session::set('message_id',$_GET['id']);//将message_id存入session;

        $User=M("message_2");//实例化表
        $data = $User->where(" id = '$id' ")->select(); //通过当前消息id查找对应信息
        $this->assign('data', $data);//将数据传入模板
        $this->display();//显示页面
        $look_number = $User->where("  id = '$id'  ")->getField('look_number');  //获得浏览次数
        $User->find($id); // 查找主键为$id的数据
        $User->look_number=$look_number+1;
        $User->save();
    }



    /*
    // +----------------------------------------------------------------------
    // |                       校园信息用户留言模块                          |
    // +----------------------------------------------------------------------
    */

    public function comment()//详细信息界面　留言
    {

        if($_GET['message']!="")
        {
            $usernumber=session('username');
            $message_id=session('message_id');
            $comment=M("message_2")->where("id='$message_id'")->getField('comment');//获得当前消息评论次数
            M("message_2")->comment=$comment+1;
            M("message_2")->where("id='$message_id'")->save();//存入评论次数
            $img=M("user")->where("usernumber='$usernumber'")->getField('img'); //获得留言用户头像
            $nickname=M("user")->where("usernumber='$usernumber'")->getField('username');

            $m=M("comment");
            $m->username = session('username');
            $m->message_id= session('message_id');
            $m->img=$img;
            $m->nickname=$nickname;
            $m->message= $_GET['message'];
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
        $message_id= session('message_id');
        $data=M("comment")->where(" message_id = '$message_id' ")->order('id desc')->select();
        $this->ajaxReturn($data);
    }


}

?>
