<?php
/**
 * Created by PhpStorm.
 * User: zidoo
 * Date: 2018/4/25
 * Time: 19:57
 */
namespace Home\Controller;
use Think\Controller;
class ApperController extends CommonController
{
    /*
     * apk显示页面
     * */
    public function apper()
    {
        $this->display();
    }

    /*
     * 添加apk
     * */
    public function addapk()
    {
        $name=$_POST['name'];
        $remark=$_POST['remark'];
        $create_time=date('Y-m-d H:i:s',time());
        $create_people=$_SESSION['uid'];
        $result=M('apk')->data(array('name'=>$name,'remark'=>$remark,'create_time'=>$create_time,'create_people'=>$create_people))->add();
        if($result)
        {
            $this->success('添加成功');
        }
        else
        {
            $this->error('添加失败');
        }

    }

}