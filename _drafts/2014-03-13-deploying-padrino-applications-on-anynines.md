---
layout: post
title: Deploying Padrino Applications On Anynines
description: Beside writing an application it is very important to know how you can deploy it
categories: ['padrino', 'zsh']
---

{% include leanpub.html %}


(Note: This post is tested with [padrino 0.12.0](http://www.padrinorb.com/blog/padrino-0-12-0-activesupport-4-rewritten-reloader-smarter-rendering-and-loads-more), and [a9s 1.2.0](http://rubygems.org/gems/a9s/versions/1.2.0) gem)


## Installing The Gem

Getting anynines gem called a9s:


{% highlight bash %}

$ gem install a9s
Fetching: a9s-1.2.0.gem (100%)
Successfully installed a9s-1.2.0
Parsing documentation for a9s-1.2.0
Done installing documentation for a9s after 0 seconds
1 gem installed

{% endhighlight %}


## Hello Padrino In Anynines

Creating a new app:


{% highlight bash %}

$ padrino generate project padrino-hello-world-anynines
    create
    create  .gitignore
    ...
     force  .components

=================================================================
padrino-hello-world-anynines is ready for development!
=================================================================
$ cd ./padrino-hello-world-anynines
$ bundle
=================================================================

{% endhighlight %}


The next part is to create a route in `app/app.rb`:


{% highlight ruby %}

module PadrinoHelloWorldAnynines
  class App < Padrino::Application
    ...
    get "/" do
      "Hello Padrino On Heroku"
    end
  end
end

{% endhighlight %}


Before we are going to upload our application you need to sign up for a new account on [anynines](http://www.anynines.com/signups/new). After that you can login:


{% highlight bash %}

$ cf login
target: https://api.de.a9s.eu

Email> matthias@wikimatze.de

Password> ...

Authenticating... OK

{% endhighlight %}


Set up the target:


{% highlight bash %}

$ cf target
Setting target to https://api.de.a9s.eu... OK

Target Information (where will apps be pushed):
  CF instance: https://api.de.a9s.eu (API version: 2)
  user: matthias@wikimatze.de
  target app space: padrino-job-vacancy (org: matthias_wikimatze_de)

{% endhighlight %}


Push the application:


{% highlight bash %}

$ cf push
Name> padrino-hello-world-anynines

Instances> 1

1: 128M
2: 256M
3: 512M
4: 1G
Memory Limit> 256M

Creating padrino-hello-world-anynines... OK

1: padrino-hello-world-anynines
2: none
Subdomain> padrino-hello-world-anynines

1: de.a9sapp.eu
2: none
Domain> de.a9sapp.eu

Creating route padrino-hello-world-anynines.de.a9sapp.eu... OK
Binding padrino-hello-world-anynines.de.a9sapp.eu to padrino-hello-world-anynines... OK

Create services for application?> n

Bind other services to application?> n

Save configuration?> y

Saving to manifest.yml... OK
Uploading padrino-hello-world-anynines... OK
Preparing to start padrino-hello-world-anynines... OK
-----> Downloaded app package (12K)
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
Checking status of app 'padrino-hello-world-anynines'...Application failed to stage

{% endhighlight %}


Error, anynines needs to have a `Gemfile.lock`:


{% highlight bash %}

$ bundle
Fetching gem metadata from https://rubygems.org/.........
Fetching additional metadata from https://rubygems.org/..
Resolving dependencies...
Using rake (10.3.1)
...
Your bundle is complete!
Use `bundle show [gemname]` to see where a bundled gem is installed.

{% endhighlight %}


Let's try it again:


{% highlight bash %}

$ cf push
Uploading padrino-hello-world-anynines... OK
Stopping padrino-hello-world-anynines... OK

Preparing to start padrino-hello-world-anynines... OK
-----> Downloaded app package (12K)
-----> Downloaded app package (12K)
-----> Using Ruby version: ruby-1.9.3
-----> Installing dependencies using Bundler version 1.3.2
       Running: bundle install --without development:test --path vendor/bundle --binstubs vendor/bundle/bin --deployment
tps://rubygems.org/.........
       Fetching gem metadata from https://rubygems.org/..
       Installing rake (10.3.1)
       ...
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
       Installing rake (10.3.1)
       ...
       Your bundle is complete! It was installed into ./vendor/bundle
       Cleaning up the bundler cache.
-----> Writing config/database.yml to read from DATABASE_URL
-----> WARNINGS:
       You have not declared a Ruby version in your Gemfile.
       To set your Ruby version add this line to your Gemfile:"
       ruby '1.9.3'"
       # See https://devcenter.heroku.com/articles/ruby-versions for more information."
Checking status of app 'padrino-hello-world-anynines'....
  1 of 1 instances running (1 running)
Push successful! App 'padrino-hello-world-anynines' available at padrino-hello-world-anynines.de.a9sapp.eu

{% endhighlight %}


If you now visit [padrino-hello-world-anynines.de.a9sapp.eu](http://padrino-hello-world-anynines.de.a9sapp.eu/) you can see the "Hello Padrino" in the browser.


You find the code of this application on [GitHub](https://github.com/matthias-guenther/padrino-hello-world-anynines).


## Hello Padrino In Anynines With MySQL

Let's create a new application:


{% highlight bash %}

$ padrino g project project padrino-hello-world-anynines-mysql -d activerecord -a mysql
    create
    create  .gitignore
    ...
     force  .components

=================================================================
padrino-hello-world-anynines-mysql is ready for development!
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

Password> ....

Authenticating... OK

{% endhighlight %}


Now we need to setup a MySQL database:


{% highlight bash %}

$ cf push
Name> padrino-hello-world-anynines-mysql

Instances> 1

1: 128M
2: 256M
3: 512M
4: 1G
Memory Limit> 256M

Creating padrino-hello-world-anynines-mysql... OK

1: padrino-hello-world-anynines-mysql
2: none
Subdomain> padrino-hello-world-anynines-mysql

1: de.a9sapp.eu
2: none
Domain> de.a9sapp.eu

Creating route padrino-hello-world-anynines-mysql.de.a9sapp.eu... OK
Binding padrino-hello-world-anynines-mysql.de.a9sapp.eu to padrino-hello-world-anynines-mysql... OK

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

Name?> mysql-e4298

1: Mercury-5: Shared: 512 MB Ram, 5 GB Storage
2: Pluto-free: Shared VM, shared DB: free plan
3: Venus-20: Shared: 2 GB Ram, 20 GB Storage
Which plan?> 2

Creating service mysql-e4298... OK
Binding mysql-e4298 to padrino-hello-world-anynines-mysql... OK
Create another service?> n

Bind other services to application?> n

Save configuration?> y

Saving to manifest.yml... OK
Uploading padrino-hello-world-anynines-mysql... OK
Preparing to start padrino-hello-world-anynines-mysql... OK
-----> Downloaded app package (16K)
-----> Downloaded app package (16K)
-----> Using Ruby version: ruby-1.9.3
-----> Installing dependencies using Bundler version 1.3.2
       Running: bundle install --without development:test --path vendor/bundle --binstubs vendor/bundle/bin --deployment
tps://rubygems.org/.........
       Fetching gem metadata from https://rubygems.org/..
       Installing rake (10.3.1)
       ...
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
       Installing rake (10.3.1)
       ...
       Installing slim (2.0.2)
       Your bundle is complete! It was installed into ./vendor/bundle
       Cleaning up the bundler cache.
-----> Writing config/database.yml to read from DATABASE_URL
-----> WARNINGS:
       You have not declared a Ruby version in your Gemfile.
       To set your Ruby version add this line to your Gemfile:"
       ruby '1.9.3'"
       # See https://devcenter.heroku.com/articles/ruby-versions for more information."
Checking status of app 'padrino-hello-world-anynines-mysql'....
  1 of 1 instances running (1 running)
Push successful! App 'padrino-hello-world-anynines-mysql' available at padrino-hello-world-anynines-mysql.de.a9sapp.eu

{% endhighlight %}


Next, we need to find out the credentials for our database:


{% highlight bash %}

$ cf tunnel
1: mysql-e4298
Which service instance?> 1

1: none
2: mysql
3: mysqldump
Which client would you like to start?> 2

Opening tunnel on port 10000... OK
Waiting for local tunnel to become available... OK
'mysql' execution failed; is it in your $PATH?

{% endhighlight %}


You need to install a proper MySQL client like `mysql-client-5.5` under Ubuntu and try it again:


{% highlight bash %}

$ cf tunnel

1: mysql-e4298
Which service instance?> 1

1: none
2: mysql
3: mysqldump
Which client would you like to start?> 2

Opening tunnel on port 10000... FAILED
Time of crash:
  2014-05-06 06:53:52 +0200

RuntimeError: Remote tunnel helper is unaware of mysql-e4298!

cf-5.4.3/lib/tunnel/tunnel.rb:222:in `get_connection_info'
cf-5.4.3/lib/tunnel/tunnel.rb:35:in `open!'
cf-5.4.3/lib/tunnel/plugin.rb:41:in `block in tunnel'
interact-0.5.2/lib/interact/progress.rb:98:in `with_progress'
cf-5.4.3/lib/tunnel/plugin.rb:40:in `tunnel'
mothership-0.5.1/lib/mothership/base.rb:66:in `run'
mothership-0.5.1/lib/mothership/command.rb:72:in `block in invoke'
mothership-0.5.1/lib/mothership/command.rb:86:in `instance_exec'
mothership-0.5.1/lib/mothership/command.rb:86:in `invoke'
mothership-0.5.1/lib/mothership/base.rb:55:in `execute'
cf-5.4.3/lib/cf/cli.rb:195:in `block (2 levels) in execute'
cf-5.4.3/lib/cf/cli.rb:206:in `save_token_if_it_changes'
cf-5.4.3/lib/cf/cli.rb:194:in `block in execute'
cf-5.4.3/lib/cf/cli.rb:123:in `wrap_errors'
cf-5.4.3/lib/cf/cli.rb:190:in `execute'
mothership-0.5.1/lib/mothership.rb:45:in `start'
cf-5.4.3/bin/cf:18:in `<top (required)>'
/home/wikimatze/.gem/ruby/2.1.0/bin/cf:23:in `load'
/home/wikimatze/.gem/ruby/2.1.0/bin/cf:23:in `<main>'

{% endhighlight %}


This can happen, and another try:


{% highlight bash %}

$ cf tunnel
1: mysql-e4298
Which service instance?> 1

1: none
2: mysql
3: mysqldump
Which client would you like to start?> 2

Opening tunnel on port 10000... OK
Waiting for local tunnel to become available... OK
Welcome to the MySQL monitor.  Commands end with ; or \g.
Your MySQL connection id is 1565127
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
| d59423f34f20f4878a9ab9b2b886cf4a6 |
+-----------------------------------+
2 rows in set (0.34 sec)

mysql> use d59423f34f20f4878a9ab9b2b886cf4a6
Database changed
mysql> show tables;
Empty set (0.34 sec)
mysql> exit

{% endhighlight %}


But what we really need are the credentials:


{% highlight bash %}

cf tunnel
1: mysql-e4298
Which service instance?> 1

1: none
2: mysql
3: mysqldump
Which client would you like to start?> 1

Opening tunnel on port 10000... OK

Service connection info:
  username : uy343uAqNYg0z
  password : pbSSWIxA6JF19
  name     : d59423f34f20f4878a9ab9b2b886cf4a6
  uri      : mysql://uy343uAqNYg0z:pbSSWIxA6JF19@10.12.0.6:3307/d59423f34f20f4878a9ab9b2b886cf4a6


Open another shell to run command-line clients or
use a UI tool to connect using the displayed information.
Press Ctrl-C to exit...

{% endhighlight %}


With that, we ca add these credentials to the `config/database.rb` settings. Don't take the variables because chances
are high that you make mistakes. Instead try to use the `ENV["VCAP_SERVICES"]` variables:


{% highlight bash %}

ActiveRecord::Base.configurations[:production] = {
  :adapter   => 'mysql2',
  :encoding  => 'utf8',
  :reconnect => true,
  :database  => JSON.parse(ENV["VCAP_SERVICES"])["mysql-5.5"].first['credentials']['name'],
  :pool      => 5,
  :username  => JSON.parse(ENV["VCAP_SERVICES"])["mysql-5.5"].first['credentials']['username'],
  :password  => JSON.parse(ENV["VCAP_SERVICES"])["mysql-5.5"].first['credentials']['password'],
  :host      => JSON.parse(ENV["VCAP_SERVICES"])["mysql-5.5"].first['credentials']['hostname'],
  :port      => JSON.parse(ENV["VCAP_SERVICES"])["mysql-5.5"].first['credentials']['port']
}

{% endhighlight %}


Create a user model:


{% highlight bash %}

$ padrino g model users name:string email:text
  apply  orms/activerecord
  create  models/users.rb
  create  db/migrate/001_create_users.rb

{% endhighlight %}


And run the migrations:


{% highlight bash %}

$ cf push --command 'RACK_ENV=production bundle exec rake ar:migrate && bundle exec padrino start -p $PORT -h $VCAP_APP_HOST'

Using manifest file manifest.yml

Not applying manifest changes without --reset

Uploading padrino-hello-world-anynines-mysql... OK
Changes:
  command: '' -> 'RACK_ENV=production bundle exec rake ar:migrate && bundle exec padrino start -p $PORT -h $VCAP_APP_HOST'
Updating padrino-hello-world-anynines-mysql... OK
Stopping padrino-hello-world-anynines-mysql... OK

Preparing to start padrino-hello-world-anynines-mysql... OK
-----> Downloaded app package (16K)
-----> Downloaded app buildpack cache (11M)
-----> Downloaded app package (16K)
-----> Downloaded app buildpack cache (11M)
-----> Using Ruby version: ruby-1.9.3
-----> Installing dependencies using Bundler version 1.3.2
       Running: bundle install --without development:test --path vendor/bundle --binstubs vendor/bundle/bin --deployment
       Using rake (10.3.1)
       ...
       Using slim (2.0.2)
       Your bundle is complete! It was installed into ./vendor/bundle
       Cleaning up the bundler cache.
-----> Writing config/database.yml to read from DATABASE_URL
-----> WARNINGS:
       You have not declared a Ruby version in your Gemfile.
       To set your Ruby version add this line to your Gemfile:"
       ruby '1.9.3'"
       # See https://devcenter.heroku.com/articles/ruby-versions for more information."
Checking status of app 'padrino-hello-world-anynines-mysql'....
  0 of 1 instances running (1 starting)
  0 of 1 instances running (1 starting)
  1 of 1 instances running (1 running)
Push successful! App 'padrino-hello-world-anynines-mysql' available at padrino-hello-world-anynines-mysql.de.a9sapp.eu

{% endhighlight %}


First, the migration will be applied and then the application will be started.


Now we can check if the `users` table is in our database:


{% highlight bash %}

$ cf tunnel
1: mysql-e4298
Which service instance?> 1

1: none
2: mysql
3: mysqldump
Which client would you like to start?> 2

Opening tunnel on port 10000... OK
Waiting for local tunnel to become available... OK
Reading table information for completion of table and column names
You can turn off this feature to get a quicker startup with -A

Welcome to the MySQL monitor.  Commands end with ; or \g.
Your MySQL connection id is 1570790
Server version: 5.5.29-rel29.4 Percona Server with XtraDB (GPL), Release rel29.4, Revision 401

Copyright (c) 2000, 2013, Oracle and/or its affiliates. All rights reserved.

Oracle is a registered trademark of Oracle Corporation and/or its
affiliates. Other names may be trademarks of their respective
owners.

Type 'help;' or '\h' for help. Type '\c' to clear the current input statement.

mysql> use d59423f34f20f4878a9ab9b2b886cf4a6
Database changed
mysql> show tables;
+---------------------------------------------+
| Tables_in_d59423f34f20f4878a9ab9b2b886cf4a6 |
+---------------------------------------------+
| schema_migrations                           |
| users                                       |
+---------------------------------------------+
2 rows in set (0.33 sec)

mysql> SHOW COLUMNS FROM users;
+------------+--------------+------+-----+---------+----------------+
| Field      | Type         | Null | Key | Default | Extra          |
+------------+--------------+------+-----+---------+----------------+
| id         | int(11)      | NO   | PRI | NULL    | auto_increment |
| name       | varchar(255) | YES  |     | NULL    |                |
| email      | text         | YES  |     | NULL    |                |
| created_at | datetime     | YES  |     | NULL    |                |
| updated_at | datetime     | YES  |     | NULL    |                |
+------------+--------------+------+-----+---------+----------------+
5 rows in set (0.34 sec)


mysql> INSERT INTO users (name, email) VALUES('Matthias Günther', 'matthias@wikimatze.de');
Query OK, 1 row affected (0.35 sec)

mysql> SELECT * FROM users;
+----+-------------------+-----------------------+------------+------------+
| id | name              | email                 | created_at | updated_at |
+----+-------------------+-----------------------+------------+------------+
|  1 | Matthias Günther  | matthias@wikimatze.de | NULL       | NULL       |
+----+-------------------+-----------------------+------------+------------+
1 row in set (0.36 sec)

{% endhighlight %}


Finally, let's create a view with the entries in `app/app.rb`:


{% highlight ruby %}

module PadrinoHelloWorldAnyninesMysql
  class App < Padrino::Application
    ...
    get "/" do
      wikimatze = Users.find(1)
      "Hello #{wikimatze.name}, I know you email: #{wikimatze.email}"
    end
  end
end

{% endhighlight %}


If you now call [padrino-hello-world-anynines-mysql.de.a9sapp.eu/](http://padrino-hello-world-anynines-mysql.de.a9sapp.eu/) you can see the "Hello Matthias Günther, I know your email: matthias@wikimatze.de" in your browser.


You find the code of this application on [GitHub](https://github.com/matthias-guenther/padrino-hello-world-anynines-mysql).

