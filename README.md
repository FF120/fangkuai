# 方块网
一个关于钢材信息的综合信息展示和交易平台

# 结构

- Application		-- 应用程序主目录
- Public			-- JS，CSS，IMAGE等资源文件
- ThinkPHP		-- ThinkPHP框架源码
- html			-- 网站前台的静态展示页面
- fangkuai.sql			-- 网站运行需要的数据库文件

# 部署

1. 配置好`Apache`服务器和`Mysql`数据库。
2. 新建数据库`fangkuai`,将`fangkuai.sql`导入`fangkuai`数据库
3. 在`Common`模块中的`Conf`下的`config.php`中配置数据库连接信息
```php
 'DB_TYPE'   => 'mysql', // 数据库类型
    'DB_HOST'   => 'localhost', // 服务器地址
    'DB_NAME'   => 'fangkuai', // 数据库名
    'DB_USER'   => 'root', // 用户名
    'DB_PWD'    => '123456', // 密码
    'DB_PORT'   => 3306, // 端口
    'DB_PREFIX' => '', // 数据库表前缀
    'DB_CHARSET'=> 'utf8', // 字符集
```

5. 访问根目录的服务器地址，自动跳转到前台页面
- 前台地址：[http://localhost/fangkuai/index.php/Home/Product/index.html](http://localhost/fangkuai/index.php/Home/Product/index.html)
- 后台地址：[http://localhost/fangkuai/index.php/Admin](http://localhost/fangkuai/index.php/Admin)
- 演示地址：[https://ff120.github.io/fangkuai/](https://ff120.github.io/fangkuai/)


