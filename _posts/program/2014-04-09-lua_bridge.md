---
layout: post
title: lua桥接Objective-C和jni
categories: [general]
tags: []
---

从去年开始起就一直想做lua桥接Objective-C的事情，原因有二：

1. 不擅长Objective-C。
2. Objective-C的代码无法实现应用内更新。


## lua桥接Objective-C ##
最初想使用[LuaCocoa](http://playcontrol.net/opensource/LuaCocoa/other-luaobjective-c-bridge.html)，因为作者自吹自擂的厉害，但下载后发现xcode5编不过，只好用他嗤之以鼻但好多开发者都在用的wax了（如：愤怒的小鸟）。

### 调用OC函数 ###
ObjC与C混编+lua导出：
    
    {% highlight ObjC %}
    std::string XEnvironment::GetAppVersion()
    {
        NSDictionary* infoDict =[[NSBundle mainBundle] infoDictionary];
        NSString* versionNum =[infoDict objectForKey:@"CFBundleVersion"];
        return [versionNum UTF8String];
    }
    // ... 
    int LuaGetAppVersion(lua_State* L)
    {
        std::string strVersion = XEnvironment::GetAppVersion();
    
        lua_pushstring(L, strVersion.c_str());
        return 1;
    }
    {% endhighlight %}
 
ObjC与lua桥接：

    {% highlight lua %}
    function GetAppVersion()
        local dict = NSBundle:mainBundle():infoDictionary();
        return dict.CFBundleVersion;
    end
    {% endhighlight %}

### 设置OC委托 ###
ObjC与C混编+lua导出：
    
    {% highlight ObjC %}
    @interface XYCallbackHandler : NSObject<XYPlatformUIProtocol_PayAndRecharge>    
    @end

    @implementation XYCallbackHandler
    - (id)init
    {
        if (self = [super init]) {
            [_NotiCenter addObserver:self selector:@selector(XYInitNotify:) name:kXYCPInitDidFinishNotification object:nil];
            [_NotiCenter addObserver:self selector:@selector(XYLoginNotify:) name:kXYCPLoginNotification object:nil];
            [_NotiCenter addObserver:self selector:@selector(XYLogoutNotify:) name:kXYCPLogoutNotification object:nil];
            [_NotiCenter addObserver:self selector:@selector(XYAppUpdateNotify:) name:kXYCPAppVersionUpdateNotification object:nil];
            [_NotiCenter addObserver:self selector:@selector(XYBuyResultNofity:) name:kXYCPBuyResultNotification object:nil];
            [_NotiCenter addObserver:self selector:@selector(XYLeavePlatformNofity:) name:kXYCPLeavePlatformNotification object:nil];
        }
        
        return self;
    }
    // ... 
    {% endhighlight %}
 
ObjC与lua桥接：

    {% highlight lua %}
    waxClass{"XYCallbackHandler", NSObject, protocols={"XYPlatformUIProtocol_PayAndRecharge"}}
    
    function init(self)
        if (self.super:init())
        {
            NSNotificationCenter:defaultCenter():addObserver(self, XYInitNotify, kXYCPInitDidFinishNotification, nil);
            NSNotificationCenter:defaultCenter():addObserver(self, XYLoginNotify, kXYCPLoginNotification, nil);
            NSNotificationCenter:defaultCenter():addObserver(self, XYLogoutNotify, kXYCPLogoutNotification, nil);
            NSNotificationCenter:defaultCenter():addObserver(self, XYAppUpdateNotify, kXYCPAppVersionUpdateNotification, nil);
            NSNotificationCenter:defaultCenter():addObserver(self, XYBuyResultNofity, kXYCPBuyResultNotification, nil);
            NSNotificationCenter:defaultCenter():addObserver(self, XYLeavePlatformNofity, kXYCPLeavePlatformNotification, nil);
            
            return self;
        }
    
        return nil;  
    end
    {% endhighlight %}

## lua桥接jni ##
还没开始做，研究[AndroLua](https://github.com/mkottman/AndroLua)中。。。