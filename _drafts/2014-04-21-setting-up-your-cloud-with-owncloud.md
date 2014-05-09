---
title: Setting up your Cloud with owncloud
---

<a href="https://farm6.staticflickr.com/5113/13957019295_306e62d553_o_d.png" title="Setting up owncloud" class="fancybox"><img src="https://farm6.staticflickr.com/5113/13957019295_f2225c931c_z_d.jpg" class="big center" alt="Setting up owncloud"/></a>


[owncloud](http://owncloud.org/) is a service to manually access and manage files, contacts, and bookmarks across
different machines. The main difference to [dropbox](https://www.dropbox.com/) is that you can decide where the data is
(normally on your own webspace) and that you a file limit of 495 GB.


Why taking the hussle and make your data more save? Two things make me aware of this: First the [heartbleed](http://en.wikipedia.org/wiki/Heartbleed) issues the last weeks and secondly a tweet of my friend [@mybc](https://twitter.com/myabc):


<blockquote class="twitter-tweet" lang="en"><p>Downgrade. Delete.&#10;&#10;Done with <a href="https://twitter.com/Dropbox">@dropbox</a>. <a href="http://t.co/003vHshhk4">pic.twitter.com/003vHshhk4</a></p>&mdash; Alex Coles (@myabc) <a href="https://twitter.com/myabc/statuses/454899329439125505">April 12, 2014</a></blockquote>
<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>


The fact that I'm German I'm always concerned about data security.


(This article works with ownCloud 6.0 and ownCloud client 1.5)


## Installing On The Server

Since I'm owning my own webserver, I decided to use the [webinstaller](http://owncloud.org/install/):


{% highlight bash %}

$ ssh <username>@<yourwebserver>
$ cd <the-directory-where-you-want-to-have-owncloud-installed>
$ wget https://download.owncloud.com/download/community/setup-owncloud.php

{% endhighlight %}


Next, you need to open the `setup-owncloud.php` in your browser: [http://wikimatze.de/setup-owncloud.php](http://wikimatze.de/setup-owncloud.php).


Once you setup an admin user and a password you should visit [http://wikimatze.de/owncloud/](http://wikimatze.de/owncloud/).


## Possible Issues After Installation

{% highlight bash %}

Magic Quotes is enabled. ownCloud requires that it is disabled to work
properly.

Magic Quotes is a deprecated and mostly useless setting that should be
disabled. Please ask your server administrator to disable it in php.ini
or in your webserver config.

{% endhighlight %}


All you have to do is to mess around in your `php.ini` config files as mentioned above.


{% highlight bash %}

PHP modules have been installed, but they are still listed as missing?

Please ask your server administrator to restart the web server.

{% endhighlight %}


Please ask your provider to restart the webserver or do it on your own.


## Getting The Client

Since I'm using [xubuntu](http://xubuntu.org/news/14-04-release/), I'm running the following command:


{% highlight bash %}

$ sudo sh -c "echo 'deb http://download.opensuse.org/repositories/isv:/ownCloud:/desktop/xUbuntu_13.10/ /' >> /etc/apt/sources.list.d/owncloud-client.list"
$ sudo apt-get update
$ sudo apt-get install owncloud-client

{% endhighlight %}


Other installation instructions for windows or mac can be found on the [owncloud client installation page](http://owncloud.org/sync-clients/).


Next run the `owncloud` command on your terminal and you are ready to use it.


If something is wrong with the settings of your application, the easiest thing to do is to delete the settings:


{% highlight bash %}

$ rm -rf ~/.local/share/data/ownCloud

{% endhighlight %}


## Owncloud-Sync: no E-Tag received

After I installed everything correct and tried to sync other machines with my
cloud I got the message that no etag could be received. `etag` stands for entity tag and is an mechanism for HTTP web
cache validation. The etag is used as an identifier to specify a certain version of a resource found at a certain URL
which can be data, files, music and so on. They are used like [fingerprints](http://en.wikipedia.org/wiki/Fingerprint_%28computing%29) to quickly compare if two versions of a file are the same.


I checked my `.htaccess` file and found the following setting:


{% highlight bash %}

# ----------------------------------------------------------------------
# ETag removal
# ----------------------------------------------------------------------

# FileETag None is not enough for every server.
<IfModule mod_headers.c>
  Header unset ETag
</IfModule>

# Since we're sending far-future expires, we don't need ETags for
# static content.
#   developer.yahoo.com/performance/rules.html#etags
FileETag None

{% endhighlight %}


Bumm, you know what to do:


{% highlight bash %}

# ----------------------------------------------------------------------
# ETag removal
# ----------------------------------------------------------------------

FileETag All

{% endhighlight %}

