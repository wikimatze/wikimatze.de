---
title: Installing PostgreSQL gem under Ubuntu and Mac
date: 2012-02-26
update: 2014-12-20
categories: howto
---

*This article describes how to install the postgresql gem (called 'pg') under your local machine.  The installation process is not trivial because you need to install the right packages under Ubuntu/Linux or set the specify the correct path for Mac.*


I checked out a new rails app called [Brokenlifts](https://github.com/sozialhelden/brokenlift). Brokenlifts in public transportation are annoying and limit the mobility of people in wheelchairs. The app provides status information from different operators on one page and shows how well they are performing.


Ones I checked out the project I have detected that it uses [PostgreSQL](http://www.rhok.org/node/20654) as their database driver. I have never worked with it and I run into a couple of problems to get it running.


## The problem

A `$ gem install pg` brought me the following error message:


```bash
$ gem install pg
Building native extensions.  This could take a while...
/Users/helex/.rbenv/versions/1.9.2-p290/lib/ruby/site_ruby/1.9.1/rubygems/ext/builder.rb:48: warning: Insecure world writable dir /Users/helex/bin in PATH, mode 040777
ERROR:  Error installing pg:
	ERROR: Failed to build gem native extension.

        /Users/helex/.rbenv/versions/1.9.2-p290/bin/ruby extconf.rb
checking for pg_config... no
No pg_config... trying anyway. If building fails, please try again with
 --with-pg-config=/path/to/pg_config
checking for libpq-fe.h... no
Can't find the 'libpq-fe.h header
\*\*\* extconf.rb failed \*\*\*
Could not create Makefile due to some reason, probably lack of
necessary libraries and/or headers.  Check the mkmf.log file for more
details.  You may need configuration options.

Provided configuration options:
  --with-opt-dir
  --without-opt-dir
  --with-opt-include
  --without-opt-include=${opt-dir}/include
  --with-opt-lib
  --without-opt-lib=${opt-dir}/lib
  --with-make-prog
  --without-make-prog
  --srcdir=.
  --curdir
  --ruby=/Users/helex/.rbenv/versions/1.9.2-p290/bin/ruby
  --with-pg
  --without-pg
  --with-pg-dir
  --without-pg-dir
  --with-pg-include
  --without-pg-include=${pg-dir}/include
  --with-pg-lib
  --without-pg-lib=${pg-dir}/lib
  --with-pg-config
  --without-pg-config
  --with-pg_config
  --without-pg_config


Gem files will remain installed in /Users/helex/.rbenv/versions/1.9.2-p290/lib/ruby/gems/1.9.1/gems/pg-0.13.2 for inspection.
Results logged to /Users/helex/.rbenv/versions/1.9.2-p290/lib/ruby/gems/1.9.1/gems/pg-0.13.2/ext/gem_make.out
```


What relevant about the mess up there is the following part:


```bash
checking for pg_config... no
No pg_config... trying anyway. If building fails, please try again with
 --with-pg-config=/path/to/pg_config
checking for libpq-fe.h... no
```


Ruby can't find the relevant setting of the PostgreSQL installation. Let's change this!


## Solution for Mac

- install PostgreSQL library as described on the [PostgreSQL page](http://www.postgresql.org/download/macosx/) (opening the `*.dmg` file will install a bunch of stuff, so don't be afraid of the amount of steps you have to perform)
- check if you can find the installation open it under `/Library/PostgreSQL/x.y` - where x.y stands for the version you installed


Say you want to install the PostgreSQL manually with a `gem install` - you have to perform the following command:


```bash
$ sudo PATH=$PATH:/Library/PostgreSQL/x.y/bin gem install pg
```


If you want to install it with [Bundle](http://gembundler.com/), run the following command


```bash
$ sudo PATH=$PATH:/Library/PostgreSQL/x.y/bin bundle install
```


Please change the **x.y** with the version you have installed. Thats it!


If you have problems with `gcc`, please look into the [stackoverflow link](http://stackoverflow.com/questions/26486163/gcc-4-9-1-in-os-x-yosemite-gcc-warning-couldn-t-understand-kern-osversion-1/26609483#26609483 "stackoverflow link") - thanks [Asad](https://disqus.com/by/AsadAkbar/ "Asad").


## Solution for Ubuntu/Linux

It is easier because you only have to install the right packages:


```bash
sudo apt-get install postgresql
sudo apt-get install libpq-dev
```


Now `gem install pg` should work.


## Conclusion

It can be a really pain if you want to install gems and don't have the right dependencies on your machine but if you initially invest some time on the problem, you have your enlightenment.

