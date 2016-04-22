<?php
function Format($data, $indent=null){
	$ret = '';
	$pos = 0;
	$length = strlen($data);
	$indent = isset($indent)? $indent : '    ';
	$newline = "\n";
	$prevchar = '';
	$outofquotes = true;

	for($i=0; $i<=$length; $i++){

		$char = substr($data, $i, 1);

		if($char=='"' && $prevchar!='\\'){
			$outofquotes = !$outofquotes;
		}elseif(($char=='}' || $char==']') && $outofquotes){
			$ret .= $newline;
			$pos --;
			for($j=0; $j<$pos; $j++){
				$ret .= $indent;
			}
		}

		$ret .= $char;
		
		if(($char==',' || $char=='{' || $char=='[') && $outofquotes){
			$ret .= $newline;
			if($char=='{' || $char=='['){
				$pos ++;
			}

			for($j=0; $j<$pos; $j++){
				$ret .= $indent;
			}
		}

		$prevchar = $char;
	}

	return $ret;
}

function Object2Array($array)//对象转数组
{
 if(is_object($array))
 {
  $array = (array)$array;
 }
 if(is_array($array))
 {
  foreach($array as $key=>$value)
  {
   $array[$key] = Object2Array($value);
  }
 }
 return $array;
}

function DeJson($json)//对象转数组
{
 return Object2Array(json_decode($json));
}

function Json($array)//数组转Json支持中文
{ 
  ArrayRecursive($array, 'urlencode', true); 
  $json = json_encode($array); 
  return urldecode($json); 
} 

function ArrayRecursive(&$array, $function, $apply_to_keys_also = false)
{ 
  static $recursive_counter = 0; 
  if (++$recursive_counter > 1000) { 
	  die('possible deep recursion attack'); 
  } 
  foreach ($array as $key => $value) { 
	  if (is_array($value)) { 
		  ArrayRecursive($array[$key], $function, $apply_to_keys_also); 
	  } else { 
		  $array[$key] = $function($value); 
	  }                                        
	  if ($apply_to_keys_also && is_string($key)) { 
		  $new_key = $function($key); 
		  if ($new_key != $key) { 
			  $array[$new_key] = $array[$key]; 
			  unset($array[$key]); 
		  } 
	  } 
  } 
  $recursive_counter--; 
} 

function UpDate($Json,$Key,$Val,$M=0)//更新或添加
{ 
  $Json = DeJson($Json);
  if($M==0){
  //任意更新
  $Json[$Key]=$Val;
  }
  if($M==1 && isset($Json[$Key])){
  //存在即更新
  $Json[$Key]=$Val;
  }
  if($M==2 && !isset($Json[$Key])){
  //不存在即更新
  $Json[$Key]=$Val;
  }
  
  return Json($Json);
} 


function Del($Json,$Key,$M=0)//删除
{ 
  $Json = DeJson($Json);
  if($M==0){
  //任意删除
  unset($Json[$Key]);
  }
  if($M==1 && empty($Json[$Key])){
  //为空删除
  unset($Json[$Key]);
  }
  if($M==2 && !empty($Json[$Key])){
  //不为空删除
  unset($Json[$Key]);
  }
  return Json($Json);
} 	

?>