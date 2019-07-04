# thinkphp5-api
=================
基于ThinkPHP5.1* 基础上开发的一个简单的restful api

在开源项目[thinkphp5-restfulapi](https://github.com/Leslin/thinkphp5-restfulapi)上修改而来

使用JSON Web令牌(JWT)跨域身份验证解决方案做权限验证
> ThinkPHP5的运行环境要求PHP5.6以上。

## 开发
```
# 克隆项目
git clone https://github.com/yxlix/thinkphp5-api.git

# 进入项目目录
cd vue-element-admin

# 安装依赖
composer install

# 可以使用php自带webserver快速测试，启动服务
php think run
```

然后就可以在浏览器中访问
~~~
http://127.0.0.1:8000/v1/demo
~~~

## thinkphp5.1在线手册

+ [完全开发手册](https://www.kancloud.cn/manual/thinkphp5_1/content)
+ [升级指导](https://www.kancloud.cn/manual/thinkphp5_1/354155) 

## 目录结构

初始的目录结构如下：

~~~
www  WEB部署目录（或者子目录）
├─application           应用目录
│  ├─common             公共模块目录（可以更改）
│  ├─api                接口目录
│  │  ├─controller      控制器目录
│  │  │     ├─v1        版本1目录
|  |  |     ├─v2        版本2目录
│  │  ├─Api.php         授权基类
│  │  ├─Oauth.php       授权验证
|  |  |─exception       异常目录
│  │  ├─model           模型目录
│  │  ├─validate        验证器目录
│  │  └─ ...            更多类库目录
│  │
│  ├─command.php        命令行定义文件
│  ├─common.php         公共函数文件
│  └─tags.php           应用行为扩展定义文件
│
├─config                应用配置目录
│  ├─module_name        模块配置目录
│  │  ├─database.php    数据库配置
│  │  ├─cache           缓存配置
│  │  └─ ...            
│  │
│  ├─app.php            应用配置
│  ├─cache.php          缓存配置
│  ├─cookie.php         Cookie配置
│  ├─database.php       数据库配置
│  ├─log.php            日志配置
│  ├─session.php        Session配置
│  ├─template.php       模板引擎配置
│  └─trace.php          Trace配置
│
├─route                 路由定义目录
│  ├─route.php          路由定义
│  └─...                更多
│
├─public                WEB目录（对外访问目录）
│  ├─index.php          入口文件
│  ├─router.php         快速测试文件
│  └─.htaccess          用于apache的重写
│
├─thinkphp              框架系统目录
│  ├─lang               语言文件目录
│  ├─library            框架类库目录
│  │  ├─think           Think类库包目录
│  │  └─traits          系统Trait目录
│  │
│  ├─tpl                系统模板目录
│  ├─base.php           基础定义文件
│  ├─console.php        控制台入口文件
│  ├─convention.php     框架惯例配置文件
│  ├─helper.php         助手函数文件
│  ├─phpunit.xml        phpunit配置文件
│  └─start.php          框架入口文件
│
├─extend                扩展类库目录
├─runtime               应用的运行时目录（可写，可定制）
├─vendor                第三方类库目录（Composer依赖库）
├─build.php             自动生成定义文件（参考）
├─composer.json         composer 定义文件
├─LICENSE.txt           授权说明文件
├─README.md             README 文件
├─think                 命令行入口文件
~~~



## 配置
本项目使用强制路由模式，因此每一个接口都需要在route中写入

数据集返回类型修改为 `collecton`，如需 `array` 请自行到 `config/database` 中修改 `resultset_type`设置
### 数据库配置
项目根目录创建.env文件
```
APP_DEBUG = true
[DATABASE]
    HOSTNAME = 127.0.0.1
    USERNAME = root
    PASSWORD = root
```
### jwt配置
自行修改`config/jwt.php`,里面有注释
#### firebase/php-jwt RS256 公私钥生成指南
下载安装git后，右键打开Git Bash Here 终端工具
1. 生成私钥
    ```
    # 1024 这个长度可根据实际情况调整
    openssl genrsa -out pri_key.pem 1024
    ```
    完成后桌面就会出现 `pri_key.pem` 文件，打开后替换 `config/jwt.php` 文件中`$privateKey`的值
2. 生成公钥
    ```
    openssl rsa -in pri_key.pem -pubout -out pub_key.pem
    ```
    完成后桌面就会出现 `pub_key.pem` 文件，打开后替换 `config/jwt.php` 文件中`$publicKey`的值

## 具体用法参照application/api/controller/v1/Demo.php

## 版权信息
遵循Apache2开源协议发布，并提供免费使用。