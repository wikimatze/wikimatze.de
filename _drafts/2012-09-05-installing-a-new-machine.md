---
layout: post
title: Installing a new machine
published: false
meta-description: ...
---
*When I'm installing a new machine, I have to fireup a bunch of commands to setup my working environment. This
article describes the steps I need perfom when installing a new machine.*


## Getting the latest Xubuntu image

I'm having an old Netbook with an Intel Atom processor and a Modern Desktop PC. I need to from the Download page:


- [PC Intel 86 - 14.04](http://ftp.tu-chemnitz.de/pub/linux/ubuntu-cdimage/xubuntu/releases/trusty/release/xubuntu-14.04-desktop-i386.iso)
- [64-bit (AMD64)](http://ftp.tu-chemnitz.de/pub/linux/ubuntu-cdimage/xubuntu/releases/trusty/release/xubuntu-14.04-desktop-amd64.iso)


## Creating a Bootable Startup USB Stick

I'm using a tool called [unetbootin](<`2:`) to create a bootable device. After the USBstick is reader I'm pluggin in
the stick and chose in the BIOS to start from this location.


## Getting owncloud

I'm using owncloud to manager my files on my own server. All you have to is to install the client:


```bash
$ sudo sh -c "echo 'deb http://download.opensuse.org/repositories/isv:/ownCloud:/desktop/xUbuntu_14.04/ /' >> /etc/apt/sources.list.d/owncloud-client.list"
$ sudo apt-get update
$ sudo apt-get install owncloud-client
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


## Installing Ubuntu Packages

Afte the syncing of all my files is done, it's time to install all the other packages and programs I need on the
machine:


```bash
$ bash $HOME/ownCloud/dotfiles/scripts/ubuntu_install.sh
```

Shorterway wget -O ubuntu_install.sh "https://github.com/wikimatze/dotfiles/blob/master/scripts/ubuntu_install.sh"


To see what's going on in this script, we will have a look on it:


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

After applying all the changes to the system, we need run `sudo init 6`. After that, all should be running and you should have a bunch of new programms installed on your machine.


## Symlinks

Symlinks are great. They are a special type of a file that contains a reference to another file or directory. I need them to set up my `*.dot` config files and directory structure. Creating a symlink is easy:


```bash
ln -s target_path link_path
```


The `target_path` is the place to which the `link_path` points to when using the `link_path`.  All what I do is running:


```bash
$ bash $HOME/ownCloud/dotfiles/scripts/symlink_install.sh
```

Shorterway wget -O ubuntu_install.sh "https://github.com/wikimatze/dotfiles/blob/master/scripts/symlink_install.sh"


Here is an example of the symlink script:


```bash
...

# Directories links

ln -sf $HOME/Dropbox/.zsnes $HOME/.zsnes
ln -sf $HOME/Dropbox/bin $HOME/bin
ln -sf $HOME/Dropbox/blog-wikimatze $HOME/blog-wikimatze
ln -sf $HOME/Dropbox/git-repositories $HOME/git-repositories
ln -sf $HOME/Dropbox/latex $HOME/latex
ln -sf $HOME/Dropbox/vim-settings $HOME/.vim
ln -sf $HOME/Dropbox/zsnes-games $HOME/zsnes-games

# Bash files

if [ "$OSTYPE" == "linux-gnu" ]
then
  ln -sf $HOME/Dropbox/dotfiles/bashrc $HOME/.bashrc
elif [ "$OSTYPE" == "darwin10.0" ]
  then
  ln -sf $HOME/Dropbox/dotfiles/bashrc $HOME/.bash_profile
fi
...
```


## Installing Ruby with ruby-install and chruby
```bash
$ cd /tmp && rm -rf ruby-install && git clone https://github.com/postmodern/ruby-install.git
$ cd ruby-install && sudo make install
```

Now, you are able to install different ruby versions with the `ruby-install` command. To change between different ruby
versions you need to install `chruby`:


```bash
cd /tmp && rm -rf chruby && git clone https://github.com/postmodern/chruby.git
cd chruby && sudo make install
```

The combination of the commands is summarized in the following script:


```
wget -O ubuntu_install.sh "https://github.com/wikimatze/dotfiles/blob/master/scripts/chruby_install.sh"
```

Since we setup `ruby-install` and `chruby`, it's now time to install the different ruby versions. This step takes very
long because each version needs to be compiled:


```
wget -O ubuntu_install.sh "https://github.com/wikimatze/dotfiles/blob/master/scripts/chruby_versions_install.sh"
```

### Installing Gems

After setting up the correct version of ruby, it's time to install the different gems.

```
wget -O ubuntu_install.sh "https://github.com/wikimatze/dotfiles/blob/master/scripts/gem_install.sh"
```


The content of this file:


You can find this file GitHub
[gem_install.sh](https://github.com/wikimatze/dotfiles/blob/master/scripts/gem_install.sh)


## Installing tmux


```bash
# Create the $HOME/lib folder {{{

cd /tmp

# }}}
# Get the sources {{{

curl -OL http://downloads.sourceforge.net/project/levent/libevent/libevent-2.0/libevent-2.0.21-stable.tar.gz
tar -xvzf libevent-2.0.21-stable.tar.gz &&

# }}}
# Compiling libevent {{{

cd /tmp/libevent-2.0.21-stable && ./configure --prefix=/opt && make && sudo make install

# }}}
# Compiling tmux {{{
cd /tmp && git clone git://git.code.sf.net/p/tmux/tmux-code tmux
cd /tmp/tmux && git checkout 1.9a
bash autogen.sh
LDFLAGS="-L/opt/lib" CPPFLAGS="-I/opt/include" LIBS="-lresolv" ./configure --prefix=/opt && make && sudo make install

# }}}
# Move the tmux-bin file in the right directory where it can be executed {{{

sudo mv -f /opt/bin/tmux /usr/local/bin

# }}}
```


## Installing vim

You can find more about this on my post about ["Compiling Vim from source with Ruby and Python Support"](/compiling-vim-from-source-for-ubuntu-and-mac-with-rbenv/)
jo


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

