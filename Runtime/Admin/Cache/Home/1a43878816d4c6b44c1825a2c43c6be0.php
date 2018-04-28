<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>无标题文档</title>
    <link href="/authtest/Public/home/css/style.css" rel="stylesheet" type="text/css" />
    <link href="/authtest/Public/home/css/select.css" rel="stylesheet" type="text/css" />
    <!--<link href="/authtest/library/bootstrap3.3.7/css/bootstrap.css" rel="stylesheet" type="text/css" />-->
    <script type="text/javascript" src="/authtest/Public/home/js/jquery.js"></script>
    <script type="text/javascript" src="/authtest/Public/home/js/jquery.idTabs.min.js"></script>
    <script type="text/javascript" src="/authtest/Public/home/js/select-ui.min.js"></script>
    <script src="/authtest/library/layer/layer.js"></script>



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
        <li><a href="#">方案</a></li>
        <li><a href="#">添加型号</a></li>
    </ul>
</div>

<div class="formbody">


    <div id="usual1" class="usual">

        <div class="itab">
            <ul>
                <li><a href="#tab1" class="selected">添加型号</a></li>
            </ul>
        </div>

        <div id="tab1" class="tabson">

            <form action="<?php echo U('sureaddmodel');?>" method="post">
                <ul class="forminfo">
                    <li><label>型号名称<b></b></label><input name="name" value="" type="text" class="dfinput" placeholder="请填写型号名称"  style="width:518px;" required="required"/></li>
                    <li><label>备注<b></b></label><input name="remark" type="text" class="dfinput" placeholder="请填写备注"  style="width:518px;" required="required"/></li>
                    <li>
                        <label>所属方案<b></b></label>
                        <select class="dfinput" name="programid" style="opacity:1;">
                           <?php if(is_array($program)): $i = 0; $__LIST__ = $program;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v["id"]); ?>"><?php echo ($v["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </li>

                    <li>
                        <label>关联组</label>
                        <select class="dfinput" name="groupid" id='groupid' style="opacity:1;">
                            <option value="0">单独选择</option>
                            <?php if(is_array($group)): $i = 0; $__LIST__ = $group;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v["id"]); ?>"><?php echo ($v["title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </li>

                    <li><label>选择人员</label></li>
                    <div id="people">
                    <?php echo ($allpeople); ?>
                    </div>
                    <li><label></label><input type="submit" class="btn" value="添加"/></li>
                </ul>
            </form>


        </div>



    </div>

    <script type="text/javascript">
        $("#usual1 ul").idTabs();
    </script>

    <script type="text/javascript">
        $('.tablelist tbody tr:odd').addClass('odd');
    </script>

    <script>
        $("#groupid").change(function(){
            var groupid=$(this).val();
            $.post("<?php echo U('Program/showpeople');?>",{groupid:groupid},function(result){
                $('#people').html(result);
            });
        });
    </script>


    <script src="/authtest/library/bootstrap3.3.7/js/bootstrap.min.js"></script>

</div>


</body>

</html>