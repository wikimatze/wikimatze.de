---
title: Keeping your passwords save
description: Keeping your passwords save
categories: security
---

## Explain my system
- vim
- gpg key
- open the file, copy the name and passwords
- name the plugin I'm using


## Keepass

sudo apt-get install keepass2 mono-complete

Note: the mono-complete module is necessary for the browser integration and it will install a whole lot of mono libraries.


The tools looks a lot like kde.


<img src="https://farm2.staticflickr.com/1632/24836113205_e8d354f457_o_d.png" class="big center" alt="keepass2"/>
<div class="caption">"keepass2"</div>


In order to use the tool with the browser you need to install a tool which is called
[keepasshttp](https://github.com/pfn/keepasshttp "keepasshttp"). It creates a locale webserver on which Browser plugin (like [PasslFox](https://addons.mozilla.org/en-us/firefox/addon/passifox/ "PasslFox") for Firefox or [chromelPass](https://chrome.google.com/webstore/detail/chromeipass/ompiailgknfdndiefoaoiligalphfdae "chromelPass") for Chrome )can get password information after authentication


I tried to run the tool on my old netbook with the [i3 window manager](https://i3wm.org/ "i3 window manager") and it was
running very slow.


If you want to learn more abot the setup, you have to read <https://www.maketecheasier.com/integrate-keepass-with-browser-in-ubuntu/>


# Enable the keepasshttp plugin

Download keepasshttp and put the unzipped file in your homedirectory.
Next We need to copy the "KeePassHttp.plgx" file to the KeePass2 plugins folder.


```sh
sudo mkdir /usr/lib/keepass2/plugins
sudo mv ~/keepasshttp/KeePassHttp.plgx /usr/lib/keepass2/plugins/
```


To see if the plugin is working, start the tool and check if the option is available under


keepasshttp.png


https://www.maketecheasier.com/integrate-keepass-with-browser-in-ubuntu/


## Trying pass

https://sanctum.geek.nz/arabesque/linux-crypto-passwords/

I wrote on twitter, that I'm trying keepass and [@blueyed](https://twitter.com/blueyed?ref_src=twsrc%5Etfw "@blueyed") mentioned a tool called [pass](http://www.passwordstore.org/ "pass"):

<blockquote class="twitter-tweet" data-lang="en"><p lang="en" dir="ltr"><a
href="https://twitter.com/wikimatze">@wikimatze</a> you might like <a
href="https://t.co/bC8Ag9JNcG">https://t.co/bC8Ag9JNcG</a> !</p>&mdash; Daniel Hahler Ⓥ (@blueyed) <a
href="https://twitter.com/blueyed/status/695379565980454912">February 4, 2016</a></blockquote>
<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>


```sh
$ sudo apt-get install pass
Reading package lists... Done
Building dependency tree
Reading state information... Done
The following extra packages will be installed:
  pwgen
Suggested packages:
  libxml-simple-perl
The following NEW packages will be installed:
  pass pwgen
0 upgraded, 2 newly installed, 0 to remove and 149 not upgraded.
Need to get 29,0 kB of archives.
After this operation, 159 kB of additional disk space will be used.
Do you want to continue? [Y/n]
```

It's a very small tool


## Initialize a project with your public gpg key

You if create a new passwort file without your `gpkhj` key:

```sh
$ pass init bla@bla.de
mkdir: created directory ‘/home/wm/.password-store’
Password store initialized for bla@bla.de.
wm@wm ~ » pass insert Web/Disqus
mkdir: created directory ‘/home/wm/.password-store/Web’
Enter password for Web/Disqus:
Retype password for Web/Disqus:
gpg: bla@bla.de: skipped: No public key
gpg: [stdin]: encryption failed: No public key
```

As you can see, you are not using your public key. If you run


```sh
$ pass init
Usage: pass init [--reencrypt,-e] gpg-id
```


you can see that you can pass your `gpg-id` you can run the following command:


```sh
$ gpg --list-key
/home/wm/.gnupg/pubring.gpg
---------------------------
pub   2048D/D64C14E5 2012-12-08
uid                  Matthias Günther <matthias.guenther@wikimatze.de>
sub   2048g/289AFD13 2012-12-08
```


```sh
$ pass init D64C14E5
mkdir: created directory ‘/home/wm/.password-store’
Password store initialized for D64C14E5.
$ pass insert Web/Disqus
Enter password for Web/Disqus:
Retype password for Web/Disqus:
```


where D64C14E5 is my `gpg-id`


Yeah, that `No public key` message is gone. To see if the encryption has worked, just open the file:


```sh
$ cat .password-store/Web/Disqus.gpg
OyءOn.׆pw6aι`ԓ"o02b*Dr
J0@&ӯ2B#ޫ e/
ȑzzը2Uj1,"|!H9a.[
   yśC@+S9Nwk5pwd#וXu4tI8*{/SEe5FC{]gHŖ\BKk$IqUc(t^T˗%
   )}}]"
```


If you want to see the saved password, you can use `pass Web/Disqus`. But what if you want to save not only the
password? You can pass the `--multiline` or `-m` option:


```sh
$ pass insert -m Web/Multi
Enter contents of Web/Multi and press Ctrl+D when finished:

URL:
Username:
```


If you want now to edit the passwords:


```sh
$ pass edit Web/Multi
```

And you can edit the fields. Since the passwords are stored in in flat files, they can contain arbitray data. It's
a good way to have the following schema for the files:


```sh
<the_password>
login: <the_login>
url: <the_url>
```


You can even generate passwords with the following command:


```sh
sss generate Web/pass 40
An entry already exists for Web/pass. Overwrite it? [y/N] y
The generated password to Web/pass is:
4ejyh$CfTGBKUc?-RBtmA?uy>QOZ[7:d?b,P);hb
wm@wm ~/.password-store » 4ejyh$CfTGBKUc?-RBtmA?uy>QOZ[7:d?b,P);hb
```


Beware that after running this command that the whole content of the file will be overwritten.

## Use pass with Firefox

Just grab the latest version of [passff](https://github.com/jvenant/passff/releases "passff") and click on the
`passff.xpi` to install for your Firefox.


To see that it's setup, you see a black p in the extension window:


<img src="https://farm2.staticflickr.com/1637/24211626993_363a6f7a4d_o_d.png" class="big center" alt="passff in the extension window"/>
<div class="caption">"passff in the extension window"</div>


In order to use the plugin you have to setup preferences. Just click on the extension and select the `Preferences`
menue and click on the tab `Pass Script`:


<img src="https://farm2.staticflickr.com/1481/24211670023_9e019fd522_o_d.png" class="big center" alt="passff preferences"/>
<div class="caption">"passff preferences"</div>


In order to use this plugin, you have to press `<Ctrl-y>` it will open a fuzzy-search like window where you can get
the passwords you need:


<img src="https://farm2.staticflickr.com/1646/24720943662_d17f1a88f5_h_d.jpg" class="big center" alt="passff fuzzy search"/>
<div class="caption">"passff fuzzy search"</div>


## Use with qtpass

This is the graphical variant called [qtpass](https://qtpass.org/ "qtpass") which is a cross-platform GUI client. You can install it with the following way:


```sh
$ git clone https://github.com/IJHack/qtpass.git
$ cd qtpass && make && sude make install
```


First you need to make sure that you are using pass: Go to `Config >> Programs`


<img src="https://farm2.staticflickr.com/1694/24471458729_5eeb8f1d59_o_d.png" class="big center" alt="qtpass enable pass"/>
<div class="caption">"qtpass enable pass"</div>



When you click on `Users` you can the the used gpg keys:


<img src="https://farm2.staticflickr.com/1637/24812818536_c861b5eb3f_o_d.png" class="big center" alt="qtpass see used gpg keys"/>
<div class="caption">"qtpass see used gpg keys"</div>


When everything is setup you can see an overview of all your passwords and you can edit them:


<img src="https://farm2.staticflickr.com/1629/24212227093_744d9ffa22_o_d.png" class="big center" alt="qtpass password overview and edit passwords"/>
<div class="caption">"qtpass password overview and edit passwords"</div>

