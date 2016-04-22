<?php
function CurlPost($url, $data=array(),$type="tojson", $timeout = 30)//远程连接获取函数
{
  $ssl = substr($url,0,8) == "https://" ? TRUE : FALSE;
  $ch  = curl_init();
  if($type=="tojson"){
	  $data = Json($data);
	  }
  $opt =  array(CURLOPT_URL=>$url,CURLOPT_POST=>1,CURLOPT_HEADER=>0,CURLOPT_POSTFIELDS=>$data,CURLOPT_RETURNTRANSFER=>1,CURLOPT_TIMEOUT=> $timeout);
  if ($ssl){$opt[CURLOPT_SSL_VERIFYHOST] = 1;$opt[CURLOPT_SSL_VERIFYPEER]=FALSE;}
  @curl_setopt_array($ch, $opt);
  $Reposns = curl_exec($ch);
  curl_close($ch);
  return $Reposns;
}

function Len($str)//字符长度
{    
	$i = 0;  
	$count = 0;  
	$len = strlen ($str);  
	while($i < $len){  
		$chr = ord ($str[$i]);  
		$count++;  
		$i++;  
		if($i >= $len)break;  
		if($chr & 0x80) {  
			$chr <<= 1;  
			while($chr & 0x80) {  
			  $i++;  
			  $chr <<= 1;  
			}  
		}  
	}  
	return $count;  
}  

function Sub($str,$len,$dot="...")//字符截取函数
{
	if($len<=0){
	  return ;
	  }
	if(len($str)<=$len){
	  return $str;
	  }
	$res="";
	$offset=0;
	$chars=0;
	$length=strlen($str);
	while($chars<$len && $offset<$length){

		$hign=decbin(ord(substr($str,$offset,1)));
			if(strlen($hign)<8){
				$count=1;
			}elseif(substr($hign,0,3)=="110"){
				$count=2;
			}elseif(substr($hign,0,4)=="1110"){
				$count=3;
			}elseif(substr($hign,0,5)=="11110"){
				$count=4;
			}elseif(substr($hign,0,6)=="111110"){
				$count=5;
			}elseif(substr($hign,0,7)=="1111110"){
				$count=6;
			}

		$res.=substr($str,$offset,$count);
		$offset+=$count;
		$chars+=1;

	}
	return $res.$dot;
}

function Format2Money($STR)//数字转货币
{ 
	if ( $STR == "" ) 
	{ 
	   return ""; 
	} 
	if ( $STR == ".00" ) 
	{ 
	   return "0.00"; 
	} 
	$TOK = strtok( $STR, "." ); 
	if ( strcmp( $STR, $TOK ) == "0" ) 
	{ 
	   $STR .= ".00"; 
	} 
	else 
	{ 
	   $TOK = strtok( "." ); 
	for ($I=1;$I<=(2-strlen($TOK));$I++) 
	{ 
	   $STR .= "0"; 
	} 
	} 
	if ( substr( $STR, 0, 1 ) == "." ) 
	{ 
	   $STR = "0".$STR; 
	} 
	return $STR; 
}

function Randomkeys($length,$rlen=9)//生成php随机数
{
 $key = "";
 $pattern='1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLOMNOPQRSTUVWXYZ';
 for($i=0;$i<$length;$i++)
 {
   $key .= $pattern{mt_rand(0,$rlen)};    
 }
 return $key;
}

function authcode($string,$operation='DECODE',$skey = '') { //加密解密函数
			$original = array('=', '+', '/');
			$later = array('O0O0O', 'o0O0o', 'oo00o');  
			$skey = $skey?$skey:'ui' ;
			$skey = md5(substr($skey, 0, 16));   
			if($operation=="DECODE"){
				$strArr = str_split(str_replace($later,$original,$string),2);
				$strCount = count($strArr);
				foreach (str_split($skey) as $key => $value)
				{
					$key < $strCount && $strArr[$key][1] === $value && $strArr[$key] = $strArr[$key][0];
				}       
				$result = base64_decode(join('', $strArr));         
				if(substr($result, 0, 10) == 0 || substr($result, 0, 10) - time > 0)
				{
					return substr($result, 10);
				}
				else
				{
					return false;
				}     
			}
			if($operation=="ENCODE"){
			  if(is_array($string))
			  {
				  $string = json_encode($string); // uicms::json($string, true, 'en');
			  }               
			  $string = str_pad($expiry ? $expiry + time:0,10,0).$string;     
			  $strArr = str_split(base64_encode($string));
			  $strCount = count($strArr); 
			  foreach (str_split($skey) as $key => $value)
			  {
				  $key < $strCount && $strArr[$key].=$value;
			  }
			  return str_replace($original,$later,join('',$strArr));
			}
			//$str = $string;
			return $str;
} 

function BadWord($str,$badword){//过滤敏感词

	if(!is_array($badword))return $str;
	return strtr($str,$badword);
}

function In($str1,$str2){//检查字符串/数组是否包含
	if(is_array($str1)){
		$str1=array_reverse($str1);
		if(is_array($str2)){//两个都为数组
			for($i=0;$i<count($str1);$i++){
				if(in_array($str1[$i],$str2))return true;
			}
			}else{//$str2 为字符串
				for($i=0;$i<count($str1);$i++){
					if(count(explode($str1[$i],$str2))>1)return true;
					}
				}
		}else{
		if(is_array($str2)){//str2为数组
			if(in_array($str1,$str2))return true;
			}else{//$str2 为字符串
				if(count(explode($str1,$str2))>1)return true;
				}			
		}
	return false;
}

function tranTime($time) {
	$now_time = date("Y-m-d H:i:s", time());
	$now_time = strtotime($now_time);
	//$time = strtotime($the_time);
	$dur = $now_time - $time;
	if ($dur < 0) {
		return $the_time;
	} else {
		if ($dur < 60) {
			return $dur . '秒前';
		} else {
			if ($dur < 3600) {
				return floor($dur / 60) . '分钟前';
			} else {
				if ($dur < 86400) {
					return floor($dur / 3600) . '小时前';
				} else {
					if ($dur < 259200) {//3天内
						return floor($dur / 86400) . '天前';
					} else {
						return date("Y-m-d",$time);
					}
				}
			}
		}
	}
}


function Tsetting($str){//自动排版
	$str=trim($str);//去除首尾空格
	$str=preg_replace("/<(\/?br.*?)>/si","\r\n",$str); 
	$str=preg_replace("/<(\/?p.*?)>/si","\r\n",$str); //率先把能想到的换行符换成\r\n
	$search = array (
	"'<script[^>]*?>.*?</script>'si", // 去掉 javascript 
	"'<style[^>]*?>.*?</style>'si", // 去掉 css 
	"'<span[^>]*?>.*?</span>'si", // 去掉 css 
	"'<!--[/!]*?[^<>]*?>'si", // 去掉 注释标记 
	"'([rn])[s]+'", // 去掉空白字符 
	"'&(quot|#34);'i", // 替换 HTML 实体 
	"'&(amp|#38);'i", 
	"'&(lt|#60);'i", 
	"'&(gt|#62);'i", 
	"'&(nbsp|#160);'i", 
	"'&(iexcl|#161);'i", 
	"'&(cent|#162);'i", 
	"'&(pound|#163);'i", 
	"'&(copy|#169);'i", 
	"'&#(d+);'e"); // 作为 PHP 代码运行 
	$replace = array (
	"", 
	"", 
	"$1", 
	"", 
	"\1", 
	"\"", 
	"&", 
	"<", 
	">", 
	" ", 
	chr(161), 
	chr(162), 
	chr(163), 
	chr(169), 
	"chr(\1)"); 
	$str = preg_replace($search, $replace, $str);//格式化文本
	$str=str_replace("#pic#","<img",$str); //还原图片标记
	$str=preg_replace("/<(\/?img.*?)>/si","<center><$1></center>",$str); //恢复图片标记
	$str=str_replace("\r\n","</p>\n<p>",$str);//用p标签代替换行符
	$str="<p>".$str."</p>";//添加首尾P标签
	$str=preg_replace("/(\s)+/i","",$str);//去除空白
	$str=str_replace("　","",$str);//去除空白
	$str=str_replace(" ","",$str);//去除空白
	$str=str_replace("<p></p>","",$str); //去除空段落
	$str=str_replace("</p>","</p>\n\n",$str); //整理html代码
	$str=str_replace("<img","<img ",$str); //恢复图片标记
	$str=str_replace("'","' ",$str); //恢复图片标记
	$str=str_replace('"','" ',$str); //恢复图片标记
	$str=str_replace("<p>","<p style=\"text-indent:2em;\">",$str); //添加首行缩进
	//$str=str_replace("<p>","<p>　　",$str); //添加首行缩进
	return $str;	
}
?>