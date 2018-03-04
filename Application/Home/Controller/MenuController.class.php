<?php
namespace Home\Controller;
use Think\Controller;
class MenuController extends BaseController {
	public function index(){
		$this->assign('base_url',__ROOT__);
		$this->display('Menu:index');
	}
	
	public function query(){
		$fields = array('page', 'rows', 'sidx', 'sord', 'type', 'query', 'value', '_search', 'searchField', 'searchString', 'searchOper',);
		$params = $this->I($fields);
	
		$offset = ($params['page'] - 1) * $params['rows'];
	
		$p = array('offset' => $offset, 'limit' => $params['rows']);
		$MenuModel = M('menu');
		$result = $MenuModel->limit($p['offset'],$p['limit'])->select();
		$records = $MenuModel->count();
		$total = ceil($records/$params['rows']);
		$data = array(
				'records' => $records,
				'page' => $params['page'],
				'total' => $total,
				'rows' => $result,
		);
	
		echo json_encode($data);
	}
	
	
	public function update(){
		$fields = array('id', 'name', 'image','description','price','status');
		$params = $this->I($fields);
	
		$MenuModel = M('menu');
	
		$oper = I('post.oper');
		if ($oper == 'del') {//删除
			$MenuModel->where("id={$params['id']}")->delete();
		} else if ($oper == 'edit') {
			$params['updated_at'] = time();
			$MenuModel->where("id={$params['id']}")->save($params);
		}else if($oper == 'add'){
			unset($params['id']);
			$params['updated_at'] = time();
			$MenuModel->add($params);
		}
	
		echo json_encode(array('msg'=>'ok'));
	}
	
	public function upload(){
		$data = $this->upload_local();
	
		echo json_encode($data);
	}
	
	private function upload_local(){
		$base = dirname($_SERVER['SCRIPT_FILENAME']);
		$upload = new \Think\Upload();// 实例化上传类
		$upload->maxSize   =     3145728 ;// 设置附件上传大小
		$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$upload->rootPath  =     $base.'/Public/menupicture/'; // 设置附件上传根目录
		$upload->savePath  =     ''; // 设置附件上传（子）目录
		// 上传文件
		$info   =   $upload->upload();
		$url = C('BASE_URL').'/Public/menupicture/'.$info['file']['savepath'].$info['file']['savename'];
// 		$url = 'http://localhost:8080/queueup'.'/Public/menupicture/'.$info['file']['savepath'].$info['file']['savename'];
		if(!$info) {// 上传错误提示错误信息
			return array(
					'ret'=>-1,
					'msg'=>'上传失败'
			);
		}else{// 上传成功
			return array(
					'ret'=>0,
					'url'=>$url
			);
		}
	
	}
}
?>