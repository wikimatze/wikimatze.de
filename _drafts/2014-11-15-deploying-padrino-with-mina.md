---
title: Deploying Padrino with Mina
description: Deploying Padrino with Mina
categories: padrino deployment
---

{% include leanpub.html %}

{% include newsletter.html %}


## Tools and installation

[Virtualbox](https://www.virtualbox.org/ "Virtualbox") for managing virtual machines:


```sh
$ wget http://download.virtualbox.org/virtualbox/4.3.18/virtualbox-4.3_4.3.18-96516~Ubuntu~raring_amd64.deb && sudo dpkg -i virtualbox-*
```


[Vagrant](https://www.vagrantup.com/ "Vagrant") for creating a virtual machines:


```sh
$ wget https://dl.bintray.com/mitchellh/vagrant/vagrant_1.6.5_x86_64.deb && sudo dpkg -i vagrant*.deb
```


[Mina](http://mina-deploy.github.io/mina/ "Mina") for the deployment:


```sh
gem install mina
```


## Configuration and running the virtual machine

`vagrant init` will create a basic `Vagrantfile` with a lot text and configuration inside. We need:

- `config.vm.box` setting to set a basic image for the machine
- `config.vm.network` setting to Create a private network, which allows host-only access to the machine using a specific IP
- `config.ssh.forward_agent` setting to forward running apps on the virtual machine to our host
- `config.vm.provision` setting to run a shell script for installing the basic setup


The final config of the `Vagrantfile`:


```ruby
# -*- mode: ruby -*-
# vi: set ft=ruby :

# Vagrantfile API/syntax version. Don't touch unless you know what you're doing!
VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
  # Every Vagrant virtual environment requires a box to build off of.
  config.vm.box = "hashicorp/precise64"
  config.vm.hostname = "machine-one"

  # Create a private network, which allows host-only access to the machine
  # using a specific IP.
  config.vm.network "private_network", ip: "192.168.50.4"

  # If true, then any SSH connections made will enable agent forwarding.
  # Default value: false
  config.ssh.forward_agent = true

  config.vm.provider "virtualbox" do |vb|
    # Don't boot with headless mode
    vb.gui = false

    vb.customize ["modifyvm", :id, "--memory", "512"]
  end

  config.vm.provision :shell, path: 'bootstrap.sh', keep_color: true
end
```


The content of the `bootstrap.sh` file:


```sh
#!/bin/bash

# The output of all these installation steps is noisy. With this utility
# the progress report is nice and concise.
function installing {
  echo "installing $1"
  shift
  apt-get -y install "$@" >/dev/null 2>&1
}

echo "Updating package information"
apt-get -y update >/dev/null 2>&1

installing 'development tools' build-essential

installing 'Git vcm' git
installing 'SQLite tool' sqlite3 libsqlite3-dev
installing 'Vim editor' vim

echo "Install Ruby"
cd /tmp && rm -rf ruby-install && git clone https://github.com/postmodern/ruby-install.git >/dev/null 2>&1
cd ruby-install && sudo make install >/dev/null 2>&1
cd /tmp && rm -rf chruby && git clone https://github.com/postmodern/chruby.git >/dev/null 2>&1
cd chruby && sudo make install >/dev/null 2>&1
ruby-install ruby 2.1.5 >/dev/null 2>&1

echo "source /usr/local/share/chruby/chruby.sh" >> /home/vagrant/.bashrc
echo "chruby 2.1.5" >> /home/vagrant/.bashrc

# Switching to ruby 2.1.5 so that gems are installed the right way
source /usr/local/share/chruby/chruby.sh
chruby 2.1.5

echo "Install bundler and padrino "
gem install bundler --no-document
gem install padrino
```


Now we can create the virtual machine with `vagrant up`:


```sh
$ vagrant up
Bringing machine 'default' up with 'virtualbox' provider...
==> default: Importing base box 'hashicorp/precise64'...
==> default: Matching MAC address for NAT networking...
==> default: Checking if box 'hashicorp/precise64' is up to date...
==> default: Setting the name of the VM: vagrant_one_default_1416040654204_20149
==> default: Clearing any previously set network interfaces...
==> default: Preparing network interfaces based on configuration...
    default: Adapter 1: nat
    default: Adapter 2: hostonly
==> default: Forwarding ports...
    default: 22 => 2222 (adapter 1)
==> default: Running 'pre-boot' VM customizations...
==> default: Booting VM...
==> default: Waiting for machine to boot. This may take a few minutes...
    default: SSH address: 127.0.0.1:2222
    default: SSH username: vagrant
    default: SSH auth method: private key
    default: Warning: Remote connection disconnect. Retrying...
==> default: Machine booted and ready!
==> default: Checking for guest additions in VM...
    default: The guest additions on this VM do not match the installed version of
    default: VirtualBox! In most cases this is fine, but in rare cases it can
    default: prevent things such as shared folders from working properly. If you see
    default: shared folder errors, please make sure the guest additions within the
    default: virtual machine match the version of VirtualBox you have installed on
    default: your host and reload your VM.
    default:
    default: Guest Additions Version: 4.2.0
    default: VirtualBox Version: 4.3
==> default: Setting hostname...
==> default: Configuring and enabling network interfaces...
==> default: Mounting shared folders...
    default: /vagrant => /home/wm/git-repositories/vagrant_one
==> default: Running provisioner: shell...
    default: Running: /tmp/vagrant-shell20141115-27026-ojdr3g.sh
==> default: stdin: is not a tty
==> default: Updating package information
==> default: installing development tools
==> default: installing Git
==> default: installing SQLite
==> default: installing Vim
==> default: Install Ruby
...
```


Now you can login with `vagrant ssh` into the machine. You can check the ip of the machine under `/etc/network/interfaces`:


```sh
# This file describes the network interfaces available on your system
# and how to activate them. For more information, see interfaces(5).

# The loopback network interface
auto lo
iface lo inet loopback

# The primary network interface
auto eth0
iface eth0 inet dhcp
#VAGRANT-BEGIN
# The contents below are automatically generated by Vagrant. Do not modify.
auto eth1
iface eth1 inet static
      address 192.168.50.4
      netmask 255.255.255.0
#VAGRANT-END
```


You can ping the machine from your host system to check if you can deploy the machine:


```sh
$ ping 192.168.50.4
  PING 192.168.50.4 (192.168.50.4) 56(84) bytes of data.
  64 bytes from 192.168.50.4: icmp_seq=1 ttl=64 time=0.268 ms
  64 bytes from 192.168.50.4: icmp_seq=2 ttl=64 time=0.379 ms
  64 bytes from 192.168.50.4: icmp_seq=3 ttl=64 time=0.384 ms

  --- 192.168.50.4 ping statistics ---
  3 packets transmitted, 3 received, 0% packet loss, time 2000ms
  rtt min/avg/max/mdev = 0.268/0.343/0.384/0.057 ms
```


# Create an app and configure mina for the deployment

Create an Padrino app with the following command: `padrino generate project -a sqlite -d activerecord -t steak test`, after that go into the directory and run `mina init`:


```sh
$ mina init
-----> Created ./config/deploy.rb
       Edit this file, then run `mina setup` after.
```


Let's have a look into the generated `deploy.rb` file:


{% highlight ruby linenos %}
require 'mina/bundler'
require 'mina/rails'
require 'mina/git'
# require 'mina/rbenv'  # for rbenv support. (http://rbenv.org)
# require 'mina/rvm'    # for rvm support. (http://rvm.io)

# Basic settings:
#   domain       - The hostname to SSH to.
#   deploy_to    - Path to deploy into.
#   repository   - Git repo to clone from. (needed by mina/git)
#   branch       - Branch name to deploy. (needed by mina/git)

set :domain, 'foobar.com'
set :deploy_to, '/var/www/foobar.com'
set :repository, 'git://...'
set :branch, 'master'

# For system-wide RVM install.
#   set :rvm_path, '/usr/local/rvm/bin/rvm'

# Manually create these paths in shared/ (eg: shared/config/database.yml) in your server.
# They will be linked in the 'deploy:link_shared_paths' step.
set :shared_paths, ['config/database.yml', 'log']

# Optional settings:
#   set :user, 'foobar'    # Username in the server to SSH to.
#   set :port, '30000'     # SSH port number.
#   set :forward_agent, true     # SSH forward_agent.

# This task is the environment that is loaded for most commands, such as
# `mina deploy` or `mina rake`.
task :environment do
  # If you're using rbenv, use this to load the rbenv environment.
  # Be sure to commit your .rbenv-version to your repository.
  # invoke :'rbenv:load'

  # For those using RVM, use this to load an RVM version@gemset.
  # invoke :'rvm:use[ruby-1.9.3-p125@default]'
end

# Put any custom mkdir's in here for when `mina setup` is ran.
# For Rails apps, we'll make some of the shared paths that are shared between
# all releases.
task :setup => :environment do
  queue! %[mkdir -p "#{deploy_to}/#{shared_path}/log"]
  queue! %[chmod g+rx,u+rwx "#{deploy_to}/#{shared_path}/log"]

  queue! %[mkdir -p "#{deploy_to}/#{shared_path}/config"]
  queue! %[chmod g+rx,u+rwx "#{deploy_to}/#{shared_path}/config"]

  queue! %[touch "#{deploy_to}/#{shared_path}/config/database.yml"]
  queue  %[echo "-----> Be sure to edit '#{deploy_to}/#{shared_path}/config/database.yml'."]
end

desc "Deploys the current version to the server."
task :deploy => :environment do
  deploy do
    # Put things that will set up an empty directory into a fully set-up
    # instance of your project.
    invoke :'git:clone'
    invoke :'deploy:link_shared_paths'
    invoke :'bundle:install'
    invoke :'rails:db_migrate'
    invoke :'rails:assets_precompile'
    invoke :'deploy:cleanup'

    to :launch do
      queue "mkdir -p #{deploy_to}/#{current_path}/tmp/"
      queue "touch #{deploy_to}/#{current_path}/tmp/restart.txt"
    end
  end
end

# For help in making your deploy script, see the Mina documentation:
#
#  - http://nadarei.co/mina
#  - http://nadarei.co/mina/tasks
#  - http://nadarei.co/mina/settings
#  - http://nadarei.co/mina/helpers
{% endhighlight %}


The interesting part is on line 13 - 16 and 56 - 65. Line 13 - 16 is were we need to set the credentials for our machine:


```ruby
set :domain, '192.168.50.4'
set :deploy_to, '/home/vagrant/padrino-hello-world'
set :repository, 'https://github.com/wikimatze/job-vacancy.git'
set :branch, 'master'
```


Hmm, but that is still not enough. You login on the virtual machine with `vagrant ssh`. This command is an alias for:


```sh
ssh vagrant@192.168.50.4 -i ~/.vagrant.d/insecure_private_key
```


So we have to set the user and the ssh identity file:


```ruby
set :user, 'vagrant'
set :identity_file, "/home/wm/.vagrant.d/insecure_private_key"
```


Now we can run `mina setup` on the app:


```sh
% mina setup
-----> Setting up /home/vagrant/padrino-hello-world

       total 16
       drwxrwxr-x 4 vagrant vagrant 4096 Nov 15 18:09 .
       drwxr-xr-x 5 vagrant vagrant 4096 Nov 15 18:09 ..
       drwxrwxr-x 2 vagrant vagrant 4096 Nov 15 18:09 releases
       drwxrwxr-x 4 vagrant vagrant 4096 Nov 15 18:09 shared

-----> Done.
-----> Be sure to edit '/home/vagrant/padrino-hello-world/shared/config/database.yml'.
       Elapsed time: 0.13 seconds
```


Line 56 - 65 defines the build commands after the release. So it's up to you which commands you want to run after the deployment. We just want to deploy the code without any setup:


```ruby
desc "Deploys the current version to the server."
task :deploy => :environment do
  deploy do
    # Put things that will set up an empty directory into a fully set-up
    # instance of your project.
    invoke :'git:clone'
    invoke :'deploy:link_shared_paths'

    to :launch do
      queue "mkdir -p #{deploy_to}/#{current_path}/tmp/"
      queue "touch #{deploy_to}/#{current_path}/tmp/restart.txt"
    end
  end
end
```


Now you can run `mina deploy`:


```sh
$ mina deploy
-----> Creating a temporary build path
-----> Cloning the Git repository
       Cloning into bare repository '/home/vagrant/padrino-hello-world/scm'...
-----> Using git branch 'master'
       Cloning into '.'...
       done.
-----> Using this git commit

       Matthias Guenther (a416c3a):
       > Remove travis branch options

-----> Symlinking shared paths
-----> Build finished
-----> Moving build to releases/1
-----> Updating the current symlink
-----> Launching
-----> Done. Deployed v1
       Elapsed time: 2.88 seconds
```


## Sub tasks

We need to run `bundler` to install the dependencies for the application. Since mina is using rake to define task, we do the same:


```ruby

desc "Deploys the current version to the server."
task :deploy => :environment do
  deploy do
    # Put things that will set up an empty directory into a fully set-up
    # instance of your project.
    invoke :'git:clone'
    invoke :'deploy:link_shared_paths'
    invoke :'bundle'

    to :launch do
      queue "mkdir -p #{deploy_to}/#{current_path}/tmp/"
      queue "touch #{deploy_to}/#{current_path}/tmp/restart.txt"
    end
  end
end

task :bundle do
  status = %[
    echo "-----> Using bundler to install dependencies" &&
    cd "#{deploy_to}/current" &&
    /opt/rubies/ruby-2.1.5/bin/bundler
  ]

  queue status
end
```


Whenever you run now `mina deploy`, it will run the additional bundler step:


```sh
$ mina deploy
-----> Creating a temporary build path
-----> Fetching new git commits
-----> Using git branch 'master'
       Cloning into '.'...
       done.
-----> Using this git commit

       Matthias Guenther (a416c3a):
       > Remove travis branch options

-----> Symlinking shared paths
-----> Using bundler to install dependencies
       Fetching gem metadata from https://rubygems.org/.........
       Fetching git://github.com/nightsailer/padrino-sprockets.git
       Installing rake 10.1.1
       ...
       Your bundle is complete!
       Use `bundle show [gemname]` to see where a bundled gem is installed.
-----> Build finished
-----> Moving build to releases/2
-----> Updating the current symlink
-----> Launching
-----> Done. Deployed v2
       Elapsed time: 109.68 seconds
```


## Deployment on other several machines.

It's a good idea to have a staging system for the deployment. That means that you deploy the code on this machine first.  Copy your `Vagrantfile` and change the IP of the machine to `192.168.50.5`, run vagrant up and this generated machine will be your staging machine. Don't forget to change the `:domain` settings in the `config/deploy.rb` file to set up the deployment structure.


Mina has not any settings for multiple deployment. A simple idea is to pass a `to=staging` variable evaluate this
variable to decide on which platform you want to deploy:


```ruby
set :user, 'vagrant'
set :identity_file, "/home/wm/.vagrant.d/insecure_private_key"
set :deploy_to, '/home/vagrant/padrino-hello-world'
set :repository, 'https://github.com/wikimatze/job-vacancy.git'
set :branch, 'master'


case ENV['to']
when 'staging'
  set :domain, '192.168.50.5'
else
  set :domain, '192.168.50.4'
end
```


You can now run `mina deploy to=staging` to deploy the padrino application on your staging machine.


## Further reading

- [Automatic Deployment with Mina](http://lequochung.me/expressionengine-automatic-deployment-via-mina/#multiple-environments "Automatic Deployment with Mina")
- [Super Fast Deployment With Mina - Capistrano Alternative]( "Super Fast Deployment With Mina - Capistrano Alternative")
- [An Introduction To Deploying WordPress with Mina](http://code.tutsplus.com/articles/an-introduction-to-deploying-wordpress-with-mina--wp-34776 "An Introduction To Deploying WordPress with Mina")
- [How To Deploy With Mina: Getting Started](https://www.digitalocean.com/community/tutorials/how-to-deploy-with-mina-getting-started "How To Deploy With Mina: Getting Started")

