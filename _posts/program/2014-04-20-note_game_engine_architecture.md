---
layout: post
title: 读书笔记《游戏引擎架构》
categories: [general, note]
tags: []
---

该书的第一遍读完了，跳过了4、10、11、12章，这几章的内容工作中很少用到，
代码马马虎虎能看懂，但写不出。

先把能看懂并认可的观点记录下来，剩下的几章先打打基础，半年后再看，
这很像我大学中看《C专家编程》，大一刚学C语言，去图书馆发现这本书，发现只能看懂几章，
大二学了数据结构，再看多看懂了几章，大三学了操作系统，又多看懂了几章。

## 内存泄漏 ##

> 避免因指针问题造成内存泄漏的方法之一，是养成良好的编程习惯。

金山代码规范中的固定写法，能有效地确保不出现内存泄漏。

## 字节对齐 ##
> 若读/写非对齐的数据，一些微处理器不做处理，读出来或写进去的可能只是随机数；
> 还有一些微处理器，会使程序崩溃。

2012年底和纯峰做移动项目预研的时候，就遇到了字节对齐问题，
当时我们网络协议处理中有 `double f = *(double*)pby;` 会在android上闪退。

## 处理开发者错误 ##
> 最佳方式是寻找这两个极端之间的平衡点。当发生开发者错误，笔者希望让错误变得明显，
> 并使团队可于问题存在的情况下继续工作。

2013年上半年，我们使用cocos2dx和cocosbuilder研发手游项目，cocos2dx的ccb解析器，
一旦出现缺图等问题，就会宕掉，但我们做第一次界面调整的时候换了好多图，导致团队卡住的问题。

## 断言应当只用来不住严重错误 ##
《编程精粹》中提到：断言用来检查不可能出现的问题。

## 优化动态内存分配的原因 ##
> 维持最低限度的堆分配，并且永不在紧凑循环中使用堆分配。
对于多进程单线程的服务器架构，测试结果是影响不大。
对于单进程多线程的服务器架构，大都采用jemalloc。

## Unicode ##
作者推荐了[The Absolute Minimum Every Software Developer Absolutely, Positively Must Know About Unicode and Character Sets (No Excuses!)](http://www.joelonsoftware.com/articles/Unicode.html)
中文版 [每個軟體開發者都絕對一定要會的Unicode及字元集必備知識(沒有藉口！)](http://local.joelonsoftware.com/wiki/The_Joel_on_Software_Translation_Project:%E8%90%AC%E5%9C%8B%E7%A2%BC)