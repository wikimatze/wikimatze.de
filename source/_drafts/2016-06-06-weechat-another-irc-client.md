---
title: Weechat - another IRC client
description: Learn how to install and configure Weechat
categories: tools irc weechat irssi
---

I was using [irssi](https://irssi.org/ "irssi") as my client to get started with
[IRC](https://en.wikipedia.org/wiki/Internet_Relay_Chat "IRC"). Then `lam0r` mentioned on the
[vimberlin gitter room](https://gitter.im/vimberlin/vimberlin.de "vimberlin gitter room") that he made the switch from Irssi to
[Weechat](https://weechat.org/ "Weechat").
At first I was sceptical because I had a working (mostly copied) setup for Irssi and why should I change my running system.

(This post was created with *Weechat 1.5* under *Ubuntu 14.04.3 LTS*)


# Installation

Via package:

```sh
$ sudo apt-get install weechat
```

Or build on your own:


```sh
$ git clone https://github.com/weechat/weechat.git && cd weechat
$ mkdir build && cd build && cmake .. && make && sudo make install
```

I would suggest the latest one so that you can see the nice output:


# First start and basic setup

Starting weechat:


```sh
06:18:26 |   ___       __         ______________        _____
06:18:26 |   __ |     / /___________  ____/__  /_______ __  /_
06:18:26 |   __ | /| / /_  _ \  _ \  /    __  __ \  __ `/  __/
06:18:26 |   __ |/ |/ / /  __/  __/ /___  _  / / / /_/ // /_
06:18:26 |   ____/|__/  \___/\___/\____/  /_/ /_/\__,_/ \__/
06:18:26 | WeeChat 1.5 [compiled on May  4 2016 06:16:40]
06:18:26 | - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
06:18:26 |
06:18:26 | Welcome to WeeChat!
06:18:26 |
06:18:26 | If you are discovering WeeChat, it is recommended to read at least the quickstart guide, and the user's guide if you have some time; they explain main WeeChat concepts.
06:18:26 | All WeeChat docs are available at: https://weechat.org/doc
06:18:26 |
06:18:26 | Moreover, there is inline help with /help on all commands and options (use Tab key to complete the name).
06:18:26 | The command /iset (script iset.pl) can help to customize WeeChat: /script install iset.pl
06:18:26 |
06:18:26 | You can add and connect to an IRC server with /server and /connect commands (see /help server).
06:18:26 |
06:18:26 | ---
06:18:26 |
06:18:26 | Bar "input" created
06:18:26 | Bar "title" created
06:18:26 | Bar "status" created
06:18:26 | Bar "nicklist" created
06:18:26 | Plugins loaded: alias, charset, exec, fifo, irc, javascript, logger, lua, perl, python, relay, ruby, script, tcl, trigger, xfer
```

First of all, you need to setup a server:


```sh
/server add freenode chat.freenode.net
```


After that you can configure your nickname, username, and realname:


```sh
/set irc.server.freenode.nicks "wikimatze"
/set irc.server.freenode.username "Matthias"
/set irc.server.freenode.realname "Matthias Günther"
```


Next you need to connect to freenode before you can join channels:


```sh
/connect freenode
/join #vimberlin
```


To connect automatically to freenode, please set the following option:


```sh
/set irc.server.freenode.autoconnect "on"
```


To autojoin channels, you can set the following option:


```sh
/set irc.server.freenode.autojoin "#vimberlin,#padrino"
```


# Enabling SSL

You should enable SSL if you don't want to submit your password as clear text:


```sh
/set irc.server.freenode.ssl "on"
/set irc.server.freenode.ssl_verify "on"
/set weechat.network.gnutls_ca_file "/etc/ssl/certs/ca-certificates.crt"
```

Next you need to change your address to use SSL port:


```sh
/set irc.server.freenode.addresses chat.freenode.net/6697
```


If something is wrong with your SSL setup, you will get messages like:


```sh
06:34:29 freenode =!= | irc: TLS handshake failed
06:34:29 freenode =!= | irc: error: An unexpected TLS packet was received.
```


When everything works, you can see the `Zi` in your username:

<img src="https://farm8.staticflickr.com/7184/26239337713_d48cee69d7_z_d.jpg" class="big center" alt="Weechat with SSL"/>
<div class="caption">Weechat with SSL</div>


# Authenticate with your nickname

When starting a new session you may get a message like the following:

```sh
freenode  -- | NickServ (NickServ@services.): This nickname is registered. Please choose a different nickname, or identify via /msg NickServ identify <password>.
```


In order to authenticate nickname:


```sh
/msg nickserv identify {your password}
freenode  -- | MSG(nickserv): identify ************
freenode  -- | NickServ (NickServ@services.): You are now identified for wikimatze.
```


You can automate nickname authentication:


```sh
/set irc.server.freenode.command "/msg nickserv identify {your password}"
```


Up to now, your password is saved in your `irc.conf` file as plain text:


```sh
freenode.command = "/msg nickserv identify {your password}"
```


## Secure your password with SASL

You can use the [secure](http://www.weechat.org/files/doc/stable/weechat_user.en.html#secured_data "secure") function to
encrypt your nickserv password.  You can set a passphrase to encrypt data in `sec.conf`:


```sh
/secure passphrase {this is my passphrase}.
```


Next time you start weechat, you'll get the following dialog:


```sh
Please enter your passphrase to decrypt the data secured by WeeChat:
(enter just one space to skip the passphrase, but this will DISABLE all secured data!)
(press ctrl-C to exit WeeChat now)

=>
```


If you skip the passphrase, you'll get:


```sh
weechat =!= | Passphrase is not set, unable to decrypt data "freenode"
weechat     | To recover your secured data, you can use /secure decrypt (see /help secure)
```


If you don't want to type in the passphrase on every weechat start, you can store the decrypt passphrase in a text file
[sec.crypt.passphrase_file](http://www.weechat.org/files/doc/stable/weechat_user.en.html#option_sec.crypt.passphrase_file "sec.crypt.passphrase_file")
Here is my setup (which takes the suggested default path):


```sh
/set sec.crypt.passphrase_file "~/.weechat_passphrase"
```


Now you can set the password for freenode server:


```sh
/secure set freenode **********
```


Instead of saving your password using the `nickserv` command authentication, you can also use SASL for this. SASL is a mechanism that identifies yourself
at IRC automatically even before you are visible to the network. It's optional but the nice thing is
that you can use your stored password in your settings and that gives you the advantage to share your settings without
exposing sensible data.


```sh
/set irc.server.freenode.sasl_username {username}
/set irc.server.freenode.sasl_password "${sec.data.freenode}"
/save
/reconnect
```


If you are still not convinced why using SSL and SASL, please read more under
[this post](https://pthree.org/2010/01/31/freenode-ssl-and-sasl-authentication-with-irssi/ "this post").


# Configuring


## Enable mouse

```sh
/mouse enable
```

## Don't display if someone is joining or leaving the channel:

You will always see if someone is joining or leaving a channel as shown in the following image:

<img src="https://farm8.staticflickr.com/7358/26776467951_f263eb4fc4_z_d.jpg" class="big center" alt="Weechat joining and leaving"/>
<div class="caption">Weechat joining and leaving</div>


To get rid of those, you can set the following  settings:


```sh
/set weechat.look.buffer_notify_default message
/set irc.look.smart_filter on
/filter add irc_smart * irc_smart_filter *
```


## Hide channel operations

<img src="https://farm8.staticflickr.com/7535/26809766896_14862c7657_z_d.jpg" class="big center" alt="Weechat joining information"/>
<div class="caption">"Weechat joining information"</div>


```sh
/filter add irc_join_names * irc_366,irc_332,irc_333,irc_329,irc_324 *
```


<img src="https://farm8.staticflickr.com/7694/26239335263_96dec55968_z_d.jpg" class="big center" alt="Weechat joining with less information"/>
<div class="caption">"Weechat joining with less information"</div>


## Look and feel

Set the timeformat:


```sh
/set weechat.look.buffer_time_format %H:%M
```


## Special symbols

Join and quit icons:


```sh
/set weechat.look.prefix_join "▬▬▶"
/set weechat.look.prefix_quit "◀▬▬"
```


Network, scroll, error, and information symbols:


```sh
/set weechat.look.item_buffer_filter "•"

/set weechat.look.bar_more_down "▼"
/set weechat.look.bar_more_left "◀"
/set weechat.look.bar_more_right "▶"
/set weechat.look.bar_more_up "▲"

/set weechat.look.prefix_quit ""
/set weechat.look.prefix_error "⚠ "
/set weechat.look.prefix_network "ℹ "
/set weechat.look.prefix_action "⚡"
/set weechat.look.item_buffer_filter "⚑"
```


## Hide merged buffer

Normally you see all open servers on the first bar, which can take a lot of space if you are connected to different
channels on different servers. You can get rid of this with the following setting:


```sh
/set buffers.look.hide_merged_buffers all
```


# Useful shortcuts

- `Alt-a`: triggers a `/input jump_smart` command, which jumps to the window with the latest activity. Since I'm using
  the [xfce-terminal](https://en.wikipedia.org/wiki/Terminal_(Xfce)) I had to disable the Menubar Access keys under the
  Terminal Preferences (Advanced tab)



# Seeing strange symbols

I couldn't type in German symbols like Äüß. The solution was to install the `libcursesw` package:


```sh
$ sudo apt-get install libncursesw5-dev
```


# Plugins

You can search after plugins with `/script search` - here you can type in words to fuzzy search after plugins.
Install extensions with the following command:


```sh
/script install <plugin-name>
```


Here is a list of plugins that I'm actually using:


- [autosort.py](https://weechat.org/scripts/source/autosort.py.html/) grouping default groups your channels by server.
  - useful if you are on several different servers
  - if you are only on freenode, it's enough to configure the `freenode.autojoin = "#vimberlin,#padrino"` setting in
    your `irc.conf`
- [iset.pl]( "iset") interactive way to change your configuration
  - `/isect` will start the plugin
  - press `<C-alt-space>` to change boolean values
  - [Video](https://www.youtube.com/watch?v=D6K1SOorqqw "Video")
- [buffers.pl](https://weechat.org/scripts/source/buffers.pl.html/) is a great way to get an overview of all the open channels or individual chats in the sidebar.
  - [Video](https://www.youtube.com/watch?v=Ot74td6rBrU"Video")
<img src="https://farm8.staticflickr.com/7784/26809767896_2b92906204_z_d.jpg" class="big center" alt="Weechat buffers"/>
<div class="caption">Weechat buffers</div>
  - You can change the postion of the buffer with `/set weechat.bar.buffers.position bottom`
- [go.py](https://weechat.org/scripts/source/go.py.html/ "go.py"): Quick jump to buffers using the /go command.


# Important files

When you switch to other machines and don't want to do all the config again, you have to preserve the following files:

- `alias.conf`:
- `buffers.conf`: config of the buffers.pl plugin (mainly for colors and channel display)
- `irc.conf`: server settings, your nickname
- `iset.conf`: Configuration for iset plugin
- `perl/`: Directory containing python plugins.
- `plugin.conf`: The configuration of your plugins
- `python/`: Directory containing python plugins.
- `script.conf`:
- `sec.conf`: You encrypted passwords
- `weechat.conf`: symbols, position of elements, colors, mappings, filters


# Links

- http://kmacphail.blogspot.de/2011/09/using-weechat-with-freenode-basics.html
- https://mikaela.info/english/2015/03/26/weechat-sasl-simply.html
- exhausting config: https://pascalpoitras.com/my-weechat-configuration/
- http://zanshin.net/2015/01/10/a-guide-for-setting-up-weechat-and-bitlbee/
- https://blog.hugo.sx/post/the-perfect-weechat-setup-2/
- http://fixato.org/guides/setting_up_weechat.html#compiling-weechat-from-scratch
- http://www.skaletz.me/weechat/notizen.html
