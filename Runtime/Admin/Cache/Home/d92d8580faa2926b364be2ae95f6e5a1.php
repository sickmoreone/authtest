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
        <li><a href="#">应用开发</a></li>
        <li><a href="#">应用</a></li>
    </ul>
</div>

<div class="formbody">


    <div id="usual1" class="usual">

        <div class="itab">
            <ul>
                <li><a href="#tab1" class="selected">应用列表</a></li>
                <li><a href="#tab2">添加应用</a></li>
            </ul>
        </div>




        <div id="tab1" class="tabson">








        </div>


        <div id="tab2" class="tabson">


            <form action="<?php echo U('Apper/addapk');?>" method="post">
                <ul class="forminfo">
                    <li><label>apk名<b>*</b></label><input name="name" value="" type="text" class="dfinput" placeholder="请填写apk名"  style="width:518px;" required="required"/></li>
                    <li><label>备注<b></b></label><input name="remark" type="text" class="dfinput" placeholder="请填写备注"  style="width:518px;" required="required"/></li>
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



    <script src="/authtest/library/bootstrap3.3.7/js/bootstrap.min.js"></script>

</div>


</body>

</html>