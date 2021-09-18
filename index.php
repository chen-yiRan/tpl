<?php

require dirname(__FILE__) . '/template.inc.php';
global $_tpl;
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