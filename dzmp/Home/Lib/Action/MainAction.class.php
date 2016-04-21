<?php
// 本类由系统自动生成，仅供测试用途
import('ORG.Util.Session');
class MainAction extends Action {

    public function index()
    {
        $id=$_GET["id"];
        $data = M("user")->where("id = '$id'")->select();
        $this->assign('data', $data);
        $this->display();
    }

    public function index3()
    {
        $id=$_GET["id"];
        $data = M("user")->where("id = '$id'")->select();
        $this->assign('data', $data);
        $this->display();
    }

    public function index4()
    {
        $id=$_GET["id"];
        $data = M("user")->where("id = '$id'")->select();
        $this->assign('data', $data);
        $this->display();
    }

    public function index1()
    {
        $username=$_SESSION['username'];
        if($username==null) $this->error("您还未登陆","login");

        $data = M("user")->where("recycle=0")->select();
        $this->assign('data', $data);
        $this->display();
    }


    public function index2()
    {
        $username=$_SESSION['username'];
        if($username==null) $this->error("您还未登陆","login");
    	$this->display();
    }

    public function add_pass()
    {
        $username=$_SESSION['username'];
        if($username==null) $this->error("您还未登陆","login");

        import('ORG.Net.UploadFile');//引入上传类
        $upload = new UploadFile();// 实例化上传类
        $upload->maxSize  = 3145728 ;// 设置附件上传大小
        $upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->savePath =  './Uploads/';// 设置附件上传目录
        $upload->thumb= ture; //设置缩略图
        $upload->thumbPrefix = 'thumb4_,thumb3_,thumb2_,thumb_';//生产2张缩略图
        $upload->thumbMaxWidth      = '180,1366,680,180'; //设置缩略图最大宽度
        $upload->thumbMaxHeight     = '249,683,900,180';//设置缩略图最大高度
       
        if(!$upload->upload()) 
        {   
            // 上传错误提示错误信息
            $this->error($upload->getErrorMsg());
        }

        else
        {  // 上传成功 获取上传文件信息
            $info =  $upload->getUploadFileInfo();
        }
        $Mess = M("user");
        $Mess->create();
        $Mess->img = $info[0]['savename'];
        $Mess->background = $info[1]['savename']; 
        $Mess->add();
        $this->success("添加成功","index1");
    }

    public function update()
    {
        $username=$_SESSION['username'];
        if($username==null) $this->error("您还未登陆","login");

        $id=$_GET["id"];
        $data = M("user")->where("id = '$id'")->select();
        $this->assign('data', $data);
        Session::set('id',$_GET['id']);//将username存入session; 
        $this->display();
    }



    public function update_pass()
    {  
        $username=$_SESSION['username'];
        if($username==null) $this->error("您还未登陆","login");

        import('ORG.Net.UploadFile');//引入上传类
        $upload = new UploadFile();// 实例化上传类
        $upload->maxSize  = 3145728 ;// 设置附件上传大小
        $upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->savePath =  './Uploads/';// 设置附件上传目录
        $upload->thumb= ture; //设置缩略图
        $upload->thumbPrefix = 'thumb4_,thumb3_,thumb2_,thumb_';//生产2张缩略图
        $upload->thumbMaxWidth      = '180,1366,680,180'; //设置缩略图最大宽度
        $upload->thumbMaxHeight     = '249,683,900,180';//设置缩略图最大高度
        $upload->upload();
        $info =  $upload->getUploadFileInfo();



        $id=$_SESSION['id'];//用户账号
        // 需要更新的数据
        $data = M("user");
        $data->create();
        if ($info[0]['savename']!=null) {
            $data->img = $info[0]['savename'];
        }
        
        $data->background = $info[1]['savename']; 
        // 更新的条件
        //$condition['id'] = $id;
        $result = $data->where("id='$id'")->save();
        $this->success("修改成功","index1");
    }


    public function del()
    {
       $username=$_SESSION['username'];
       if($username==null) $this->error("您还未登陆","login");

       $id=$_GET["id"];
       $data = M("user");
       $data->recycle = 1;
       $data->where("id='$id'")->save();
       $this->redirect('index1'); 


    }

    public function login()
    {
        $this->display();
    }

    public function login_pass()
    {
          $admin=M("admin");
          $username=$_POST["username"];
          $password=$_POST["password"];
          $where['username'] = $username;
          $where['password'] = $password;
          $i=$admin->where($where)->count();
          if($i!=0)
          {
            Session::set('username',$username);//将username存入session; 
            $this->redirect('index1');
          }

          else
          {
            $this->error("管理员账号错误");
          }

    }

    public function recycle()
    {
        $username=$_SESSION['username'];
        if($username==null) $this->error("您还未登陆","login");

        $data = M("user")->where("recycle=1")->select();
        $this->assign('data', $data);
        $this->display();
    }

    public function save()
    {
        $username=$_SESSION['username'];
       if($username==null) $this->error("您还未登陆","login");

       $id=$_GET["id"];
       $data = M("user");
       $data->recycle = 0;
       $data->where("id='$id'")->save();
       $this->redirect('index1');        
    }

    public function rel_del()
    {
        $username=$_SESSION['username'];
        if($username==null) $this->error("您还未登陆","login");
        
        $id=$_GET["id"];
        M("user")->where("id = '$id'")->delete();
        $this->redirect('index1');
    }




}