<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->display(index);
    }
    public function Main(){
		
    }	
/**
左侧管理菜单
*/
	public function LeftMenu(){
		   $resourceType = I("post.resourceType");
		   $Core[] = array("resourceName"=>"信息管理","parentID"=>0,"resourceID"=>1,  "accessPath"=>"");
		   $Core[] = array("resourceName"=>"信息发布管理","parentID"=>1,"resourceID"=>101,"accessPath"=>U("Home/Index/two"));
		   $Core[] = array("resourceName"=>"活动信息管理","parentID"=>1,"resourceID"=>102,"accessPath"=>U("Home/Index/product_list"));
		   $Core[] = array("resourceName"=>"社区信息管理","parentID"=>1,"resourceID"=>103,"accessPath"=>U("Home/Index/member"));
		   $Core[] = array("resourceName"=>"其他信息管理","parentID"=>1,"resourceID"=>104,"accessPath"=>U("Home/Index/order_list"));

		   $Data["Core"] = $Core;
		   
		   $resourceType = $Data[$resourceType];
		   $resourceType[] = array("resourceName"=>"技术支持","parentID"=>0,"resourceID"=>9,  "accessPath"=>"");
		   $resourceType[] = array("resourceName"=>"参考文档","parentID"=>9,"resourceID"=>901,"accessPath"=>"");
		   $resourceType[] = array("resourceName"=>"意见反馈","parentID"=>9,"resourceID"=>902,"accessPath"=>"");
		   	   
		   $this->ajaxReturn($resourceType); 
	}		
	/**
	删除
	*/
	public function deleAttr(){
		$table=$_GET['table'];
		$id=$_GET['id'];
		$db=M($table);
		if($db->delete($id)){
		    $this->success('删除成功');
			}else{
		    $this->error('删除失败');
	        }
	}	
	public function two(){
		/**
		查询
		*/
		if(IS_POST){
			$n=$_POST['condition'];
			
			$arr=A('Common')->lookAtMore("message_2",array("span_1"=>$n));
		}else{
			$arr=A('Common')->lookAtMore("message_2");
		}
		$this->assign("arr",$arr);
		$this->display("two");
		}
		

}