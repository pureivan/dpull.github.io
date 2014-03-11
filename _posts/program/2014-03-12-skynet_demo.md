---
layout: post
title: Skynet的demo
categories: [general]
tags: [c]
---

公司立了一个新项目，让我去做一下服务器的设计，趁机尝试一下skynet，我没有linux机器，以下尝试在mac上进行。

## 为何要使用skynet ##
以后再说~~


## 下载并安装Skynet ##

#### 下载lua5.2 和 skynet ####
#### 编译并安装lua ####
	
	make macosx
	sudo make install

#### 编译skynet ####
#### 设置gcc查找路径 （修改 .bash_profile） ####
	
	export CPATH=$CPATH:/usr/local/include
	export LIBRARY_PATH=$LIBRARY_PATH:/usr/local/lib	

#### 执行make ####

