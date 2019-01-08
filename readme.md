# 项目基于laravel-admin1.6版本开发中~~~
# 尝试新版本~~~
# stationery-cms 
基于laravel-admin开发的办公用品管理系统，针对于中小型企业

```
本项目可以直接用，也可以用于二次开发，二次开发具体看相关文档
laravel版本为5.5.*、laravel-admin版本为1.6.*
```
[laravel-admin文档地址](https://laravel-admin.org/docs/zh)
### 克隆仓库
```
git clone git@github.com:WXiangQian/stationery-cms.git
```

### 运行环境
```
"php": ">=7.0.0"
```

### 生成配置文件
```
cp .env.example .env
```
你可以根据情况修改 .env 文件里的内容，如数据库连接、缓存、邮件设置等。

### 生成秘钥
```
php artisan key:generate
```

### 配置好.env以后执行以下命令进行创建数据库
(提示directory already exists 可忽略)

```
php artisan admin:install
```

### 生成网站链接
```
php artisan serve

Laravel development server started: <http://127.0.0.1:8000>
http://127.0.0.1:8000为该网站的临时地址
```

### 配置好.env以后执行以下命令进行创建数据库
(提示directory already exists 可忽略)

```
php artisan admin:install
```

### 后台

描述 | 详情
--- |---
后台登录地址 | http://127.0.0.1:8000/admin/auth/login
账号 | admin
密码 | admin
菜单管理地址 | http://127.0.0.1:8000/admin/auth/menu

如有问题可添加我QQ：175023117
（备注：GitHub）
