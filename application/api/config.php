<?php
$home_config = [
    // +----------------------------------------------------------------------
    // | 模板设置
    // +----------------------------------------------------------------------
	//默认错误跳转对应的模板文件
	'dispatch_error_tmpl' => 'public:dispatch_jump',
	//默认成功跳转对应的模板文件
	'dispatch_success_tmpl' => 'public:dispatch_jump', 
	'API_SECRET_KEY'        =>'www.tp-shop.cn', // app 调用的签名秘钥
	'app_access_key'        =>'isCrJEctN_cwJqgH3r2rqTx_APNnqk5Epe',
    'sms_url' => 'http://shz.api.user.ruitukeji.cn:8502/index.php?m=Api&c=BaseMessage&a=sendInterCaptcha',
];

$html_config = include_once 'html.php';
return array_merge($home_config,$html_config);
?>