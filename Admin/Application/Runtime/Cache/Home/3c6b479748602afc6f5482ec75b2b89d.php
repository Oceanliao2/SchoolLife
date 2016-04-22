<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="/schooladmin/Public/scripts/jquery/jquery-1.7.1.js"></script>
<script type="text/javascript" src="/schooladmin/Public/Jquery/Check.js"></script>
<link href="/schooladmin/Public/style/authority/basic_layout.css" rel="stylesheet" type="text/css">
<link href="/schooladmin/Public/style/authority/common_style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/schooladmin/Public/scripts/authority/commonAll.js"></script>
<script type="text/javascript" src="/schooladmin/Public/scripts/fancybox/jquery.fancybox-1.3.4.js"></script>
<script type="text/javascript" src="/schooladmin/Public/scripts/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="/schooladmin/Public/style/authority/jquery.fancybox-1.3.4.css" media="screen"></link>
<script type="text/javascript" src="/schooladmin/Public/scripts/artDialog/artDialog.js?skin=default"></script>
<link href="/schooladmin/Public/Font/LigatureSymbols/LigatureSymbols/style.css" rel="stylesheet" type="text/css" />
<style>
div,ul,li{ list-style:none;}
.formTag { border-bottom:3px solid #EEE; height:30px;}
.formTag a{ line-height:30px; float:left; padding-left:10px; color:#CCC; padding-right:10px; display:block;}
.formTag a:hover{ text-decoration:none; color: #CCC;}
.formTag .cek{ border-bottom:3px solid #2f2f2f; color: #2f2f2f;}
.formTag .cek:hover{ border-bottom:3px solid #2f2f2f; color: #2f2f2f;}
.formLab li{ display:none;}
.formLab li td{ line-height:50px; border-bottom:1px dashed #CCCCCC;}
.formBtn{text-align:center; margin-top:10px;}

.lable2{ color:#FFF; margin-right:10px; font-size:12px; padding:1px 8px 1px 8px}
.lable{ color:#FFF; margin-left:10px; font-size:12px; padding:1px 8px 1px 8px}
.yellow{ background: #FC0;}
.blue{ background: #09F}
.red{ background: #C30;}
.black{ background: #2F2F2F;}
.gray{ background: #CCC;}

</style>
<title>二手商品</title>
<script>
function formCek(cekOpt){
	cekOpt = cekOpt.split(",");
	for(var i in cekOpt){
		var thisOpt = $("#"+cekOpt[i]).val();
		if(thisOpt==""){
			$("#"+cekOpt[i]).focus();
				
			var Text = $("label[for='"+cekOpt[i]+"']").html();
			Text = Text.replace(":","");
			Text = Text.replace("：","");
			
			alert(Text+"不可为空！");
			return false;
			} 
		}
	alert("ok");
	return false;
	} 
</script>
<script type="text/javascript">
    var Nums=0;
	$(document).ready(function() {
	$(".formTag a").click(function(){
		$(".formTag a:eq("+Nums+")").removeClass("cek");
		$(".formLab li:eq("+Nums+")").hide();
		Nums = $(this).index();
		$(this).addClass("cek");
		$(".formLab li:eq("+Nums+")").show();
		})
	$(".formTag a:eq("+Nums+")").addClass("cek");
	$(".formLab li:eq("+Nums+")").show();
	});
	
	function add(form){
		$("#".form).submit();
	}
	
	function del(ID,TABLE){
		if(ID == '' || TABLE == '') return;
		if(confirm("您确定要删除吗？")){
			$.ajax({    
				url:'/schooladmin/index.php/home/index/Del', 
				type:'POST', 
				timeout:3000,   
				async:false,
				data:{id:ID,table:TABLE},
				success:function(obj){ 
				   var obj = eval('('+obj+')');
				   alert(obj.msg);
				   if(obj.code!=0){
					   return false;
				   }
				   for(var i in row = obj.id){
					$("#list_"+row[i]).remove();
				   }
		        }  
			  });
						  
		}
	}
	
	/** 批量删除 **/
	function batchDel(){
		if($("input[name='IDCheck']:checked").size()<=0){
			art.dialog({icon:'error', title:'友情提示', drag:false, resize:false, content:'至少选择一条', ok:true,});
			return;
		}
		// 1）取出用户选中的checkbox放入字符串传给后台,form提交
		var allIDCheck = "";
		$("input[name='IDCheck']:checked").each(function(index, domEle){
			bjText = $(domEle).parent("td").parent("tr").last().children("td").last().prev().text();
// 			alert(bjText);
			// 用户选择的checkbox, 过滤掉“已审核”的，记住哦
			if($.trim(bjText)=="已审核"){
// 				$(domEle).removeAttr("checked");
				$(domEle).parent("td").parent("tr").css({color:"red"});
				$("#resultInfo").html("已审核的是不允许您删除的，请联系管理员删除！！！");
// 				return;
			}else{
				allIDCheck += $(domEle).val() + ",";
			}
		});
		// 截掉最后一个","
		if(allIDCheck.length>0) {
			allIDCheck = allIDCheck.substring(0, allIDCheck.length-1);
			// 赋给隐藏域
			$("#allIDCheck").val(allIDCheck);
			if(confirm("您确定要批量删除这些记录吗？")){
				// 提交form
				$("#submitForm").attr("action", "/xngzf/archives/batchDelFangyuan.action").submit();
			}
		}
	}

	/** 普通跳转 **/
	function jumpNormalPage(page){
		$("#submitForm").attr("action", "house_list.html?page=" + page).submit();
	}
	
	/** 输入页跳转 **/
	function jumpInputPage(totalPage){
		// 如果“跳转页数”不为空
		if($("#jumpNumTxt").val() != ''){
			var pageNum = parseInt($("#jumpNumTxt").val());
			// 如果跳转页数在不合理范围内，则置为1
			if(pageNum<1 | pageNum>totalPage){
				art.dialog({icon:'error', title:'友情提示', drag:false, resize:false, content:'请输入合适的页数，\n自动为您跳到首页', ok:true,});
				pageNum = 1;
			}
			$("#submitForm").attr("action", "house_list.html?page=" + pageNum).submit();
		}else{
			// “跳转页数”为空
			art.dialog({icon:'error', title:'友情提示', drag:false, resize:false, content:'请输入合适的页数，\n自动为您跳到首页', ok:true,});
			$("#submitForm").attr("action", "house_list.html?page=" + 1).submit();
		}
	}
	
	function autofill(JSON){
		for(var i in JSON){
		   if($("#"+i).attr('type')=='checkbox' && JSON[i]==1){
			   alert(JSON[i]);
			   }
		   $("#"+i).val(JSON[i]);
		}
	}
</script>
<style>
	.alt td{ background:black !important;}
</style>

<script type="text/javascript" src="__Plugin__/Ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="__Plugin__/Ueditor/ueditor.all.min.js"></script>
<script type="text/javascript" src="__Plugin__/Jquery/jquery.form.js"></script>
<script type="text/javascript">
$(function(){
	var $form = $("form");
	$form.on("change","input:file",function(){
		//上传
		var data = {};
		var $this=$(this);
		$this.closest('form').ajaxSubmit({
			
			url: "/schooladmin/index.php/home"+'/Common/ajaximg',
			type:'POST',
			data:data,
			dataType: 'json',
			async:false,
			beforeSend:function(){
			},
			uploadProgress: function(event, position, total, percentComplete) {
				
			},
			cache: false,
			contentType: false,
			processData: false,
			success:function(data){
				var str=$("#img").val();
				str=str+data;
				$("#img").val(str);
				
			},
			error:function(){
				
			}
		});
	})
})
</script>


<style>
.img_show{ margin:10px auto 0 auto;width:80%;}
</style>

</head>
<body>
<div id="top_nav">
    <span id="here_area_bottom"><a href="javascript:history.go(-1)" class="actBtn lsf">undo 返回</a></span><span id="here_area">当前位置：信息发布管理&nbsp;>&nbsp;二手商品</span>
</div>
<div id="top_nav_p"></div>



<form id="myForm" onsubmit="return add('myForm')" name="myForm" enctype="multipart/form-data" action="/schooladmin/index.php/home/index/Edit/table/product/id/<?php echo ($get["cid"]); ?>" method="post">
	<div id="container">
		<div class="ui_content">
			<div class="formTag">
              <a href="javascript:" >基本设置</a>
            </div>
            <?php $par0 = 'message_2';$par1 = array('id'=>array('eq',$_GET['cid']));$T=Ext("Common")->lookAtOne($par0,$par1);?> 
            <div class="formLab">
               <li>
                 <table width="100%" border="0" cellspacing="0" cellpadding="0">
                   <tr>
                     <td width="200" align="right"><label for="classname">物品名称：</label></td>
                     <td width="10">&nbsp;</td>
                     <td><input type="text" name="title" id="title" value="<?php echo ($T["title"]); ?>"  class="ui_input_txt03" /></td>
                   </tr>
                   <tr>
                     <td align="right"><label for="describe">物品描述：</label></td>
                     <td>&nbsp;</td>
                     <td><textarea name="description" id="description" cols="45" class="ui_textarea_txt03"  rows="5"><?php echo ($T["description"]); ?></textarea></td>
                   </tr>
                   
                   <tr>
                     <td width="200" align="right"><label for="price">物品价格：</label></td>
                     <td width="10">&nbsp;</td>
                     <td><input type="text" name="price" id="price"  value="<?php echo ($T["price"]); ?>" class="ui_input_txt02" /></td>
                   </tr>
                   <tr>
                     <td width="200" align="right"><label for="price">新旧程度：</label></td>
                     <td width="10">&nbsp;</td>
                     <td><input type="text" name="price" id="price"  value="<?php echo ($T["price"]); ?>" class="ui_input_txt02" /></td>
                   </tr>
                    <tr>
                     <td width="200" align="right"><label for="price">原价：</label></td>
                     <td width="10">&nbsp;</td>
                     <td><input type="text" name="price" id="price"  value="<?php echo ($T["price"]); ?>" class="ui_input_txt02" /></td>
                   </tr>
                    <tr>
                     <td width="200" align="right"><label for="price">QQ：</label></td>
                     <td width="10">&nbsp;</td>
                     <td><input type="text" name="price" id="price"  value="<?php echo ($T["price"]); ?>" class="ui_input_txt02" /></td>
                   </tr>
                    <tr>
                     <td width="200" align="right"><label for="price">电话：</label></td>
                     <td width="10">&nbsp;</td>
                     <td><input type="text" name="price" id="price"  value="<?php echo ($T["price"]); ?>" class="ui_input_txt02" /></td>
                   </tr>
                   <tr>
                     <td width="200" align="right"><label for="file">添加图片：</label></td>
                     <td width="10">&nbsp;</td>
                     <td>                 
                     	<input name="image[]" multiple type="file"  class="ui_input_file03" id="file" value="" />
                     	<input type="hidden" name="img" value="<?php echo ($T["img"]); ?>" id="img" />
                     </td> 
                 </table>

          <div class="formBtn">
            <input type="submit" class="ui_input_btn01" id="submitbutton" value="提 交"/>
            <input type="reset"  class="ui_input_btn01" id="cancelbutton" value="取 消"/>
          </div>
		</div>
	</div>
</form>
<script type="text/javascript">
    var ue = UE.getEditor('editor');
</script>


</body>
</html>