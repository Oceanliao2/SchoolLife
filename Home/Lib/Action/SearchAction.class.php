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
class SearchAction extends Action
{
	public function index()
	{
		$search=M("search")->order("count desc")->select();
		$this->assign('search',$search);
		$this->display();
	}

	public function search()
	{

		/*搜索热词*/
		if($_POST['mess']!=null)
		{
			$search=M("search");
			$word=$_POST['mess'];
			if($search->where("word='$word'")->count()==0)
			{
				$search->word=$word;
				$search->add();
			}

			else
			{
				$c=M("search")->where("word='$word'")->select();
				// 需要更新的数据
				$count=$c[0]['count'];
			    $data['count'] =$count+1;
			    // 更新的条件
			    $search->where("word='$word'")->save($data);
			}
		}

		/*搜索*/

		Session::set('search_mess',$_POST['mess']);//将message_id存入session;
        if(isset($_POST['mess']) && $_POST['mess']!=null)
        {
	        $where['message_tittle']= array('like',"%{$_POST['mess']}%");

	        $two=M("message_2")->where("span_1='二手交易'");
	        $two=$two->where($where)->select();
	        $this->assign('two',$two);

	        $find=M("message_2")->where("span_1='寻物启事'");
	        $find=$find->where($where)->select();
	        $this->assign('find',$find);

	        $lose=M("message_2")->where("span_1='失物招领'");
	        $lose=$lose->where($where)->select();
	        $this->assign('lose',$lose);

	        $other=M("message_2")->where("span_1='其他'");
	        $other=$other->where($where)->select();
	        $this->assign('other',$other);


	        $where2['part_name']= array('like',"%{$_POST['mess']}%");//校园活动
	        $part=M("part");
	        $part=$part->where($where2)->select();
			for($i=0;$i<M('part')->where($where2)->count();$i++)
			{
				$str = $part[$i]['part_message'];
				preg_match_all('/[\x{4e00}-\x{9fff}]+/u', $str, $matches);//过滤非汉字的字符
				$part[$i]['part_message'] = implode('', $matches[0]);
			}
	        $this->assign('part',$part);


	        $community=M("community");
	        $community=$community->where($where)->select();
			for($i=0;$i<M("community")->where($where)->count();$i++)
			{
				$str = $community[$i]['message_more'];
				preg_match_all('/[\x{4e00}-\x{9fff}]+/u', $str, $matches);//过滤非汉字的字符
				$community[$i]['message_more'] = implode('', $matches[0]);
			}
	        $this->assign('community',$community);


	        $essay=M("essay");
	        $essay=$essay->where($where)->select();
			for($i=0;$i<M("essay")->where($where)->count();$i++)
			{
				$str = $essay[$i]['message_more'];
				preg_match_all('/[\x{4e00}-\x{9fff}]+/u', $str, $matches);//过滤非汉字的字符
				$essay[$i]['message_more'] = implode('', $matches[0]);
			}
	        $this->assign('essay',$essay);


	        $video=M("video");
	        $video=$video->where($where)->select();
			for($i=0;$i<M("video")->where($where)->count();$i++)
			{
				$str = $video[$i]['message_more'];
				preg_match_all('/[\x{4e00}-\x{9fff}]+/u', $str, $matches);//过滤非汉字的字符
				$video[$i]['message_more'] = implode('', $matches[0]);
			}
	        $this->assign('video',$video);


	        $study=M("study");
	        $study=$study->where($where)->select();
			for($i=0;$i<M("study")->where($where)->count();$i++)
			{
				$str = $study[$i]['message_more'];
				preg_match_all('/[\x{4e00}-\x{9fff}]+/u', $str, $matches);//过滤非汉字的字符
				$study[$i]['message_more'] = implode('', $matches[0]);
			}
	        $this->assign('study',$study);

        }

        $count=count($two,COUNT_NORMAL)+count($find,COUNT_NORMAL)+count($lose,COUNT_NORMAL)+count($other,COUNT_NORMAL)+count($part,COUNT_NORMAL)+count($community,COUNT_NORMAL)+count($essay,COUNT_NORMAL)+count($video,COUNT_NORMAL)+count($study,COUNT_NORMAL);
        $this->assign('count',$count);
        $this->assign('look_0','look');


        $search=M("search")->order("count desc")->select();
		$this->assign('search',$search);
        $this->display('index');

	}

	public function search2()
	{
        if(isset($_SESSION['search_mess']))
        {
	        $where['message_tittle']= array('like',"%{$_SESSION['search_mess']}%");

	        $two=M("message_2")->where("span_1='二手交易'");
	        $two=$two->where($where)->select();
	        $this->assign('two',$two);

	        $find=M("message_2")->where("span_1='寻物启事'");
	        $find=$find->where($where)->select();
	        $this->assign('find',$find);

	        $lose=M("message_2")->where("span_1='失物招领'");
	        $lose=$lose->where($where)->select();
	        $this->assign('lose',$lose);

	        $other=M("message_2")->where("span_1='其他'");
	        $other=$other->where($where)->select();
	        $this->assign('other',$other);


	        $where2['part_name']= array('like',"%{$_SESSION['search_mess']}%");//校园活动
	        $part=M("part");
	        $part=$part->where($where2)->select();
			for($i=0;$i<M('part')->where($where2)->count();$i++)
			{
				$str = $part[$i]['part_message'];
				preg_match_all('/[\x{4e00}-\x{9fff}]+/u', $str, $matches);//过滤非汉字的字符
				$part[$i]['part_message'] = implode('', $matches[0]);
			}
	        $this->assign('part',$part);


	        $community=M("community");
	        $community=$community->where($where)->select();
			for($i=0;$i<M("community")->where($where)->count();$i++)
			{
				$str = $community[$i]['message_more'];
				preg_match_all('/[\x{4e00}-\x{9fff}]+/u', $str, $matches);//过滤非汉字的字符
				$community[$i]['message_more'] = implode('', $matches[0]);
			}
	        $this->assign('community',$community);


	        $essay=M("essay");
	        $essay=$essay->where($where)->select();
			for($i=0;$i<M("essay")->where($where)->count();$i++)
			{
				$str = $essay[$i]['message_more'];
				preg_match_all('/[\x{4e00}-\x{9fff}]+/u', $str, $matches);//过滤非汉字的字符
				$essay[$i]['message_more'] = implode('', $matches[0]);
			}
	        $this->assign('essay',$essay);


	        $video=M("video");
	        $video=$video->where($where)->select();
			for($i=0;$i<M("video")->where($where)->count();$i++)
			{
				$str = $video[$i]['message_more'];
				preg_match_all('/[\x{4e00}-\x{9fff}]+/u', $str, $matches);//过滤非汉字的字符
				$video[$i]['message_more'] = implode('', $matches[0]);
			}
	        $this->assign('video',$video);


	        $study=M("study");
	        $study=$study->where($where)->select();
			for($i=0;$i<M("study")->where($where)->count();$i++)
			{
				$str = $study[$i]['message_more'];
				preg_match_all('/[\x{4e00}-\x{9fff}]+/u', $str, $matches);//过滤非汉字的字符
				$study[$i]['message_more'] = implode('', $matches[0]);
			}
	        $this->assign('study',$study);
	        $this->assign('look_0','look');

        }

        $count=count($two,COUNT_NORMAL)+count($find,COUNT_NORMAL)+count($lose,COUNT_NORMAL)+count($other,COUNT_NORMAL)+count($part,COUNT_NORMAL)+count($community,COUNT_NORMAL)+count($essay,COUNT_NORMAL)+count($video,COUNT_NORMAL)+count($study,COUNT_NORMAL);
        $this->assign('count',$count);

        		$search=M("search")->order("count desc")->select();
		$this->assign('search',$search);
        $this->display('index');

	}

	public function two()
	{
		if(isset($_SESSION['search_mess']))
        {
	        $where['message_tittle']= array('like',"%{$_SESSION['search_mess']}%");

	        $two=M("message_2")->where("span_1='二手交易'");
	        $two=$two->where($where)->select();
	        $this->assign('two',$two);
	        $count=count($two,COUNT_NORMAL);
	        $this->assign('count',$count);
	         $this->assign('look_1','look');

	    }

	    		$search=M("search")->order("count desc")->select();
		$this->assign('search',$search);
	     $this->display('index');

	}

	public function find()
	{
		if(isset($_SESSION['search_mess']))
        {
	        $where['message_tittle']= array('like',"%{$_SESSION['search_mess']}%");

	        $find=M("message_2")->where("span_1='寻物启事'");
	        $find=$find->where($where)->select();
	        $this->assign('find',$find);

	        $count=count($find,COUNT_NORMAL);
	        $this->assign('count',$count);
	         $this->assign('look_3','look');

	    }

	    		$search=M("search")->order("count desc")->select();
		$this->assign('search',$search);
	     $this->display('index');

	}

	public function lose()
	{
		if(isset($_SESSION['search_mess']))
        {
	        $where['message_tittle']= array('like',"%{$_SESSION['search_mess']}%");

	        $lose=M("message_2")->where("span_1='失物招领'");
	        $lose=$lose->where($where)->select();
	        $this->assign('lose',$lose);

	        $count=count($lose,COUNT_NORMAL);
	        $this->assign('count',$count);
	         $this->assign('look_2','look');

	    }

	    		$search=M("search")->order("count desc")->select();
		$this->assign('search',$search);
	    $this->display('index');

	}


	public function other()
	{
		if(isset($_SESSION['search_mess']))
        {
	        $where['message_tittle']= array('like',"%{$_SESSION['search_mess']}%");

	        $other=M("message_2")->where("span_1='其他'");
	        $other=$other->where($where)->select();
	        $this->assign('other',$other);

	        $count=count($other,COUNT_NORMAL);
	        $this->assign('count',$count);
	         $this->assign('look_4','look');

	    }

	    		$search=M("search")->order("count desc")->select();
		$this->assign('search',$search);
	     $this->display('index');

	}


	public function part()
	{
		if(isset($_SESSION['search_mess']))
        {
	        $where['part_name']= array('like',"%{$_SESSION['search_mess']}%");//校园活动
	        $part=M("part");
	        $part=$part->where($where)->select();
			for($i=0;$i<M('part')->where($where)->count();$i++)
			{
				$str = $part[$i]['part_message'];
				preg_match_all('/[\x{4e00}-\x{9fff}]+/u', $str, $matches);//过滤非汉字的字符
				$part[$i]['part_message'] = implode('', $matches[0]);
			}
	        $this->assign('part',$part);
	       	$count=count($part,COUNT_NORMAL);
	        $this->assign('count',$count);
	         $this->assign('look_5','look');

	    }

	    		$search=M("search")->order("count desc")->select();
		$this->assign('search',$search);
	    $this->display('index');

	}


	public function community()
	{
		if(isset($_SESSION['search_mess']))
        {
        	$where['message_tittle']= array('like',"%{$_SESSION['search_mess']}%");
			$community=M("community");
	        $community=$community->where($where)->select();
			for($i=0;$i<M("community")->where($where)->count();$i++)
			{
				$str = $community[$i]['message_more'];
				preg_match_all('/[\x{4e00}-\x{9fff}]+/u', $str, $matches);//过滤非汉字的字符
				$community[$i]['message_more'] = implode('', $matches[0]);
			}
	        $this->assign('community',$community);
	        $count=count($community,COUNT_NORMAL);
	        $this->assign('count',$count);
	         $this->assign('look_6','look');

	    }

	    		$search=M("search")->order("count desc")->select();
		$this->assign('search',$search);
	    $this->display('index');

	}


	public function essay()
	{
		if(isset($_SESSION['search_mess']))
        {
        	$where['message_tittle']= array('like',"%{$_SESSION['search_mess']}%");
			$essay=M("essay");
	        $essay=$essay->where($where)->select();
			for($i=0;$i<M("essay")->where($where)->count();$i++)
			{
				$str = $essay[$i]['message_more'];
				preg_match_all('/[\x{4e00}-\x{9fff}]+/u', $str, $matches);//过滤非汉字的字符
				$essay[$i]['message_more'] = implode('', $matches[0]);
			}
	        $this->assign('essay',$essay);
	        $count=count($essay,COUNT_NORMAL);
	        $this->assign('count',$count);
	         $this->assign('look_7','look');

	    }

	    		$search=M("search")->order("count desc")->select();
		$this->assign('search',$search);
	     $this->display('index');

	}


	public function video()
	{
		if(isset($_SESSION['search_mess']))
        {
        	$where['message_tittle']= array('like',"%{$_SESSION['search_mess']}%");
			$video=M("video");
	        $video=$video->where($where)->select();
			for($i=0;$i<M("video")->where($where)->count();$i++)
			{
				$str = $video[$i]['message_more'];
				preg_match_all('/[\x{4e00}-\x{9fff}]+/u', $str, $matches);//过滤非汉字的字符
				$video[$i]['message_more'] = implode('', $matches[0]);
			}
	        $this->assign('video',$video);
	        $count=count($video,COUNT_NORMAL);
	        $this->assign('count',$count);
	         $this->assign('look_8','look');

	    }

	    		$search=M("search")->order("count desc")->select();
		$this->assign('search',$search);
	     $this->display('index');

	}


	public function study()
	{
		if(isset($_SESSION['search_mess']))
        {
        	$where['message_tittle']= array('like',"%{$_SESSION['search_mess']}%");
			$study=M("study");
	        $study=$study->where($where)->select();
			for($i=0;$i<M("study")->where($where)->count();$i++)
			{
				$str = $study[$i]['message_more'];
				preg_match_all('/[\x{4e00}-\x{9fff}]+/u', $str, $matches);//过滤非汉字的字符
				$study[$i]['message_more'] = implode('', $matches[0]);
			}
	        $this->assign('study',$study);
	        $count=count($study,COUNT_NORMAL);
	        $this->assign('count',$count);
	         $this->assign('look_9','look');

	    }

	    		$search=M("search")->order("count desc")->select();
		$this->assign('search',$search);
	    $this->display('index');
	}


}
?>
