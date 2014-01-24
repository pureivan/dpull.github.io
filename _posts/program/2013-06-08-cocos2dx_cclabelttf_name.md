---
layout: post
title: CCLabelTTF的字体名字
categories: [General, Cocos2dx]
tags: [Cocos2dx]
---

> 在地海世界，一个充满著岛屿、海洋、魔法的奇幻世界，万物皆有真名。而当知晓了某物／人之真名，便能成为其主人。 
> *--《地海巫师》（A Wizard of Earthsea）*

----------

使用Cocosbuilder的时候，有使用UserFonts的选项，可以选择ttf文件，但是选择后在模拟器上没有效果，调试后发现了一个注释：

	{% highlight C++ %}
	// On iOS custom fonts must be listed beforehand in the App info.plist (in order to be usable) and referenced only the by the font family name itself when
	// calling [UIFont fontWithName]. Therefore even if the developer adds 'SomeFont.ttf' or 'fonts/SomeFont.ttf' to the App .plist, the font must
	// be referenced as 'SomeFont' when calling [UIFont fontWithName]. Hence we strip out the folder path components and the extension here in order to get just
	// the font family name itself. This stripping step is required especially for references to user fonts stored in CCB files; CCB files appear to store
	// the '.ttf' extensions when referring to custom fonts.
	{% endhighlight %}
        
然后经过一番尝试和研究，简单记录一下CCLabelTTF关于字体方面的坑。

1. 将ttf字体的英文名修改为字体名，不知道ttf字体的英文名，则先执行下一步，因为设置字体的英文名为文件名是为了支持CocosBuilder。
1. XCode工程设置的Targets->Info属性页, 右键添加新行，选择Font provided by application，将字体路径添加到其子项中。
1. 如果不知道该字体的英文名，可在main.m中添加如下代码，输出程序的字体英文名

		{% highlight C++ %}
		#ifdef COCOS2D_DEBUG
		   NSArray* familyNames = [[NSArray alloc] initWithArray:[UIFont familyNames]];
		   NSArray* fontNames;
		
		   NSInteger indFamily, indFont;
		
		   for (indFamily=0; indFamily<[familyNames count]; ++indFamily)
		   {
		       NSLog(@"Family name: %@", [familyNames objectAtIndex:indFamily]);
		
		       fontNames = [[NSArray alloc] initWithArray: [UIFont fontNamesForFamilyName: [familyNames objectAtIndex:indFamily]]];        
		       for (indFont=0; indFont<[fontNames count]; ++indFont)
		       {
		           NSLog(@"    Font name: %@", [fontNames objectAtIndex:indFont]);
		       }
		   }
		#endif
		{% endhighlight %}