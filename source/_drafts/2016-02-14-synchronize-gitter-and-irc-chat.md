---
title: Synchronize gitter and IRC
description: Learn to synchronize Gitter and IRC
categories:
---

[gitter](https://gitter.im/ "gitter") is like Chat for github and [IRC](https://en.wikipedia.org/wiki/Internet_Relay_Chat "IRC") (Internet Relay Chat)
is a very old and efficient way to communicate with text.


The usage of IRC is very powerful and the suitable tool if you
want are a person who lives in the terminal but ones you leave the session your whole history is lost. I know that you
can use [irclogger](http://irclogger.com/ "irclogger") to browser the chat for each day - but I also want to talk with
people who likes user Interfaces.


gitter has a nice user interface, it's easier to use (just sign with your github credentials and you are ready) and saves your chat history.


Learn in this article how you can take synchronize message either written in IRC or gitter - it doesn't matter which
tool you use.

(This article was written for the [gitter-client 3.0.3 for Linux](https://gitter.im/#apps-panel) and [irssi 0.8.19](https://irssi.org/ "irssi 0.8.19"))


## Getting started with gitter-irc-bot

Create [heroku](https://heroku.com/) profile. Go to <https://github.com/finnp/gitter-irc-bot>
and click on deploy to heroku (it's at the bottom of the README). It will then ask you a bunch of config Variables like
`GITTER_ROOM`, `IRC_CHANNEL`, `IRC_NICK`, and `APIKEY`. Get your gitterbot api token from <https://developer.gitter.im/apps>.

It worked quite well for a while, but out of sudden I had a problem with some node package on heroku and
sadly the bot stopped working for me.


I could also run this process on my local by saving the credentials in `bin.js`:


```javascript
var opts = {
  ircServer: "irc.freenode.net",
  ircChannel: "#padrino",
  ircNick: "padrinobot",
  ircAdmin: "wikimatze",
  ircOpts: getIrcOpts(),
  gitterApiKey: "<you-gitter-apikey>",
  gitterRoom: "padrino/padrino-framework"
}
```


and start the app with `node bin.js`. I'm a person who actually turns of his machine, so the bot would be gone.


## Hosting on uberspace

[uberspace](https://uberspace.de/ "uberspace") is a German based hosting company where you decide what you
want to pay. They take care of security, have an exhausting
[wiki/documentation](https://wiki.uberspace.de/ "wiki/documentation") and many modern programs are installed there.


The easiest way to test your bot is copy the files from above on this server, run npm install and npm start:

```sh
$ ssh fomalhaut.uberspace.de -l padrino
[padrino@fomalhaut ~]$ git clone https://github.com/vimberlin/vimberlinbot.git
[padrino@fomalhaut ~]$ cd vimberlinbot && ./bin.js
```

<img src="https://farm8.staticflickr.com/7381/26727355831_95204692c0_z_d.jpg" class="big center" alt="Vimberlinbot joins IRC chat"/>
<div class="caption">"Vimberlinbot joins IRC chat"</div>



When you quit session, the app will stop running.

<img src="https://farm8.staticflickr.com/7666/26794150475_be3fc01e93_z_d.jpg" class="big center" alt="Vimberlinbot leaves IRC chat"/>
<div class="caption">"Vimberlinbot leaves IRC chat"</div>


## Creating a permanent bot as a daemon

You need to create a [daemon](https://wiki.uberspace.de/system:daemontools) and activate the service, from
which you can create your own daemons:


```sh
[padrino@fomalhaut ~]$ test -d ~/service || uberspace-setup-svscan
Creating the /etc/run-svscan-padrino/run script
Symlinking /etc/run-svscan-padrino to /service/svscan-padrino to start the service
Waiting for the service to start ... 1 2 3 4 5 started!

Congratulations - your personal ~/service directory is now ready to use!
```

Next we need to create a service:


```sh
[padrino@fomalhaut service]$ uberspace-setup-service vimberlinservice npm start
Creating the ~/etc/run-vimberlinservice/run service run script
Creating the ~/etc/run-vimberlinservice/log/run logging run script
Symlinking ~/etc/run-vimberlinservice to ~/service/vimberlinservice to start the service
Waiting for the service to start ... 1 2 3 started!

Congratulations - the ~/service/vimberlinservice service is now ready to use!
To control your service you'll need the svc command (hint: svc = service control):

To start the service (hint: u = up):
  svc -u ~/service/vimberlinservice
To stop the service (hint: d = down):
  svc -d ~/service/vimberlinservice
To reload the service (hint: h = HUP):
  svc -h ~/service/vimberlinservice
To restart the service (hint: du = down, up):
  svc -du ~/service/vimberlinservice

To remove the service:
  cd ~/service/vimberlinservice
  rm ~/service/vimberlinservice
  svc -dx . log
  rm -rf ~/etc/run-vimberlinservice

More information about controlling daemons can be found here:
https://uberspace.de/dokuwiki/system:daemontools#wenn_der_daemon_laeuft
```


Edit the job `~/service/vimberlinservice/run`


```sh
#!/bin/sh

# These environment variables are sometimes needed by the running daemons
export USER=padrino
export HOME=/home/padrino

# Include the user-specific profile
source $HOME/.bash_profile

# Now let's go!
cd /home/padrino/vimberlinbot && exec /package/host/localhost/nodejs-4.3.2/bin/npm start
```


And start the service:


```sh
svc -u ~/service/vimberlinservice
svc -u ~/service/padrinoservice
```

## Delete a daemon:

Don't think it's just enough to delete the folder - if you do so then the supervise commands will not be closed. You
than have to contact uberspace and say which commands they should kill.


Prepare, that you should not run your processes in the background to prevent having multiple bots. For examples I the
following line in `~/service/vimberlinservice/run`:


```sh
cd /home/padrino/vimberlinbot && exec /usr/local/bin/npm start 2>&1
```

Which cause me having the following situation:

<img: vimberlin_background_services.png>


Here are the suggested steps for deleting a daemon:


```sh
[padrino@fomalhaut service]$ cd ~/service/vimberlinservice
[padrino@fomalhaut service]$ rm ~/service/vimberlinservice
[padrino@fomalhaut service]$ svc -dx . log
[padrino@fomalhaut service]$ rm -rf ~/etc/run-vimberlinservice
```


## Using IRC-bridge

I gave a talk about this topic at [Ruby User Group Berlin in May 2016](http://www.rug-b.de/topics/synchronize-gitter-and-irc "Ruby User Group Berlin in May 2016") and you can directly connect to gitter via <https://irc.gitter.im/>. Here is how you can add the server via [weechat]( "weechat")


```sh
/server add gitter irc.gitter.im/6667 -ssl -password=TOKEN
/connect gitter
/join #vimberlin
```


It works but it doesn't synchronize with their servers.


## Links

- https://wiki.uberspace.de/system:daemontools
- http://blog.christophvoigt.com/how-to-setup-ghost-on-uberspace-de/
- https://wiki.uberspace.de/system:daemontools#wenn_der_daemon_laeuft

