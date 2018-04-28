<?php if (!defined('THINK_PATH')) exit();?><link href="/authtest/library/bootstrap3.3.7/css/bootstrap.min.css" rel="stylesheet">
<form class="form-horizontal">
    <!--<form class="form-horizontal" action="<?php echo U('Program/suremod');?>" method="post">-->
    <div class="form-group">
        <label for="name" class="col-sm-2 control-label">模型名</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="name" placeholder="模型名" name="name" value="<?php echo ($model["name"]); ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="remark" class="col-sm-2 control-label">备注</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="remark" placeholder="备注" name="remark" value="<?php echo ($model["remark"]); ?>">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="" class="btn btn-default" id="suremod">确认修改</button>
        </div>
    </div>
    <input id='id' name="id" type="hidden" value="<?php echo ($model["id"]); ?>"/>
</form>
<script type="text/javascript" src="/authtest/Public/home/js/jquery.js"></script>
<script src="/authtest/library/layer/layer.js"></script>
<script>
$("#suremod").click(function () {
    var name=$('#name').val();
    var remark=$('#remark').val();
    var id=$('#id').val();
        $.post("<?php echo U('Model/suremod');?>",{id:id,name:name,remark:remark},function(result){
            if(result==1)
            {

               var index = parent.layer.getFrameIndex(window.name);
                window.parent.location.reload();
                parent.layer.close(index);
                /*  window.location.hash = "#tab2";*/
                /*  window.location.href = "/authtest/index.php/Program/programList.html#tab2";*/
            }
            else
            {
                alert("失败或无修改");
            }

        });


});
</script>