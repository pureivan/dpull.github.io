---
layout: post
title: `wchar_t`
categories: [General, 3rdparty]
tags: [Gtest, GMock]
---

`wchar_t`在gcc下如果不增加`-fshort-wchar`选项，`wchar_t`默认是32位

The C and C++ standard libraries include a number of facilities for
dealing with wide characters and strings composed of them. The wide
characters are defined using datatype `wchar_t`, which in the original
C90 standard was defined as "an integral type whose range of values can
represent distinct codes for all members of the largest extended
character set specified among the supported locales" (ISO 9899:1990§4.1.5)