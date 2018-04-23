<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="/authtest/Public/home/css/style.css" rel="stylesheet" type="text/css" />
<link href="/authtest/Public/home/css/select.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/authtest/Public/home/js/jquery.js"></script>
<script type="text/javascript" src="/authtest/Public/home/js/jquery.idTabs.min.js"></script>
<script type="text/javascript" src="/authtest/Public/home/js/select-ui.min.js"></script>

  
<script type="text/javascript">
$(document).ready(function(e) {
    $(".select1").uedSelect({
		width : 345			  
	});
	$(".select2").uedSelect({
		width : 167  
	});
	$(".select3").uedSelect({
		width : 100
	});
});
</script>
</head>

<body>

	<div class="place">
    <span>位置：</span>
    <ul class="placeul">
    <li><a href="#">管理员</a></li>
    <li><a href="#">管理员</a></li>
    </ul>
    </div>
    
    <div class="formbody">
    
    
    <div id="usual1" class="usual"> 
    
    <div class="itab">
  	<ul> 
    <li><a href="#tab1" class="selected">添加</a></li> 
    <li><a href="#tab2">列表</a></li> 
  	</ul>
    </div> 
    
  	<div id="tab1" class="tabson">
    <form action="" method="post">
    <ul class="forminfo">
    <input type="hidden" name="id" value="<?=$info['id']?>"/>
    <li><label>用户名<b>*</b></label><input name="username" value="<?=$info['username']?>" type="text" class="dfinput" placeholder="请填写用户名"  style="width:518px;" required="required"/></li>
 	<li><label>密　码<b>*</b></label><input name="password" type="password" class="dfinput" placeholder="请填写密码"  style="width:518px;" required="required"/></li>
	<li><label>所属权限组<b>*</b></label>
		<select class="dfinput" name="group_id" style="opacity:1;">
			<?php foreach($groupList as $v){?>
			<option value="<?php echo $v['id']?>"><?php echo $v['title']?></option>
			<?php }?>
		</select>
	</li>
	<li><label></label><input type="submit" class="btn" value="添加"/></li>
    </ul>
    </form>
    </div> 
    
    
  	<div id="tab2" class="tabson">
    
    <table class="tablelist">
    	<thead>
    	<tr>
        <th>用户名</th>
        <th>所属权限组</th>
        <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($list as $v){?>
        <tr>
        <td><?php echo $v['username']?></td>
        <td><?php echo $v['title']?></td>
        <td>        	     
        	<a href="#" class="tablelink"> 删除</a></td>
        </tr> 
        <?php }?>
        
    
        </tbody>
    </table>
    
   
  
    
    </div>  
       
	</div> 
 
	<script type="text/javascript"> 
      $("#usual1 ul").idTabs(); 
    </script>
    
    <script type="text/javascript">
	$('.tablelist tbody tr:odd').addClass('odd');
	</script>
    
    
    
    
    
    </div>


</body>

</html>