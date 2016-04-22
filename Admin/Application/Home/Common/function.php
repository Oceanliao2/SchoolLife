<?php
function Ext($Controller){
   $ExtConfig = array();
   $ExtConfig["A"]="Common/Action";
   $ExtConfig["E"]="Common/Error";
   $ExtConfig["File"]="Common/FileAct";
   $ExtConfig["J"]="Common/Json";
   $ExtConfig["JsSdk"]="Common/JsSdk";
   $ExtConfig["WX"]="Common/WeiXin";
   $ExtConfig["Z"]="Common/Zip";

   $ExtConfig["W"]="Home/WebConfig";
   $ExtConfig["L"]="Home/List";
   $ExtConfig["I"]="Home/InfoClass";
   $ExtConfig["C"]="Home/Check";

   if(isset($ExtConfig[$Controller])){
	  $Controller = $ExtConfig[$Controller];
   }
   
   $Ext = A($Controller);
   
   return $Ext;
}
require_once('Action.php');
require_once('Json.php');
require_once('Plugin.php');

?>
