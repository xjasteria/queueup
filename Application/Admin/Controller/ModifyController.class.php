<?php
namespace Admin\Controller;
use Think\Controller;
class ModifyController extends BaseController {
	public function index(){
		$this->assign('base_url', __ROOT__);
		$this->display('login:modify');
	}
	

	public function do_modify(){

		//文件路径地址
		$path = 'Application/'.'Common'.'/Conf/new.php';
		 
		//thinkphp的配置文件是数组

		//读取配置文件,
		$file = include $path;

		//这里获取用户提交上来的配置文件 
		$oldpassword = I('post.oldpassword/s', '');
		$password = I('post.password/s', '');
		$newpassword = I('post.newpassword/s', '');
		$config = array(
				'ADMIN_PASSWORD' => $password,
		);
		if ($oldpassword == C('ADMIN_PASSWORD') && $password == $newpassword) {
			//合并数组，相同键名，后面的值会覆盖原来的值
			$res = array_merge($file, $config);
			
			//数组循环，拼接成php文件
			$str = '<?php return array(';
			
			foreach ($res as $key => $value){
				// '\'' 单引号转义
				$str .= '\''.$key.'\''.'=>'.'\''.$value.'\''.',';
			};
			$str .= '); ?>';
				
			//写入文件中,更新配置文件
			if(file_put_contents($path, $str)){
				$this->success('修改成功！请重新登录',C('BASE_URL').'/index.php/home/login/index',3);
			}
		} else {
			$this->error('修改失败，请查看原密码是否正确！',C('BASE_URL').'/index.php/admin/modify',1);
		}

	}
}