---
layout: post
title: Windows Sleep 函数
categories: [general]
tags: [windows]
---

## 问题： ##
今天博强说我们手游的windows端比端游消耗的cpu都高，用vs的性能分析看了一下其热点在于Sleep函数。

    // file: cocos2dx/platform/win32/CCApplication.cpp
    if (nNow.QuadPart - nLast.QuadPart > m_nAnimationInterval.QuadPart)
    {
        nLast.QuadPart = nNow.QuadPart;
        CCDirector::sharedDirector()->mainLoop();
    }
    else
    {
        Sleep(0); 
    }

----------

问题的原因就在于这个Sleep(0)， [MSDN中](http://msdn.microsoft.com/en-us/library/windows/desktop/ms686298(v=vs.85).aspx):

A value of zero causes the thread to relinquish the remainder of its
time slice to any other thread that is ready to run. If there are no
other threads ready to run, the function returns immediately, and the
thread continues execution.

## 解决方案： ##
修改为Sleep(10)就好了，以前剑三做过一个测试，dwMilliseconds小于10和10没有区别。

