---
title: gpg-and-vim
meta-description: ...
---
*<outline>*


## Why?

Normally I was using `vim -x` do encrypt files with sensitive data which uses the blowfish algorithm for encryption.
But then a change comes ...


## Generating the keys

First we need to generate keys and when you come to the step to create the passphrase don't forget to move your mouse
to create enough entropy for the key:


```bash
$  gpg --gen-key

gpg (GnuPG) 1.4.11; Copyright (C) 2010 Free Software Foundation, Inc.
This is free software: you are free to change and redistribute it.
There is NO WARRANTY, to the extent permitted by law.

Please select what kind of key you want:
   (1) RSA and RSA (default)
   (2) DSA and Elgamal
   (3) DSA (sign only)
   (4) RSA (sign only)
Your selection? 2
DSA keys may be between 1024 and 3072 bits long.
What keysize do you want? (2048)
Requested keysize is 2048 bits
Please specify how long the key should be valid.
         0 = key does not expire
      <n>  = key expires in n days
      <n>w = key expires in n weeks
      <n>m = key expires in n months
      <n>y = key expires in n years
Key is valid for? (0)
Key does not expire at all
Is this correct? (y/N) y

You need a user ID to identify your key; the software constructs the user ID
from the Real Name, Comment and Email Address in this form:
    "Heinrich Heine (Der Dichter) <heinrichh@duesseldorf.de>"

Real name: Matthias Günther
Email address: matthias.guenther@wikimatze.de
Comment:
You are using the `utf-8' character set.
You selected this USER-ID:
    "Matthias Günther <matthias.guenther@wikimatze.de>"

Change (N)ame, (C)omment, (E)mail or (O)kay/(Q)uit? O
You need a Passphrase to protect your secret key.

We need to generate a lot of random bytes. It is a good idea to perform
some other action (type on the keyboard, move the mouse, utilize the
disks) during the prime generation; this gives the random number
generator a better chance to gain enough entropy.
gpg: WARNING: some OpenPGP programs can't handle a DSA key with this digest size
.++++++++++++++++++++++++++++++.++++++++++.+++++++++++++++..++++++++++..+++++++++++++++++++++++++......+++++.+++++..++++++++++..+++++.+++++..+++++....++++++++++>+++++.................................................................+++++
We need to generate a lot of random bytes. It is a good idea to perform
some other action (type on the keyboard, move the mouse, utilize the
disks) during the prime generation; this gives the random number
generator a better chance to gain enough entropy.
++++++++++.++++++++++++++++++++...++++++++++++++++++++++++++++++++++++++++.+++++.++++++++++++++++++++.+++++.++++++++++++++++++++..+++++..+++++.+++++.++++++++++>+++++.+++++.......................>+++++..........<.+++++...............................................>+++++......<.+++++......................................>+++++...........<+++++.............................................................................+++++^^^
gpg: key D64C14E5 marked as ultimately trusted
public and secret key created and signed.
```


## Encryption and Decryption

```bash
$ vi document.txt
$ gpg --encrypt --armour
    -r matthias.guenther@wikimatze.de
    -o document.asc document.txt
$ rm document.txt
```


Now your file have an encrypted file `document.asc` which looks like:

```bash
-----BEGIN PGP MESSAGE-----
Version: GnuPG v1.4.11 (GNU/Linux)

hQIOA+83xiAomv0TEAf/RD3Xh1NkFIjc5C5lz1VnUxsqjTf4jPOwTPqXvBgs6Sqi
leGHoOnRMN6EUGS6xx6fcPeTxMPWjd+vK1SvV4VsPKJHun+0AX2yRCfd8PZA8IZ2
h1iaFPmG+5Jn4pBA89+0Z1odUZ4fd4wmABN33jmlNUuw4qXVu4xHYf+MVeCtWJWG
xaEGK8X+9w2C0ycgf18n1NUBPgJXQ76e+qyqmZ8gMyv5uq18ayvmZ5R/+HBdrJGP
DnqQKMI9SFjWn0eVCb6H6hCIHPS7xAxfmtYx+XuP5ZIt3+i1nthj4vAixSMJsIHc
tmA7hKuAG8MT6+6FiUX3+74I3T1QE3d7YyBaMVmjgQgAjFZ182G547gSw6lhu+Zc
wFm0IAPzpI4US01hddK1LBmk/HmdggONAv7HRs13JC1LjFWzAJrLsCFehAC4N3B2
T8yuZXxPC3kjSFwk+KmsD8XhqllSGc/LxCp3EQhMLassjejZ0tc7jqx5JFYxwUXU
ODvXkk8D88if39wSqwQPZTfw2sYwU0ujv2GwuMd5r+oLgljKI8NghyZZsAZMPaFl
XYQliqm/ZgjKeoYtu15d/VS4ft7hncnikLSUzwxlzMIUlDBzCfYull06n3N6BS9o
L9zpaqXGcMP1frZyUGiUMvRVV2zUIQmTmZM2RFufzaqfmKgHFtRzmHT2FGx4+FzP
M9JUAalW0Y2Rcio4LG8Ba++5gvvG4ofqlpwGu2v7lxVzWFXQVJajZcgh4Bwdar5H
fIvM/5YED4+ZlNXmqsNYMrEoPD94FyLSMMduUE/9T7SSgKiGywBt
=AQI2
-----END PGP MESSAGE-----
```


You can view and edit this file with:


```bash
$ gpg --decrypt -o document.txt document.asc
$ vim document.txt
```


After you are done with your editing you need to encrypt your file again:


```bash
$ gpg --encrypt --armour
    -r matthias.guenther@wikimatze.de
    -o document.asc document.txt
```


Now it we are fine and everything is working.


## Automating Enrcyption and Decryption with a Vim plugin

James McCoy create a nice plugin for doing this tasks [https://github.com/jamessan/vim-gnupg](https://github.com/jamessan/vim-gnupg).

Now when edit a file with the `.gpg, .pgp` or `.asc` suffix, the plugin decrypts it, and load the editable content in
memory (called *buffer* in the Vim language). The plugin will re-encrypt the file before writing it back to disk.


## Conclusion

You may ask: Why is it besser then a common `vim -x` which uses the blowfish encryption? You don't have to type in the
password everytime when you want to edit such a file. Even if you are encrypting your home directory you have to be
aware that your data are secured in case your hardware gets stolen. But when you are logged in your machine and
something is on it, your files may still be read. Please use this additional layer to save sensitive data. Furthermore,
encrypting textfiles beside your harddisk encryption will put another security layer around you.


## Further reading

- [gpg basic](http://aplawrence.com/Basics/gpg.html "gpg basic")
- [operationaldynamics](http://blogs.operationaldynamics.com/andrew/software/gnome-desktop/vim-gpg-integration)
- lk

