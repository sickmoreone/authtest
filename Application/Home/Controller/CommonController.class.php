<?php
namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller{
	public function _initialize(){
		if(!isset($_SESSION['uid']) || empty($_SESSION['uid'])){
			$this->redirect('login/index');
		}
		//echo C('AUTH_CONFIG.AUTH_SUPER');
		//p($_SESSION);die;
		if(!session('isadmin')){//超级管理员不用验证
			if(CONTROLLER_NAME!='Index'){
				$auth=new \Think\Auth();
				if(!$auth->check(CONTROLLER_NAME.'/'.ACTION_NAME,$_SESSION['uid'])){
					$this->error('你没有权限',U('Index/index'));
				}
			}
		}
	}

}