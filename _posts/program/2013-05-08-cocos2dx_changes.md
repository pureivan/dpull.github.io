---
layout: post
title: 对cocos2dx功能完善或者bug修复
categories: [General, Cocos2dx]
tags: [Cocos2dx]
---

**不满足需求的地方**

1. 增加extensions 的ios proj
1. 修改触摸响应机制，简化为消息树。
1. CCB关键帧回调改为Action（和James Chen聊了一下，他建议改为ND，但我认为ND是不安全的）

----------

**bug**
1. 修复ccb动画管理器空指针访问（已合并）
1. cb锚点位置（已合并）
1. 解决了子节点初始隐藏然后显示，顺序错乱的bug
1. 解决了AssetsManager消息分发慢的问题
1. 修复了EditBox在ios平台上部分情况下不显示光标的问题。
1. 修复了CCScrollView::minContainerOffset没有考虑Container小于View的情况。(回滚了,CCTableView使用其做了一个功能.)

从bug第3条起，cocos2dx团队正准备要发布2.1.4版本并进行3.0版本的升级，
3.0命名规范改动很大，James Chen建议我把改动合到3.0分支，
但我这一段忙着出公司内测版本，先放放吧。
