---
layout: post
title: X工作室代码规范
categories: [general]
tags: []
---

## C++ ##
1. 参考心游/金山代码规范。
1. 前缀改为X，即类前缀`XExample`，宏前缀`X_FAILED_JUMP`

## C# 和 lua##
参考《.net设计规范：约定、惯用法与模式》

1. 作用域小于或者等于当前函数的变量使用camelCasing规则命名
1. 作用域大于当前函数的变量使用PascalCasing规则命名
1. 不使用X前缀

### C#示例 ###
    标识符  				| 类型				| 例子
    ---  			 	| --- 				| ---
    类名    	            | PascalCasing     	| class **Example**
    成员变量  		    | PascalCasing     	| int **m_Level**
    属性           	    | PascalCasing     	| int **Level**
    函数           	    | PascalCasing     	| void **SetLevel** (int level)
    函数参数         	| camelCasing      	| void SetLevel(int **level**)

### lua示例 ###
    标识符  				| 类型				| 例子
    ---  			 	| --- 				| ---
    文件内全局变量    	| PascalCasing     	| **Lib** = Import("scripts/lib.lua"); 
    Panel的附加参数  		| PascalCasing     	| panel. **Parameter** = {**SelectIndex** = 5, };
    函数名           	| PascalCasing     	| function **Register** (panel) ... end
    函数参数         	| camelCasing      	| function OnTouchEvent(**panel**, **control**, **controlEvent**) ... end
    Tab表中列名      	| PascalCasing     	| setting. **CardTemplateId**
