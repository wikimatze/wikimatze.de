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


Now can just copy the iso directly on the stick and use that.


## Update Packages information


```
sudo apt-get -y update
```


## Start the Software Updater


Install all suggested updates before you proceed. Then reboot the machine.


## Installing Packages

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

I'm using [nextcloud](https://nextcloud.com/ "nextcloud") to manager my files on my own server. All you have to is to install the client:



```bash
wget -O nextcloud_install.sh 'https://raw.githubusercontent.com/wikimatze/dotfiles/master/scripts/nextcloud_install.sh' && bash nextcloud_install.sh
```


## Copy Keys and settings permissions

```
cp -R .ssh /media/wm/verbatim/.ssh ~
cp -R /media/wm/transcend/.gnupg ~
cp .netrc /media/wm/transcend
sudo chmod 600 ~/.ssh/*
sudo chmod 600 ~/.netrc
```


Import gpg keys:


```
gpg --import ~/.gnupg/secring.gpg
```


Make sure, that `gpg --list-secret-keys` has an output like:


```
wm~/.gnupg  % gpg -K
/home/wm/.gnupg/pubring.gpg
---------------------------
sec   dsa2048 2012-12-08 [SC]
      53155B8E04005CFECA8965C75287E11BD64C14E5
uid           [ultimate] Matthias Günther <matthias.guenther@wikimatze.de>
uid           [ultimate] Matthias Günther <matthias@wikimatze.de>
uid           [ultimate] Matthias Guenther <matthias@wikimatze.de>
ssb   elg2048 2012-12-08 [E]
```


## Get gitconfig

`wget -O ~/.gitconfig 'https://raw.githubusercontent.com/wikimatze/dotfiles/master/gitconfig'`


## Clone dotfiles

`git clone https://github.com/wikimatze/dotfiles.git ~/git/dotfiles`


## Clone git repositories

`wget -O git_repositories_checkout_install.sh 'https://raw.githubusercontent.com/wikimatze/dotfiles/master/scripts/git_repositories_checkout_install.sh' && bash git_repositories_checkout_install.sh`


## Clone forked git repositories

`wget -O git_forked_repositories_checkout_install.sh 'https://raw.githubusercontent.com/wikimatze/dotfiles/master/scripts/git_forked_repositories_checkout_install.sh' && bash git_forked_repositories_checkout_install.sh`


## Clone bitbuckets repositories

`wget -O bitbucket_repos_clone.sh 'https://raw.githubusercontent.com/wikimatze/dotfiles/master/scripts/bitbucket_repos_clone.sh' && bash bitbucket_repos_clone.sh`


## Symlinks

Symlinks are great. They are a special type of a file that contains a reference to another file or directory. I need them to set up my `*.dot` config files and directory structure. Creating a symlink is easy:


```bash
ln -s source_path target_path
```


The `source_path` is the place to which the `target_path` points to when using the `target_path`.  All what I do is running:


```bash
wget -O symlink_install.sh 'https://raw.githubusercontent.com/wikimatze/dotfiles/master/scripts/symlink_install.sh' && bash symlink_install.sh
```


## Install git, checkout forked repositories, and run symlinks again

```bash
wget -O git_install.sh 'https://raw.githubusercontent.com/wikimatze/dotfiles/master/scripts/git_install.sh' && bash git_install.sh
wget -O git_forked_repositories_checkout_install 'https://raw.githubusercontent.com/wikimatze/dotfiles/master/scripts/git_forked_repositories_checkout_install.sh' && bash git_forked_repositories_checkout_install
wget -O symlink_install.sh 'https://raw.githubusercontent.com/wikimatze/dotfiles/master/scripts/symlink_install.sh' && bash symlink_install.sh
```


Why running symlinks again? Because now the git repositories are there and I'm symlinking some configuration files into them.



## Installing Ruby with rvm

```
wget -O rvm_install.sh 'https://raw.githubusercontent.com/wikimatze/dotfiles/master/scripts/rvm_install.sh' && bash rvm_install.sh
```

Now, you are able to install different ruby versions with the `rvm install ruby-*` command. To change between different ruby
versions you need to call `rvm use <the-version>`

To install more ruby versions, just execute the following script:

```
wget -O rvm_versions_install.sh 'https://raw.githubusercontent.com/wikimatze/dotfiles/master/scripts/rvm_versions_install.sh' && bash rvm_versions_install.sh
```


## Installing Gems

After setting up the correct version of ruby, it's time to install the different gems. But first set a default ruby
version:


```
rvm --default ruby-2.7.2
```

And now install the gems:

```
wget -O gem_install.sh 'https://raw.githubusercontent.com/wikimatze/dotfiles/master/scripts/gem_install.sh' && bash gem_install.sh
```


## Installing tmux


Install version 3.2 by executing the following script:


```sh
wget -O tmux_install.sh 'https://raw.githubusercontent.com/wikimatze/dotfiles/master/scripts/tmux_install.sh' && bash tmux_install.sh
```


And install the tmux-plugins:

```sh
wget -O tmux_plugins_install.sh 'https://raw.githubusercontent.com/wikimatze/dotfiles/master/scripts/tmux_plugins_install.sh' && bash tmux_plugins_install.sh
```


## Installing nvim and related tools


```sh
wget -O nvim_install.sh 'https://raw.githubusercontent.com/wikimatze/dotfiles/master/scripts/nvim_install_linux.sh' && bash nvim_install.sh
```


This script will also automatically clone the configs to `~/.config/nvim`


Next, start `nvim` and you will see a black screen :). Just open a new terminal tab and start `nvim`

and run `:PlugInstall` - happy neo-vimming!


Install ctags:

`wget -O ctags_install.sh 'https://raw.githubusercontent.com/wikimatze/dotfiles/master/scripts/ctags_install.sh' && bash ctags_install.sh`


## Install zsh and switch to it

Install zsh:

`wget -O zsh_install.sh 'https://raw.githubusercontent.com/wikimatze/dotfiles/master/scripts/zsh_install.sh' && bash zsh_install.sh`



The switch to the `zsh` happens via the settings in the `bashrc` file:


```
which zsh > /dev/null 2>&1
if [ $? = 0  ]; then
  exec zsh
fi
```


## Install chrome

`wget -O chrome_install.sh 'https://raw.githubusercontent.com/wikimatze/dotfiles/master/scripts/chrome_install.sh' && bash chrome_install.sh`


## Install search tools (ack, ag, pt)

`wget -O ack_install.sh 'https://raw.githubusercontent.com/wikimatze/dotfiles/master/scripts/ack_install.sh' && bash ack_install.sh`

`wget -O ag_install.sh 'https://raw.githubusercontent.com/wikimatze/dotfiles/master/scripts/ag_install.sh' && bash ag_install.sh`

`wget -O pt_install.sh 'https://raw.githubusercontent.com/wikimatze/dotfiles/master/scripts/pt_install.sh' && bash pt_install.sh`


## Install LaTeX

`wget -O latex_basics_install.sh 'https://raw.githubusercontent.com/wikimatze/dotfiles/master/scripts/latex_basics_install.sh' && bash latex_basics_install.sh`

`wget -O latexmk_install.sh 'https://raw.githubusercontent.com/wikimatze/dotfiles/master/scripts/latexmk_install.sh' && bash latexmk_install.sh`

`wget -O latex_packages_install.sh 'https://raw.githubusercontent.com/wikimatze/dotfiles/master/scripts/latex_packages_install.sh' && bash latex_packages_install.sh`

`wget -O libsynctex_install.sh 'https://raw.githubusercontent.com/wikimatze/dotfiles/master/scripts/libsynctex_install.sh' && bash libsynctex_install.sh`


## Install zimfv (zsh completion thing)

First add zsh to your `/etc/shells`

```
command -v zsh | sudo tee -a /etc/shells
```


Then change the default shell to zsh:


```
sudo chsh -s "$(command -v zsh)" "${USER}"
```


Then you need to log out again so that these changes take effect in `/etc/passwd` file:


```
wm:x:1000:1000:wm,,,:/home/wm:/usr/local/bin/zsh
```


Validate your installation:


```
wm~  % echo $SHELL
/usr/local/bin/zsh
```


## Install pass


My tool to store passwords:

`wget -O pass_install.sh 'https://raw.githubusercontent.com/wikimatze/dotfiles/master/scripts/pass_install.sh' && bash pass_install.sh`


Copy keys:


```
cp -R /media/wm/verbatim/.password-store ~
```


## Install i3 window manager

To manage the task bar I use conky:


`wget -O conky_install.sh 'https://raw.githubusercontent.com/wikimatze/dotfiles/master/scripts/conky_install.sh' && bash conky_install.sh`


To have a a fast starter menu I use rofi:


`wget -O rofi_install.sh 'https://raw.githubusercontent.com/wikimatze/dotfiles/master/scripts/rofi_install.sh' && bash rofi_install.sh`


And to have access to passwords I use rofi-pass:


`wget -O rofi_pass_install.sh 'https://raw.githubusercontent.com/wikimatze/dotfiles/master/scripts/rofi_pass_install.sh' && bash rofi_pass_install.sh`


And finally install i3:


`wget -O i3_install.sh 'https://raw.githubusercontent.com/wikimatze/dotfiles/master/scripts/i3_install.sh' && bash i3_install.sh`



## Install cmd line tools

fasd (fuzzy directory and file jumping):


`wget -O fasd_install.sh 'https://raw.githubusercontent.com/wikimatze/dotfiles/master/scripts/fasd_install.sh' && bash fasd_install.sh`


cmus (commandline music player):


`wget -O cmus_install.sh 'https://raw.githubusercontent.com/wikimatze/dotfiles/master/scripts/cmus_install.sh' && bash cmus_install.sh`


gromit-mpx (nice drawing tool for screens):


`wget -O gromit_mpx_install.sh 'https://raw.githubusercontent.com/wikimatze/dotfiles/master/scripts/gromit_mpx_install.sh' && bash gromit_mpx_install.sh`


gitter (chat like tool for all OS repos):


`wget -O gitter_install.sh 'https://raw.githubusercontent.com/wikimatze/dotfiles/master/scripts/gitter_install.sh' && bash gitter_install.sh`


grub-customizer (change the boot order):


`wget -O grub_customizer.sh 'https://raw.githubusercontent.com/wikimatze/dotfiles/master/scripts/grub_customizer.sh' && bash grub_customizer.sh`


weechat (nice IRC client):


`wget -O weechat_install.sh 'https://raw.githubusercontent.com/wikimatze/dotfiles/master/scripts/weechat_install.sh' && bash weechat_install.sh`


pdftk (good tool to manipulate PDFs on the commandline):


`wget -O pdftk_install.sh 'https://raw.githubusercontent.com/wikimatze/dotfiles/master/scripts/pdftk_install.sh' && bash pdftk_install.sh`


qutebrowser (minimalistic browser with a lot of vim keybindings):


`wget -O qutebrowser_install.sh 'https://raw.githubusercontent.com/wikimatze/dotfiles/master/scripts/qutebrowser_install.sh' && bash qutebrowser_install.sh`


pip (python dependencies):


`wget -O pip_install.sh 'https://raw.githubusercontent.com/wikimatze/dotfiles/master/scripts/pip_install.sh' && bash pip_install.sh`


simplescreenrecorder (screencasting tool):


`wget -O simplescreenrecorder_install.sh 'https://raw.githubusercontent.com/wikimatze/dotfiles/master/scripts/simplescreenrecorder_install.sh' && bash simplescreenrecorder_install.sh`


tig (git diff like tool):


`wget -O tig_install.sh 'https://raw.githubusercontent.com/wikimatze/dotfiles/master/scripts/tig_install.sh' && bash tig_install.sh`


ttygif (generate gifs out of your commandline):


`wget -O ttygif_install.sh 'https://raw.githubusercontent.com/wikimatze/dotfiles/master/scripts/ttygif_install.sh' && bash ttygif_install.sh`


zathura (pdf viewer mostly for my latex projects):


`wget -O zathura_install.sh 'https://raw.githubusercontent.com/wikimatze/dotfiles/master/scripts/zathura_install.sh' && bash zathura_install.sh`

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

