<?php
/**
 * Created by PhpStorm.
 * User: zidoo
 * Date: 2018/4/25
 * Time: 18:09
 */
namespace Home\Controller;
use Think\Controller;
class ApkController extends CommonController
{
    /*
 * 应用列表页
 * */
   public function apk()
   {
        //显示所有的apk，按时间倒序和未关联已关联
       $result=M('apk as  a')->field('a.id,a.name,a.remark,a.create_time,a.f_model,u.nickname')->join('t_user as u on a.create_people=u.id')->order('a.create_time desc')->select();
       $modelid_name=M('model')->field('id,name')->select();
       $a=array();
       foreach ($modelid_name as $k=>$v)
       {
           $a[$v['id']]=$v['name'];
       }
       foreach ($result as $k=>$v)
       {

           if($v['f_model']=='')
           {
               $result[$k]['model_name']='';
           }
           else
           {
               $b=explode(',',$v['f_model']);
               foreach ($b as $k1=>$v1)
               {
                   $result[$k]['model_name'] .=$a[$v1].',';
               }
           }
       }
      $this->assign('apks',$result);
       $this->display();
   }

   /*
    * apk关联型号页面
    * */
   public function related($id)
   {
       //所有方案
       $result = M('program')->order('create_time desc')->select();
       $this->assign('program', $result);


       //apk 已经关联的型号
       $result = M('apk')->where("id=$id")->field('f_model')->find();
       $b = explode(',', $result['f_model']);

       //所有型号id-name集合$a
       $modelid_name = M('model')->field('id,name')->select();
       $a = array();
       $link = '';
       foreach ($modelid_name as $k => $v) {
           $a[$v['id']] = $v['name'];
       }
       if ($result['f_model'] == '') {
           foreach ($a as $k1 => $v1) {
               $link .= "<input type='checkbox'name='modelid[]' value=$k1>" . $v1 . '&nbsp;&nbsp;&nbsp;';
           }

       } else {
           foreach ($a as $k1 => $v1) {
               $b = explode(',', $result['f_model']);

               if (in_array($k1, $b)) {
                  /* $link .= "<input type='checkbox' name='modelid[]' checked='checked' value=$k1>$v1" . '&nbsp;&nbsp;&nbsp;';*/
               } else {
                   $link .= "<input type='checkbox'  name='modelid[]' value=$k1>$v1" . '&nbsp;&nbsp;&nbsp;';
               }


           }

       }
       $this->assign('apkid',$id);
        $this->assign('models',$link);
       $this->display();
   }

   /*
    * 确认关联模型
    * */
   public function surerelated()
   {
       $apkid=$_POST['apkid'];
       //原有的关联模型id
       $result=M('apk')->where("id=$apkid")->field('f_model')->find();

       $modelids=$_POST['modelid'];//一维数组
       if(empty($modelids))
       {

       }
       else
       {
           $modelids=implode(',',$modelids);
           if($result['f_model']=='')
           {
               $result1=M('apk')->where("id=$apkid")->data(array('f_model'=>$modelids))->save();
           }
           else
           {
               $result1=M('apk')->where("id=$apkid")->data(array('f_model'=>$result['f_model'].",".$modelids))->save();
           }

           if($result1)
           {
               echo "<script>alert('关联成功');var index = parent.layer.getFrameIndex(window.name);window.parent.location.reload();parent.layer.close(index);</script>";
           }
           else
           {
               echo "<script>alert('失败或无修改');var index = parent.layer.getFrameIndex(window.name);window.parent.location.reload();parent.layer.close(index);</script>";
           }
       }

   }

   /*
    * apk关联型号页面方案下拉
    * */
   public function showmodels()
   {
        $programid=$_POST['programid'];
        $apkid=$_POST['apkid'];
       //apk 已经关联的型号
       $result = M('apk')->where("id=$apkid")->field('f_model')->find();
       $b = explode(',', $result['f_model']);

        //显示$programid下所有型号，判断型号是否已关联apkid
       $models=M('model')->where("f_program=$programid")->order('create_time desc')->select();
       $a = array();
       $link = '';
       foreach ($models as $k => $v) {
           $a[$v['id']] = $v['name'];
       }

       if ($result['f_model'] == '') {
           foreach ($a as $k1 => $v1) {
               $link .= "<input type='checkbox'name='modelid[]' value=$k1>" . $v1 . '&nbsp;&nbsp;&nbsp;';
           }

       } else {
           foreach ($a as $k1 => $v1) {
               if (in_array($k1, $b)) {
                   /*$link .= "<input type='checkbox' name='modelid[]' checked='checked' value=$k1>$v1" . '&nbsp;&nbsp;&nbsp;';*/
               } else {
                   $link .= "<input type='checkbox'  name='modelid[]' value=$k1>$v1" . '&nbsp;&nbsp;&nbsp;';
               }


           }

       }
       $this->ajaxReturn($link);
   }

   /*
    * 应用列表下拉选择
    * */
   public function pull()
   {
       $selects=$_POST['selects'];//0全部1未关联2已关联
       $keyword=trim($_POST['keyword']);
        if($selects==0)
        {
            $where="a.name like '%$keyword%'";

        }
        else if($selects==1)
        {
            $where="a.name like '%$keyword%' and a.f_model=''  or a.f_model is null";
        }
        else
        {
            $where="a.name like '%$keyword%' and a.f_model<>''";
        }

        //显示所有的apk，按时间倒序和未关联已关联
       $result=M('apk as  a')->field('a.id,a.name,a.remark,a.create_time,a.f_model,u.nickname')->join('t_user as u on a.create_people=u.id')->where($where)->order('a.create_time desc')->select();
       $modelid_name=M('model')->field('id,name')->select();
       $a=array();
       foreach ($modelid_name as $k=>$v)
       {
           $a[$v['id']]=$v['name'];
       }
       foreach ($result as $k=>$v)
       {

           if($v['f_model']=='')
           {
               $result[$k]['model_name']='';
           }
           else
           {
               $b=explode(',',$v['f_model']);
               foreach ($b as $k1=>$v1)
               {
                   $result[$k]['model_name'] .=$a[$v1].',';
               }
           }
       }
       $link='';
       foreach ($result as $k=>$v)
       {
           $link.="<tr>
                        <td>{$v['id']}</td>
                        <td><a href=\"__APP__/Apk/apkinfo/id/{$v['id']}\">{$v['name']}</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"__APP__/Apk/apkinfo/id/{$v['id']}\">查看应用信息</a></td>
                        <td>{$v['remark']}</td>
                        <td>{$v['create_time']}</td>
                        <td>{$v['nickname']}</td>
                        <td>{$v['model_name']}</td>
                        <td class=\"operating\">
                            <a href=\"javascript:;\" name='related' class=\"tablelink\"  modurl=\"".__APP__."/Apk/related/id/{$v['id']}\">关联型号</a>
                        </td>
                    </tr>";
       }


       $this->ajaxReturn($link);

   }

   /*
    * 搜索
    * */
   public function search()
   {
       $selects=$_POST['selects'];//0全部1未关联2已关联
       $keyword=trim($_POST['keyword']);
       if($selects==0)
       {
           $where="a.name like '%$keyword%'";

       }
       else if($selects==1)
       {
           $where="a.name like '%$keyword%' and a.f_model='' or a.f_model is null";
       }
       else
       {
           $where="a.name like '%$keyword%' and a.f_model<>''";
       }

       //显示所有的apk，按时间倒序和未关联已关联
       $result=M('apk as  a')->field('a.id,a.name,a.remark,a.create_time,a.f_model,u.nickname')->join('t_user as u on a.create_people=u.id')->where($where)->order('a.create_time desc')->select();
       $modelid_name=M('model')->field('id,name')->select();
       $a=array();
       foreach ($modelid_name as $k=>$v)
       {
           $a[$v['id']]=$v['name'];
       }
       foreach ($result as $k=>$v)
       {

           if($v['f_model']=='')
           {
               $result[$k]['model_name']='';
           }
           else
           {
               $b=explode(',',$v['f_model']);
               foreach ($b as $k1=>$v1)
               {
                   $result[$k]['model_name'] .=$a[$v1].',';
               }
           }
       }
       $link='';
       foreach ($result as $k=>$v)
       {
           $link.="<tr>
                        <td>{$v['id']}</td>
                        <td><a href=\"__APP__/Apk/apkinfo/id/{$v['id']}\">{$v['name']}</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"__APP__/Apk/apkinfo/id/{$v['id']}\">查看应用信息</a></td>
                        <td>{$v['remark']}</td>
                        <td>{$v['create_time']}</td>
                        <td>{$v['nickname']}</td>
                        <td>{$v['model_name']}</td>
                        <td class=\"operating\">
                            <a href=\"javascript:;\" name='related' class=\"tablelink\"  modurl=\"".__APP__."/Apk/related/id/{$v['id']}\">关联型号</a>
                        </td>
                    </tr>";
       }


       $this->ajaxReturn($link);
   }

   /*
    * apk详情页
    * */
   public function apkinfo($id)
   {
       $apkinfo=M('apk')->where("id=$id")->field('name')->find();
       $this->assign('apkname',$apkinfo);

       $all_version=M('apk_version')->where("f_id=$id")->order('create_time desc')->select();
       /*field('a.id,a.address,a.version,a.create_time,a.update_info,a.create_people')*/
        $this->assign('apk_version',$all_version);
       $this->display();
   }

   /*
    * 上传apk版本
    * */
   public function upload()
   {

   }
}