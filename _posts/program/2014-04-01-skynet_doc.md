---
layout: post
title: Skynet笔记
categories: [general]
tags: []
---

## 运维相关 ##
### 示例工程没有在后台运营，是要自己扩充守护进程功能么？还是写个程序使用popen ###
使用nohup

### 如何正确的关闭，以便通知各个模块进行存盘？ ###
参考[如何安全的退出 skynet](http://blog.codingnow.com/2013/08/exit_skynet.html) 

### 示例工程使用了stdin操控服务器，运维中呢？ ###
参考debug console 把 stdin 改成 listen 一个 port

## skynet 常用函数 ##
### address是什么？ ###
address 可以理解为handle的变量名，有几种格式：

- `:name`, name是handle的16进制，一般用于会重复存在的service，如:agent
- `.name`, name是本进程唯一的，集群内可以有多个。
- `name`， name是集群内唯一的，（后注册的会覆盖前面注册的）。

### `skynet.launch` ###
开启服务，如果要开启lua服务，可以写为`skynet.launch(snlua, lua模块`

### `skynet.newservice` ###
开启lua服务，并在服务退出或出错时，通知创建者。
即等同于：`skynet.launch(snlua, lua模块` + 退出回调功能。

### `skynet.uniqueservice` ###
创建唯一的skynet.newservice， 如果第一个参数为ture，即为创建集群内唯一的服务，
否则是本进程唯一的lua服务

### `skynet.call` ###
### `skynet.blockcall` ###
### `skynet.ret` ###
和`skynet.call`配合使用。
需要注意的是：

- 只能调用一次，调用两次会出现很难懂的错误日志；
- 和`skynet.call`不同的是，`skynet.ret`不支持自动打包；

云风说这两个都是为了兼容老项目而无法改进其封装的形式。

### `skynet.exit` ###
 
### `skynet.fork` ###

### `skynet.timeout` ###

### `mcgroup` ###