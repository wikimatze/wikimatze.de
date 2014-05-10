---
title: Widden the Life of Your SSD
description:
---


# Last access times for files
Many linux related distibutions are going to use the [relatime flag](https://wiki.archlinux.org/index.php/fstab) which
update the inode access time in relation to the modified time of the file. Just create a file called `test.txt` and then
use the `stat test.txt` command to the different information like *access, modify, or last change of the file*:


```bash

wikimatze/tmp: vim test.txt
<do something with the file>
wikimatze/tmp: stat test.txt
  File: ‘test.txt’
  Size: 3         	Blocks: 8          IO Block: 4096   regular file
Device: 804h/2052d	Inode: 1048581     Links: 1
Access: (0644/-rw-r--r--)  Uid: ( 1000/wikimatze)   Gid: ( 1000/wikimatze)
Access: 2014-01-09 19:18:29.005806285 +0100
Modify: 2014-01-09 19:18:29.005806285 +0100
Change: 2014-01-09 19:18:29.005806285 +0100
 Birth: -
wikimatze/tmp: vim test.txt
wikimatze/tmp: stat test.txt
  File: ‘test.txt’
  Size: 3         	Blocks: 8          IO Block: 4096   regular file
Device: 804h/2052d	Inode: 1048581     Links: 1
Access: (0644/-rw-r--r--)  Uid: ( 1000/wikimatze)   Gid: ( 1000/wikimatze)
Access: 2014-01-09 19:18:57.369806831 +0100
Modify: 2014-01-09 19:18:29.005806285 +0100
Change: 2014-01-09 19:18:29.005806285 +0100
 Birth: -
```


In order to find if the `relatime` option is activated on your file system you can watch in `/proc/mounts`:


```bash
wikimatze~: cat /proc/mounts
rootfs / rootfs rw 0 0
sysfs /sys sysfs rw,nosuid,nodev,noexec,relatime 0 0
proc /proc proc rw,nosuid,nodev,noexec,relatime 0 0
...
```


As you can see, my root filesystem is running with the `relatime` option. We will use the [fstab](http://en.wikipedia.org/wiki/Fstab) file to set `noatime` options which basically says to not update access time of files. Another useful option in this context is `nodiratime`, and `discard`. The `nodiratime` says to not update directory inode access times on the filesystem, and `discard` issue [Trim](http://en.wikipedia.org/wiki/Trim_(computing)) commands to the underlying block device when blocks are freed. The Trim command sustain the long-term performance and wear-leveling by inform the SSD which blocks of data are no longer considered of use and can be wiped internally.


# Scheduler
A scheduler helps the filesystem to organize reads and writes in the I/O queue to maximize performance. The default
scheduler for linux is called [Completely Fair Queuing](http://en.wikipedia.org/wiki/CFQ) which was designed for the
rotational latency of of spinning plate drives. The [NOOP scheduler](http://en.wikipedia.org/wiki/Noop_scheduler)
inserts all incoming I/O into a simple FIFO queue and through this your computer doesn't care about productively reorder requests. This feature fits perfect for non-rotational media like SSD because no additional CPU time must be spend for moving the read/write head. Since I'm using a Ubuntu related operating system, we need to edit the [GRUB2](https://help.ubuntu.com/community/Grub2) file and add the `deadline` option to the `GRUB_CMDLINE_LINUX_DEFAULT` parameter:


```bash
wikimatze~: vim /etc/default/grub

# If you change this file, run 'update-grub' afterwards to update
# /boot/grub/grub.cfg.
# For full documentation of the options in this file, see:
#   info -f grub -n 'Simple configuration'

GRUB_DEFAULT=0
#GRUB_HIDDEN_TIMEOUT=0
GRUB_HIDDEN_TIMEOUT_QUIET=true
GRUB_TIMEOUT=10
GRUB_DISTRIBUTOR=`lsb_release -i -s 2> /dev/null || echo Debian`
GRUB_CMDLINE_LINUX_DEFAULT="quiet splash elevator=deadline"
GRUB_CMDLINE_LINUX=""
```


# tmp directories
You can use the [tmpfs](http://en.wikipedia.org/wiki/Tmpfs) which indicates that files will not be created on the hard
drive but rather stored in a volatile memory like [RAM disk](http://en.wikipedia.org/wiki/RAM_disk). You can use the `df` command to see for which parts of your system `tmpfs` is used:


```bash
wikimatze~: df
Filesystem      1K-blocks      Used  Available Use% Mounted on
/dev/sda4        96532204  32129656   59475880  36% /
none                    4         0          4   0% /sys/fs/cgroup
udev              2053896         4    2053892   1% /dev
tmpfs              413280      1272     412008   1% /run
none                 5120         0       5120   0% /run/lock
none              2066388      1480    2064908   1% /run/shm
none               102400        20     102380   1% /run/user
/dev/dm-0      1922858856 663567488 1161615744  37% /media/wikimatze/intenso
/dev/dm-1      1922857776 382362396 1442819812  21% /media/wikimatze/samsung
```


Add the following entries to your `fstab`:


```bash
tmpfs   /tmp       tmpfs   defaults,noatime,mode=1777   0  0
tmpfs   /var/spool tmpfs   defaults,noatime,mode=1777   0  0
tmpfs   /var/tmp   tmpfs   defaults,noatime,mode=1777   0  0
tmpfs   /var/log   tmpfs   defaults,noatime,mode=0755   0  0
```


- `/tmp`: Is available for programs that require temporary files and are not available after a reboot.
- `/var/spool`: Contains data which is awaiting some kind of later processing like mails or cron services.
- `/var/tmp`: Is made for programs that require temporary files or directories between system reboots.
- `/var/log`: Contains miscellaneus log files of the system and other running services.


The contents of each of those files is known as [Filesystem Hierachy Standard](http://en.wikipedia.org/wiki/Filesystem_Hierarchy_Standard)


A good overview about the different file hierarchy in linux based operating systems can be found [here](http://www.pathname.com/fhs/2.2/index.html#TOC)



## References

- [apcmag](http://apcmag.com/how-to-maximise-ssd-performance-with-linux.htm
- [Ubuntu swap faq](https://help.ubuntu.com/community/SwapFaq)
- [swappiness factor](http://askubuntu.com/questions/103242/is-it-safe-to-turn-swap-off-permanently)


