---
layout: post
title:
meta-description: ...
published: false
---
# SSH login on remote machine without the need to type in everytime the your password

Found it so annoying to Enter the password everytime I want to switch to a different machine to run some tests.

As we’re going to be deploying our application with Capistrano and we don’t want to be passing around passwords, we now want to
set up SSH keys. If you’re not familiar with the concept, you can use SSH keys to log into a user account without entering a
password by putting your public key in a file called authorized_keys in the user’s home directory.  The solution is to copy your
ssh key on the machines:

- `ssh-copy-id <user>@<ip-of-machine>`
  - what this command does is using scp
- `ssh-add -l`
  - will list all saved keys for the later authentification
  - if it prints nothing, than no passphrase is saved for later authentification
- `ssh-add`
  - will ask you only once for your passphrase key of your `~/.ssh/id_rsa`


## Further reading
- [SSH on ubuntu page](http://wiki.ubuntuusers.de/SSH)



## Conclusion


## Further reading

-
-
-

