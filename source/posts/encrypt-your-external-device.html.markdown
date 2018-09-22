---
title: Encrypt Your External Device
date: 2015-05-05
updated: 2015-01-26
description: I recently bought a new External Hardware with 2 TB space Transcend StoreJet 25M3 Anti-Shock 2TB and I use it as a backup for my music, images, and all other documents. I always wanted to encrypt my whole device so here is how I started my journey. First let’s check where our newly plugged in device can be found.
categories: encrypt device ops
---

I recently bought a new External Hardware with 2 TB space ([Transcend StoreJet 25M3 Anti-Shock 2TB](http://www.amazon.com/Transcend-Military-Tested-External-TS2TSJ25M3/dp/B00K087BM2) and I use it as a backup for my music, images, and all other documents.


I always wanted to encrypt my whole device so here is how I started my journey. First let's check
where our newly plugged in device can be found:


```sh
$ sudo fdisk -l

Disk /dev/sda: 256.1 GB, 256060514304 bytes
255 heads, 63 sectors/track, 31130 cylinders, total 500118192 sectors
Units = sectors of 1 * 512 = 512 bytes
Sector size (logical/physical): 512 bytes / 512 bytes
I/O size (minimum/optimal): 512 bytes / 512 bytes
Disk identifier: 0x000a9645

Device Boot      Start         End      Blocks   Id  System
/dev/sda1   *        2048      206847      102400    7  HPFS/NTFS/exFAT
/dev/sda2          206848   295317503   147555328    7  HPFS/NTFS/exFAT
/dev/sda3       491730942   500117503     4193281    5  Extended
/dev/sda4       295317504   491728895    98205696   83  Linux
/dev/sda5       491730944   500117503     4193280   82  Linux swap / Solaris

Partition table entries are not in disk order

Disk /dev/sdb1: 2000.4 GB, 2000398934016 bytes
255 heads, 63 sectors/track, 243201 cylinders, total 3907029168 sectors
Units = sectors of 1 * 512 = 512 bytes
Sector size (logical/physical): 512 bytes / 512 bytes
I/O size (minimum/optimal): 512 bytes / 512 bytes
Disk identifier: 0xa437ef40

  Device Boot      Start         End      Blocks   Id  System
/dev/sdb1              63  3907029167  1953514552+   7  HPFS/NTFS/exFAT
```


Now we need to unmount the device:


```sh
$ sudo umount /dev/sdb1
```


To encrypt the device we will use a tool called [cryptsetup](https://gitlab.com/cryptsetup/cryptsetup/blob/master/README.md "cryptsetup"). Once you've installed it, please run `cryptesetup --help`, to see which cipher format are available for your machine:


```sh
$ cryptsetup --help

Default compiled-in key and passphrase parameters:
  Maximum keyfile size: 8192kB, Maximum interactive passphrase length 512 (characters)
  Default PBKDF2 iteration time for LUKS: 1000 (ms)

Default compiled-in device cipher parameters:
  loop-AES: aes, Key 256 bits
  plain: aes-cbc-essiv:sha256, Key: 256 bits, Password hashing: ripemd160
  LUKS1: aes-xts-plain64, Key: 256 bits, LUKS header hashing: sha1, RNG: /dev/urandom
```

- [cipher](http://en.wikipedia.org/wiki/Cipher "cipher"): is an algorithm doing the encryption or decryption
- [PBKDF2](http://en.wikipedia.org/wiki/PBKDF2 "PBKDF2"): stands for *Password-Based Key Derivation Function 2* and applies various pseudorandom functions, HMAC (Hash Message Authentication Code), and salt over the input password in order to create a derived key for an block cipher
- [aes](http://en.wikipedia.org/wiki/Advanced_Encryption_Standard "aes"): stands for **Advanced Encryption Standard** and is a specification for the encryption of data.
- [LUKS1](https://en.wikipedia.org/wiki/Linux_Unified_Key_Setup "LUKS1"): stands for **Linux Unified Key Setup** and is disk-encryption specification developed by Clemens Fruhwirth (a Vienna guy) in 2004. The good thing about LUKS is that it is platform-independent for use in various tools, supports multiple passwords, stores all information in the partition header (users can transport or migrate data seamlessly), and it's free.


So LUKS1 uses aes under the hood for partition encryption, while aes uses PBKDF2 to cipher the key to encrypt your
device.


In order to check the performance of the different encryption formats, you can use the `cryptsetup benchmark`:


```sh
$ cryptsetup benchmark

# Tests are approximate using memory only (no storage IO).
PBKDF2-sha1       254015 iterations per second
PBKDF2-sha256     216647 iterations per second
PBKDF2-sha512     147603 iterations per second
PBKDF2-ripemd160  308767 iterations per second
PBKDF2-whirlpool  149454 iterations per second
#  Algorithm | Key |  Encryption |  Decryption
aes-cbc       128b   177,8 MiB/s   185,4 MiB/s
serpent-cbc   128b    91,7 MiB/s   229,0 MiB/s
twofish-cbc   128b   197,8 MiB/s   247,8 MiB/s
aes-cbc       256b   143,6 MiB/s   148,1 MiB/s
serpent-cbc   256b    94,8 MiB/s   240,0 MiB/s
twofish-cbc   256b   212,7 MiB/s   262,4 MiB/s
aes-xts       256b   201,5 MiB/s   196,0 MiB/s
serpent-xts   256b   214,8 MiB/s   214,0 MiB/s
twofish-xts   256b   194,9 MiB/s   227,0 MiB/s
aes-xts       512b   143,4 MiB/s   148,1 MiB/s
serpent-xts   512b   209,4 MiB/s   212,4 MiB/s
twofish-xts   512b   229,8 MiB/s   225,0 MiB/s
```


As you can above, PBKDF2-sha512 has the lowest number of iteration per second, this maximizes the effort of the
attacker, because he can't less iteration to get your password. Besides [cbc (cipher-block chaining)](http://en.wikipedia.org/wiki/Disk_encryption_theory#Cipher-block_chaining_.28CBC.29 "cbc") and [xts](http://en.wikipedia.org/wiki/Disk_encryption_theory#XEX-based_tweaked-codebook_mode_with_ciphertext_stealing_.28XTS.29 "xts") are possible ciphers. We will use xts because it's designed to support disk encryption efficiently and cbc is known to have some information leakage attacks. Since I'm having an SSD under the hood and USB 3 I want to have fast access so using 512 bit key with the [twofish](http://en.wikipedia.org/wiki/Twofish "twofish") key block cipher is my choice. Normally [256 bit are good enough](http://security.stackexchange.com/questions/6141/amount-of-simple-operations-that-is-safely-out-of-reach-for-all-humanity/6149#6149 "256 bit are good enough") but I take 512 in favor with the little CPU overhead to be more save for the future.


Now let's put all the theory into practise:


```sh
$ sudo cryptsetup luksFormat -c twofish-xts -s 512 -h sha256 /dev/sdb1

WARNING!
========
This will overwrite data on /dev/sdb1 irrevocably.


Are you sure? (Type uppercase yes): YES
Enter passphrase:
Verify passphrase:
```


- c ... set the cipher specification link
- s ... set the key size in bits
- h ... specifies the passphrase hash for open (I'm using the deprecated sha256 because sha512 was not working on my
machine)


Next we use the `luksOpen` to mount the device:


```sh
$ sudo cryptsetup luksOpen /dev/sdb1 transcend
Enter passphrase for /dev/sdb1:
```


Once it's mounted you need to create a valid partition:


```sh
$ sudo mke2fs -j /dev/mapper/transcend -L transcend

mke2fs 1.42.9 (4-Feb-2014)
Filesystem label=transcend
OS type: Linux
Block size=4096 (log=2)
Fragment size=4096 (log=2)
Stride=0 blocks, Stripe width=0 blocks
122101760 inodes, 488378126 blocks
24418906 blocks (5.00%) reserved for the super user
First data block=0
Maximum filesystem blocks=4294967296
14905 block groups
32768 blocks per group, 32768 fragments per group
8192 inodes per group
Superblock backups stored on blocks:
  32768, 98304, 163840, 229376, 294912, 819200, 884736, 1605632, 2654208,
  4096000, 7962624, 11239424, 20480000, 23887872, 71663616, 78675968,
  102400000, 214990848

Allocating group tables: done
Warning: could not read block 0: Attempt to read block from filesystem resulted in short read
Writing inode tables: done
ext2fs_mkdir: Attempt to read block from filesystem resulted in short read while creating root dir
```


The `-j` options says that the filesystem should be [ext3 journal](http://en.wikipedia.org/wiki/Ext3 "ext3 journal") and
`-L` sets the volume label for the filesystem to new-volume-label.


I tried `mkfs.exfat` to create the filesystem but got later on problems with changing the owner rights.


It can be helpful to format the device in the exFAT format because it is both readable and writable by Mac, Windows, and
Linux.


Finally edit `fstab` file to automount the plates on your machine. Luckily the [thunar filesmanager](http://docs.xfce.org/xfce/thunar/start "thunar filesmanager") does all the `luksOpen` thing automatically for me.


## Further reading

- [Inspiration](http://ubuntu-tutorials.com/2007/08/17/7-steps-to-an-encrypted-partition-local-or-removable-disk/)
- [Better explanation](http://www.axllent.org/docs/security-and-encryption/256bit-aes-encryption/)
- [cipher benchmarks](http://blog.wpkg.org/2009/04/23/cipher-benchmark-for-dm-crypt-luks/)
- [luks cryptseup options](http://security.stackexchange.com/questions/40208/recommended-options-for-luks-cryptsetup)
- [Problems with rsync](http://docs.xfce.org/xfce/thunar/start "Problems with rsync")

