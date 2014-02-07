---
layout: post
title: Dumper重构总结
categories: [General]
tags: [windows]
---

## Dumper是什么？ ##
Dumper是用来捕获程序的崩溃信息，并将它们发送到指定的服务器，服务器的后台分析程序可以将程序崩溃时的堆栈信息重现出来。Dump还提供一些接口，调用即可创建转储文件并发送到服务器上进行分析。

Dumper目前应用于剑侠情缘网络版三，月影传说，九天神话等项目。

----------

## Dump能做什么不能做什么 ##

### Dumper能够捕获哪些宕机类型？ ###
1. 未处理的异常（堆栈溢出、空指针赋值、栈数组越界、程序抛出的异常） 
1. 进程非正常结束（在代码中调用exit、abort、ExitProcess、TerminateProcess）
1. 纯虚函数调用 
1. 无效参数（如printf(NULL)） 
1. 系统蓝屏（下次启动游戏时捕获）

### Dumper不能捕获哪些程序意外退出？ ###
1. 被其他进程结束进程（如任务管理器结束进程） 
1. 栈破坏（如memcpy(sz1,sz2, -100)，这个只能进入向量化异常处理，无法进入结构化异常处理）


## Dumper重构经验 ##
Dumper2.0参考了剑三Dumper(Dumper1.0)、Google的Break_Pad、easymule的宕机处理模块还有毒霸宕机处理的一些机制（这个没源代码）。

### 全局变量什么时候析构 ###
Dumper有个功能是当程序执行exit等进程退出函数的时候会走宕机处理流程
（这是其他异常处理模块没有的功能，因为我们的代码规范要求不允许随便在代码中写这种结束本进程的语句），当执行exit函数后，要注意此时Exe模块中的全局对象已经析构了（如果使用dll没问题，此时dll中的还没有析构），也就是所有全局的或者静态的变量都不能用了，Dumper采用了这种机制，如果发现Dumper的全局变量（Dumper采用了单件模式）在析构的前没有执行UnInit则走宕机流程。

### 某些时候只有一个线程可用 ###
在执行exit可以注册一个回调函数(由atexit添加)，
当执行这个回调的时候要注意此时只有一个线程可用，其他的线程都被挂起。
（_lockexit的注释
Makes sure only one thread is in the exit code at a time. 
If a thread is already in the exit code, it must be allowed to continue. 
All other threads must pend.）

在执行FreeLibrary的时候线程退出会停在ExitThread函数不返回（可以看Windows核心编程（中文版）第五版P529），
这时候如果等待线程退出就会卡住（在dll中用KThread要注意，如果其析构时调用KThread::Destroy可能会导致线程卡住）。

### 写单元测试 ###
代码怎样具有可测试性，怎样实现高内聚，低耦合的目标，
有一个简单办法来做到，就是自己写单元测试，Dumper重构写了70多个单元测试（当然并没有完全测试），
首先一个感觉是写单元测试不会影响工程的开发进度，而且会在局部代码重构或者整理的时候节省时间。
其次可以快速的把自己的代码用起来，尽早发现并解决问题，还可以尽早看到自己代码的执行，非常有乐趣。
最重要的是可以强迫自己去少用全局变量，或者依赖一大坨模块初始化的代码。
从这儿还有一个感悟，当开发或重构一个功能的时候，这个功能肯定可以做单元测试，
只是开发者会不会为单元测试作设计罢了。

### 少造轮子 ###
当需要一个功能的时候，尽可能的想如何用现有的代码解决问题。
如果不想让第三方的代码和工程代码耦合的太多，可以根据想要的功能，对第三方的代码进行一个简单封装，
如果第三方的模块不满足需求可以简单修改这个封装就可以。

Dumper中很多路径合并、获取文件名，获取文件所在文件夹之类的操作，
因为习惯了.NET Framework中的Path类，就根据其接口，
设计了几个常用的函数，但不想重复造轮子（关键是我没时间），
故而对用Boost库中的Filesystem库做简单封装，后来考虑到可能会给统一构建带来麻烦，
所以不想用Boost库了，还不如直接用MFC的CPath类，于是就拿CPath重新实现了Path类，
因为Path类有足够的单元测试，所以这个重构时间很短，
因为用Path类对Filesystem库做了简单的封装，这个重构对Dumper没有任何影响。

## 处理VS2005（VC8）无法捕获的Unhandled exceptions ##

很多软件通过设置自己的异常捕获函数，捕获未处理的异常，生成报告或者日志（例如生成mini-dump文件），
达到Release版本下追踪Bug的目的。但是到了VS2005（即VC8），
Microsoft对CRT（C运行时库）的一些与安全相关的代码做了些改动，典型的，例如增加了对缓冲溢出的检查。
新CRT版本在出现错误时强制把异常抛给默认的调试器（如果没有配置的话，默认是Dr.Watson），
而不再通知应用程序设置的异常捕获函数，这种行为主要在以下三种情况出现。

调用abort函数，并且设置了_CALL\_REPORTFAULT选项（这个选项在Release版本是默认设置的）。
启用了运行时安全检查选项，并且在软件运行时检查出安全性错误，例如出现缓存溢出。
（安全检查选项/GS 默认也是打开的）
遇到\_invalid\_parameter错误，而应用程序又没有主动调用\_set\_invalid\_parameter\_handler设置错误捕获函数。
所以结论是，使用VS2005（VC8）编译的程序，许多错误都不能在SetUnhandledExceptionFilter捕获到。
这是CRT相对于前面版本的一个比较大的改变，遗憾的是Microsoft却没有在相应的文档明确指出。

应用程序捕获不到那些异常，原因是因为新版本的CRT实现在异常处理中强制删除所有应用程序先前设置的捕获函数，
如下所示：**Make sure any filter already in place is deleted.** SetUnhandledExceptionFilter(NULL);UnhandledExceptionFilter(&ExceptionPointers);
解决方法是拦截CRT调用SetUnhandledExceptionFilter函数，使之无效。

## 参考资料 ##

["SetUnhandledExceptionFilter" and VC8](http://blog.kalmbachnet.de/?postid=75) 

[Unhandled exceptions in VC8 and above… for x86 and x64](http://blog.kalmbach-software.de/2008/04/02/unhandled-exceptions-in-vc8-and-above-for-x86-and-x64/)
