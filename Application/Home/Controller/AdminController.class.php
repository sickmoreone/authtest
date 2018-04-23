<?php
namespace Home\Controller;
use Think\Controller;
class AdminController extends CommonController{
	public function add(){
		$m=M('user');
		$id=I('id');
		if(IS_POST){
			$m->create();
			$m->password=md5(I('password'));
			$where['username']=I('username');
			if($id){
				$where['id']=array('neq',$id);
				$count=$m->where($where)->count();
				if($count){
					$this->error('用户名重复');
				}else{
					if($m->save()){
						M('auth_group_access')->where('id='.$id)->setField('group_id',I('group_id'));
						$this->success('修改成功');
					}
				}
			}else{
				$count=$m->where($where)->count();
				if($count){
					$this->error('用户名重复');
				}else{
					if($id=$m->add()){
						M('auth_group_access')->add(array(
							'uid'	=>$id,
							'group_id'	=>I('group_id')
						));
						$this->success('添加成功');
					}
				}
			}
		}
		if($id)
			$this->info=$m->find($id);
		
		//用户以及所属权限组
		$sql="select a.*,b.title,c.username from t_auth_group_access a inner join t_auth_group b on a.group_id=b.id inner join t_user c on a.uid=c.id";
		$list=M()->query($sql);
		//echo $sql;
		//p($list);die;
		$this->list=$list;
		//权限组遍历
		$this->groupList=M('auth_group')->select();
		$this->display();
	}
}