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
        <li><a href="#">系统管理</a></li>
    </ul>
</div>

<div class="formbody">


    <div id="usual1" class="usual">

        <div class="itab">
            <ul>
                <li><a href="#tab1" class="selected">型号关联</a></li>
               <!-- <li><a href="#tab2">添加型号</a></li>-->
            </ul>
        </div>




        <div id="tab1" class="tabson">

            <div>
                <select id="program" name="program" class="dfinput" style="opacity:1;">
                    <option value="0">方案筛选</option>
                    <?php if(is_array($program)): $i = 0; $__LIST__ = $program;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v["id"]); ?>"><?php echo ($v["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
                <input class="dfinput" name="keyword" value="" placeholder="请输入关键字"/>
                <button  class="btn" type="submit">搜索</button>
            </div>

            <table class="tablelist">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>型号名称</th>
                    <th>备注</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody id="wraps">

                <?php if(is_array($model)): $i = 0; $__LIST__ = $model;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr>
                        <td><?php echo ($v["id"]); ?></td>
                        <td><?php echo ($v["name"]); ?></td>
                        <td><?php echo ($v["remark"]); ?></td>
                        <td class="operating">
                            <a href="javascript:;" name='related' class="tablelink"  modurl="<?php echo U('System/related',array('id'=>$v['id']));?>">关联人员</a>
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

    <script>
        function objToArray(array) {
            var arr = []
            for (var i in array) {
                arr.push(array[i]);
            }
            return arr;
        }
        /*
         * 下拉框显示方案下模型
         * */
        $('#program').change(function () {
            var programid=$('#program').val();
            var str='';
            $.post("<?php echo U('System/models');?>",{programid:programid},function(result){
                $("#wraps").html(result);
            });
        });
        /*
         * 点击button显示方案下模型
         * */
        $(document).on('click',".btn",function(){
            var programid=$('#program').val();
            var keyword=$("input[name='keyword']").val();
            if(programid==0 && keyword=='')
            {
                //默认全部
            }
            else if(programid==0 && keyword!='')
            {
                //方案没选，有关键字
                $.post("<?php echo U('System/showmodes');?>",{programid:programid,keyword:keyword},function(result){
                    $("#wraps").html(result);
                });

            }
            else if(programid!=0 && keyword=='')
            {
                //组
            }
            else if(programid!=0 && keyword!='')
            {
                //方案选了，有关键字
                $.post("<?php echo U('System/showmodes');?>",{programid:programid,keyword:keyword},function(result){
                    $("#wraps").html(result);
                });

            }


            //alert(programid);alert(keyword);

        });
    </script>


    <script>
        $("#groupid").change(function(){
            var groupid=$(this).val();
            $.post("<?php echo U('Model/showpeople');?>",{groupid:groupid},function(result){
                $('#people').html(result);
            });
        });
        //点击关联人员
        $(document).on('click',"a[name='related']",function(){
            var modurl = $(this).attr("modurl");
            layer.open({
                type: 2,
                title: '关联人员',
                maxmin: true,
                scrollbar:false,
                area: ['800px', '500px'],
                content:[modurl,'no']

            });
        });
    </script>

    <script src="/authtest/library/bootstrap3.3.7/js/bootstrap.min.js"></script>

</div>


</body>

</html>