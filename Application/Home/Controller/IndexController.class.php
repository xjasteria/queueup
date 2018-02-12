<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->assign('base_url',__ROOT__);
        $this->display('Index:index');
    }
}