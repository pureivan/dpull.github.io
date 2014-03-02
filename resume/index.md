---
layout: default
title: Resume
---

## 简介 ##

### 2014.01.20 ###
发现markdown比reStructuredText的学习成本低，部署起来也相对简单，风格调整起来也容易，更重要的是有github做无限流量的托管（GAE还是经常被墙的）。
决定将blog格式markdown改为迁移到github上。
每天搬运几篇，刚好做一个文章的梳理，预计2014.02.08将其迁移完成。

    pandoc -s -w rst --toc foo.rst -o foo.md

### 2013.10.24 ###
开始使用新域名[dpull.com]，空间选用[Google App Engine]。

> 几年了，一直想做点除了blog以外的东西，却又没有动手。
> 
>  重新定位了一下，写reStructuredText并非易事，网上看到的文章收藏到云笔记中就好了，这个blog记录一些自己的总结，或许能帮到大家。

    
[dpull.com]: http://www.dpull.com
[Google App Engine]: https://appengine.google.com

### 为什么要创建这个网站? ###
常遇到用过的类库或者函数再次使用的时候，却忘掉如何写的情况。或是，想找一段示例代码给别人参考的情况。却发现翻来覆去找的麻烦。
于是，整理写过或者见过的一些常用方法或文档，方便回顾和查询。
本来将这些写成文档放在网盘中，但发现搜索起来也不是很方便。
突发奇想，不如做成一个网站，查找的时候使用用：关键字 [site:dpull.com]，也许是一个不错的想法。

> 代码能借用就借用 
> *--Tom Duff, 贝尔实验室*


### 为什么选用了 Sphinx? ###

1. 是否方便修改分类和整理文档[WordPress]和[MediaWiki]采用的数据库存储，修改起来只能在网站上操作。[PmWiki]和[DokuWiki]采用的虽是文本，但[PmWiki]文档存在版本信息，[DokuWiki]是压缩起来单独文件，也不方便在本地调整。[Sphinx]是本地文本文档，修改起来很方便。

1. 是否方便备份[WordPress]和[MediaWiki]的数据库可以定时备份。
   [PmWiki]和[DokuWiki]需要定期去服务器备份文件。 [Sphinx]源格式是文本文件，可以放在 [Github]进行版本管理(欢迎有兴趣的朋友参与)。

1. 是否支持代码高亮 这个都有插件，没有比较价值。

1. 是否需要交互
   不需要，有问题直接发邮件(beingStudio@Gmail.com)就好了，没必要搞留言板之类的。

[WordPress]: http://wordpress.org/
[MediaWiki]: http://mediawiki.org/
[PmWiki]: http://pmwiki.org/
[DokuWiki]: http://dokuwiki.org/
[Sphinx]: http://sphinx.pocoo.org/
[Github]: https://github.com/dpull/dpull.github.io
[site:dpull.com]: http://www.google.com.hk/search?q=site%3Adpull.com

### 关于我 ###

浪迹在珠海的山东大汉。

	时间 				| 项目 		| 公司
	---  				| --- 		| ---
	*2013.04-* 			| 卖个萌仙 	| 心游科技
	*2011.06-2013.04* 	| 逍遥江湖 	| 心游科技
	*2007.05-2011.06* 	| 剑网三 	| 金山西山居