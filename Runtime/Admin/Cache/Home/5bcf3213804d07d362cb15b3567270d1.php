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
    <style>
       .div{
           float: left;
           display: inline-block;
           background-color:#00a0e9;
           width: 200px;
           height: 200px;
           border: 1px solid red;
           margin: 4px;
       }
        #wrap{
            float: left;
        }
        .name  {
            text-align:center;
            height: 30%;
        }
       .remark
       {

           text-align:center;
           height: 20%;
       }
       .operating {

           text-align:center;
           height: 20%;
       }
        .create_time{
            text-align:right;
            height: 20%;
        }
    </style>


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
        <li><a href="#">型号列表</a></li>
    </ul>
</div>

<div class="formbody">


    <div id="usual1" class="usual">

        <div class="itab">
            <ul>
                <li><a href="#tab1" class="selected">型号列表</a></li>
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

            <br>
            <br>
            <br>

            <div id="wrap">
                <?php if(is_array($model)): $i = 0; $__LIST__ = $model;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><div  class="div">
                        <div class="name"><h1><b><strong><?php echo ($v["name"]); ?></strong></b></h1></div>
                        <div class="remark"><?php echo ($v["remark"]); ?></div>
                        <div class="operating"><button>编辑</button>&nbsp;&nbsp;&nbsp;&nbsp;<button>删除</button></div>
                        <div class="create_time"><?php echo ($v["create_time"]); ?></div>
                    </div><?php endforeach; endif; else: echo "" ;endif; ?>
               <!-- <div  class="div">div2</div>
                <div  class="div">div3</div>
                <div  class="div">div4</div>
                <div  class="div">div5</div>
                <div  class="div">div6</div>
                <div  class="div">div7</div>
                <div  class="div">div8</div>
                <div  class="div">div9</div>
                <div  class="div">div10</div>
                <div  class="div">div11</div>-->

            </div>
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
            $.post("<?php echo U('Program/models');?>",{programid:programid},function(result){
                for ( i in result)
                {
                   /* alert(i);//属性名称
                    alert(result[i].name)	;//属性值*/
                  /* str+="<div  class=\"div\"> <div class=\"bottom_footer\">"+ result[i].name+"</div> </div>";*/
                  str+="<div  class=\"div\"> <div class=\"name\"><h1><b><strong>"+ result[i].name+"</strong></b></h1></div> <div class=\"remark\">"+ result[i].remark+"</div> <div class=\"operating\"><button>编辑</button>&nbsp;&nbsp;&nbsp;&nbsp;<button>删除</button></div> <div class=\"create_time\">"+ result[i].create_time+"</div> </div>";
                }
                //alert(str);
                // alert(result[0].name);
                $("#wrap").html(str);


            });
        });
        /*
        * 点击button显示方案下模型
        * */
        $('.btn').click(function () {
            var programid=$('#program').val();
            var keyword=$("input[name='keyword']").val();
            if(programid==0 && keyword=='')
            {
                //默认全部
            }
            else if(programid==0 && keyword!='')
            {
                //方案没选，有关键字
                $.post("<?php echo U('Program/showmodes');?>",{programid:programid,keyword:keyword},function(result){
                    $("#wrap").html(result);
                });

            }
            else if(programid!=0 && keyword=='')
            {
                //组
            }
            else if(programid!=0 && keyword!='')
            {
                //方案选了，有关键字
                $.post("<?php echo U('Program/showmodes');?>",{programid:programid,keyword:keyword},function(result){
                    $("#wrap").html(result);
                });

            }


            //alert(programid);alert(keyword);

        });
    </script>


    <script src="/authtest/library/bootstrap3.3.7/js/bootstrap.min.js"></script>

</div>


</body>

</html>