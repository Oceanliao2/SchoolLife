<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {
    public function index()
    {

		$user_agent = $_SERVER['HTTP_USER_AGENT'];  
	    $mobile_agents = Array("240x320","acer","acoon","acs-","abacho","ahong","airness","alcatel","amoi","android","anywhereyougo.com","applewebkit/525","applewebkit/532","asus","audio","au-mic","avantogo","becker","benq","bilbo","bird","blackberry","blazer","bleu","cdm-","compal","coolpad","danger","dbtel","dopod","elaine","eric","etouch","fly ","fly_","fly-","go.web","goodaccess","gradiente","grundig","haier","hedy","hitachi","htc","huawei","hutchison","inno","ipad","ipaq","ipod","jbrowser","kddi","kgt","kwc","lenovo","lg ","lg2","lg3","lg4","lg5","lg7","lg8","lg9","lg-","lge-","lge9","longcos","maemo","mercator","meridian","micromax","midp","mini","mitsu","mmm","mmp","mobi","mot-","moto","nec-","netfront","newgen","nexian","nf-browser","nintendo","nitro","nokia","nook","novarra","obigo","palm","panasonic","pantech","philips","phone","pg-","playstation","pocket","pt-","qc-","qtek","rover","sagem","sama","samu","sanyo","samsung","sch-","scooter","sec-","sendo","sgh-","sharp","siemens","sie-","softbank","sony","spice","sprint","spv","symbian","tablet","talkabout","tcl-","teleca","telit","tianyu","tim-","toshiba","tsm","up.browser","utec","utstar","verykool","virgin","vk-","voda","voxtel","vx","wap","wellco","wig browser","wii","windows ce","wireless","xda","xde","zte");  
	    $is_mobile = false;  
	    foreach ($mobile_agents as $device)//这里把值遍历一遍，用于查找是否有上述字符串出现过  
	    {
	        if (stristr($user_agent, $device)) 
	        { //stristr 查找访客端信息是否在上述数组中，不存在即为PC端。  
	            $is_mobile = true;  
	            break;  
	        }  
	    }  


    	if(!$is_mobile)
    	{
    		$this->redirect('./First/index2');
    	}

    	else 
    	{
    		$this->redirect('./MobelFirst/index');
    	}
    	
	 }
}