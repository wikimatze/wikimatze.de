---
title: Solving svn up keyring issue
---

~/git/approval_de svn up
WARNING: gnome-keyring:: couldn't connect to: /tmp/keyring-m4qoRl/pkcs11: No such file or directory
svn: Can't find a temporary directory: Internal error

Solution: /usr/bin/gnome-keyring-daemon --start --components=pkcs11

Now you are ready to

http://askubuntu.com/questions/243210/why-do-i-get-this-warning-from-gnome-keyring-in-xubuntu
