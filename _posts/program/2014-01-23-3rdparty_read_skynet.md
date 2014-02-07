---
layout: post
title: 读Skynet
categories: [General, 3rdparty]
tags: [skynet]
---

今天晚上不想写代码，看一下skynet的代码。

##两个main函数 ##
**client-src** 

一个命令行工具，开了两个线程，
一个线程将stdin发送到服务端，
一个线程将收到的数据输出在stdout。

**skynet-src**

`skynet_env_init` 创建lua虚拟机

`skynet_start` 

`skynet_socket_init` kqueue网络库

## 吐槽 ##

- 配置文件的读取和设置挺绕的
- 和我们一样，用了大量的全局变量，不过用C的写法，可以隐藏这些，这个值得学习。
