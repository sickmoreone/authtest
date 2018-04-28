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
<form class="form-horizontal" action="<?php echo U('Apk/surerelated');?>" method="post" onsubmit="return checkSubmit();">
    <ul class="forminfo">
        <li>
            <label>方案</label>
            <select class="dfinput" name="programid" id='programid' style="opacity:1;">
                <option value="0">请选择方案</option>
                <?php if(is_array($program)): $i = 0; $__LIST__ = $program;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v["id"]); ?>"><?php echo ($v["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </li>
        <li id="models"><?php echo ($models); ?></li>
        <li><button type="submit" class="btn btn-default" id="suremod">确认关联</button></li>
    </ul>
    <input type="hidden" name='apkid' value="<?php echo ($apkid); ?>"/>
</form>
<script type="text/javascript" src="/authtest/Public/home/js/jquery.js"></script>
<script src="/authtest/library/layer/layer.js"></script>
<script>
    function checkSubmit() {
        //没选中不让提交
        if(checkedTest()==''){ return false;}
    }
    $("#programid").change(function(){
        var programid=$(this).val();
        var apkid=$("input[name='apkid']").val();
        $.post("<?php echo U('Apk/showmodels');?>",{programid:programid,apkid:apkid},function(result){
            $('#models').html(result);
        });
    });

    function checkedTest(){
        obj = document.getElementsByName("modelid[]");
        check_val = [];
        for(k in obj){
            if(obj[k].checked)
                check_val.push(obj[k].value);
        }
        return check_val;
    }

</script>