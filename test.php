这是一个测试
<?php
function test(){
    echo "方法";
}

echo "这是一个测试";
echo "\n";
ob_start();
echo "我向浏览器输出了";
$a = ob_get_contents();
ob_end_clean();
echo 'a' . $a;
