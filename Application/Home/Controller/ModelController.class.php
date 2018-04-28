<?php
/**
 * Created by PhpStorm.
 * User: zidoo
 * Date: 2018/4/25
 * Time: 9:29
 */
namespace Home\Controller;
use Think\Controller;
class ModelController extends CommonController
{
    public function model()
    {
        //所有方案
        $result=M('program')->order('create_time desc')->select();
        $this->assign('program',$result);
        //所有型号
        $result1=M('model')->order('create_time desc')->select();
        $this->assign('model',$result1);


        //所有组
        $result2=M('auth_group')->select();
        $this->assign('group',$result2);
        //所有人员
        $result3=M('user')->field('id,username,nickname')->select();
        $link='';
        foreach ($result3 as $k=>$v)
        {
            $link.="<input type='checkbox' name='uid[]' value=".$v['id']." />".$v['nickname'].'&nbsp;&nbsp;&nbsp;';
            /* <input type="checkbox" name="vehicle" value="Car" checked="checked" />*/
        }
        $this->assign('allpeople',$link);
        $this->display();
    }

    /*
    * groupid查询组下所有人
    * */
    public function showpeople()
    {
        $groupid=$_POST['groupid'];
        $result=M('auth_group_access as a')->join('t_user as b')->field('b.id,b.nickname,a.group_id')->where("a.group_id=$groupid and a.uid=b.id")->select();
        $a=array();
        foreach ($result as $k=>$v)
        {
            $a[]=$v['id'];
        }
        $result1=M('user')->field('id,username,nickname')->select();
        $link='';
        foreach ($result1 as $k=>$v)
        {
            if( in_array($v['id'],$a))
            {
                $link.="<input type='checkbox' name='uid[]' value=".$v['id']." checked='checked'/>".$v['nickname'].'&nbsp;&nbsp;&nbsp;';
            }
            else
            {
                $link.="<input type='checkbox' name='uid[]' value=".$v['id']." />".$v['nickname'].'&nbsp;&nbsp;&nbsp;';
            }


        }
        $this->ajaxReturn($link);
    }

    /*
    * 添加型号提交
    * */
    public function sureaddmodel()
    {
        $name=$_POST['name'];
        $remark=$_POST['remark'];
        $f_program=$_POST['programid'];
        $create_time=date("Y-m-d H:i:s",time());
        $asso_person='';
        foreach ($_POST['uid'] as $k=>$v)
        {
            $asso_person.=$v.',';
        }
        $asso_person=delcomma($asso_person);
        $result=M('model')->data(array('name'=>$name,'remark'=>$remark,'f_program'=>$f_program,'create_time'=>$create_time,'asso_person'=>$asso_person))->add();
        if($result)
        {
            $this->success('添加成功',U('Model/model'));
        }
        else
        {
            $this->success('数据错误',U('Model/model'));
        }

    }

    /*
    * 方案列表下拉框出型号
    * */
    public function models()
    {
        $programid=$_POST['programid'];
        if($programid==0){

        }else{
            //所有与该方案相关联的型号
            $result=M('model')->where("f_program=$programid")->order('create_time desc')->select();
            $link='';
            foreach ($result as $k=>$v)
            {
                $link.="<tr><td>{$v['id']}</td><td>{$v['name']}</td><td>{$v['remark']}</td><td class=\"operating\"><a href=\"#\" name='mod' class=\"tablelink\"  modurl=\"".__APP__."/Model/modpage/id/{$v['id']}\">修改</a><a href=\"javascript:;\" name='del' class=\"tablelink\" > 删除</a></td></tr>";
            }
            $this->ajaxReturn($link);
        }
    }

    /*
    * 点击button显示模型列表
    * */
    public function showmodes()
    {
        $programid=$_POST['programid'];
        $keyword=trim($_POST['keyword']);
        $link='';
        if($programid==0 && $keyword!='')
        {
            //方案没选，有关键字
            $result=M('model')->where("name like '%$keyword%'")->order('create_time desc')->select();

            foreach ($result as $k=>$v)
            {
                $link.="<tr><td>{$v['id']}</td><td>{$v['name']}</td><td>{$v['remark']}</td><td class=\"operating\"><a href=\"#\" name='mod' class=\"tablelink\"  modurl=\"".__APP__."/Model/modpage/id/{$v['id']}\">修改</a><a href=\"javascript:;\" name='del' class=\"tablelink\" > 删除</a></td></tr>";
            }
        }
        else if($programid!=0 && $keyword!='')
        {
            //方案选了，有关键字
            $result=M('model')->where("name like '%$keyword%' and f_program=$programid")->order('create_time desc')->select();

            foreach ($result as $k=>$v)
            {
                /* $link.="<div  class=\"div\"> <div class=\"bottom_footer\">{$v['name']}</div> </div>";*/
                $link.="<tr><td>{$v['id']}</td><td>{$v['name']}</td><td>{$v['remark']}</td><td class=\"operating\"><a href=\"#\" name='mod' class=\"tablelink\"  modurl=\"".__APP__."/Model/modpage/id/{$v['id']}\">修改</a><a href=\"javascript:;\" name='del' class=\"tablelink\" > 删除</a></td></tr>";
            }
        }
        $this->ajaxReturn($link);
    }

    /*
     * 弹出的修改模型页
     * */
    public function modpage($id)
    {
        $result=M('model')->where("id=$id")->find();
        $this->assign('model',$result);
        $this->display();
    }

    /*
    * 确认修改模型
    * */
    public function suremod()
    {
        $id=$_POST['id'];
        $remark=$_POST['remark'];
        $name=$_POST['name'];
        /*dump($_POST);*/
        $result=M('model')->where("id=$id")->data(array('name'=>$name,'remark'=>$remark))->save();
        if($result)
        {

            $this->ajaxReturn(1);//修改成功

        }
        else
        {
            $this->ajaxReturn(2);//失败或者无修改
        }
    }

    /*
    * ajax删除型号（型号下可有多个apk和一个固件）
    * */
    public function delList()
    {
        $modelid=$_POST['id'];
        //查出该型号下所有的apk和固件，如果有apk或者固件就不能被删除
        $result=M('apk')->where("f_model like '%$modelid%'")->select();
        foreach ($result as $k=>$v)
        {
            //$v['f_model']是1,2,3
            $arr=explode(',',$v['f_model']);
            if(in_array($modelid,$arr))
            {
                $this->ajaxReturn(1);//有关联的apk，不能被删除
            }
        }

        $result1=M('firmware')->where("f_model=$modelid")->find();
        if(!empty($result))
        {
            $this->ajaxReturn(1);//有关联的固件，不能被删除
        }


        //执行删除
        $result=M('model')->where("id=$modelid")->delete();
        if($result)
        {
            $this->ajaxReturn(2);//删除成功
        }
    }
}