<?php
class Template {
    //我想通过一个字段来接收变量，但是又不知道有多少变量要接收，所以需要动态接收变量，使用数组来实现这个功能
    private $_vars = array();
    //保存系统变量
    private $_configs = array();

    //创建一个构造方法来验证各个目录是否存在
    public function __construct()
    {
        if(!is_dir(TPL_DIR) || !is_dir(TPL_C_DIR) || !is_dir(CACHE)){
            exit("ERROR:模版目录或编译目录或缓存目录不存在！请手工添加");
        }
        //载入和保存系统变量
        $_sxe = simplexml_load_file(ROOT_PATH. '/config/config.xml');
        $_tagLib = $_sxe->xpath('/root/taglib');
        foreach ($_tagLib as $_tag){
            $this->_configs["$_tag->name"] = $_tag->value;
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
        //生成缓存文件
        $_cacheFile = CACHE . md5($_file) . $_file . '.html';
        //当第二次运行相同文件的时候，直接载入缓存文件，避开编译
        if(IS_CACHE){
            //缓存文件和编译文件都要存在
            if(file_exists($_cacheFile) && file_exists($_parFile)){
                //判断模版文件是否修改过 判断编译文件是否修改过
                if(filemtime($_parFile) >= filemtime($_tplFile) && filemtime($_cacheFile) >= filemtime($_parFile)){
                    echo "正在执行缓存文件";
                    //直接载入缓存文件
                    include $_cacheFile;
                    return;
                }
            }

        }
        //当编译文件不存在 或者 模版文件修改过 则生成编译文件
        if(!file_exists($_parFile) || filemtime($_parFile) < filemtime($_tplFile)){
            //引入模版解析类
            require ROOT_PATH . '/includes/Parser.class.php';
            $_parser = new Parser($_tplFile);
            $_parser->compile($_parFile);
        }

        //载入编译文件
        include $_parFile;

        if(IS_CACHE){
            //获取缓冲区内的数据
//        ob_get_contents();
            //获取缓冲区的数据，并且创建缓存文件,缓存文件就会是全静态html
            file_put_contents($_cacheFile,ob_get_contents());
            //清除缓冲区
            ob_end_clean();
            //载入缓存文件
            include $_cacheFile;
        }

    }
}