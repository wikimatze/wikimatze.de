---
title: Migration RSS from FeedBurner to Feedio
date: 2016-04-21
description: I was wondering - FeedBurner was acquired around 2011 by Google. Google announced that the feedburner API is going to be no longer available.  My intent to use this tool was to track how many people sign up and how many people subscribed to it.
categories: rss
---

I was wondering: [FeedBurner](https://en.wikipedia.org/wiki/FeedBurner "FeedBurner") was acquired around 2011 by Google.
Google [announced](https://developers.google.com/feedburner/ "announced") that the feedburner API is going to be no
longer available.


My intent to use this tool was to track how many people sign up and how many people subscribed to it. It surprised my,
that [feed for my blog wikimatze](http://feeds.feedburner.com/guenther "feed for my blog wikimatze") was still working.
Time to look for alternatives and see how technology has changed.


## RSS in the wild

Pages like [blog.crazyegg.com](http://blog.crazyegg.com/2012/10/12/alternatives-to-feedburner/ "blog.crazyegg.com")
mentioned 13 alternatives - but for most of them you have to pay money.

There are [many wordpress plugins out there](https://premium.wpmudev.org/blog/5-best-feedburner-alternatives-for-your-wordpress-blog/ "many wordpress plugins out there") but since I'm using [jekyll](http://jekyllrb.com/ "jekyll") to build my site as a static HTML page, that is not even an alternative.

The site [feedburner-alternatives.com](http://www.feedburner-alternatives.com/ "feedburner-alternatives.com") mentions tools like
[feedblitz](http://www.feedblitz.com/ "feedblitz") and [specificfeeds.com](http://www.feedburner-alternatives.com/img/Picture1.png "specificfeeds.com"). I tried feedblitz and created an [RSS-feed of wikimatze.de](https://www.specificfeeds.com/wikimatze "RSS-feed of wikimatze.de") but wasn't satisfied with the statistics and handling.


Than I stumbled across [Danny Browns'](http://dannybrown.me "Danny Browns'") post about
[if you blog really needs RSS](http://dannybrown.me/2015/03/12/does-your-blog-really-need-to-provide-an-rss-feed-anymore/ "if you blog really needs RSS"). The author may be right that E-Mail subscribers are more open to change and that you can inform then more easier with new information (like changing the URL of your RSS feed).


I still like using RSS feed and using [Tiny Tiny RSS](https://tt-rss.org/gitlab/fox/tt-rss/wikis/home "Tiny Tiny RSS")
to manage my feeds - there is even an app from which I can read new on the road. But I have also gathered positive
experience with building up a [mailing List for my PadrinoBook](http://padrinobook.com/ "Mailing List for my PadrinoBook") with [mailchimp.com](http://mailchimp.com/ "mailchimp.com").


Why not taking both? This is what Danny Brown talks about in his post [how he changed his mind about RSS](Changed My Mind About RSS "Danny Browns post how he changed his mind about RSS"). He mentioned a tool called [feedio.co](http://www.feedio.co "feedio.co") which should take care of this issues. I will show you some features of the tool in the last section of this article with some images.


## Get your feedburner users

I made the error to link my [RSS feed direct to feedburner](http://feeds.feedburner.com/guenther "RSS feed direct to feedburner"). That means, that first all the traffic goes to the external service and second when I change the URL, my readers will not be informed about this.


First of all login to your feedburner account and follow the tab with `Analyze`:


<img src="https://farm2.staticflickr.com/1573/24503236302_fe7c30ee44_z_d.jpg" class="big center" alt="Get an overview of your feedburner RSS feed"/>
<div class="caption">"Get an overview of your feedburner RSS feed"</div>


Next step would be to get an E-Mail to all of your subscribers you need to click on `FeedBurner Email Subscriptions` :

<img src="https://farm2.staticflickr.com/1645/23983433284_5168160522_z_d.jpg" class="big center" alt="Manager your feedburner RSS subscribers"/>
<div class="caption">"Manager your feedburner RSS subscribers"</div>


The good part is: I had no subscribers so I don't need to contact anyone. The bad part: I will probably lose my 19
subscribers of my old feed. Before I go on, I'll shortly explain the ways you
can use to link your RSS feed.


## Ways to link your RSS feed

You have several possibilities to link your RSS-feed. The classical way is to put a link in the `head` and/or link it in
the navigation:


```html
<html class="no-js" lang="en">
  <head>
    ...
    <link href="/atom.xml" rel="alternate" type="application/rss+xml" title="RSS feed of Matthias Günther">
  </head>
  <body>
	<nav>
		<ul class="dropdown menu large-8 medium-8 columns" data-dropdown-menu>
			...
			<li><a href="/atom.xml" target="_blank"><i class="fa fa-rss"></i></a></li>
			...
		</ul>
	</nav>
	...
  </body>
  ...
</html>
```


<img src="https://farm2.staticflickr.com/1682/24593272036_10a605f80e_z_d.jpg" class="big center" alt="Make a RSS link in the head and in the navigation"/>
<div class="caption">"Make a RSS link in the head and in the navigation"</div>


Browser like Firefox will then detect, that there is an RSS feed and will make highlight the RSS icon:


There is even a [RSS icon plugin for the address bar](https://addons.mozilla.org/en-US/firefox/addon/rss-feed-icon-in-navbar "RSS icon plugin for the address bar"):


<img src="https://farm2.staticflickr.com/1530/24251677829_fb80fefc9d_o_d.png" class="big center" alt="Firefox plugin to detect RSS feeds in the address bar"/>
<div class="caption">"Firefox plugin to detect RSS feeds in the address bar"</div>


## Create a apache redirect for your atom

Let's say, that people should always signup under <http://yourdomain/atom.xml> and you need to track those things. A
possible way would be to create a `htaccess` redirect and point the user to the location you like:


```sh
RewriteEngine On
RewriteCond %{HTTP_USER_AGENT} !feedio [NC]
RewriteRule ^atom.xml/?$ http://www.feedio.co/@wikimatze/feed [R=302,L]
RewriteEngine Off
```


Decide if you want tracking or be lord over your domain. A mix between the two is also possible, let's say you offer
visible RSS on your site which points to some third-party tool (like feedburner) and keep the `<link href="/atom.xml" ...` on your site.


But you need to be careful with your redirect: Ask the service you want to use, if a redirect is okay - not that their
crawlers have problems with the loop.

## Feedio

It's very easy to setup. All you have to do is to sign up with your twitter account. Your picture and bio will be
taken automatically and you have to submit a link of your feed.


If there are some issues with your feed, one of their founders will help you setup your account. I had some issues
with my feed, as [Justin Butlion](https://twitter.com/justin_butlion "Justin Butlion") contacted my directly via mail:


    Hey Matthias,

    I was able to find and access your feed at http://wikimatze.de/atom.xml. There doesn't seem to be a redirect on this
    feed which is ideal for us. The issue is that this actual feed has issues which you can see listed here -
    http://www.rssboard.org/rss-validator/check.cgi?url=http%3A%2F%2Fwikimatze.de%2Fatom.xml. Only after the feed is valid
    will we be able to crawl it.


I checked my RSS feed under [rssboard.org](http://www.rssboard.org/rss-validator "rssboard.org") and could see that my
feed was not ready. This was also a good point to watch what formats are possible. You can get a nice overview
[atomenabled.org](http://www.atomenabled.org/developers/syndication "atomenabled.org").


Feedio offers a very clean and easy subscription mechanism for your updates: It offers RSS, [feedly](http://feedly.com "feedly") or email:


<img src="https://farm2.staticflickr.com/1600/24523636912_f53ed4e82e_b_d.jpg" class="big center" alt="Nice sign up interface for email and RSS"/>
<div class="caption">"Nice sign up interface for email and RSS"</div>


The dashboard gives you a high-level overview of your subscribers and how many people you reach with your
entries:


<img src="https://farm2.staticflickr.com/1566/24523637342_e4437bc933_h_d.jpg" class="big center" alt="Nice analytics and dashboard"/>
<div class="caption">"Nice analytics and dashboard"</div>


You can use a more detailed view of your articles to and see social share buttons for them:


<img src="https://farm2.staticflickr.com/1451/24523637662_60a450c505_h_d.jpg" class="big center" alt="Detail view of your articles and social share buttons"/>
<div class="caption">"Detail view of your articles and social share buttons"</div>


Not so many options are editable on the profile page:


<img src="https://farm2.staticflickr.com/1602/24336449850_358b4f330f_b_d.jpg" class="big center" alt="Profile page"/>
<div class="caption">"Profile page"</div>


If you want become my first RSS subscribe, you can do that [here](http://www.feedio.co/@wikimatze "RSS subscribe wikimatze").


Feedio is still in development and not everything is working - but they are planning to release new features:


- customizable email templates - I'm still using [mailchimp.com](http://mailchimp.com/ "mailchimp.com") but maybe I'll
switch
- google analytics integration - I'm not using it but why not
- Advanced reporting
- multiple users
- ...


They have many things on their agenda - let's see where the voyage will go.

