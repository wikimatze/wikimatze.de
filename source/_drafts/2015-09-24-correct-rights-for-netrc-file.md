---
title: Correct rights for netrc file
description: Correct rights for netrc file
categories: ,
---


Permission bits for '/home/wm/.netrc' should be 0600, but are 664.
You should run `chmod 0600 /home/wm/.netrc` so that your credentials are NOT accessible by others.

