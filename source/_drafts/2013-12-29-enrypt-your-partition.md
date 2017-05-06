---
title: Enrypt Your Partition
description: Encrypt your external device
---
wikimatze~: sudo fdisk -l

Disk /dev/sda: 64.0 GB, 64023257088 bytes
255 heads, 63 sectors/track, 7783 cylinders, total 125045424 sectors
Units = sectors of 1 * 512 = 512 bytes
Sector size (logical/physical): 512 bytes / 512 bytes
I/O size (minimum/optimal): 512 bytes / 512 bytes
Disk identifier: 0x000d06ea

   Device Boot      Start         End      Blocks   Id  System
/dev/sda1   *        2048   120868863    60433408   83  Linux
/dev/sda2       120870910   125044735     2086913    5  Extended
/dev/sda5       120870912   125044735     2086912   82  Linux swap / Solaris

Disk /dev/sdc: 1000.2 GB, 1000204883968 bytes
255 heads, 63 sectors/track, 121601 cylinders, total 1953525164 sectors
Units = sectors of 1 * 512 = 512 bytes
Sector size (logical/physical): 512 bytes / 512 bytes
I/O size (minimum/optimal): 512 bytes / 512 bytes
Disk identifier: 0x77a8d0eb

   Device Boot      Start         End      Blocks   Id  System
/dev/sdc1            2048  1953523711   976760832    b  W95 FAT32
wikimatze~: sudo umount /dev/sdd1
wikimatze~: sudo cryptsetup luksFormat /dev/sdc1 -c aes -s 256 -h sha256

WARNING!
========
This will overwrite data on /dev/sdc1 irrevocably.

Are you sure? (Type uppercase yes): YES
Enter LUKS passphrase:
Verify passphrase:
wikimatze~: sudo cryptsetup luksOpen /dev/sdc1 verbatim
Enter passphrase for /dev/sdc1:

wikimatze~: sudo mke2fs -j /dev/mapper/verbatim -L verbatim
mke2fs -j /dev/mapper/name -L label
wikimatze~: sudo mkfs.exfat -n verbatim /dev/mapper/verbatim
mkexfatfs 1.0.1
Creating... done.
Flushing... done.
File system created successfully.


Dont use mkfs.exfat as a file system because when doing a rsync it has great problems with changing owner rights and
stuff.


Format my 1 TB external drive under Mac, which uses the exFAT format which is both readbale by Mac, Windows, and Linux.


Problems with rsync: http://blog.marcelotmelo.com/linux/ubuntu/rsync-to-an-exfat-partition/




Finally edit `fstab` file to automount the plates on your machine. Since the devices changes all the time you plugin in
devices it is a good idea to get the [UUID]() - use the [blkid](https://help.ubuntu.com/community/UsingUUID).


- [Inspiration](http://ubuntu-tutorials.com/2007/08/17/7-steps-to-an-encrypted-partition-local-or-removable-disk/)
- [Better explanation](http://www.axllent.org/docs/security-and-encryption/256bit-aes-encryption/)
- [cipher benchmarks](http://blog.wpkg.org/2009/04/23/cipher-benchmark-for-dm-crypt-luks/)

