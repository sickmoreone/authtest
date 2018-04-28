<?php if (!defined('THINK_PATH')) exit();?><style type="text/css">
    li{
        display:block;
        float:left;
        width:70%;
        margin-right:8px;
        white-space:normal;
        word-break : break-all;
        word-wrap: break-word;
    }
</style>

<link href="/authtest/Public/home/css/style.css" rel="stylesheet" type="text/css" />
<form class="form-horizontal" action="<?php echo U('System/surerelated');?>" method="post">
    <ul class="forminfo">
        <li>
            <label>关联组</label>
            <select class="dfinput" name="groupid" id='groupid' style="opacity:1;">
                <option value="0">单独选择</option>
                <?php if(is_array($group)): $i = 0; $__LIST__ = $group;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v["id"]); ?>"><?php echo ($v["title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </li>
        <li id="people"><?php echo ($allpeople); ?></li>
        <li><button type="" class="btn btn-default" id="suremod">确认修改</button></li>
    <li><input id='id' name="id" type="hidden" value="<?php echo ($modelid); ?>"/></li>
    </ul>

</form>
<script type="text/javascript" src="/authtest/Public/home/js/jquery.js"></script>
<script src="/authtest/library/layer/layer.js"></script>
<script>
    $("#groupid").change(function(){
        var groupid=$(this).val();
        $.post("<?php echo U('Model/showpeople');?>",{groupid:groupid},function(result){
            $('#people').html(result);
        });
    });
</script>