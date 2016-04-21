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
class ChatAction extends Action
{
	public function message()
	{
		$this->display();
	}

	public function look()//显示留言
	{
		$data=M(message)->order('id desc')->limit('5')->select();
		$this->ajaxReturn($data);
	}

	public function message_add()
	{
		$m=M("message");
		if($m->add($_GET))
		{
			$this->ajaxReturn($_GET,'添加信息成功',1);
		}
		else
		{
			$this->ajaxReturn(0,'添加信息失败',0);
		}

	}


}
?>
