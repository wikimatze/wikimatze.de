---
layout: post
title: Xubuntu Install Error No DEFAULT or UI Configuration Directive Found
description: Something breaks everytime in the Linux world
---

After getting downloading the ISO of [xubuntu 13.04](http://xubuntu.org/news/13-04-release/) I got created an live
usbstick and got the following error

    Xubuntu Install Error No DEFAULT or UI Configuration Directive Found


Something like this never happened to me before. I created the Startup Disk as usually with the
[Startup Disk Creator](https://apps.ubuntu.com/cat/applications/usb-creator-gtk/) and that was it was causing the
problem. Instead of using the [UNetbootin script](http://unetbootin.sourceforge.net/). In order to use this script you
have to download it, make it executable, and run the script:


{% highlight bash %}

$ curl http://downloads.sourceforge.net/project/unetbootin/UNetbootin/583/unetbootin-linux-583
$ chmod +x
$ ./unetbootin-linux-583

{% endhighlight %}


But it was not detecting my USB-Stick - I formatted it with vfat to be more Windows compatible. It is recommended to
format your USB-Stick with FAT32. You can do this with the [mkdosfs](http://en.wikipedia.org/wiki/Mkdosfs) package:


{% highlight bash %}

$ sudo apt-get install mkdosfs
$ sudo umount /dev/sdb1 # or wherever your USB-Stick is mounted
$ sudo mkdosfs -F 32 -I /dev/sdb1

{% endhighlight %}
{: lang="bash" }


And it just works!


## Conclusion

The nice thing about UNetbootin is, that it offers you a dialog of all the different linux versions you want to use.


## Further reading

