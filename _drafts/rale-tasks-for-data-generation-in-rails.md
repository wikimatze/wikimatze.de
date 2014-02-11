---
layout: post
title:
meta-description: ...
published: false
---
# own-rake-tasks-with-fake
Need to fill your db with fake-data? No problem with rake and the faker gem

{% highlight ruby %}
namespace :db do
  desc "Fill in database with sample data"
  task :populate => :environment do
    Rake::Task['db:reset'].invoke
    User.create!(:name => "Example User",
                 :email => "example@example.org",
                 :password => "foobar",
                 :password_confirmation => "foobar")
    99.times do |n|
      name = Faker::Name.name
      email = "example-#{n+1}@example.org"
      password = "password"
      User.create!(:name => name,
                   :email => email,
                   :password => password,
                   :password_confirmation => password)
    end

  end
end
{% endhighlight %}

We define a task:

{% highlight ruby %}
task db:populate
{% endhighlight %}

which can be run in the console.

The line

{% highlight ruby %}
task :populate => :environment
{% endhighlight %}

ensures that the the Rake task has access to the local Rails environment, including the models.

Really great if you want to work with it.


## Conclusion

## Further reading

-
-
-


