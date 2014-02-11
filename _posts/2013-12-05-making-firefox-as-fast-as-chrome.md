---
layout: post
title: Making Firefox as Fast as Chrome
description: Make the beloved Firefox browser as fast as Chrome
---
*Learn in this article how you can make Firefox as fast as Chrome again.*

I can remember clearly that in the past some coworker says to me: "Why are you using Firefox and not the faster Chrome?" Hmm, I have always been using Firefox and never saw a reason why to use another browser. But I installed Chrome, it feels faster, and it consumes less CPU and memory of my system. The ecosystem and the look and feel is typical for a Google product: It just works, is intuitive, and you know it just works. It is very easy to sync your bookmarks, settings, prefill forms, and even passwords => just everybody has nowadays a [gmail](https://mail.google.com) account and this is how all the magic works.


But being a German, it always felt wrong to send Google information about my web experience, which buttons I press, what plugins I use and so on. Since I'm a big Vim fan I heard of a plugin called [Vimium](https://chrome.google.com/webstore/detail/vimium/dbepggeogbaibhgnhhndojpepiihcmeb?hl=en) which enables keyboard shortcuts for navigating webpages without using the mouse, I installed it but was not really happy with it because it hasn't all the shortcuts I really want and it was difficult to create custom mappings, as well as handling bookmarks. Than during a [vimberlin](http://vimberlin.de/) I saw [@andrewradev](https://twitter.com/andrewradev) using [Vimperator](http://www.vimperator.org/vimperator) and it was a blast: He was so fast and doing all the things I wanted but never could do with Vimium. That was a turning point to give Firefox a new chance. So I spent one weekend to learn most of Vimperators shortcuts and create a *vimperatorrc*.


But than came the release of [Xubuntu 13.10](http://xubuntu.org/news/saucy-salamander-final/) and I installed a fresh new system ...


## Firefox can be slow

After everything was installed and I was ready to use the new system. Starting Firefox was a nightmare, everything is so slow.  Thanks to my friend [@jcavena](https://twitter.com/jcavena) from Kansas City - he gave me starting point to solve this issue and not spending more hours on it:


<blockquote class="twitter-tweet"><p><a href="https://twitter.com/wikimatze">@wikimatze</a> how many plugins on Firefox vs chrome?</p>&mdash; JC (@jcavena) <a href="https://twitter.com/jcavena/statuses/392387457745821696">October 21, 2013</a></blockquote>
<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>


I didn't had any plugins, only the basic installation with the default settings. I spend the evening fiddling around with the settings, tried this and that, checked my Internet connection, but all what I did was senseless. Firefox was loading 2000 times slower than Chrome. But don't give up in such situations, just clear your mind and think about what you want solve.


## Making Firefox fast

I stick around the Internet and found the `about:config` setting in Firefox (it's nearly the same when you call the `chrome://settings/` URL in Chrome but has more options). This is the place where you can change security, stability, and performance. That what I was searching for and this is the place you can't find in the normal graphical settings of Firefox. There you can see a list preferences names with either `string`, `integer`, or `boolean` values. Than I stumbled upon the `network.dns.disableIPv6` option. There is an error in IPv6-capable DNS servers where an IPv4 address is returned although an IPv6 was requested. Firefox can recover from this error but due to lack of performance. So my solution was to setting this option to `true`.


## Further pimping steps

Set the values of [network.http.pipelining](http://kb.mozillazine.org/Network.http.pipelining) and
[network.http.proxy.pipelining](http://kb.mozillazine.org/Network.http.proxy.pipelining) to true.
Next set the value [network.http.pipelining.maxrequests](http://kb.mozillazine.org/Network.http.pipelining.maxrequests) to 8. This in combination with the pipelining options, Firefox will send 8 requests to a page and this results in a faster load of the page.


Create the new value [nglayout.initialpaint.delay](http://kb.mozillazine.org/Nglayout.initialpaint.delay) with the value of 0. This will load a page initially but take longer
till the whole page is rendered. Normally, Firefox renders web pages incrementally, so it displays what's been received before the entire page has been downloaded.


Next, create the new value [content.notify.interval](http://kb.mozillazine.org/Content.notify.interval) to 500000. This preference specifies the minimum amount of time to wait between reflows to 1/2 of a second. Lowering the interval will lower the perceived page loading time but increase the total loading time. To make use of the content.notify.interval setting you need to add the boolean setting [content.notify.ontime](http://kb.mozillazine.org/Content.notify.ontimer) to true. This means that pages are not reflowed at an interval any higher than that specified by the content.notify.interval.


Next, create the new value [content.switch.threshold](http://kb.mozillazine.org/Content.switch.threshold) and set it to 250000. When a page is loaded, there is a high frequency and low frequency level. The high frequency mode is active when the user moves the mouse or uses the keyboard - so it allows higher UI responsiveness. On the other hand, the low frequency mode is on, when the user is just reading the page. So raising the value will make the application more responsive at the expense of page load time.
In order to make use of this option, you need to create the new value [content.interrupt.parsing](http://kb.mozillazine.org/Content.interrupt.parsing) and set it to false. So parsing a page will not be interrupted by user and the page is loaded faster. But that means, that the application is unresponsive until the parsing the site is complete.

