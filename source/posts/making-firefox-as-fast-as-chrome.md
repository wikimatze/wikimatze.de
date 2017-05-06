---
title: Making Firefox as Fast as Chrome
date: 2013-12-05
update: 2015-02-16
categories: howto browser firefox chrome
---

*Learn in this article how you can make Firefox as fast as Chrome again.*

I can remember that in the past some coworker says to me: "Why are you using Firefox and not the faster Chrome?" Hmm, I have always been using Firefox and never saw a reason why to use another browser. But I installed Chrome, it feels faster, and it consumes less CPU and memory of my system. The ecosystem and the look and feel is typical for a Google product: It works, is intuitive, and you know it works. It is not difficult to sync your bookmarks, settings, prefill forms, and even passwords => just everybody has nowadays a [gmail](https://mail.google.com) account and this is how all the magic works.


But being a German, it always felt wrong to send Google information about my web experience, which buttons I press, what plugins I use and so on. Since I'm a big Vim fan I heard of a plugin called [Vimium](https://chrome.google.com/webstore/detail/vimium/dbepggeogbaibhgnhhndojpepiihcmeb?hl=en) which enables keyboard shortcuts for navigating webpages without using the mouse, I installed it but was not really happy with it because it hasn't all the shortcuts I really want and it was difficult to create custom mappings, as well as handling bookmarks. Than during a [vimberlin meetup](http://vimberlin.de/) I saw [@andrewradev](https://twitter.com/andrewradev) using [Vimperator](http://www.vimperator.org/vimperator) and it was a blast: He was very fast and doing all the things I wanted but never could do with Vimium. That was a turning point to give Firefox a new chance. I spent one weekend to learn most of Vimperators shortcuts and create a *vimperatorrc*.


But than came the release of [Xubuntu 13.10](http://xubuntu.org/news/saucy-salamander-final/) and I installed a fresh new system ...


## Slow Firefox

After everything was installed and I was ready to use the new system. Starting Firefox was a nightmare, everything is slow. Thanks to my friend [@jcavena](https://twitter.com/jcavena) from Kansas City - he gave me starting point to solve this issue and not spending more hours on it:


<blockquote class="twitter-tweet"><p><a href="https://twitter.com/wikimatze">@wikimatze</a> how many plugins on Firefox vs chrome?</p>&mdash; JC (@jcavena) <a href="https://twitter.com/jcavena/statuses/392387457745821696">October 21, 2013</a></blockquote>
<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>


I didn't had any plugins, only the basic installation with the default settings. I spend the evening fiddling around with the settings, tried this and that, checked my Internet connection, but all what I did was senseless. Firefox was loading 2000 times slower than Chrome. But don't give up in such situations, just clear your mind and think about what you want solve.


<hr>
<div class="default alert">
  <h4>Want to read more articles like that?</h4>
  <link href="//cdn-images.mailchimp.com/embedcode/classic-10_7.css" rel="stylesheet" type="text/css">
  <style type="text/css">
    #mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; }
    /* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
       We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
  </style>
  <div id="mc_embed_signup">
  <form action="//wikimatze.us6.list-manage.com/subscribe/post?u=4010f8ce18503766e176536f1&amp;id=863c3ac16a" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
    <div id="mc_embed_signup_scroll">
    <div class="mc-field-group">
      <label for="mce-EMAIL">Email Address </label>
      <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
    </div>
    <div id="mce-responses" class="clear">
      <div class="response" id="mce-error-response" style="display:none"></div>
      <div class="response" id="mce-success-response" style="display:none"></div>
    </div>
      <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_4010f8ce18503766e176536f1_863c3ac16a" tabindex="-1" value=""></div>
      <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
    </div>
  </form>
  </div>
</div>
<hr>

## Fast Firefox

I stick around the Internet and found the `about:config` setting in Firefox (it's nearly the same when you call the `chrome://settings/` URL in Chrome but has more options). This is the place where you can change security, stability, and performance. That what I was searching for and this is the place you can't find in the normal graphical settings of Firefox. There you can see a list preferences names with either `string`, `integer`, or `boolean` values. Than I stumbled upon the `network.dns.disableIPv6` option. There is an error in IPv6-capable DNS servers where an IPv4 address is returned although an IPv6 was requested. Firefox can recover from this error but due to lack of performance. So my solution was to setting this option to `true`.


### Reduce Firefox Memory and Cache Usage

Next, create the [config.trim_on_minimize](http://kb.mozillazine.org/Config.trim_on_minimize "config.trim_on_minimize")
as a boolean value and set it's value to true. This will swap out memory when the program is minimized.


If you have enough memory, you can set the [browser.cache.disk.enable](http://kb.mozillazine.org/Browser.cache.disk.enable
"browser.cache.disk.enable") and the [browser.cache.memory.enable](http://kb.mozillazine.org/Browser.cache.memory.enable "browser.cache.memory.enable") value to false.


### Pipelining

Set the values of [network.http.pipelining](http://kb.mozillazine.org/Network.http.pipelining) and [network.http.proxy.pipelining](http://kb.mozillazine.org/Network.http.proxy.pipelining) to true. Next set the value [network.http.pipelining.maxrequests](http://kb.mozillazine.org/Network.http.pipelining.maxrequests) to 8. This in combination with the pipelining options, Firefox will send 8 requests to a page and this results in a faster load of the page.


Create the new value [nglayout.initialpaint.delay](http://kb.mozillazine.org/Nglayout.initialpaint.delay) with the value of 0. This will load a page initially but take longer till the whole page is rendered. Normally, Firefox renders web pages incrementally, it displays what's been received before the entire page has been downloaded.


### Fast Rendering

Create the new value [content.notify.interval](http://kb.mozillazine.org/Content.notify.interval) to 500000. This preference specifies the minimum amount of time to wait between reflows to 1/2 of a second. Lowering the interval will lower the perceived page loading time but increase the total loading time. To make use of the content.notify.interval setting you need to add the boolean setting [content.notify.ontime](http://kb.mozillazine.org/Content.notify.ontimer) to true. This means that pages are not reflowed at an interval any higher than that specified by the content.notify.interval.


<hr>
<div class="default alert">
  <h4>Want to read more articles like that?</h4>
  <link href="//cdn-images.mailchimp.com/embedcode/classic-10_7.css" rel="stylesheet" type="text/css">
  <style type="text/css">
    #mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; }
    /* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
       We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
  </style>
  <div id="mc_embed_signup">
  <form action="//wikimatze.us6.list-manage.com/subscribe/post?u=4010f8ce18503766e176536f1&amp;id=863c3ac16a" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
    <div id="mc_embed_signup_scroll">
    <div class="mc-field-group">
      <label for="mce-EMAIL">Email Address </label>
      <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
    </div>
    <div id="mce-responses" class="clear">
      <div class="response" id="mce-error-response" style="display:none"></div>
      <div class="response" id="mce-success-response" style="display:none"></div>
    </div>
      <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_4010f8ce18503766e176536f1_863c3ac16a" tabindex="-1" value=""></div>
      <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
    </div>
  </form>
  </div>
</div>
<hr>


### Frequency Mode

Create the new value [content.switch.threshold](http://kb.mozillazine.org/Content.switch.threshold) and set it to 250000. When a page is loaded, there is a high frequency and low frequency level. The high frequency mode is active when the user moves the mouse or uses the keyboard - so it allows higher UI responsiveness. On the other hand, the low frequency mode is on, when the user is reading the page. Raising the value will make the application more responsive at the expense of page load time. In order to make use of this option, you need to create the new value [content.interrupt.parsing](http://kb.mozillazine.org/Content.interrupt.parsing) and set it to false. Parsing a page will not be interrupted by user and the page is loaded faster. But that means, that the application is unresponsive until the parsing the site is complete.


### Session History Entries

Set the `browser.sessionhistory.max_entries` to 5 - you won't surf more than 5 of the websites we previously surfed before, and there is really no need to store more than that in the session.


### Increase Page Loading

Next, create the new value [nglayout.initialpaint.delay](http://kb.mozillazine.org/Nglayout.initialpaint.delay "nglayout.initialpaint.delay"), chose a new integer type and set the value to 0. This will speed up page loading by intentionally telling Firefox to avoid waiting during certain parts of page loading.


## Further Improvements

The following improvements are based on [Gheorghe Sarcov](http://www.gheorghesarcov.ga/ "Gheorghe Sarcov").


- Set `browser.display.show_image_placeholders` to false - this stops the display of placeholders while images are loading to speed up the page
- Set `browser.tabs.animate` to false - this disables all tab animation features (e.g.  when you click the ‘New Tab’ (+) button) to make the tab interface feel quicker.
- Set [network.prefetch-next](http://kb.mozillazine.org/Network.prefetch-next "network.prefetch-next") to true - this setting can automatically prefetch (load) the contents of pages linked to by the page you are viewing e.g. to load the homepage in the background, making it quicker for you to view next if you want to.


## Final Thoughts

There is not the perfect setup here for everyone. You can type in `about:cache?device=memory` and see your current number of entries, maximum storage size, storage in use and inactive storage. Chrome make better use of a modern multi-core CPU, as described under [howtogeek.com](http://www.howtogeek.com/165264/heres-why-firefox-is-still-years-behind-google-chrome/ "howtogeek.com") - where Firefox uses a single-process architecture.


<hr>
<div class="default alert">
  <h4>Want to read more articles like that?</h4>
  <link href="//cdn-images.mailchimp.com/embedcode/classic-10_7.css" rel="stylesheet" type="text/css">
  <style type="text/css">
    #mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; }
    /* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
       We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
  </style>
  <div id="mc_embed_signup">
  <form action="//wikimatze.us6.list-manage.com/subscribe/post?u=4010f8ce18503766e176536f1&amp;id=863c3ac16a" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
    <div id="mc_embed_signup_scroll">
    <div class="mc-field-group">
      <label for="mce-EMAIL">Email Address </label>
      <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
    </div>
    <div id="mce-responses" class="clear">
      <div class="response" id="mce-error-response" style="display:none"></div>
      <div class="response" id="mce-success-response" style="display:none"></div>
    </div>
      <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_4010f8ce18503766e176536f1_863c3ac16a" tabindex="-1" value=""></div>
      <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
    </div>
  </form>
  </div>
</div>
<hr>

## Further reading

- [Reduce Firefox Memory and Cache Usage](http://www.davidtan.org/tips-reduce-firefox-memory-cache-usage/ "Reduce Firefox Memory and Cache Usage")
- [Switching From Chrome: How to Make Firefox Feel Like Home](http://www.makeuseof.com/tag/switching-from-chrome-make-firefox-feel-like-home/ "Switching From Chrome: How to Make Firefox Feel Like Home")
- [Best Firefox Addons](http://www.makeuseof.com/tag/best-firefox-addons/ "Best Firefox Addons")

