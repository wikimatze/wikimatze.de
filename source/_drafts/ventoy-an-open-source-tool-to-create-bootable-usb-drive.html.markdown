---
title: TITLE
description: TITLE
twitter_src:
facebook_src:
categories:
---

Ventoy is an open source tool to create bootable USB drive for ISO files. With ventoy, you don't need to format the disk again and again,
you just need to copy the iso file to the USB drive and boot it. You can copy many iso files at a time and ventoy will give you a boot menu to select them.

## Installation

Get the latest release from <https://github.com/ventoy/Ventoy/releases> and decompress it.

```sh
wm~/Downloads/ventoy-1.0.21-linux/ventoy-1.0.21  % sudo sh Ventoy2Disk.sh -i /dev/sda

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

