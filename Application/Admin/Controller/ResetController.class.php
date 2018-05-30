<?php
namespace Admin\Controller;
use Think\Controller;
class ResetController extends BaseController {
	public function index(){
		$this->assign('base_url', __ROOT__);
		$this->display('login:reset');
	}

	public function do_reset(){

		//文件路径地址
		$path = 'Application/'.'Common'.'/Conf/new.php';
			
		//thinkphp的配置文件是数组

		//读取配置文件,
		$file = include $path;

		//这里获取用户提交上来的配置文件
		$username = I('post.username/s', '');
		$password = I('post.password/s', '');
		$config = array(
				'USER_USERNAME' => $username,
				'USER_PASSWORD' => $password,
		);
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
			$this->success('重置成功！！！',C('BASE_URL').'/index.php/admin/reset',1);
		}
		
	}
}