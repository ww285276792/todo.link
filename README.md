## 基于项目的任务管理系统

todo.link是基于项目为基础的任务管理系统，使用laravel进行开发，秉承简洁、易用的准则。

## 线上地址

[www.todo.link](http://www.todo.link)
![avatar](http://www.todo.link/static/images/dash.png)

## 运行环境要求

- PHP 7.1+
- MySQL 5.6+

## 开发环境部署/安装

### 基础安装

#### 克隆源代码

克隆源代码到本地：

    > git clone git@github.com:ww285276792/todo.link.git

#### 安装扩展包依赖

	composer install

#### 生成配置文件

```
cp .env.example .env
```

#### 生成数据表

```shell
$ php artisan migrate
```

#### 初始化系统数据

```shell
$ php artisan module:seed Core
```

## License

GNU General Public License v3.0

## Todo

* 项目自定义角色权限管理
* 通知系统
