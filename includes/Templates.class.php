<?php
class Template {
    //我想通过一个字段来接收变量，但是又不知道有多少变量要接收，所以需要动态接收变量，使用数组来实现这个功能
    private $_vars = array();

    //创建一个构造方法来验证各个目录是否存在
    public function __construct()
    {
        if(!is_dir(TPL_DIR) || !is_dir(TPL_C_DIR) || !is_dir(CACHE)){
            exit("ERROR:模版目录或编译目录或缓存目录不存在！请手工添加");
        }
    }
    //用于注入变量
    public function assign($_var, $_value){
        //$_var用于同步模版里的变量名，例如index.php是name 那么index.tpl就是{$name}
        //$_value值表示的是index.php里的变量值
        if(isset($_var) && !empty($_var)){
            $this->_vars[$_var] = $_value;
        } else {
            exit("ERROR:请设置模版变量！");
        }
    }
    public function display($_file){
        $_tplFile = TPL_DIR.$_file;
        //判断模版文件是否存在
        if(!file_exists($_tplFile)){
            exit("ERROR:模版文件不存在！");
        }

        //生成编译文件
        $_parFile = TPL_C_DIR . md5($_file) . $_file . '.php';
        //当编译文件不存在 或者 模版文件修改过 则生成编译文件
        if(!file_exists($_parFile) || filemtime($_parFile) < filemtime($_tplFile)){
            //引入模版解析类
            require ROOT_PATH . '/includes/Parser.class.php';
            $_parser = new Parser($_tplFile);
            $_parser->compile($_parFile);
        }

        //载入编译文件
        include $_parFile;
    }
}