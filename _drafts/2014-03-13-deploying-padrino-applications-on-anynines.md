---
layout: post
title: Deploying Padrino Applications On Anynines
description: Beside writing an application it is very important to know how you can deploy it
categories: ['padrino', 'zsh']
---

{% include leanpub.html %}



(Note: This post is tested with [padrino 0.12.0](http://www.padrinorb.com/blog/padrino-0-12-0-activesupport-4-rewritten-reloader-smarter-rendering-and-loads-more), and [a9s 1.2.0](http://rubygems.org/gems/a9s/versions/1.2.0) gem)


## Installing The Gem


**Getting anynines gem called a9s:**


{% highlight bash %}

$ gem install a9s
Fetching: a9s-1.2.0.gem (100%)
Successfully installed a9s-1.2.0
Parsing documentation for a9s-1.2.0
Installing ri documentation for a9s-1.2.0
Done installing documentation for a9s after 0 seconds
1 gem installed

{% endhighlight %}


## Hello World In Anynines

Creating a new app:


{% highlight bash %}

$ padrino generate project hello-world-anynines
      create
      create  .gitignore
      create  config.ru
      create  config/apps.rb
      create  config/boot.rb
      create  public/favicon.ico
      create  public/images
      create  public/javascripts
      create  public/stylesheets
      create  tmp
      create  .components
      create  app
      create  app/app.rb
      create  app/controllers
      create  app/helpers
      create  app/views
      create  app/views/layouts
      create  Gemfile
      create  Rakefile
    skipping  orm component...
    skipping  test component...
    skipping  mock component...
    skipping  script component...
    applying  slim (renderer)...
       apply  renderers/slim
      insert  Gemfile
    skipping  stylesheet component...
   identical  .components
       force  .components
       force  .components

=================================================================
hello-world-anynines is ready for development!
=================================================================
$ cd ./hello-world-anynines
$ bundle
=================================================================

{% endhighlight %}


The next part is to create a route in `app/app.rb`:


{% highlight ruby %}

module HelloWorldHeroku
  class App < Padrino::Application
    ...
    get "/" do
      "Hello Padrino On Heroku"
    end
  end
end

{% endhighlight %}


First of all, we need to login:


{% highlight bash %}

$ cf login
target: https://api.de.a9s.eu

Email> matthias@wikimatze.de

Password> **********

Authenticating... OK

{% endhighlight %}


Next, we set up the target:


{% highlight bash %}

$ cf target https://api.de.a9s.eu
Setting target to https://api.de.a9s.eu... OK

Target Information (where will apps be pushed):
  CF instance: https://api.de.a9s.eu (API version: 2)
  user: matthias@wikimatze.de
  target app space: padrino-job-vacancy (org: matthias_wikimatze_de)

{% endhighlight %}


Next, we want to push our application:


{% highlight bash %}

$ cf push
Name> test

Save configuration?> y

Saving to manifest.yml... OK
Uploading test... OK
Stopping test... OK

Preparing to start test... OK
-----> Downloaded app package (12K)
-----> Downloaded app buildpack cache (7.6M)
 !
 !     Gemfile.lock required. Please check it in.
 !
/var/vcap/packages/dea_next/buildpacks/lib/installer.rb:16:in `compile': Buildpack compilation step failed: (RuntimeError)
        from /var/vcap/packages/dea_next/buildpacks/lib/buildpack.rb:79:in `block in compile_with_timeout'
        from /usr/lib/ruby/1.9.1/timeout.rb:68:in `timeout'
        from /var/vcap/packages/dea_next/buildpacks/lib/buildpack.rb:78:in `compile_with_timeout'
        from /var/vcap/packages/dea_next/buildpacks/lib/buildpack.rb:59:in `block in stage_application'
        from /var/vcap/packages/dea_next/buildpacks/lib/buildpack.rb:55:in `chdir'
        from /var/vcap/packages/dea_next/buildpacks/lib/buildpack.rb:55:in `stage_application'
        from /var/vcap/packages/dea_next/buildpacks/bin/run:10:in `<main>'
Checking status of app 'test'...Application failed to stage

{% endhighlight %}


Error, so anynines needs to have a `Gemfile.lock` file in the root folder:


{% highlight bash %}

$ bundle
Fetching gem metadata from https://rubygems.org/...........
Fetching additional metadata from https://rubygems.org/..
Resolving dependencies...
Using rake (10.1.1)
Using i18n (0.6.9)
Using minitest (4.7.5)
Installing multi_json (1.9.0)
Installing atomic (1.1.15)
Installing thread_safe (0.2.0)
Using tzinfo (0.3.38)
Installing activesupport (4.0.3)
Using bundler (1.5.1)
Using rack (1.5.2)
Using url_mount (0.2.1)
Installing http_router (0.11.1)
Using mime-types (1.25.1)
Installing polyglot (0.3.4)
Using treetop (1.4.15)
Using mail (2.5.4)
Using moneta (0.7.20)
Using rack-protection (1.5.2)
Using tilt (1.4.1)
Using sinatra (1.4.4)
Using thor (0.17.0)
Using padrino-core (0.12.0)
Using padrino-helpers (0.12.0)
Using padrino-admin (0.12.0)
Using padrino-cache (0.12.0)
Using padrino-gen (0.12.0)
Using padrino-mailer (0.12.0)
Using padrino (0.12.0)
Using temple (0.6.7)
Using slim (2.0.2)
Your bundle is complete!
Use `bundle show [gemname]` to see where a bundled gem is installed.

{% endhighlight %}


Now let's try it again:


{% highlight bash %}

$ cf push
Using manifest file manifest.yml

Uploading test... OK
Stopping test... OK

Preparing to start test... OK
-----> Downloaded app package (12K)
-----> Downloaded app buildpack cache (7.6M)
-----> Downloaded app package (12K)
-----> Downloaded app buildpack cache (7.6M)
-----> Using Ruby version: ruby-1.9.3
-----> Installing dependencies using Bundler version 1.3.2
       Running: bundle install --without development:test --path vendor/bundle --binstubs vendor/bundle/bin --deployment
gem metadata from https://rubygems.org/..
       Using rake (10.1.1)
       Using i18n (0.6.9)
       Installing minitest (4.7.5)
       Installing multi_json (1.9.0)
       Installing atomic (1.1.15)
       Installing thread_safe (0.2.0)
       Installing tzinfo (0.3.38)
       Installing activesupport (4.0.3)
       Using rack (1.5.2)
       Using url_mount (0.2.1)
       Installing http_router (0.11.1)
       Using mime-types (1.25.1)
       Installing polyglot (0.3.4)
       Using treetop (1.4.15)
       Using mail (2.5.4)
       Installing moneta (0.7.20)
       Using rack-protection (1.5.2)
       Using tilt (1.4.1)
       Using sinatra (1.4.4)
       Using thor (0.17.0)
       Installing padrino-core (0.12.0)
       Installing padrino-helpers (0.12.0)
       Installing padrino-admin (0.12.0)
       Installing padrino-cache (0.12.0)
       Using bundler (1.3.2)
       Installing padrino-gen (0.12.0)
       Installing padrino-mailer (0.12.0)
       Installing padrino (0.12.0)
       Using temple (0.6.7)
       Using slim (2.0.2)
       Your bundle is complete! It was installed into ./vendor/bundle
       Cleaning up the bundler cache.
       Removing padrino-gen (0.11.4)
       Removing padrino-core (0.11.4)
       Removing padrino (0.11.4)
       Removing polyglot (0.3.3)
       Removing padrino-mailer (0.11.4)
       Removing padrino-admin (0.11.4)
       Removing padrino-cache (0.11.4)
       Removing http_router (0.11.0)
       Removing activesupport (3.2.16)
       Removing padrino-helpers (0.11.4)
       Removing multi_json (1.8.4)
-----> Writing config/database.yml to read from DATABASE_URL
-----> WARNINGS:
       You have not declared a Ruby version in your Gemfile.
       To set your Ruby version add this line to your Gemfile:"
       ruby '1.9.3'"
       # See https://devcenter.heroku.com/articles/ruby-versions for more information."
gem metadata from https://rubygems.org/..
       Using rake (10.1.1)
       Using i18n (0.6.9)
       Installing minitest (4.7.5)
       Installing multi_json (1.9.0)
       Installing atomic (1.1.15)
       Installing thread_safe (0.2.0)
       Installing tzinfo (0.3.38)
       Installing activesupport (4.0.3)
       Using rack (1.5.2)
       Using url_mount (0.2.1)
       Installing http_router (0.11.1)
       Using mime-types (1.25.1)
       Installing polyglot (0.3.4)
       Using treetop (1.4.15)
       Using mail (2.5.4)
       Installing moneta (0.7.20)
       Using rack-protection (1.5.2)
       Using tilt (1.4.1)
       Using sinatra (1.4.4)
       Using thor (0.17.0)
       Installing padrino-core (0.12.0)
       Installing padrino-helpers (0.12.0)
       Installing padrino-admin (0.12.0)
       Installing padrino-cache (0.12.0)
       Using bundler (1.3.2)
       Installing padrino-gen (0.12.0)
       Installing padrino-mailer (0.12.0)
       Installing padrino (0.12.0)
       Using temple (0.6.7)
       Using slim (2.0.2)
       Your bundle is complete! It was installed into ./vendor/bundle
       Cleaning up the bundler cache.
       Removing padrino-gen (0.11.4)
       Removing padrino-core (0.11.4)
       Removing padrino (0.11.4)
       Removing polyglot (0.3.3)
       Removing padrino-mailer (0.11.4)
       Removing padrino-admin (0.11.4)
       Removing padrino-cache (0.11.4)
       Removing http_router (0.11.0)
       Removing activesupport (3.2.16)
       Removing padrino-helpers (0.11.4)
       Removing multi_json (1.8.4)
-----> Writing config/database.yml to read from DATABASE_URL
-----> WARNINGS:
       You have not declared a Ruby version in your Gemfile.
       To set your Ruby version add this line to your Gemfile:"
       ruby '1.9.3'"
       # See https://devcenter.heroku.com/articles/ruby-versions for more information."
Checking status of app 'test'...
  1 of 1 instances running (1 running)
Push successful! App 'test' available at testt.de.a9sapp.eu

{% endhighlight %}


If you now call [http://testt.de.a9sapp.eu/](http://testt.de.a9sapp.eu/) you can see the "Hello world" in the browser.



## Database Deployments With Anynines


Let's create a new application:


{% highlight bash %}

$ padrino g project hello-world-anynines-mysql -d activerecord -a mysql
    create
    create  .gitignore
    create  config.ru
    create  config/apps.rb
    create  config/boot.rb
    create  public/favicon.ico
    create  public/images
    create  public/javascripts
    create  public/stylesheets
    create  tmp
    create  .components
    create  app
    create  app/app.rb
    create  app/controllers
    create  app/helpers
    create  app/views
    create  app/views/layouts
    create  Gemfile
    create  Rakefile
  applying  activerecord (orm)...
     apply  orms/activerecord
    insert  Gemfile
    insert  Gemfile
    insert  app/app.rb
    create  config/database.rb
  skipping  test component...
  skipping  mock component...
  skipping  script component...
  applying  slim (renderer)...
     apply  renderers/slim
    insert  Gemfile
  skipping  stylesheet component...
 identical  .components
     force  .components
     force  .components

=================================================================
hello-world-anynines-mysql is ready for development!
=================================================================
$ cd ./hello-world-anynines-mysql
$ bundle
=================================================================

{% endhighlight %}


After running `bundle` to generate the `Gemfile.lock`, you need to login:


{% highlight bash %}

$ cf login
target: https://api.de.a9s.eu

Email> matthias@wikimatze.de

Password> **********

Authenticating... OK

{% endhighlight %}


Next we need to see the credentials for one of our databases:


Now, we are ready to deploy our app:


{% highlight bash %}

$ cf push
Name> anynines-padrino-mysql

Instances> 1

1: 128M
2: 256M
3: 512M
4: 1G
Memory Limit> 256M

Creating anynines-padrino-mysql... OK

1: anynines-padrino-mysql
2: none
Subdomain> anynines-padrino-mysql

1: de.a9sapp.eu
2: none
Domain> de.a9sapp.eu

Creating route anynines-padrino-mysql.de.a9sapp.eu... OK
Binding anynines-padrino-mysql.de.a9sapp.eu to anynines-padrino-mysql... OK

Create services for application?> y

1: elasticsearch 0.20
2: mongodb 2.0
3: mysql 5.5
4: postgresql 9.1
5: rabbitmq 2.8
6: redis 2.2
7: swift 1.0
8: user-provided , via
What kind?> 3

Name?> mysql-e26e2

1: Pluto-free: Shared VM, shared DB: free plan
2: Venus-20: Shared: 2 GB Ram, 20 GB Storage
Which plan?> 1

Creating service mysql-e26e2... OK
Binding mysql-e26e2 to anynines-padrino-mysql... OK
Create another service?> n

Bind other services to application?> n

Save configuration?> y

Saving to manifest.yml... OK
Uploading anynines-padrino-mysql... OK
Preparing to start anynines-padrino-mysql... OK
-----> Downloaded app package (12K)
-----> Downloaded app package (12K)
-----> Using Ruby version: ruby-1.9.3
-----> Installing dependencies using Bundler version 1.3.2
       Running: bundle install --without development:test --path vendor/bundle --binstubs vendor/bundle/bin --deployment
tps://rubygems.org/.........
       Fetching gem metadata from https://rubygems.org/..
       Installing rake (10.1.1)
       Installing i18n (0.6.9)
       Installing minitest (4.7.5)
       Installing multi_json (1.9.0)
       Installing atomic (1.1.16)
       Installing thread_safe (0.2.0)
       Installing tzinfo (0.3.39)
       Installing activesupport (4.0.4)
       Installing builder (3.1.4)
       Installing activemodel (4.0.4)
       Installing activerecord-deprecated_finders (1.0.3)
       Installing arel (4.0.2)
       Installing activerecord (4.0.4)
       Installing rack (1.5.2)
       Installing url_mount (0.2.1)
       Installing http_router (0.11.1)
       Installing mime-types (1.25.1)
       Installing polyglot (0.3.4)
       Installing treetop (1.4.15)
       Installing mail (2.5.4)
       Installing moneta (0.7.20)
       Installing mysql2 (0.3.15)
       Installing rack-protection (1.5.2)
       Installing tilt (1.4.1)
       Installing sinatra (1.4.4)
       Installing thor (0.17.0)
       Installing padrino-core (0.12.0)
       Installing padrino-helpers (0.12.0)
       Installing padrino-admin (0.12.0)
       Installing padrino-cache (0.12.0)
       Using bundler (1.3.2)
       Installing padrino-gen (0.12.0)
       Installing padrino-mailer (0.12.0)
       Installing padrino (0.12.0)
       Installing temple (0.6.7)
       Installing slim (2.0.2)
       Your bundle is complete! It was installed into ./vendor/bundle
       Cleaning up the bundler cache.
-----> Writing config/database.yml to read from DATABASE_URL
-----> WARNINGS:
       You have not declared a Ruby version in your Gemfile.
       To set your Ruby version add this line to your Gemfile:"
       ruby '1.9.3'"
       # See https://devcenter.heroku.com/articles/ruby-versions for more information."
tps://rubygems.org/.........
       Fetching gem metadata from https://rubygems.org/..
       Installing rake (10.1.1)
       Installing i18n (0.6.9)
       Installing minitest (4.7.5)
       Installing multi_json (1.9.0)
       Installing atomic (1.1.16)
       Installing thread_safe (0.2.0)
       Installing tzinfo (0.3.39)
       Installing activesupport (4.0.4)
       Installing builder (3.1.4)
       Installing activemodel (4.0.4)
       Installing activerecord-deprecated_finders (1.0.3)
       Installing arel (4.0.2)
       Installing activerecord (4.0.4)
       Installing rack (1.5.2)
       Installing url_mount (0.2.1)
       Installing http_router (0.11.1)
       Installing mime-types (1.25.1)
       Installing polyglot (0.3.4)
       Installing treetop (1.4.15)
       Installing mail (2.5.4)
       Installing moneta (0.7.20)
       Installing mysql2 (0.3.15)
       Installing rack-protection (1.5.2)
       Installing tilt (1.4.1)
       Installing sinatra (1.4.4)
       Installing thor (0.17.0)
       Installing padrino-core (0.12.0)
       Installing padrino-helpers (0.12.0)
       Installing padrino-admin (0.12.0)
       Installing padrino-cache (0.12.0)
       Using bundler (1.3.2)
       Installing padrino-gen (0.12.0)
       Installing padrino-mailer (0.12.0)
       Installing padrino (0.12.0)
       Installing temple (0.6.7)
       Installing slim (2.0.2)
       Your bundle is complete! It was installed into ./vendor/bundle
       Cleaning up the bundler cache.
-----> Writing config/database.yml to read from DATABASE_URL
-----> WARNINGS:
       You have not declared a Ruby version in your Gemfile.
       To set your Ruby version add this line to your Gemfile:"
       ruby '1.9.3'"
       # See https://devcenter.heroku.com/articles/ruby-versions for more information."
Checking status of app 'anynines-padrino-mysql'...
  0 of 1 instances running (1 starting)
  1 of 1 instances running (1 running)
Push successful! App 'anynines-padrino-mysql' available at anynines-padrino-mysql.de.a9sapp.eu

{% endhighlight %}


Next, we need to find out the credentials for our database:


{% highlight bash %}

$ cf tunnel
1: mysql-e26e2
Which service instance?> 1

1: none
2: mysql
3: mysqldump
Which client would you like to start?> 2

Opening tunnel on port 10000... OK
Waiting for local tunnel to become available... OK
'mysql' execution failed; is it in your $PATH?

{% endhighlight %}


I need to install a proper mysql client with `sudo apt-get install mysql-client-5.5`. Now we need to get the credentials
of the database:


{% highlight bash %}

$ cf tunnel
1: mysql-e26e2
Which service instance?> 1

1: none
2: mysql
3: mysqldump
Which client would you like to start?> 2

Opening tunnel on port 10000... OK
Waiting for local tunnel to become available... OK
Welcome to the MySQL monitor.  Commands end with ; or \g.
Your MySQL connection id is 523597
Server version: 5.5.29-rel29.4 Percona Server with XtraDB (GPL), Release rel29.4, Revision 401

Copyright (c) 2000, 2013, Oracle and/or its affiliates. All rights reserved.

Oracle is a registered trademark of Oracle Corporation and/or its
affiliates. Other names may be trademarks of their respective
owners.

Type 'help;' or '\h' for help. Type '\c' to clear the current input statement.

mysql> show databases;
+-----------------------------------+
| Database                          |
+-----------------------------------+
| information_schema                |
| d52372f354f604616a03cce4680a8e126 |
+-----------------------------------+
2 rows in set (0.30 sec)

mysql> exit

{% endhighlight %}


But what we really need are the credentials:


{% highlight bash %}

1: mysql-e26e2
Which service instance?> 1

1: none
2: mysql
3: mysqldump
Which client would you like to start?> 1

Opening tunnel on port 10000... OK

Service connection info:
  username : utpQSWCohARgN
  password : ps8YnASnVGJIS
  name     : d52372f354f604616a03cce4680a8e126
  uri      : mysql://utpQSWCohARgN:ps8YnASnVGJIS@10.12.0.6:3307/d52372f354f604616a03cce4680a8e126


Open another shell to run command-line clients or
use a UI tool to connect using the displayed information.
Press Ctrl-C to exit...

{% endhighlight %}



And now edit `config/database.rb` with the following settings:


{% highlight bash %}

ActiveRecord::Base.configurations[:production] = {
  :adapter   => 'mysql2',
  :encoding  => 'utf8',
  :reconnect => true,
  :database  => 'd52372f354f604616a03cce4680a8e126',
  :pool      => 5,
  :username  => 'utpQSWCohARgN',
  :password  => 'ps8YnASnVGJIS',
  :host      => '10.12.0.6',
  :socket    => '/tmp/mysql.sock'
}

{% endhighlight %}



And run the migrations:


{% highlight bash %}

$ cf push --command "PADRINO_ENV=production bundle exec rake ar:migrate"
Using manifest file manifest.yml

Not applying manifest changes without --reset

Uploading anynines-padrino-mysql... OK
Changes:
  command: '' -> 'PADRINO_ENV=production bundle exec rake ar:migrate'
Updating anynines-padrino-mysql... OK
Stopping anynines-padrino-mysql... OK

Preparing to start anynines-padrino-mysql... OK
-----> Downloaded app package (16K)
-----> Downloaded app buildpack cache (9.9M)
-----> Downloaded app package (16K)
-----> Downloaded app buildpack cache (9.9M)
r version 1.3.2
       Running: bundle install --without development:test --path vendor/bundle --binstubs vendor/bundle/bin --deployment
       Using rake (10.1.1)
       Using i18n (0.6.9)
       Using minitest (4.7.5)
       Using multi_json (1.9.0)
       Using atomic (1.1.16)
       Using thread_safe (0.2.0)
       Using tzinfo (0.3.39)
       Using activesupport (4.0.4)
       Using builder (3.1.4)
       Using activemodel (4.0.4)
       Using activerecord-deprecated_finders (1.0.3)
       Using arel (4.0.2)
       Using activerecord (4.0.4)
       Using rack (1.5.2)
       Using url_mount (0.2.1)
       Using http_router (0.11.1)
       Using mime-types (1.25.1)
       Using polyglot (0.3.4)
       Using treetop (1.4.15)
       Using mail (2.5.4)
       Using moneta (0.7.20)
       Using mysql2 (0.3.15)
       Using rack-protection (1.5.2)
       Using tilt (1.4.1)
       Using sinatra (1.4.4)
       Using thor (0.17.0)
       Using padrino-core (0.12.0)
       Using padrino-helpers (0.12.0)
       Using padrino-admin (0.12.0)
       Using padrino-cache (0.12.0)
       Using bundler (1.3.2)
       Using padrino-gen (0.12.0)
       Using padrino-mailer (0.12.0)
       Using padrino (0.12.0)
       Using temple (0.6.7)
       Using slim (2.0.2)
       Your bundle is complete! It was installed into ./vendor/bundle
       Cleaning up the bundler cache.
-----> Writing config/database.yml to read from DATABASE_URL
-----> WARNINGS:
       You have not declared a Ruby version in your Gemfile.
       To set your Ruby version add this line to your Gemfile:"
       ruby '1.9.3'"
       # See https://devcenter.heroku.com/articles/ruby-versions for more information."
-----> Uploading droplet (27M)
Checking status of app 'anynines-padrino-mysql'...
  0 of 1 instances running (1 starting)
  0 of 1 instances running (1 starting)
  0 of 1 instances running (1 starting)
  0 of 1 instances running (1 starting)
  0 of 1 instances running (1 starting)
  0 of 1 instances running (1 crashing)
Push unsuccessful.
TIP: The system will continue to attempt restarting all requested app instances that have crashed. Try 'cf app' to monitor app status. To troubleshoot crashes, try 'cf events' and 'cf crashlogs'.

{% endhighlight %}


You can find the code https://github.com/matthias-guenther/hello-world-padrino-anynines-mysql

