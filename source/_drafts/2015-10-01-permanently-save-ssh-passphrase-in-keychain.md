---
title: Permanently save ssh passphrase in keychain
description: Permanently save ssh passphrase in keychain
categories: ,
---

Enter passphrase for key ~/.ssh/id_rsa


The one time solution is `ssh-add ~/.ssh/id_rsa` but the permanent solution is to add `eval `gnome-keyring-daemon
--start` to your `.bashrc` or `.zshrc`

