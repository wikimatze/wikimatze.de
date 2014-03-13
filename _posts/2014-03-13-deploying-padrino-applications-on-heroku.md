---
layout: post
title: Deploying Padrino Applications On Heroku
description: Beside writing an application it is very important to know how you can deploy it
categories: ['padrino', 'zsh']
---

{% include leanpub.html %}

{% include newsletter.html %}

I was always asking myself how I can use cloud services like [heroku](http://www.heroku.com/) to deploy Padrino applications without having an own server.


In this post I'm going to show you how you can a simple "Hello Padrino" app on heroku.ones without and ones with
database interactions.


(Note: This post is tested with [padrino 0.12.0](http://www.padrinorb.com/blog/padrino-0-12-0-activesupport-4-rewritten-reloader-smarter-rendering-and-loads-more), and [heroku-toolbelt/3.4.1](https://github.com/heroku/toolbelt/commit/d0fc05d6bf53b57505c1e9d9caa671ae57c357e3))


## Installing Heroku

{% highlight bash %}

$ gem install heroku
Fetching: heroku-3.4.2.gem (100%)
 !    The `heroku` gem has been deprecated and replaced with the Heroku Toolbelt.
 !    Download and install from: https://toolbelt.heroku.com
 !    For API access, see: https://github.com/heroku/heroku.rb
Successfully installed heroku-3.4.2
Parsing documentation for heroku-3.4.2
Installing ri documentation for heroku-3.4.2
Done installing documentation for heroku after 1 seconds
1 gem installed

{% endhighlight %}


Hmm, the method above is working but I highly recommend you to follow the installations instructions from [toolbelt.heroku.com](https://toolbelt.heroku.com/) page:


{% highlight bash %}

$ wget -qO- https://toolbelt.heroku.com/install-ubuntu.sh | sh

{% endhighlight %}


To check if everything went well, you can run the following command:


{% highlight bash %}

$ heroku version
heroku-toolbelt/3.4.1 (i686-linux) ruby/1.9.3

{% endhighlight %}


## Hello World

Creating a new app:


{% highlight bash %}

$ padrino generate project hello-world-heroku
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
hello-world-heroku is ready for development!
=================================================================
$ cd ./hello-world-heroku
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


Next, you need to setup your account on [heroku.com](https://id.heroku.com/login):


<a href="http://farm3.staticflickr.com/2236/13108475564_1a87877ac2_o.png" title="Hello Padrino on heroku" class="fancybox"><img src="http://farm3.staticflickr.com/2236/13108475564_a455e8599e_c.jpg" class="center" alt="Hello Padrion on heroku"/></a>


Next you need to click on "Create a new app":


<a href="http://farm8.staticflickr.com/7433/13108475924_98cc833ac7_o.png" title="New App On Heroku" class="fancybox"><img src="http://farm8.staticflickr.com/7433/13108475924_46d0af5eaa_c.jpg" class="center" alt="New App On Heroku"/></a>


Initialize an empty git repository, make an initial commit, and add the heroku remote:



{% highlight bash %}

$ cd hello-world-heroku
$ git init && git add . && git commit -m "Initial commit"
$ git remote add heroku git@heroku.com:hello-world-padrino.git

{% endhighlight %}


<a href="http://farm3.staticflickr.com/2332/13108476374_7870beaf76_c.jpg" title="The Path You Need" class="fancybox"><img src="http://farm3.staticflickr.com/2332/13108476374_601991fd40_o.png" class="center" alt="The Path You Need"/></a>



When everything is setup in the right way, you need to push:


{% highlight bash %}

$ git push --set-upstream heroku master
  Initializing repository, done.
  Counting objects: 15, done.
  Delta compression using up to 4 threads.
  Compressing objects: 100% (13/13), done.
  Writing objects: 100% (15/15), 7.88 KiB | 0 bytes/s, done.
  Total 15 (delta 0), reused 0 (delta 0)

  -----> Ruby app detected
  -----> Compiling Ruby/Rack
  -----> Using Ruby version: ruby-2.0.0
  -----> Installing dependencies using 1.5.2
         New app detected loading default bundler cache
         Running: bundle install --without development:test --path vendor/bundle --binstubs vendor/bundle/bin -j4 --deployment
         Fetching gem metadata from https://rubygems.org/.........
         Fetching additional metadata from https://rubygems.org/..
         Using minitest (4.7.5)
         Using i18n (0.6.9)
         Using rake (10.1.1)
         Using atomic (1.1.14)
         Using tzinfo (0.3.38)
         Using multi_json (1.8.4)
         Using mime-types (1.25.1)
         Using rack (1.5.2)
         Using tilt (1.4.1)
         Using bundler (1.5.2)
         Installing polyglot (0.3.3)
         Using thread_safe (0.1.3)
         Installing thor (0.17.0)
         Installing url_mount (0.2.1)
         Using treetop (1.4.15)
         Installing temple (0.6.7)
         Installing moneta (0.7.20)
         Using mail (2.5.4)
         Installing rack-protection (1.5.2)
         Installing http_router (0.11.0)
         Installing slim (2.0.2)
         Installing activesupport (4.0.2)
         Installing sinatra (1.4.4)
         Installing padrino-core (0.12.0)
         Installing padrino-helpers (0.12.0)
         Installing padrino-mailer (0.12.0)
         Installing padrino-cache (0.12.0)
         Installing padrino-admin (0.12.0)
         Installing padrino-gen (0.12.0)
         Installing padrino (0.12.0)
         Your bundle is complete!
         Gems in the groups development and test were not installed.
         It was installed into ./vendor/bundle
         Bundle completed (13.40s)
         Cleaning up the bundler cache.
  -----> Writing config/database.yml to read from DATABASE_URL
  -----> WARNINGS:
         You have not declared a Ruby version in your Gemfile.
         To set your Ruby version add this line to your Gemfile:
         ruby '2.0.0'
         # See https://devcenter.heroku.com/articles/ruby-versions for more information.
  -----> Discovering process types
         Procfile declares types -> (none)
         Default types for Ruby  -> console, rake, web

  -----> Compressing... done, 15.3MB
  -----> Launching... done, v4
         http://hello-world-padrino.herokuapp.com/ deployed to Heroku

  To git@heroku.com:hello-world-padrino.git
   * [new branch]      master -> master
  Branch master set up to track remote branch master from heroku.

{% endhighlight %}


If you now call [hello-world-herokuapp.com](http://hello-world-padrino.herokuapp.com/) you can see it and your done.


You can find the code for this application on [GitHub padrino-hello-world-heroku](https://github.com/matthias-guenther/padrino-hello-world-heroku)


## Database Deployments With Heroku


Let's create a new application:


{% highlight bash %}

$ padrino g project hello-world-heroku-postgres -d activerecord -a postgres
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
hello-world-heroku-postgres is ready for development!
=================================================================
$ cd ./hello-world-heroku-postgres
$ bundle
=================================================================

{% endhighlight %}


Go to your app and select under "Resources" the "Get Add-ons" link and chose the "Heroku Postgres" addon with the help:


<a href="http://farm8.staticflickr.com/7410/13108187085_822c646670_o.png" title="Padrino On Heroku with Postgres" class="fancybox"><img src="http://farm8.staticflickr.com/7410/13108187085_59733ee3ab_c.jpg" class="center" alt="Padrino On Heroku with Postgres"/></a>



You can also run the following command which does the same:


{% highlight bash %}

$ heroku addons:add heroku-postgresql

Adding heroku-postgresql on hello-world-heroku-postgres... done, v3 (free)
Attached as HEROKU_POSTGRESQL_TEAL_URL
Database has been created and is available
 ! This database is empty. If upgrading, you can transfer
 ! data from another database with pgbackups:restore.
Use `heroku addons:docs heroku-postgresql` to view documentation.

{% endhighlight %}


Hmmm, let's go into the help:


{% highlight bash %}

$ heroku addons:docs heroku-postgresql

{% endhighlight %}


It will open the URL [https://devcenter.heroku.com/articles/heroku-postgresql](https://devcenter.heroku.com/articles/heroku-postgresql). Calling:


{% highlight bash %}

$ heroku config | grep HEROKU_POSTGRESQL
HEROKU_POSTGRESQL_TEAL_URL: postgres://yxkscmfxkhsvfd:hnGMVRPWmBQ06Bi3ujqP21Orl4@ec2-79-125-21-60.eu-west-1.compute.amazonaws.com:5432/dev751q4jd401b

{% endhighlight %}


gives us the host URL, the user, the port, as well as the password. You can get the same information under the URL [https://postgres.heroku.com/databases](https://postgres.heroku.com/databases).


Since we now have the information about our database, it's time to edit `config/database.rb`:


{% highlight ruby %}

ActiveRecord::Base.configurations[:production] = {
  :adapter   => 'postgresql',
  :database  => 'dev751q4jd401b',
  :username  => 'yxkscmfxkhsvfd',
  :password  => 'hnGMVRPWmBQ06Bi3ujqP21Orl4',
  :host      => 'ec2-79-125-21-60.eu-west-1.compute.amazonaws.com',
  :port      => 5432
}

{% endhighlight %}


Now, it's time to push our app on heroku:


{% highlight bash %}

$ git push heroku master
Initializing repository, done.
Counting objects: 22, done.
Delta compression using up to 4 threads.
Compressing objects: 100% (20/20), done.
Writing objects: 100% (22/22), 9.43 KiB | 0 bytes/s, done.
Total 22 (delta 4), reused 0 (delta 0)

-----> Ruby app detected
-----> Compiling Ruby/Rack
-----> Using Ruby version: ruby-2.0.0
-----> Installing dependencies using 1.5.2
       New app detected loading default bundler cache
       Running: bundle install --without development:test --path vendor/bundle --binstubs vendor/bundle/bin -j4 --deployment
       Fetching gem metadata from https://rubygems.org/.........
       Fetching additional metadata from https://rubygems.org/..
       Using rake (10.1.1)
       Using i18n (0.6.9)
       Using minitest (4.7.5)
       Using tzinfo (0.3.38)
       Using builder (3.1.4)
       Using activerecord-deprecated_finders (1.0.3)
       Using arel (4.0.2)
       Using rack (1.5.2)
       Using mime-types (1.25.1)
       Using polyglot (0.3.4)
       Using tilt (1.4.1)
       Installing thor (0.17.0)
       Using bundler (1.5.2)
       Using pg (0.17.1)
       Installing multi_json (1.9.0)
       Installing url_mount (0.2.1)
       Installing moneta (0.7.20)
       Using treetop (1.4.15)
       Installing temple (0.6.7)
       Using mail (2.5.4)
       Installing atomic (1.1.15)
       Installing rack-protection (1.5.2)
       Installing slim (2.0.2)
       Installing http_router (0.11.1)
       Installing sinatra (1.4.4)
       Installing thread_safe (0.2.0)
       Installing activesupport (4.0.3)
       Installing activemodel (4.0.3)
       Installing padrino-core (0.12.0)
       Installing padrino-mailer (0.12.0)
       Installing padrino-gen (0.12.0)
       Installing padrino-helpers (0.12.0)
       Installing activerecord (4.0.3)
       Installing padrino-cache (0.12.0)
       Installing padrino-admin (0.12.0)
       Installing padrino (0.12.0)
       Your bundle is complete!
       Gems in the groups development and test were not installed.
       It was installed into ./vendor/bundle
       Bundle completed (18.14s)
       Cleaning up the bundler cache.
-----> Writing config/database.yml to read from DATABASE_URL
-----> WARNINGS:
       You have not declared a Ruby version in your Gemfile.
       To set your Ruby version add this line to your Gemfile:
       ruby '2.0.0'
       # See https://devcenter.heroku.com/articles/ruby-versions for more information.
-----> Discovering process types
       Procfile declares types -> (none)
       Default types for Ruby  -> console, rake, web

-----> Compressing... done, 16.1MB
-----> Launching... done, v6
       http://hello-world-heroku-postgres.herokuapp.com/ deployed to Heroku

To git@heroku.com:hello-world-heroku-postgres.git
 * [new branch]      master -> master

{% endhighlight %}


Now let's create a model:


{% highlight bash %}

$ padrino g model users name:string email:text
   apply  orms/activerecord
  create  models/users.rb
  create  db/migrate/001_create_users.rb

{% endhighlight %}


Before pushing our changes we need to run the migrations:


{% highlight bash %}

$ heroku run rake db:migrate
Running `rake db:migrate` attached to terminal... up, run.1057
==  CreateUsers: migrating ====================================================
-- create_table(:users)
   -> 0.0234s
==  CreateUsers: migrated (0.0236s) ===========================================

{% endhighlight %}


Now we need to create some data with the following query:


{% highlight bash %}

INSERT INTO users (name, email) VALUES ('Matthias', 'matthias@wikimatze.de');

{% endhighlight %}


Next we need to edit our view `app/app.rb`:


{% highlight ruby %}

module HelloWorldHeroku
  class App < Padrino::Application
    ...
    get "/" do
      user = Users.find(1)
      "Hello #{user.name}\n Your email is: #{user.email}"
    end
  end
end

{% endhighlight %}


After pushing the changes, you can call [http://hello-world-heroku-postgres.herokuapp.com](http://hello-world-heroku-postgres.herokuapp.com) and see the lovely output.

{% include newsletter.html %}

