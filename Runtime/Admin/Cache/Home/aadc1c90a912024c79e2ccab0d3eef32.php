<?php if (!defined('THINK_PATH')) exit();?><link href="/authtest/library/bootstrap3.3.7/css/bootstrap.min.css" rel="stylesheet">
<form class="form-horizontal" action="<?php echo U('Program/');?>" method="post">
    <div class="form-group">
        <label for="name" class="col-sm-2 control-label">方案名</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="name" placeholder="方案名" value="<?php echo ($program["name"]); ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="remark" class="col-sm-2 control-label">备注</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="remark" placeholder="备注" value="<?php echo ($program["remark"]); ?>">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">确认修改</button>
        </div>
    </div>
</form>
<script type="text/javascript" src="/authtest/Public/home/js/jquery.js"></script>
<script src="/authtest/library/layer/layer.js"></script>