---
layout: post
title: Skynet的demo
categories: [general]
tags: [c]
---

公司立了一个新项目，让我去做一下服务器的设计，趁机尝试一下skynet。

## 为何要尝试skynet ##
主要是解决目前一些思路上的瓶颈和学习一下他人的做法，以后展开说，待续~~


## 目标 ##
我和[dinghim](https://github.com/dinghim)在3.12-3.15每晚7点~9点， 使用现有手游的客户端和服务端的业务逻辑，实现创建角色，登陆游戏，有简单游戏功能（移植不涉及奖励配置表的探索功能）。

## 下载并安装Skynet ##
git clone https://github.com/dpull/skynet_demo.git
./build
./run
另一个控制台
./test

## TODO List ##
1. ~~将LuaPacker移植（acai）~~
1. ~~将与客户端通信的分包格式移植（acai）~~
1. ~~尝试redis（dinghim）~~
1. 完成客户端登陆的基本逻辑（dinghim）
1. 尝试单机玩法的模块（dinghim）
1. 服务模块的主循环，或定时回掉（acai）
1. 尝试联机玩法的服务（acai）
1. 玩家与玩家间通信
