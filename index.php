<?php
//强制统一编码，防止出现乱码
header('Content-Type:text/html;charset=utf-8');
//网站根目录，php在读取写入文件时使用绝对路径效率最高
define('ROOT_PATH',dirname(__FILE__));
//模版文件目录
define('TPL_DIR',ROOT_PATH.'/templates/');
//编译文件目录
define('TPL_C_DIR',ROOT_PATH.'/templates_c/');
//缓存文件目录
define('CACHE',ROOT_PATH.'/cache/');

//引入模版类
require ROOT_PATH.'/includes/Templates.class.php';
//实例化模版类
$_tpl = new Template();

//声明一个变量
$_name = '我爱你';
$_content = '美丽的姑娘';
$_array = array(1,2,3,4,5,6,7);
$_tpl->assign('name',$_name);
$_tpl->assign('content',$_content);
$_tpl->assign('a',false);
$_tpl->assign('array',$_array);
//载入tpl文件
$_tpl->display('index.tpl');