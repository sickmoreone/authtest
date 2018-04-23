<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller{
	public function index(){
		
		if(IS_POST){
			$m=M('user');
			$where['username']=I('username');
			$where['password']=md5(I('password'));
			$user=$m->where($where)->find();
			if(empty($user)){
				$this->error('用户名或者密码错误');
			}else{
				//是超级管理员给个标识
				if(I('username')==C('AUTH_CONFIG.AUTH_SUPER')){
					$_SESSION['isadmin']=1;
				}
				//登录成功，存入session
				$_SESSION['uid']=$user['id'];
				$_SESSION['username']=$user['username'];
				$this->redirect('index/main');
			}
		}
		$this->display();
	}

    public function logout(){
        unset($_SESSION['uid']);
        unset($_SESSION['username']);
        unset($_SESSION['isadmin']);
        $this->redirect('login/index');
    }
}