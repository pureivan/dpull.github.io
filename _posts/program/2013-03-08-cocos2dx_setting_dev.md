---
layout: post
title: Cocos2dx开发环境设置及常用操作
categories: [general, cocos2dx]
tags: [cocos2dx]
---

以前一直开发端游，不熟悉ios和android的开发环境。

工作机选择：
ios和android特有功能的开发，选用mac作为开发机，因为它又能开发ios又能开发android。

纯游戏功能使用windows开发，毕竟大家都熟windows。

----------

## ios开发环境 ##

1. 使用AppStore安装XCode
1. 安装Svn：菜单选择XCode--Preferences--Downloads--Command Line
   Tools。（其他的ios模拟器也都下载吧！）

### XCode常用操作 ###
1. 在myapp-Info.plist 中 Bundle display name 中修改就可以修改 app安装后的显示名 
1. XCode4 设置命令行参数：左上角下拉列表 Scheme单击前面文字后选择Edit Scheme，选择Run 工程名

## Android开发环境 ##
1. 下载adt-bundle-mac 和 android-ndk （[下载](http://developer.android.com/sdk/index.html)）
1. 设置全局变量

打开终端

    {% highlight bash %}
    cd  
    vim .bash_profile  (i 进入编辑模式 ESC退出编辑模式 :wq退出并保存 :q!退出不保存)	
    {% endhighlight %}            

编辑文件
	
    {% highlight bash %}
    export CLICOLOR=1
    export LSCOLORS=gxfxaxdxcxegedabagacad
    alias ll="ls -l"
    alias la="ls -a"
    
    export ANDROID_SDK_ROOT=/Applications/ADT/sdk
    export ANDROID_NDK_ROOT=/Applications/android-ndk-r8d
    export NDK_ROOT=/Applications/android-ndk-r8d
    export PATH=$PATH:$ANDROID_SDK_ROOT
    export PATH=$PATH:$ANDROID_NDK_ROOT 
    {% endhighlight %}  

> **注意**：
> 网上的一些教程在.bash\_profile中设置COCOS2DX\_ROOT的路径，
> 其实这个路径在build\_native.sh中定义了。

## Svn注意事项 ##
> **注意**：
> 如果是在windows下使用TortoiseSVN提交cocos2dx的源代码,需要将 Global ignore pattern 中的 \*.a \*.py等去掉，否则一些文件无法Add。

## Eclipse常用操作 ##
1. 菜单File--Import--Android--Existing Android Code Into Workspace--项目工程proj.android文件夹 和 cocos2dx/platform中的android文件夹 
1. 连接手机并且解锁，然后选择 Debug As 或者 Run As

> 导入项目的时候可能会弹出错误提示：
> Errors occurred during the build. 
> Errors occurred during the build. 
> Errors running builder 'Android Pre Compiler' on project'项目名称' java.lang.NullPointerException.
> 
> 原因是使用SVN导致：svn在checkout的所有文件的文件夹下都会生成一个.svn文件用于管理版本库，
> 而新版的adt加强了对项目文件中的异常类型文件的识别，所以在遇到.svn时报了空指针的错误。

## 工程配置 ##
建议不要使用向导创建工程，直接用HelloCpp工程修改。
用文本文件打开ios和android的工程配置文件，修改文件中的相对路径。

## Android MK文件 ##
1. 示例工程中的LOCAL\_SRC\_FILES是全部列出来的，其实是没必要的。
 		
        {% highlight bash %}
        CLASS_FILES := $(wildcard $(LOCAL_PATH)/../../Classes/*.cpp)
        CLASS_FILES := $(CLASS_FILES:$(LOCAL_PATH)/%=%) 
        
        LOCAL_SRC_FILES := Client/main.cpp
        LOCAL_SRC_FILES += $(CLASS_FILES)  
        {% endhighlight %}       
        

1. 打开项目调试日志（可以看CCLOG的输出）

        {% highlight bash %}
        	LOCAL_CFLAGS += -DCOCOS2D_DEBUG=1
        {% endhighlight %}  

1. MK文件输出

        {% highlight bash %}
        $(error LOCAL_PATH)  #输出字符串LOCAL_PATH
        $(warning $(LOCAL_PATH)) #输出变量$(LOCAL_PATH)的值
        $(info LOCAL_PATH= $(LOCAL_PATH)) 
        {% endhighlight %}  
