<?php
namespace Home\Controller;
use Think\Controller;
class AuthController extends CommonController{
	//添加规则,对应的表是think_auth_rule
	public function ruleadd(){
		$m=M('auth_rule');
		$id=I('id');
		if(IS_POST){
			$m->create();
			$where['name']=I('name');
			if($id){
				//修改操作
				$where['id']=array('neq',$id);
				$count=$m->where($where)->count();
				if($count){
					$this->error('名称存在重复');
				}else {
					if($m->save()){
						$this->success('修改成功');
					}else{
						$this->error('修改失败');
					}
				}					
			}else{
				//添加操作
				$count=$m->where($where)->count();
				if($count){
					$this->error('名称存在重复');
				}else {
					if($m->add()){
						$this->success('添加成功');
					}else{
						$this->error('添加失败');
					}
				}
			}
		}
		
		//权限列表
		$this->list=$m->select();
		
		//修改页面
		if($id){
			$this->info=$m->find($id);
		}
		$this->display();
	}

	//权限组
	public function groupadd(){
		//规则列表循环
		$this->rulesList=M('auth_rule')->select();
		$m=M('auth_group');
		$id=I('id');
		if(IS_POST){
			$m->create();
			$m->rules=implode(',', I('rules'));
			$where['title']=I('title');
			if($id){
				$where['id']=array('neq',$id);
				$count=$m->where($where)->count();
				if($count){
					$this->error('名称存在重复');
				}else{
					if($m->save()){
						$this->success('修改权限组成功');
					}
				}
			}else{
				$count=$m->where($where)->count();
				if($count){
					$this->error('名称存在重复');
				}else{
					if($m->add()){
						$this->success('添加权限组成功');
					}
				}
				
			}
		}
		if($id){
			$this->info=$m->find($id);
		}
			
		//权限列表
		$list=$m->select();
 		foreach ($list as $k=>$v){
 			$list[$k]['rules']=explode(',',$v['rules']);
 			foreach ($list[$k]['rules'] as $k1=>$v1){
 				$list[$k]['rules'][$k1]=M('auth_rule')->where('id='.$v1)->getField('title');
 				//$list[$k]['rules']=implode(',',$list[$k]['rules'][$k1]);
 			}
 		} 
		//p($list);die;
		$this->list=$list;
		$this->display();
	}
}