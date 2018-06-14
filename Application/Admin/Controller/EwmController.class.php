<?php
namespace Api\Controller;
use Think\Controller;

class EwmController extends Controller {

	public function index(){
		$appid=C('APPID');
		$secret=C('APPSECRET');
		$tokenUrl="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$secret;

		$html = file_get_contents($tokenUrl);
		$arr =json_decode($html,true);
		// echo $arr['access_token'];
		
		
		$access_token=$arr['access_token'];
		
// 		$path="pages/index/index?id=1";
// 		$width='430';
// 		$post_data='{"path":"'.$path.'","width":'.$width.'}';
// 		$url="https://api.weixin.qq.com/wxa/getwxacode?access_token=".$access_token;
		
		$result=api_notice_increment($url,$post_data);
		
		$base64_image_content =data_uri($result,'image/png');
		
		
		
		
		//匹配出图片的格式
		if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_image_content, $result)){
			$type = $result[2];
			$new_file = "nusoap/".date('Ymd',time())."/";
			if(!file_exists($new_file))
			{
				//检查是否有该文件夹，如果没有就创建，并给予最高权限
				mkdir($new_file, 0700);
			}
			$new_file = $new_file.time().".{$type}";
			if (file_put_contents($new_file, base64_decode(str_replace($result[1], '', $base64_image_content)))){
				echo '新文件保存成功：', $new_file;
			}else{
				echo '新文件保存失败';
			}
		}
		
		
		exit();
		
		
		function api_notice_increment($url,$data){
		
		
			$ch = curl_init();
			$header = "Accept-Charset: utf-8";
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
			curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
		
		
			curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		
		
			$tmpInfo = curl_exec($ch);
			// return $tmpInfo;
			// //     var_dump($tmpInfo);
			// //    exit;
			if (curl_errno($ch)) {
				return false;
			}else{
				// var_dump($tmpInfo);
				return $tmpInfo;
			}
		}
		
		
		
		
		function data_uri($contents, $mime)
		{
		
			$base64   = base64_encode($contents);
		
			return ('data:' . $mime . ';base64,' . $base64);
		}
		
		
	}
}