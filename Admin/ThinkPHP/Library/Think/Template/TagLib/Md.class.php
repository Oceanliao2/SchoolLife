<?php
namespace Think\Template\TagLib;
use Think\Template\TagLib;
class Md extends TagLib {

    // 标签定义
    protected $tags   =  array(
        'ext'       =>  array('attr'=>'name,id,par,offset,length,key,mod','level'=>3,'alias'=>'iterate'),
		'prt'       =>  array('attr'=>'name,par,cek,id','close'=>0),
        );

    public function _ext($tag,$content) {
        $ext   =    explode(":",$tag['name']);
		$name  =    $ext[0];
		$fun   =    $ext[1];
		$act   =    $ext[0];
        $id    =    $tag['id'];
        $empty =    isset($tag['empty'])?$tag['empty']:'';
        $key   =    !empty($tag['key'])?$tag['key']:'i';
        $mod   =    isset($tag['mod'])?$tag['mod']:'2';
		$offset =   !empty($tag['offset'])?$tag['offset']:0;
		
		$parseStr    =  '<?php ';
        if(!empty($tag["par"])){
			$tag["par"] = str_replace("::","=>",$tag["par"]);
			$param =    explode("|",$tag["par"]);
			for($n=0;$n<count($param);$n++){
				$parTemp = $param[$n];
				
				if(strpos($param[$n],"$")===0){
					  $parseStr    .=  '$par'.$n." = ".$parTemp.";";
				}elseif(strpos($parTemp,"array")===0){
				      $parseStr    .=  '$par'.$n." = ".$parTemp.";";
				}else{
					  $parseStr    .=  '$par'.$n." = '".$parTemp."'".";";
				}
				$P[] = '$par'.$n;
				}
				$P = implode(",",$P);
				$parseStr   .=  '$'.$name.'=Ext("'.$act.'")->'.$fun.'('.$P.');';
			}else{
				$parseStr   .=  '$'.$name.'=Ext("'.$act.'")->'.$fun.'();';
		}
		
        if(0===strpos($name,':')) {
            $parseStr   .= '$_result='.substr($name,1).';';
            $name   = '$_result';
        }else{
            $name   = $this->autoBuildVar($name);
        }
		
		
        $parseStr  .=  'if(is_array('.$name.')): $'.$key.' = 0;';
        if(isset($tag['length']) && '' !=$tag['length'] ) {
            $parseStr  .= ' $__LIST__ = array_slice('.$name.','.$offset .','.$tag['length'].',true);';
        }elseif(isset($tag['offset'])  && '' !=$tag['offset']){
            $parseStr  .= ' $__LIST__ = array_slice('.$name.','.$offset .',null,true);';
        }else{
            $parseStr .= ' $__LIST__ = '.$name.';';
        }
        $parseStr .= 'if( count($__LIST__)==0 ) : echo "'.$empty.'" ;';
        $parseStr .= 'else: ';
        $parseStr .= 'foreach($__LIST__ as $key=>$'.$id.'): ';
        $parseStr .= '$mod = ($'.$key.' % '.$mod.' );';
        $parseStr .= '++$'.$key.';?>';
        $parseStr .= $this->tpl->parse($content);
        $parseStr .= '<?php endforeach; endif; else: echo "'.$empty.'" ;endif; ?>';

        if(!empty($parseStr)) {
            return $parseStr;
        }
        return ;
    }


    public function _prt($tag) {
        $ext   =    explode(":",$tag['name']);
		$act   =    $ext[0];
		if(!empty($tag['id'])){
		  $name  =  $tag['id'];	
		}else{
		  $name  =  $act;
		}
		$fun   =    $ext[1];
		$parseStr    =  '<?php ';
		if(!empty($tag["par"])){
		$tag["par"] = str_replace("::","=>",$tag["par"]);
		$param =    explode("|",$tag["par"]);
        for($n=0;$n<count($param);$n++){
			$parTemp = $param[$n];
			
			if(strpos($param[$n],"$")===0){
				  $parseStr    .=  '$par'.$n." = ".$parTemp.";";
			}elseif(strpos($parTemp,"array")===0){
				  $parseStr    .=  '$par'.$n." = ".$parTemp.";";
			}else{
				  $parseStr    .=  '$par'.$n." = '".$parTemp."'".";";
			}
			$P[] = '$par'.$n;
			}
            $P = implode(",",$P);
			$parseStr   .=  '$'.$name.'=Ext("'.$act.'")->'.$fun.'('.$P.');';
		}else{
		    $parseStr   .=  '$'.$name.'=Ext("'.$act.'")->'.$fun.'();';
		}
		
		
		
		if(!empty($tag['cek'])){
		  $parseStr   .=  $tag['cek'].'$'.$name.';';
 		}
		$parseStr   .=  '?> ';
		return $parseStr;
    }
}
