---
layout: post
title: lua和luajit的不同之处
categories: [general]
tags: [lua]
---
前几天想把游戏使用的lua换成luajit，主要基于两个想法：

1. 可以提高性能
1. 可以使用ffi加快开发速度

测试中发现了lua和luajit的一些不同之处。

版本号：

`lua` `5.1.4`

`luajit` `2.0.1`

----------

## {...} 不同 ##

    {% highlight Lua %}
    function test(...)
    	local tb  = {...}
    	print(#tb, unpack(tb))
    end
    test("as", nil, 1,2)
    {% endhighlight %}

lua 输出 

	4	as	nil	1	2
	
luajit输出

	2	as

