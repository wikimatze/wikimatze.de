---
title: Using Irssi IRC client to connect to gitter rooms
description: Using Irssi IRC client to connect to gitter rooms
categories: irssi irc gitter padrino padrinobook
---

- open [irc.gitter.im](https://irc.gitter.im/ "irc.gitter.im") and you see the following screen
<a href="https://farm8.staticflickr.com/7453/16549276921_2ba98e48c1_o_d.png" title="Gitter login screen" class="fancybox"><img src="https://farm8.staticflickr.com/7453/16549276921_479169f4b9_c.jpg" class="big center" alt="Gitter login screen"/></a>
- [Login](https://gitter.im/login "Login") login and you should see your `PASS` and `NICKNAME`
- edit your `~/.irssi/config` file with the following content:


```sh
servers = (
  {
  address = "irc.gitter.im";
  chatnet = "Gitter";
  port = "6667";
  nick = "wikimatze";
  password = "<top-secret>";
  use_ssl = "yes";
  ssl_verify = "yes";
  autoconnect = "yes";
  },
  ...
)
```

- fire up `Irssi` and type in the following commands

```sh
/connect irc.gitter.im

Feb:48:18 [Gitter] -!- Irssi: Connection to irc.gitter.im established
Feb:48:19 [Gitter] -!- Welcome to the Gitter IRC network wikimatze!wikimatze@gitter.im
Feb:48:19 [Gitter] -!- Your host is gitter.im running version 1.3.0
Feb:48:19 [Gitter] -!- This server was created on Wed Feb 04 2015 15:07:44 GMT+0000 (UTC)
Feb:48:19 [Gitter] -!- 1.3.0 wo ntr
Feb:48:19 [Gitter] -!- - Message of the Day -
Feb:48:19 [Gitter] -!- Welcome to Gitter
Feb:48:19 [Gitter] -!- Please provide your password token using /PASS <token> and your GitHub username as your /NICK.
Feb:48:19 [Gitter] -!- If you don't have a password token, please visit https://irc.gitter.im.
Feb:48:19 [Gitter] -!- To join room, simply type /JOIN #owner/repo or /JOIN #orgname.
Feb:48:19 [Gitter] -!- This service is still very much in Beta. To report any issues, please visit http://support.gitter.im.
Feb:48:19 [Gitter] -!- Be nice, have fun.
Feb:48:19 [Gitter] -!- End of /MOTD command.
Feb:48:19 [Gitter] -!- Mode change [+w wikimatze] for user wikimatze
```

- next type `/join #wikimatze/PadrinoBook`:


```sh
>> The Guide To Master The Elegant Ruby Web Framework.
Feb:58:15 -!- wikimatze [wikimatze@gitter.im] has joined #wikimatze/PadrinoBook
Feb:58:15 -!- Topic for #wikimatze/PadrinoBook: The Guide To Master The Elegant Ruby Web Framework.
Feb:58:15 [Users #wikimatze/PadrinoBook]
Feb:58:15 [ alphabetum  ] [ dataduke] [ kuadrosx] [ pepe  ] [ rosstimson] [ viejOMs  ]
Feb:58:15 [ cpursley    ] [ gitter  ] [ nesquena] [ Rendez] [ rousisk   ] [ WaYdotNET]
Feb:58:15 [ CrowdHailer ] [ jdickey ] [ nicopaez] [ renich] [ schappim  ] [ wikimatze]
Feb:58:15 [ dariocravero] [ johan-- ] [ Ortuna  ] [ revans] [ ujifgc    ]
Feb:58:15 -!- Irssi: #wikimatze/PadrinoBook: Total of 23 nicks [0 ops, 0 halfops, 0 voices, 23 normal]
Feb:58:33 < wikimatze> This is an irssi gitter testjk
```


<a href="https://farm9.staticflickr.com/8627/16364950119_4b4cf5b50f_h.jpg" title="Irssi test" class="fancybox"><img src="https://farm9.staticflickr.com/8627/16364950119_42d0bb7f32_c.jpg" class="big center" alt="Irssi test"/></a>


## Automatically join the channels


Add a chatnet and channels:


```sh
chatnets = {
  ...
  Gitter = { type = "IRC"; };
}

channels = (
  { name = "#padrino"; chatnet = "freenode"; autojoin = "yes"; }
  { name = "#wikimatze/PadrinoBook"; chatnet = "Gitter"; autojoin = "yes"; }
  { name = "#padrino/padrino-framework"; chatnet = "Gitter"; autojoin = "yes"; }
);
```


## Further reading

- [IRC support](https://gitter.zendesk.com/hc/en-us/articles/201867132-Why-won-t-my-IRC-client-connect- "IRC support")
