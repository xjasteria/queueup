<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller
{

    public function index()
    {
        $this->assign('base_url', __ROOT__);
        $this->display('login:index');
    }


    public function do_login()
    {
        $username = I('post.username/s', '');
        $pasword = I('post.password/s', '');
        $identity = I('post.identity/s', '');
        if ($identity == 'admin') {
        	if ($username == C('ADMIN_USERNAME') && $pasword == C('ADMIN_PASSWORD')) {
        		cookie('token',md5(C('ADMIN_USERNAME'.'ADMIN_PASSWORD')),86400);
        		$this->success('登录成功！',C('BASE_URL').'/index.php/admin/index/index',3);
        	} else {
        		$this->error('登录失败，请检查用户名和密码是否正确！',C('BASE_URL').'/index.php/home/login/index',3);
        	}
        }
        
        else {
        	if ($username == C('USER_USERNAME') && $pasword == C('USER_PASSWORD')) {
        		cookie('usertoken',md5(C('USER_USERNAME'.'USER_PASSWORD')),86400);
        		$this->success('登录成功！',C('BASE_URL').'/index.php/home/index/index',3);
        	} else {
        		$this->error('登录失败，请检查用户名和密码是否正确！',C('BASE_URL').'/index.php/home/login/index',3);
        	}
        	
        }
    }


    public function logout(){
        cookie('token',null);
        $this->success('已注销登录',C('BASE_URL').'/index.php/home/login/index',3);
    }


}