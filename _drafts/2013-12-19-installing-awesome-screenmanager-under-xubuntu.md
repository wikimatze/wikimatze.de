---
layout: post
title: Installing Awesome Screenmanager Under Xubuntu
description: Getting something you really love when
---
*It is something through which you can replace Gnome or KDE on your system. Awesome gives you a way to tile your views on windows instead of floating free windows.*


You can install it very easily:


{% highlight bash %}

$ sudo apt-get install awesome awesome-extra

{% endhighlight %}


Next, you need to logout from your current session and need to select it from the login manager.
If you have problems with it in any case, you need to edit `/usr/share/xsessions/awesome.desktop` and set the `NoDisplay` option to `false`:


{% highlight bash %}

[Desktop Entry]
Encoding=UTF-8
Name=awesome
Comment=Highly configurable framework window manager
NoDisplay=false
TryExec=awesome
Exec=awesome
Type=Application

{% endhighlight %}

