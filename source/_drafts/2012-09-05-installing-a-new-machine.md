---
layout: post
title: Installing a new machine
published: false
meta-description: ...
---
*When I'm installing a new machine, I have to fireup a bunch of commands to setup my working environment. This
article describes the steps I need perfom when installing a new machine.*


## Getting the latest (X)ubuntu image (20.04)

Grab the iso from one of the Download pages:

- [64-bit (AMD64)](http://ftp.uni-kl.de/pub/linux/ubuntu-dvd/xubuntu/releases/20.04/release/xubuntu-20.04.2.0-desktop-amd64.iso)


## Creating a Bootable Startup USB Stick


[Ventoy](https://www.ventoy.net/en/index.html "Ventoy") is an open source tool to create bootable USB drive for ISO files.
With ventoy, you don't need to format the disk again and again,
you just need to copy the iso file to the USB drive and boot it. You can copy many iso files at a time and ventoy will give you a boot menu to select them.


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


Now can just copy the iso directly on the stick and use that


## Update Packages information


```
sudo apt-get -y update
```


## Start the Software Updater


Install all suggested updates before you proceed. Then reboot the machine.


## Installing Ubuntu Packages

Afte the syncing of all my files is done, it's time to install all the other packages and programs I need on the
machine with:


```bash
wget -O ubuntu_install.sh 'https://raw.githubusercontent.com/wikimatze/dotfiles/master/scripts/ubuntu_install.sh' && bash ubuntu_install.sh
```


To see what's going on in this script, let's have a brief look into it:


```bash
# Remove packages

sudo apt-get remove -y abiword
sudo apt-get remove -y catfish
...


# Install of packages

sudo apt-get install -y ack-grep
...
```


I added the `-y` option to confirm all occuring messages with **yes** to keep up the installation of packages.


## Reboot

After applying all the changes to the system, we need run `sudo reboot`. After that, all should be running and you should have a bunch of new programms installed on your machine.


## Getting nextcloud

I'm using owncloud to manager my files on my own server. All you have to is to install the client:



```bash
wget -O nextcloud_install.sh 'https://raw.githubusercontent.com/wikimatze/dotfiles/master/scripts/nextcloud_install.sh' && bash nextcloud_install.sh
```


## Symlinks

Symlinks are great. They are a special type of a file that contains a reference to another file or directory. I need them to set up my `*.dot` config files and directory structure. Creating a symlink is easy:


```bash
ln -s source_path target_path
```


The `source_path` is the place to which the `target_path` points to when using the `target_path`.  All what I do is running:


```bash
wget -O symlink_install.sh 'https://raw.githubusercontent.com/wikimatze/dotfiles/master/scripts/symlink_install.sh' && bash symlink_install.sh
```


## Install git, prezto checkout repositories, git checkout forked repositories, bitbucket repositories and run symlinks again

```bash
wget -O git_install.sh 'https://raw.githubusercontent.com/wikimatze/dotfiles/master/scripts/git_install.sh' && bash git_install.sh
wget -O prezto_install.sh 'https://raw.githubusercontent.com/wikimatze/dotfiles/master/scripts/prezto_install.sh' && bash prezto_install.sh
wget -O git_repositories_checkout_install.sh 'https://raw.githubusercontent.com/wikimatze/dotfiles/master/scripts/git_repositories_checkout_install.sh' && bash git_repositories_checkout_install.sh
wget -O git_forked_repositories_checkout_install 'https://raw.githubusercontent.com/wikimatze/dotfiles/master/scripts/git_forked_repositories_checkout_install.sh' && bash git_forked_repositories_checkout_install
wget -O bitbucket_repos_clone.sh 'https://raw.githubusercontent.com/wikimatze/dotfiles/master/scripts/bitbucket_repos_clone.sh' && bash bitbucket_repos_clone.sh
wget -O symlink_install.sh 'https://raw.githubusercontent.com/wikimatze/dotfiles/master/scripts/symlink_install.sh' && bash symlink_install.sh
```


Why running symlinks again? Because now the git repositories are there and I'm symlinking some configuration files into them.



## Installing Ruby with rvm
```bash
command curl -sSL https://rvm.io/mpapis.asc | gpg --import -
unset GEM_HOME
curl -sSL https://get.rvm.io | bash -s stable --ruby
```

Now, you are able to install different ruby versions with the `rvm install ruby-*` command. To change between different ruby
versions you need to call `rvm use <the-version>`


The combination of the commands is summarized in the following script:


```
wget -O rvm_install.sh 'https://raw.githubusercontent.com/wikimatze/dotfiles/master/scripts/rvm_install.sh' && bash rvm_install.sh
```


### Installing Gems

After setting up the correct version of ruby, it's time to install the different gems.


```
wget -O gem_install.sh 'https://raw.githubusercontent.com/wikimatze/dotfiles/master/scripts/gem_install.sh' && bash gem_install.sh
```


## Installing tmux


Install version 2.3 by executing the following script:


```sh
wget -O tmux_install.sh 'https://raw.githubusercontent.com/wikimatze/dotfiles/master/scripts/tmux_install.sh' && bash tmux_install.sh
```


And install the tmux-plugins:

```sh
wget -O tmux_plugins_install.sh 'https://raw.githubusercontent.com/wikimatze/dotfiles/master/scripts/tmux_plugins_install.sh' && bash tmux_plugins_install.sh
```


## Installing vim

You can find more about this on my post about ["Compiling Vim from source with Ruby and Python Support"](/compiling-vim-from-source-for-ubuntu-and-mac-with-rbenv/).


```sh
git clone https://github.com/wikimatze/vimfiles.git ~/.vim
bash ~/.vim/install.sh
```


Install ag (silver searcher)
Install faasd
Install gitter

Need for tmux
```sh
chsh -s $(which zsh)
```


## Installing dropbox

```bash
if [$(uname -m) == "x86_64"]; then
  cd ~ && wget -O "https://www.dropbox.com/download?plat=lnx.x86" | tar xzf -
else
  cd ~ && wget -O "https://www.dropbox.com/download?plat=lnx.x86_64" | tar xzf -
fi

~/.dropbox-dist/dropboxd
```

I leave all my not security relevant files on this account.


You can get the latest version of this install script under <https://raw.githubusercontent.com/wikimatze/dotfiles/master/scripts/dropbox_install.sh>


# Conclusion

I spend a much of time inventing this simple plain format of installing a new machine with a bunch of shell script. I know
that there is duplication inside this file. I know that my scripts are not configurable to on machines with other package
managers
You can read more about the steps under [aa](/compiling-vim-from-source-for-ubuntu-and-mac-with-rben)

## Further reading

- [symlinks](http://en.wikipedia.org/wiki/Symbolic_link "symbolic link")
- [ctags](http://en.wikipedia.org/wiki/Ctags "ctags")
- [ctags gzipped](http://prdownloads.sourceforge.net/ctags/ctags-5.8.tar.gz "ctags gzipped")
- [rubygems](http://rubygems.org/ "rubygems")

