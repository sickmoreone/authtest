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
        <li><a href="#">方案</a></li>
        <li><a href="#">方案管理</a></li>
    </ul>
</div>

<div class="formbody">


    <div id="usual1" class="usual">

        <div class="itab">
            <ul>
                <li><a href="#tab1" class="selected">添加方案</a></li>
                <li><a href="#tab2">方案列表</a></li>
            </ul>
        </div>

        <div id="tab1" class="tabson">

            <form action="<?php echo U('addprogram');?>" method="post">
                <ul class="forminfo">
                    <li><label>方案名<b>*</b></label><input name="name" value="" type="text" class="dfinput" placeholder="请填写方案名"  style="width:518px;" required="required"/></li>
                    <li><label>备注<b></b></label><input name="remark" type="text" class="dfinput" placeholder="请填写备注"  style="width:518px;" required="required"/></li>
                    <li><label></label><input type="submit" class="btn" value="添加"/></li>
                </ul>
            </form>


        </div>


        <div id="tab2" class="tabson">

            <table class="tablelist">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>名称</th>
                    <th>备注</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($programList)): $i = 0; $__LIST__ = $programList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr>
                        <td><?php echo ($v["id"]); ?></td>
                        <td><?php echo ($v["name"]); ?></td>
                        <td><?php echo ($v["remark"]); ?></td>
                        <td>
                            <a href="#" class="tablelink" id="mod" modurl="<?php echo U('Program/modpage',array('id'=>$v['id']));?>">修改</a>
                            <a href="#" class="tablelink" id="del"> 删除</a>
                        </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>


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

    <script>
        //点击修改方案
        $('#mod').click(function () {
            var modurl = $(this).attr("modurl");
            layer.open({
                type: 2,
                title: '修改方案',
                maxmin: true,
                scrollbar:false,
                btn:['切换','取消'],
                area: ['800px', '500px'],
                /*content:"<?php echo U('"+"Program/modpage/id/"+id+"');?>",*/
                content:modurl
            });
        });
        //点击删除方案
        $('#del').click(function () {
            if(confirm('是否删除该方案？'))
            {
                //是
                //获取要删除的id,parent().find("td:first").text();
                var id=$("#del").parent().parent().find("td:first").text();
                $.post("<?php echo U('Program/delList');?>",{id:id},function(result){
                    if(result==1)
                    {
                        alert('请先解除关联的型号再删除！');
                    }
                    else if(result==2)
                    {
                        alert('删除成功。');
                        window.location.reload();
                    }
                    else {
                        alert('系统错误！');
                    }
                });
            }

        });
    </script>

    <script src="/authtest/library/bootstrap3.3.7/js/bootstrap.min.js"></script>

</div>


</body>

</html>