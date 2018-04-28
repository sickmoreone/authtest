<?php
/**
 * Created by PhpStorm.
 * User: zidoo
 * Date: 2018/4/25
 * Time: 16:09
 */
namespace Home\Controller;
use Think\Controller;
class SystemController extends CommonController
{
    public function system()
    {
        //所有方案
        $result=M('program')->order('create_time desc')->select();
        $this->assign('program',$result);
        //所有型号
        $result1=M('model')->order('create_time desc')->select();
        $this->assign('model',$result1);
        $this->display();
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
                $link.="<tr><td>{$v['id']}</td><td>{$v['name']}</td><td>{$v['remark']}</td><td class=\"operating\"><a href=\"#\" name='related' class=\"tablelink\"  modurl=\"".__APP__."/System/related/id/{$v['id']}\">关联人员</a></td></tr>";
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
                $link.="<tr><td>{$v['id']}</td><td>{$v['name']}</td><td>{$v['remark']}</td><td class=\"operating\"><a href=\"#\" name='related' class=\"tablelink\"  modurl=\"".__APP__."/System/related/id/{$v['id']}\">关联人员</a></td></tr>";
            }
        }
        else if($programid!=0 && $keyword!='')
        {
            //方案选了，有关键字
            $result=M('model')->where("name like '%$keyword%' and f_program=$programid")->order('create_time desc')->select();

            foreach ($result as $k=>$v)
            {
                /* $link.="<div  class=\"div\"> <div class=\"bottom_footer\">{$v['name']}</div> </div>";*/
                $link.="<tr><td>{$v['id']}</td><td>{$v['name']}</td><td>{$v['remark']}</td><td class=\"operating\"><a href=\"#\" name='related' class=\"tablelink\"  modurl=\"".__APP__."/System/related/id/{$v['id']}\">关联人员</a></td></tr>";
            }
        }
        $this->ajaxReturn($link);
    }

    /*
     * 弹出的关联人员页
     * */
    public function related($id)
    {
        //模型id
        $this->assign('modelid',$id);
        //所有组
        $result2=M('auth_group')->select();
        $this->assign('group',$result2);

        $asso_person=M('model')->where("id=$id")->field('asso_person')->find();
        $arr=explode(',',$asso_person['asso_person']);
        //所有人员
        $result3=M('user')->field('id,username,nickname')->select();
        $link='';
        foreach ($result3 as $k=>$v)
        {
            if(in_array($v['id'],$arr))
            {
                $link.="<input type='checkbox' name='uid[]' value=".$v['id']." checked='checked'/>".$v['nickname'].'&nbsp;&nbsp;&nbsp;';
            }
            else
            {
                $link.="<input type='checkbox' name='uid[]' value=".$v['id']." />".$v['nickname'].'&nbsp;&nbsp;&nbsp;';
            }

            /* <input type="checkbox" name="vehicle" value="Car" checked="checked" />*/
        }
        $this->assign('allpeople',$link);
        $this->display();
    }

    /*
     * 关联人员提交
     * */
    public function surerelated()
    {
        //dump($_POST);
        $modelid=$_POST['id'];
        $uids=$_POST['uid'];
        $link='';
        foreach($uids as $k=>$v)
        {
            $link.=$v.',';
        }
        $link=delcomma($link);
        $result=M('model')->where("id=$modelid")->data(array("asso_person"=>$link))->save();
        if($result)
        {
            echo "<script>alert('关联成功');var index = parent.layer.getFrameIndex(window.name);window.parent.location.reload();parent.layer.close(index);</script>";
        }
        else
        {
            echo "<script>alert('失败');var index = parent.layer.getFrameIndex(window.name);window.parent.location.reload();parent.layer.close(index);</script>";
        }
    }
}