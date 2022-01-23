---
title: Ventoy an Open Source tool to create a bootable USB drive
description: How can you use Ventoy to create bootable USB drive for ISO files.
nav: articles
date: 2022-01-23
updated: 2022-01-23
categories: linux howto ventoy
---

[Ventoy](https://www.ventoy.net/en/index.html "Ventoy") is an open source tool to create bootable USB drive for ISO files. With ventoy,
you don't need to format the disk again and again,
you just need to copy the iso file to the USB drive and boot it. You can copy many iso files at a time and ventoy will give
you a boot menu to select them - easy and simple.

<img class="lazy center" src="/images/ventoy_medium.png" data-src="/images/ventoy.png" data-srcset="/images/ventoy.png 2000w, /images/ventoy.png 1000w, /images/ventoy_medium.png 700w" sizes="100%" alt="Ventoy start screen">
<div class="caption">Ventoy start screen</div>


## Installation

Get the latest release from <https://github.com/ventoy/Ventoy/releases> and decompress it.

```sh
% sudo sh Ventoy2Disk.sh -i /dev/sda

**********************************************
      Ventoy: 1.0.21
      longpanda admin@ventoy.net
      https://www.ventoy.net
**********************************************

Disk : /dev/sda
Model: Flash USB Disk (scsi)
Size : 7 GB
Style: MBR


Attention:
You will install Ventoy to /dev/sda.
All the data on the disk /dev/sda will be lost!!!

Continue? (y/n)

All the data on the disk /dev/sda will be lost!!!
Double-check. Continue? (y/n) y

Create partitions on /dev/sda by parted in MBR style ...
Done
mkfs on disk partitions ...
create efi fat fs /dev/sda2 ...
mkfs.fat 4.1 (2017-01-24)
success
mkexfatfs 1.3.0
Creating... done.
Flushing... done.
File system created successfully.
writing data to disk ...
sync data ...
esp partition processing ...

Install Ventoy to /dev/sda successfully finished.
```


Now you are ready to drop in iso files on the USB-stick.


## Update ventoy

In order to update an already just Get the latest release from <https://github.com/ventoy/Ventoy/releases> and decompress it.


Next go into that folder, run the installation script but don't forget to use the `-u` option to update it.


```sh
cd /home/wm/Downloads/ventoy-1.0.50-linux/ventoy-1.0.50

sudo sh Ventoy2Disk.sh -u /dev/sda

**********************************************
      Ventoy: 1.0.50  x86_64
      longpanda admin@ventoy.net
      https://www.ventoy.net
**********************************************

Upgrade operation is safe, all the data in the 1st partition (iso files and other) will be unchanged!

Update Ventoy  1.0.34 ===> 1.0.50   Continue? (y/n)y

Update Ventoy on /dev/sda successfully finished.
```

