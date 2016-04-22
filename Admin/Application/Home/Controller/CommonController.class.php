<?php
namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller {
   /**新增**/
	public function add(){
		$table=$_GET['table'];
		$post=$_POST;
		$obj=M($table);
		$id=$obj->add($post);
	}

   /**编辑**/
	public function edit(){
		$table=$_GET['table'];
		$id=$_GET['id'];
		$post=$_POST;
		$post['time']=date('Y-m-d');
		$obj=M($table);
		$id=$obj->where('id='.$id)->save($post);
		//redirect($_SERVER['HTTP_REFERER']);
		if($id){
		    $this->success('修改成功',$_SERVER['HTTP_REFERER'] );
			}else{
		    $this->error('修改失败');
	        }
		
	}
	/**查询全部**/
	public function lookAtOne($table,$map=array()){
		$obj=M($table);
		$arr=$obj->where($map)->find();
		return $arr;
	}
	/**查询多条**/
	public function lookAtMore($table,$map=array()){
		$obj=M($table);
		$arr=$obj->where($map)->select();
		return $arr;
	}
	
}