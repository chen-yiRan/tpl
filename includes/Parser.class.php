<?php
class Parser {

    private $_tpl;

    //构造方法，用于获取模版文件里的内容
    public function __construct($_tplFile){
       if(!$this->_tpl = file_get_contents($_tplFile)){
           exit("ERROR:模版文件读取错误");
       }
    }
    //解析普通变量
    public function parVar(){
        //普通变量的匹配模式
        $_patten = '/\{\$([\w]+)\}/';
        //查找是否有普通变量存在
        if(preg_match($_patten,$this->_tpl)){
            //替换，将{$name}替换成$this->_var['name'], \\1是因为正则表达式只有一个分组，代表那个括号里的值（name） \\1 == $1
            $this->_tpl = preg_replace($_patten,"<?php echo \$this->_vars['$1'] ?>",$this->_tpl);
        }
    }

    //解析if语句
    public function parIf(){
        $_pattenIF = '/\{if\s+\$([\w]+)\}/';
        $_pattenEndIf = '/\{\/if\}/';
        $_pattenElse = '/\{else\}/';
        if(preg_match($_pattenIF,$this->_tpl)){
            if(preg_match($_pattenEndIf,$this->_tpl)){
                $this->_tpl = preg_replace($_pattenIF,"<?php if (\$this->_vars['$1']){ ?>",$this->_tpl);
                $this->_tpl = preg_replace($_pattenEndIf,"<?php } ?>",$this->_tpl);
                if(preg_match($_pattenElse,$this->_tpl)){
                    $this->_tpl = preg_replace($_pattenElse,"<?php }else{ ?>",$this->_tpl);
                }
            }else{
                exit("ERROR: if语句没有关闭！");
            }

        }

    }
    public function compile($_parFile){
        //解析模版内容
        $this->parVar();
        $this->parIf();
        //生成编译文件
        if(!$this->_tpl = file_put_contents($_parFile,$this->_tpl)){
            exit("ERROR:编译文件生成错误");
        }
    }
}