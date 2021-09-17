<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>自定义模版</title>
</head>
<body>
    我将被index.php导入
{$name},{$content} 必须经过Parser.class.php解析类解析

{if $a}
    <div>我是1号界面</div>
{else}
    <div>我是2号界面</div>
{/if}


</body>
</html>