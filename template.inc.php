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
define('IS_CACHE',true);
IS_CACHE ? ob_start() : null;
//引入模版类
require ROOT_PATH.'/includes/Templates.class.php';
//实例化模版类
$_tpl = new Template();