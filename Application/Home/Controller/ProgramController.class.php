<?php
/**
 * Created by PhpStorm.
 * User: zidoo
 * Date: 2018/4/20
 * Time: 10:13
 */
namespace Home\Controller;
use Think\Controller;
class ProgramController extends CommonController {
    /*
     * 方案列表显示页面可以跳到模型页
     * */
    public function programList()
    {
        $programList=M('program')->select();
        $this->assign('programList',$programList);
        $this->display();
    }

    /*
     * 方案管理页面，方案的增删改
     * */
    public function programm()
    {
        $programList=M('program')->select();
        $this->assign('programList',$programList);
        $this->display();
    }

    /*
     * 修改方案的页面
     * */
    public function edit()
    {
        $id=$_POST['id'];
        $program=M('program')->where("id=$id")->find();
        $this->assign('program',$program);
        $this->display();
    }

    /*
     * 添加方案
     * */

    public function addprogram()
    {
        //dump($_SESSION);
        //dump($_POST);
        $id=$_SESSION['uid'];
        $name=$_POST['name'];
        $remark=$_POST['remark'];
        $create_time=date('Y-m-d H:i:s',time());
        $result=M('program')->data(array('bodyid'=>$id,'name'=>$name,'remark'=>$remark,'create_time'=>$create_time))->add();
        if($result)
        {
            $this->success('添加成功');
        }
        else
        {
            $this->error('添加失败');
        }
    }

    /*
     * ajax删除方案
     * */

    public function delList()
    {
        $programid=$_POST['id'];
        //查出该方案下所有的型号，如果有型号就不能被删除
        $result=M('model')->where("f_program=$programid")->find();
        if(!empty($result))
        {
            $this->ajaxReturn(1);//有关联的，不能被删除
        }
        else
        {
            //执行删除
            $result=M('program')->where("id=$programid")->delete();
            if($result)
            {
                $this->ajaxReturn(2);//删除成功
            }
        }
    }

    /*
     * 修改方案的页面
     * */
    public function modpage($id)
    {
       /* $programid=$_POST['id'];*/
        $programid=$id;
        $result=M('program')->where("id=$programid")->find();
        $this->assign('program',$result);
        $this->display();
    }
}