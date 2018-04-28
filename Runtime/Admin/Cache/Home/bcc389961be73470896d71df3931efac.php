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
        <li><a href="#">产品经理</a></li>
        <li><a href="#">应用管理</a></li>
    </ul>
</div>

<div class="formbody">


    <div id="usual1" class="usual">

        <div class="itab">
            <ul>
                <li><a href="#tab1" class="selected">应用列表</a></li>
            </ul>
        </div>




        <div id="tab1" class="tabson">




            <div>
                <select id="selects" name="select" class="dfinput" style="opacity:1;">
                    <option value="0">全部</option>
                    <option value="1">未关联</option>
                    <option value="2">已关联</option>
                </select>
                <input class="dfinput" name="keyword" id="keyword" value="" placeholder="请输入关键字"/>
                <button  class="btn" type="submit" id="search">搜索</button>
            </div>

            <table class="tablelist">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>应用名称</th>
                    <th>备注</th>
                    <th>创建时间</th>
                    <th>创建人</th>
                    <th>已关联型号</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody id="wraps">

                <?php if(is_array($apks)): $i = 0; $__LIST__ = $apks;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr>
                        <td><?php echo ($v["id"]); ?></td>
                        <td><a href="/authtest/index.php/Apk/apkinfo/id/<?php echo ($v["id"]); ?>"><?php echo ($v["name"]); ?></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="/authtest/index.php/Apk/apkinfo/id/<?php echo ($v["id"]); ?>">查看应用信息</a></td>
                        <td><?php echo ($v["remark"]); ?></td>
                        <td><?php echo ($v["create_time"]); ?></td>
                        <td><?php echo ($v["nickname"]); ?></td>
                        <td><?php echo ($v["model_name"]); ?></td>
                        <td class="operating">
                            <a href="javascript:;" name='related' class="tablelink"  modurl="<?php echo U('Apk/related',array('id'=>$v['id']));?>">关联型号</a>
                        </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>


                </tbody>
            </table>







        </div>


        <div id="tab2" class="tabson">





        </div>

    </div>

    <script type="text/javascript">
        $("#usual1 ul").idTabs();
    </script>

    <script type="text/javascript">
        $('.tablelist tbody tr:odd').addClass('odd');
    </script>

    <script type="text/javascript">
        //点击关联型号
        $(document).on('click',"a[name='related']",function(){
            /*var apkname=$(this).parent().parent().find("td").eq(1).children().find("a:first").text();*/
            var apkname=$(this).parent().parent().find("td").eq(1).find('a:first').text();
            var modurl = $(this).attr("modurl");
            layer.open({
                type: 2,
                title: '['+apkname+']===APK关联型号',
                maxmin: true,
                area: ['800px', '500px'],
                content:[modurl,'no']

            });
        });

        //下拉搜索
        $('#selects').change(function () {
            var selects=$('#selects').val();
            var keyword=$('#keyword').val();
            $.post("<?php echo U('Apk/pull');?>",{selects:selects,keyword:keyword},function (result) {
                $('#wraps').html(result);
            });
        });


        //搜索
        $(document).on('click',"#search",function(result){
            var selects=$('#selects').val();
            var keyword=$('#keyword').val();
            $.post("<?php echo U('Apk/search');?>",{selects:selects,keyword:keyword},function (result) {
                $('#wraps').html(result);
            });
        });
    </script>


    <script src="/authtest/library/bootstrap3.3.7/js/bootstrap.min.js"></script>

</div>


</body>

</html>