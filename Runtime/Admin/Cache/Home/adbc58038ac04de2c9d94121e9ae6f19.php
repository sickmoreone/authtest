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
        <li><a href="#">APK</a></li>
        <li><a href="#"><?php echo ($apkname["name"]); ?></a></li>
    </ul>
</div>

<div class="formbody">


    <div id="usual1" class="usual">

        <div class="itab">
            <ul>
                <li><a href="#tab1" class="selected">版本</a></li>
                <li><a href="#tab2" >更新记录</a></li>
                <li><a href="#tab3" >BUG列表</a></li>
                <li><a href="#tab4" >测试用例</a></li>
                <li><a href="#tab5" >添加版本</a></li>
            </ul>
        </div>




        <div id="tab1" class="tabson">


            <table class="tablelist">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>版本</th>
                    <th>创建时间</th>
                    <th>创建人</th>
                    <th>下载</th>
                    <th>测试状态</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody id="wraps">

                <?php if(is_array($apk_version)): $i = 0; $__LIST__ = $apk_version;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr>
                        <td><?php echo ($v["id"]); ?></td>
                        <td><?php echo ($apkname["name"]); ?>__<?php echo ($v["version"]); ?></td>
                        <td><?php echo ($v["create_time"]); ?></td>
                        <td><?php echo ($v["create_people"]); ?></td>
                        <td><?php echo ($v["address"]); ?></td>
                        <td><?php echo (ceshistatu($v["test_statu"])); ?></td>
                        <td class="operating">
                            <button>修改状态</button>
                            <button>删除</button>
                            <button>发布</button>
                        </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>


                </tbody>
            </table>





        </div>


        <div id="tab2" class="tabson">



        </div>


        <div id="tab3" class="tabson">



        </div>


        <div id="tab4" class="tabson">



        </div>


        <div id="tab5" class="tabson">


        </div>

    </div>

    <script type="text/javascript">
        $("#usual1 ul").idTabs();
    </script>

    <script type="text/javascript">
        $('.tablelist tbody tr:odd').addClass('odd');
    </script>

    <script type="text/javascript">


    </script>


    <script src="/authtest/library/bootstrap3.3.7/js/bootstrap.min.js"></script>

</div>


</body>

</html>