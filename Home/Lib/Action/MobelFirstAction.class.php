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

class MobelFirstAction extends Action //主页
{
	public function index()
	{
      	$this->display();//显示页面
	}

	public function new_part()//最新活动
	{
		$data = M('part')->limit(2)->select();
		$this->ajaxReturn($data);
	}

	public function new_two()//最新二手交易
	{
        $data = M('message_2')->where(" span_1='二手交易'")->order('id desc')->limit(4)->select(); // 查询数据
		$this->ajaxReturn($data);
	}

	public function new_lose()//最新失物招领
	{
        $data = M('message_2')->where(" span_1='失物招领'")->order('id desc')->limit(4)->select(); // 查询数据
        $this->ajaxReturn($data);
	}

	public function new_find()//最新寻物启事
	{
        $data = M('message_2')->where(" span_1='寻物启事'")->order('id desc')->limit(4)->select(); // 查询数据
        $this->ajaxReturn($data);
	}


    public function new_other()//最新其他信息
    {
    	$data = M('message_2')->where(" span_1='其他'")->order('id desc')->limit(4)->select(); // 查询数据
        $this->ajaxReturn($data);
    }


	public function look_message_more()//查看详细信息
    {
        $id=$_GET['id'];//获得当前消息ID
        Session::set('message_more_id',$_GET['id']);//将message_id存入session;
        $User=M("message_2");//实例化表
        $data = $User->where(" id = '$id' ")->select(); //通过当前消息id查找对应信息
        $look_number = $User->where("  id = '$id'  ")->getField('look_number');  //获得浏览次数
        $User->find($id); // 查找主键为$id的数据
        $User->look_number=$look_number+1;
        $User->save();
        $this->ajaxReturn($data);
    }

		public function img_upload()
		{
				import('ORG.Net.UploadFile');//引入上传类
				$upload = new UploadFile();// 实例化上传类
				$upload->maxSize  = 3145728 ;// 设置附件上传大小
				$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
				$upload->savePath =  './Uploads/';// 设置附件上传目录
				$upload->thumb= ture; //设置缩略图
				$upload->thumbPrefix = 'thumb2_,thumb_';//生产2张缩略图
				$upload->thumbMaxWidth      = '200,200'; //设置缩略图最大宽度
				$upload->thumbMaxHeight     = '200,200';//设置缩略图最大高度
				$upload->upload();
				$info =  $upload->getUploadFileInfo();
				$data ='http://localhost/scwelife/web/Uploads/'.$info[0]['savename'];
				$this->ajaxReturn($data);
		}


}

?>
