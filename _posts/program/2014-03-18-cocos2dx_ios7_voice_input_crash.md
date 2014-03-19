---
layout: post
title: cocos2dx语音输入时闪退（ios7）
categories: [general]
tags: [cococ2dx]
---

测试报了一个bug，CCEditBox使用语音输入闪退，原以为是CCEditBox的问题，调试后发现没那么简单，查看cocos2dx提交记录，原来3.0分支已经在25天前（2014.02.19）解决了，遗憾的是2014.03.15发布的v2.2.3并没有修复这个问题。

根据3.x分支的改动，将其移植到了2.x分支，[查看改动](https://github.com/cocos2d/cocos2d-x/pull/5861/files)







