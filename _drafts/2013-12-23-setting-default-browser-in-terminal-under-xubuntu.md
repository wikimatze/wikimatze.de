---
title: Setting Default Browser in Terminal Under Xubuntu
description:
---
I was playing around with https://github.com/tyru/open-browser.vim


{% highlight plain %}

sudo update-alternatives --config x-www-browser
[sudo] password for wikimatze:
There are 2 choices for the alternative x-www-browser (providing /usr/bin/x-www-browser).

  Selection    Path                       Priority   Status
------------------------------------------------------------
* 0            /usr/bin/chromium-browser   40        auto mode
  1            /usr/bin/chromium-browser   40        manual mode
  2            /usr/bin/firefox            40        manual mode

Press enter to keep the current choice[*], or type selection number: 2
update-alternatives: using /usr/bin/firefox to provide /usr/bin/x-www-browser (x-www-browser) in manual mode

{% endhighlight %}


