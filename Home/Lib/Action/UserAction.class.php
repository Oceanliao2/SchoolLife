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
class UserAction extends Action //用户登录注册模块
{
	function code ()//生成验证码方法
	{
		import("ORG.Util.Image");//引入Image类
		//ob_end_clean();
        Image::buildImageVerify(4,1,png,270,30,verify);//调用buildImageVerify()方法
    }

	function login()
	{    
		$this->display();   
	}  

    function login_pass()
	{  
		$m=M('user');  
		$where['usernumber']=$_GET["username"];
		$where['password']=md5($_GET["password"]);

		$i=$m->where($where)->count();
		if($i>0)//检测账号信息
		{   import('ORG.Util.Session');//导入session类
			Session::set('username',$_GET['username']);//将username存入session; 
			$U=$_GET['username'];
			$m=M("user")->where("usernumber='$U'")->select();//寻找用户昵称
			M("user")->lasttime=date("Y-m-d"); 
			M("user")->where("usernumber='$U'")->save();
			$data=$m[0]['username'];
			$this->ajaxReturn($data);
		}
		else
		{  
			$data=0;
			$this->ajaxReturn($data);
		}
	}

	function logout()//退出登陆
	{
		session(null);
		$this->redirect('First/index2');
	}

	function add()//显示注册界面
	{
		$this->display();
	}

	function add_pass()//验证注册信息
	{
		$m=M('user');
		$where['usernumber']=$_GET["usernumber"];

		$i=$m->where($where)->count();//检测填入字段是否与数据库匹配,并返回数量

		if($i==0)//检测用户名是否已注册
		{
			$_GET['password']=md5($_GET['password']);
			$_GET['addtime']=date("Y-m-d");
			if($m->add($_GET))
			{  
				import('ORG.Util.Session');//导入session类
				Session::set('username',$_GET['usernumber']);//将username存入session; 
				$this->ajaxReturn($_GET,'',1);//注册成功     
			}
			else
			{
				$this->ajaxReturn($_GET,'',0);//注册失败
			}
		}
		else
		{  
			$this->ajaxReturn(0,'',2);//用户已注册   
		}
	}


	function usermessage()// 显示个人信息
	{
	  $User=M('user');
	  $username = session('username');//获得Login模块的session值
      $usermessage = $User->where(" username = '$username' ")->select();
      $this->assign('usermessage',$usermessage);//将值传入模板
      $this->display();//显示页面
	}

	function usermessage_pass()//修改个人信息
	{	//连接表
		$User=M('user');
		//获得当前登录用户名
		$username = session('username');
		//找到对应行 
		$id = $User->where(" username = '$username' ")->getField('id');        
		$User->find($id); // 查找主键为$nickname的数据

		$User->username=$_GET['username'];
		$User->age=$_GET['age'];
		$User->start=$_GET['start'];
		$result=$User->save(); 

		if(!$result)
        {
          //  $this->ajaxReturn($_GET,'',1);//成功  
        	$data=0;
            $this->ajaxReturn($data);
        }

        else
        {
        	$data=1;
        	$this->ajaxReturn($data);
        	$User=M('user'); 
        	//$this->ajaxReturn($_GET,'',0);//失败
        }
	}


	//function SendMail($address,$title,$message)
	function SendMail() 
	{
		import('ORG.Util.PHPMailer');
		$mail=new PHPMailer();
		// 设置PHPMailer使用SMTP服务器发送Email
		$mail->IsSMTP();
		// 设置邮件的字符编码，若不指定，则为'UTF-8'
		$mail->Mailer   = "SMTP";
		$mail->CharSet='UTF-8';
		// 添加收件人地址，可以多次使用来添加多个收件人
		$mail->AddAddress('2955324432@qq.com');
		// 设置邮件正文
		$mail->Body='234';
		// 设置邮件头的From字段。
		$mail->From='1576701411@qq.com';
		// 设置发件人名字
		$mail->FromName='校园生活网';
		// 设置邮件标题
		$mail->Subject='123';
		// 设置SMTP服务器。
		$mail->Host='smtp.qq.com';
		// 设置为“需要验证”
		$mail->SMTPAuth=true;
		// 设置用户名和密码。
		$mail->Username='1576701411@qq.com';
		$mail->Password='WSY6547704518';
		// 发送邮件。
		//return($mail->Send());
		$mail->Send();
		//返回错误
		echo $mail->ErrorInfo;
	}

	function find_code()
	{
		$this->display();
	}

	function find_code_pass()
	{
		$m=M('user');
		$where['usernumber']=$_GET["username"];
		$i=$m->where($where)->count();//检测填入字段是否与数据库匹配,并返回数量

		if($i==0)//检测用户名是否已注册
		{
			$this->ajaxReturn(2);
		}

		else
		{
			$userdata=$m->where($where)->select();//找到用户数据
			$username=$userdata[0]['username'];
			$usernumber=$userdata[0]['usernumber'];
			$password=$userdata[0]['password'];
			$address=$usernumber;
			$title='您好'.$username;
			$message='您正在修改密码，点击以下链接继续之后的操作，请勿将链接透露给他人http://www.shzlife.com/index.php/User/find_code_mail?usernumber='.$usernumber.'&password='.$password;
			import('ORG.Util.PHPMailer');
			$mail=new PHPMailer();
			// 设置PHPMailer使用SMTP服务器发送Email
			$mail->IsSMTP();
			// 设置邮件的字符编码，若不指定，则为'UTF-8'
			$mail->CharSet='UTF-8';
			// 添加收件人地址，可以多次使用来添加多个收件人
			$mail->AddAddress($address);
			// 设置邮件正文
			$mail->Body=$message;
			// 设置邮件头的From字段。
			$mail->From='1576701411@qq.com';
			// 设置发件人名字
			$mail->FromName='校园生活网';
			// 设置邮件标题
			$mail->Subject=$title;
			// 设置SMTP服务器。
			$mail->Host='smtp.qq.com';
			// 设置为“需要验证”
			$mail->SMTPAuth=true;
			// 设置用户名和密码。
			$mail->Username='1576701411@qq.com';
			$mail->Password='WSY6547704518';
			// 发送邮件。
			//return($mail->Send());
			$mail->Send();
			//返回错误
			$data=$mail->ErrorInfo;
			$this->ajaxReturn($data);
		}
	}

	function find_code_mail()
	{
		$where['password']=$_GET["password"];
		$where['usernumber']=$_GET["usernumber"];
		$i=$m->where($where)->count();
		if($i>0)
		{
			$this->display();
			import('ORG.Util.Session');
		    Session::set('update_password_usernumber',$_GET["usernumber"]);
		}
		else
		{
			$this->error("系统错误");
		}
	}

	function find_code_mail_pass()
	{
		$usernumber = session('update_password_usernumber');
		$password = $_POST['password'];
		$m=M('user');
		$m->password=md5($password);
		$result = $m->where("usernumber='$usernumber'")->save();
		if($result !== false)
	    {
	        $this->success('修改成功');
	    }
	    else
	    {
	        $this->error('系统临时出了点小问题，请稍候再试');
	    }
	}

	function user_suggest()
	{
		$data=M("admin_first")->select();
		$this->assign('data',$data);//将值传入模板
        $this->display();//显示页面		
	}

	function about()
	{
		$this->redirect('./First/essay');
	}

}
?>
