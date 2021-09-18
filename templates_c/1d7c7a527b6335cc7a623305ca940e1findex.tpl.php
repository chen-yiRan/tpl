<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $this->_configs['webname'];?></title>
</head>
<body>
    我将被index.php导入
    系统设置的分页数为<?php echo $this->_configs['pagesize'];?>
    <?php include 'test.php' ?>
<?php echo $this->_vars['name'] ?>,<?php echo $this->_vars['content'] ?> 必须经过Parser.class.php解析类解析

<?php if ($this->_vars['a']){ ?>
    <div>我是1号界面</div>
<?php }else{ ?>
    <div>我是2号界面</div>
<?php } ?>


<?php foreach ($this->_vars['array'] as $key => $value){ ?>
    <?php echo $key ?> ---> <?php echo $value ?> <br>
<?php } ?>

</body>
</html>