---
title: Installing Printer Driver For Brother HL-2240D Under Xubuntu
date: 2014-09-30
update: 2015-09-14
description: Sometimes you need a printer today and this blog post is a reminder for me
categories: xubuntu linux
---

You can go and install the default printer driver but that will not work for Duplex Printer under Xubuntu. The best choice is to install the official Brother Tools for Linux.


## Get the sources

Since I have HL-2240D I need to grab the following script: <http://support.brother.com/g/b/downloadlist.aspx?c=eu_ot&lang=en&prod=hl2240d_all&os=128>. You can get the code
direct from <http://download.brother.com/welcome/dlf006893/linux-brprinter-installer-2.0.0-1.gz>


## Installation

Once you get the script, you need to run it `./linux-brprinter-installer-2.0.0-1` and follow the following installation dialog:


```sh
Input model name ->HL-2240D

You are going to install following packages.
   hl2240dlpr-2.1.1-1.i386.deb
   cupswrapperHL2240D-2.0.4-2.i386.deb
OK? [y/N] ->y

dpkg -x hl2240dlpr-2.1.1-1.i386.deb /
dpkg -x cupswrapperHL2240D-2.0.4-2.i386.deb /
dpkg-deb: building package `hl2240dlpr' in `hl2240dlpr-2.1.1-1a.i386.deb'.
dpkg -b ./brother_driver_packdir hl2240dlpr-2.1.1-1a.i386.deb
dpkg-deb: building package `cupswrapperhl2240d' in `cupswrapperHL2240D-2.0.4-2a.i386.deb'.
dpkg -b ./brother_driver_packdir cupswrapperHL2240D-2.0.4-2a.i386.deb
dpkg -i --force-all hl2240dlpr-2.1.1-1a.i386.deb
(Reading database ... 261952 files and directories currently installed.)
Preparing to unpack hl2240dlpr-2.1.1-1a.i386.deb ...
Unpacking hl2240dlpr (2.1.1-1) over (2.1.1-1) ...
Setting up hl2240dlpr (2.1.1-1) ...
dpkg -i --force-all cupswrapperHL2240D-2.0.4-2a.i386.deb
(Reading database ... 261952 files and directories currently installed.)
Preparing to unpack cupswrapperHL2240D-2.0.4-2a.i386.deb ...
 * Restarting Common Unix Printing System cupsd
   ...done.
Unpacking cupswrapperhl2240d (2.0.4-2) over (2.0.4-2) ...
Setting up cupswrapperhl2240d (2.0.4-2) ...
 * Restarting Common Unix Printing System cupsd
   ...done.

Will you specify the Device URI? [Y/n] ->n

Test Print? [y/N] ->y

wait 5s.
lpr -P HL2240D /usr/share/cups/data/testprint
```


Hope this article helps you a lot and makes you happy using your Brother printer in the right version for your PC.

