---
title: Compiling Vim from source for Ubuntu and Mac with ruby and python support
update: 2014-03-30
categories: ['vim', 'linux', 'ruby', 'howto']
---

*This article describes how to build [Vim](http://www.vim.org/) (vim and gvim) from the source and compile it against a predefined version of [ruby](http://www.ruby-lang.org/en/) installed with [rbenv](https://github.com/sstephenson/rbenv/). In the first chapter I'm describing how to build it from source for Ubuntu. The second part describes how to build for [MacVim](https://github.com/b4winckler/macvim/).*


By installing Vim with ruby support from the sources, it is build against the system wide installation of ruby.  If you already installed Vim and/or ruby with `sudo apt-get install vim` (or `sudo apt-get install ruby`) or with `brew install vim` (e.g.  `brew install ruby`) if you are using OS X, remove it completely from your system to install the latest version of Vim.


## Install rbenv

I'm installing *rbenv* on different machines I created the following script (named *rbenv_install.sh*) to install
**ruby 1.9.2-p320**:


{% highlight bash %}

cd $HOME
sudo rm -rf .rbenv
git clone git://github.com/sstephenson/rbenv.git .rbenv
echo 'export PATH="$HOME/.rbenv/bin:$PATH"' >> ~/.bash_profile

# install steps for rbenv-install command
cd $HOME/Downloads
sudo rm -rf ruby-build
git clone git://github.com/sstephenson/ruby-build.git
cd ruby-build
sudo bash install.sh

# updating the current shell
cd $HOME
exec $SHELL
source $HOME/.bash_profile

rbenv-install 1.9.2-p290
rbenv rehash
exec $SHELL

{% endhighlight %}


After this try the following:


{% highlight bash %}

$ rbenv global 1.9.2-p320
$ rbenv local 1.9.2-p320
$ ruby -v
=> ruby 1.9.2p320 (2012-04-20 revision 35421) [i686-linux]
{% endhighlight %}


## Get the latest version of Python

This will be put in the `$HOME/lib` folder:


{% highlight bash %}

cd /tmp
wget http://www.python.org/ftp/python/2.7.3/Python-2.7.3.tar.bz2
tar xjvf Python-2.7.3.tar.bz2
cd Python-2.7.3
./configure --prefix=$HOME
make && make install
make inclinstall
hash -r

# cleanup
cd /tmp && rm -rf Python-2.7.3


{% endhighlight %}


## Get the latest version of Vim

Visit [vim.org](http://www.vim.org/download.php/) and select the right download for your operation system (mainly Unix).
If you are using a Unix system yo can get the latest Vim from [here](ftp://ftp.vim.org/pub/vim/unix/), download and
unzip it:


{% highlight bash %}

$ cd $HOME/Downloads
$ wget ftp://ftp.vim.org/pub/vim/unix/vim-7.4.tar.bz2
$ tar -xjvf vim-7.4.tar.bz2

{% endhighlight %}


You can also get the latest Vim version from the git repository [https://github.com/b4winckler/vim](https://github.com/b4winckler/vim) and checkout the latest tag you want to have.


## Compiling Vim and Gvim

To install Gvim on Ubuntu we need to install additional packages on our machine. The following snippets describe the
packages for Ubuntu:


{% highlight bash %}

$ sudo apt-get install libncurses-dev libgnome2-dev \
 libgtk2.0-dev libatk1.0-dev libbonoboui2-dev libcairo2-dev \
 libx11-dev libxpm-dev libxt-dev

{% endhighlight %}


Next, we need to configure the compilation and make the install:


{% highlight bash %}

cd ~/git-repositories/vim && git checkout v7-4-183 && git clean -f

./configure --prefix=/usr/local \
  --without-x \
  --disable-nls \
  --enable-gui=no \
  --enable-multibyte \
  --enable-rubyinterp \
  --enable-luainterp \
  --enable-pythoninterp \
  --with-python-config-dir=$HOME/lib/python2.7/config \
  --enable-gui=gnome2 \
  --with-features=huge \
  --with-tlib=ncurses \

sudo make && sudo make install && sudo make clean

{% endhighlight %}


Let's get over the heavy stuff:


- `--prefix=/usr/local` - place of the binaries of the installed Vim installation (check the `/usr/local/bin`) - there
  will be the executable binaries
- `--enable-rubyinterp` - says you want to build Vim with the default ruby installation (in our case
  `/home/mg/.rbenv/shims/ruby`)
- `--enable-gui=gnome2` - building Vim with Gvim support (if you don't want Gvim than you can leave this line out)


After configuring the compilation check if the console response contains the following terms:


{% highlight bash %}

checking --with-ruby-command argument... defaulting to ruby
checking for ruby... (cached) /home/mg/.rbenv/shims/ruby
checking Ruby version... OK
checking Ruby header files... /home/mg/.rbenv/versions/1.9.2-p320/include/ruby-1.9.1

{% endhighlight %}


If you can't see the lovely **Ok**, your Vim compilation will probably not have ruby support. Maybe you have not installed ruby the right way or some packages are missing on your machine.


## Check the installation

Open a new session or perform `exec $SHELL` to reboot your Shell. You will see the fresh installed version of Vim:


{% highlight bash %}

$ which vim
/usr/local/bin/vim

$ which gvim
/usr/local/bin/gvim

{% endhighlight %}


Next check is to get the correct --version of `vim` and `gvim` with the following commands:


{% highlight bash %}

$ vim --version | ack ruby
$ vim --version | ack python
$ gvim --version | ack ruby
$ gvim --version | ack python

{% endhighlight %}


If both commands return **+ruby** and **+python**, you are fine, and got the achievement *"I installed vim form source
with ruby support on my own"*. You should now be able to run the
[Hammer.vim](https://github.com/matthias-guenther/hammer.vim) plugin - install it, start it with `:Hammer`, install the
missing gems and if you are able to run `:Hammer` without any missing dependencies, you have setup everything correct.


## Installing MacVim from source

The ways are nearly the same as mentioned above: Install rbenv as mentioned in the steps before.


{% highlight bash %}

$ cd $HOME/Download
$ git clone git://github.com/b4winckler/macvim.git

{% endhighlight %}


Next step is to **configure** MacVim for OSX:


{% highlight bash %}

$ cd macvim/src
$ ./configure --prefix=/usr/local \
              --with-features=huge \
              --enable-rubyinterp \
              --enable-pythoninterp \
              --enable-perlinterp \
              --enable-cscope

{% endhighlight %}


After configuring the compilation check the console response after the following terms:


{% highlight bash %}

checking --with-ruby-command argument... defaulting to ruby
checking for ruby... /Users/helex/.rbenv/shims/ruby
checking Ruby version... OK
checking Ruby header files... /Users/helex/.rbenv/versions/1.9.2-p320/include/ruby-1.9.1

{% endhighlight %}


When this is finished, it is time `build` MacVim with make:


{% highlight bash %}

$ make

{% endhighlight %}


Next step is to run the MacVim installation:


{% highlight bash %}

open MacVim/build/Release/MacVim.app

{% endhighlight %}


The window should open MacVim. Run the following command in the MacVim quickfix window:


{% highlight bash %}

:ruby puts "MacVim"

{% endhighlight %}


In the next step, you can drop the **MacVim.app** icon in your Application folder and you are done.


## Conclusion

It was a pain to gather the information for building vim by source with rbenv. Duration of finding that was: ~ **6 h**.
I'm not sure if all of this works on [RVM](https://rvm.beginrescueend.com/) - I just need additional feedback from
people using it. Happy *"Vim-ing"*!


## Further reading

- [Building Vim](http://vim.wikia.com/wiki/Building_Vim)
- [Vim with ruby support](http://arjanvandergaag.nl/blog/compiling-vim-with-ruby-support.html)
- [Building MacVim](https://github.com/b4winckler/macvim/wiki/Building)

