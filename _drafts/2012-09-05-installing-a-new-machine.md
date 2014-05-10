---
layout: post
title: Installing a new machine
published: false
meta-description: ...
---
*When I'm installing a new machine, I have to fireup a bunch of commands to setup my working environment. This
article describes the steps I need perfom when installing a new machine.*


## Installing dropbox

Install [dropbox](https://www.dropbox.com/) - this is just my variant to sync data between different machine.
Of course I can also switch to a different sharing provider but that is actually the current standard


## Installing ubuntu packages

Next I need to install all the packages and programms I need for the new machine. All what I do is running:


```bash
$ bash $HOME/Dropbox/dotfiles/scripts/ubuntu_install.sh
```


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
You can find the original file for this part on GitHub [ubuntu_install.sh](https://github.com/matthias-guenther/dotfiles/blob/master/scripts/ubuntu_install.sh)


## Reboot your system

After applying all the changes to the systems, we need to restart our system with `sudo init 6`. After that, all should be
running and you should have a bunch of new programms installed on your machine. Now it's time to go on to the next step.


## Adding symlinks

Symlinks are great. They are a special type of a file that contains a reference to another file or directory. Creating a symlink
is easy:


```bash
ln -s target_path link_path
```


The `target_path` is the place to which the `link_path` points to when using the `link_path`.  All what I do is running:


```bash
$ bash $HOME/Dropbox/dotfiles/scripts/symlink_install.sh
```


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

You can find the original file for this part on GitHub [symlink_install.sh](https://github.com/matthias-guenther/dotfiles/blob/master/scripts/symlink_install.sh)


## Installing ctags

Because I want to browse the code I have to work with, I need to install [ctags](http://ctags.sourceforge.net/ "ctags source").
ctags is a program to tag file of names and other programming constructs (like method declaration, class constants declaration,
...).  Here is the command for this:


```bash
$ bash $HOME/Dropbox/dotfiles/scripts/ctags_install.sh
```


The contents of this file:


```bash
cp -r $HOME/Dropbox/ctags-5.8 $HOME/Downloads
sudo chmod -R 777 /usr/local/bin
sudo chmod -R 777 /usr/local/share
cd $HOME/Downloads
cd ctags-5.8
./configure
make
make install
cd $HOME/Downloads
rm -rf ctags-5.8
```

You can find this file for this part on GitHub
[ctags_install.sh](https://github.com/matthias-guenther/dotfiles/blob/master/scripts/ctags_install.sh)


## Installing ruby with rbenv


### Setup before installing different ruby versions

Here is the command for running the setup:


```bash
$ bash $HOME/Dropbox/dotfiles/scripts/rbenv_install_setup.sh
```


The contents of this file:


```bash
# Install rbenv

cd $HOME
sudo rm -rf .rbenv/
cd $HOME
git clone git://github.com/sstephenson/rbenv.git .rbenv

# Install rbenv-install

cd $HOME/Downloads
sudo rm -rf ruby-build
git clone git://github.com/sstephenson/ruby-build.git
cd ruby-build
sudo bash install.sh
```


You can find this file GitHub
[rbenv_install_setup.sh](https://github.com/matthias-guenther/dotfiles/blob/master/scripts/rbenv_install_setup.sh)


### Installing the different ruby versions

Since we setup rbenv, it's now time to install the different ruby versions. This step is the longest because every version is
compiled.

Here is the command for running the setup:


```bash
$ exec $SHELL
$ bash $HOME/Dropbox/dotfiles/scripts/rbenv_install.sh
```


The content of this file:


```bash
rbenv install 1.9.3-p286
rbenv rehash

rbenv install 1.9.2-p320
rbenv rehash

rbenv install 1.8.7-p358
rbenv rehash

rbenv global 1.9.2-p320
```


I'm using ruby version 1.9.2 (`rbenv global 1.9.2-p320`) because it is most compatible to most of the programms I'm using.

You can find this file GitHub
[rbenv_install.sh](https://github.com/matthias-guenther/dotfiles/blob/master/scripts/rbenv_install.sh)


### Installing the gems

After setting up the correct version of ruby, it's time to install the different gems.


Here is the command for running the setup:


```bash
$ bash $HOME/Dropbox/dotfiles/scripts/gem_install.sh
```


The content of this file:


```bash
gem install abstract actionmailer actionpack activemodel activerecord activeresource albino activesupport arel authlogic bluecloth builder bundler cgi_multipart_eof_fix classifier closure-compiler columnize compass configuration cucumber cucumber-rails daemons database_cleaner diff-lcs directory_watcher erubis extlib fast-stemmer fastthread ffi gem_plugin gherkin gli glynn gravatar haml highline hoe jammit jekyll jekyll-pagination jekyll_ext jekyll_generator json json_pure launchy linecache liquid log4r macaddr mail maruku memcache-client mime-types money net-sftp net-ssh nokogiri plist polyglot rack rack-mount rack-test rails railties rake rally_rest_api rb-inotify rdiscount RedCloth rest-client rspec rspec-core rspec-expectations rspec-mocks rspec-rails ruby-debug ruby-debug-base ruby-debug-ide ruby_parser rubyforge rubygems-update rubyzip showoff sinatra sqlite3 syntax SystemTimer templater term-ansicolor test-unit text-format thor tilt translate treetop tzinfo uuid webrat will_paginate xml-simple yui-compressor rb-fsevent hpricot ruby_parser wirble twitter autotest redgreen yard redcarpet org-ruby wikicloth github-markup pygmentize mechanize ruby-mp3info digestr autotest-rails-pure autotest-fsevent autotest-growl fuubar nanoc padrino sweetie simplificator-rwebthumb heroku pygments.rb faker vagrant vagrant-vbguest
```


You can find this file GitHub
[gem_install.sh](https://github.com/matthias-guenther/dotfiles/blob/master/scripts/gem_install.sh)


## Installing python

Before we are going to the final step and install vim, we need to install python. Here


Here is the command for running this script:


```bash
$ bash $HOME/Dropbox/dotfiles/scripts/python_install.sh
```


The content of this file:


```bash
mkdir $HOME/lib
cd $HOME/Downloads
wget http://www.python.org/ftp/python/2.7.3/Python-2.7.3.tar.bz2
tar xjvf Python-2.7.3.tar.bz2
cd Python-2.7.3
./configure --prefix=$HOME
make && make install
make inclinstall
hash -r

# cleanup
cd $HOME/Downloads
rm -rf Python-2.7.3
```


You can find this file GitHub
[python_install.sh](https://github.com/matthias-guenther/dotfiles/blob/master/bash_scripts/python_install.sh)


## Installing vim

Here is the command for running this script:


```bash
$ bash $HOME/Dropbox/dotfiles/jscripts/vim_install_linux.sh
```


The content of this file:


```bash
cd $HOME/Downloads
git clone https://github.com/b4winckler/vim
cd vim
git tag -l
git co v7-3-645

./configure --prefix=/usr/local \
  --enable-gui=no \
  --without-x \
  --disable-nls \
  --with-tlib=ncurses \
  --enable-multibyte \
  --enable-rubyinterp \
  --enable-pythoninterp \
  --with-python-config-dir=$HOME/lib/python2.7/config/ \
  --with-mac-arch=x86_64 \
  --with-features=huge \
  --enable-gui=gnome2

sudo make
sudo make install
sudo make clean
```


You can find this file GitHub
[vim_install_linux.sh](https://github.com/matthias-guenther/dotfiles/blob/master/scripts/vim_install_linux.sh)


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

