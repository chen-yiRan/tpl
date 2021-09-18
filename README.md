以往的编程方式为混合php+html
将php代码和静态html代码进行分离，使代码的可读性和维护性显著提高


模版引擎是一种软件库，允许从模版生成HTML代码，并指定要包含的动态内容

特点：
1.鼓励分离
2.促进分工
3.比php更容易解析：编译文件和缓存文件加载更快、占资源更少
4.增加安全性

自己设计一个引擎模版,最大的好处就是从简

第一次访问时（第一次访问index.php)
纯php文件（如index.php） +  纯html文件包含了动态标签 （index.tpl）通过 模版类template.class.php(需要模版解析类 解析 tpl文件里的动态标签，还需要读取系统变量库profile.xml) 
生成 编译文件（混合php+html文件 123abc23index.tpl.php）再生成缓存文件（纯静态html文件 123abc23index.tpl.html）

第二次访问时（第二次访问index.php）
直接访问缓存文件（纯静态html文件 123abc23index.tpl.html）


每一个php文件都对应一个tpl文件，每一个php文件都需注入变量


