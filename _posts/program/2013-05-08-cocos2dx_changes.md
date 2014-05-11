---
layout: post
title: 对cocos2dx功能完善或者bug修复
categories: [general, cocos2dx]
tags: [cocos2dx]
---

## 不满足需求的地方 ##
1. 增加extensions 的ios proj
1. 修改触摸响应机制，简化为消息树。
1. CCB关键帧回调改为Action（和James Chen聊了一下，他建议改为ND，但我认为ND是不安全的）

----------

## bug ##
1. 修复ccb动画管理器空指针访问（已合并）
1. cb锚点位置（已合并）
1. 解决了子节点初始隐藏然后显示，顺序错乱的bug
1. 解决了AssetsManager消息分发慢的问题
1. 修复了EditBox在ios平台上部分情况下不显示光标的问题。
1. 修复了CCScrollView::minContainerOffset没有考虑Container小于View的情况。(回滚了,CCTableView使用其做了一个功能.)

从bug第3条起，cocos2dx团队正准备要发布2.1.4版本并进行3.0版本的升级，
3.0命名规范改动很大，James Chen建议我把改动合到3.0分支，
但我这一段忙着出公司内测版本，先放放吧。

## 修复ios7下cocos2dx语音输入时闪退 ##
测试报了一个bug，CCEditBox使用语音输入闪退，原以为是CCEditBox的问题，调试后发现没那么简单，查看cocos2dx提交记录，原来3.0分支已经在25天前（2014.02.19）解决了，遗憾的是2014.03.15发布的v2.2.3并没有修复这个问题。

根据3.x分支的改动，将其移植到了2.x分支，[查看改动](https://github.com/cocos2d/cocos2d-x/pull/5861/files)

## windows版本CPU占用高 ##
今天博强说我们手游的windows端比端游消耗的cpu都高，用VS的性能分析看了一下其热点在于Sleep函数。

    {% highlight C %}
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
    {% endhighlight %}

----------

问题的原因就在于这个Sleep(0)， [MSDN中](http://msdn.microsoft.com/en-us/library/windows/desktop/ms686298(v=vs.85).aspx):

> A value of zero causes the thread to relinquish the remainder of its
> time slice to any other thread that is ready to run. If there are no
> other threads ready to run, the function returns immediately, and the
> thread continues execution.

### 解决方案： ###
修改为Sleep(10)就好了，以前剑三做过一个测试，dwMilliseconds小于10和10没有区别。





