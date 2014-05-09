---
title: Testing Helpers in Padrino
update: 2014-03-30
categories: ['padrino', 'ruby', 'programming']
---

{% include leanpub.html %}

{% include newsletter.html %}

I always was wondering how to test helpers in Padrino and to be honest I postponed this problem for a long time. But
this morning I reached the point in my book where I was writing helper with many methods without testing them. When
something like this happened you have stop going and spend time to solve this problem.


## The Problem

Let's say you have a typical Padrino helper:


{% highlight ruby %}

# app/helpers/users_helper.rb

JobVacancy::App.helpers do
  def foo
    "bar"
  end
end

{% endhighlight %}


You can use the `foo` method anywhere in you controllers and views. But what happened if your helper
is getting more and more complex like the following one:


{% highlight ruby %}
# app/helpers/users_helper.rb

JobVacancy::App.helpers do
  def current_user=(user)
    @current_user = user
  end

  def current_user
    @current_user ||= User.find_by_id(session[:current_user])
  end

  def current_user?(user)
    user == current_user
  end

  def sign_in(user)
    session[:current_user] = user.id
    self.current_user = user
  end

  def sign_out
    session.delete(:current_user)
  end

  def signed_in?
    !current_user.nil?
  end
end

{% endhighlight %}


Right, there is a lot of stuff inside and you need to test this.


## Assumption

Let's say you have the following structure within you application:

    .
    ├── app
    │   ├── controllers
    │   │   ├── ...
    │   ├── helpers
    │   │   ├── users_helper.rb
    │   │   ├── ...
    │   ├── models
    │       └── ...
    ├── spec
    │   ├── app
    │   │   ├── controllers
    │   │   │   ├── ...
    │   │   ├── helpers
    │   │   │   └── users_helper_spec.rb
    │   │   ├── models
    │   │   │   └── ...
    │   ├── spec_helper.rb


And you have written your helper in the typical helper style of Padrino which are generated when you create a new
controller:


{% highlight ruby %}

# app/helpers/users_helper.rb

JobVacancy::App.helpers do
  def foo
    "bar"
  end
end

{% endhighlight %}


This syntax is a shortcut for:


{% highlight ruby %}

helpers = Module.new do
  def foo
    "bar"
  end
end

JobVacancy::App.helpers helpers

{% endhighlight %}


In Padrino, helpers are generally an anonymous module. Testing something anonymous isn't possible. To make this helper
testable we need to make this module explicit:


{% highlight ruby %}
# app/helpers/users_helper.rb

module UsersHelper
  def foo
    "bar"
  end
end

JobVacancy::App.helpers UsersHelper

{% endhighlight %}


You can still use the `foo` method everywhere in your views and controller. But now you've got a big plus. You can test it.


## Prepare the Spec

We need to require the helper in our `spec_helper`:


{% highlight ruby %}
# spec/spec_helper.rb

PADRINO_ENV = 'test' unless defined?(PADRINO_ENV)
require File.expand_path(File.dirname(__FILE__) + "/../config/boot")
require File.dirname(__FILE__) + "/../app/helpers/users_helper" # <--- this is what we need

RSpec.configure do |conf|
  ...
  conf.full_backtrace= false
  conf.color_enabled= true
  conf.formatter = :documentation
end

{% endhighlight %}


## Write the spec

And here is a spec for that:

{% highlight ruby %}
# spec/app/helpers/users_helper_spec.rb
require 'spec_helper'

describe UsersHelper do
  before do
    class UsersHelperClass
      include UsersHelper
    end

    @user_helper = UsersHelperClass.new
  end

  it "test foo" do
    @user_helper.foo.should == "bar"
  end

end

{% endhighlight %}


We create a class in the before part of the spec which include our `UsersHelper` module. Next, we are creating the instance variable `@user_helper` as a new object of our class `UsersHelperClass`. Running our tests will make unicorns happy and fast:


{% highlight bash %}

$ rspec spec/app/helpers

  UsersHelper
    test foo

  Finished in 0.00041 seconds
  1 example, 0 failures

{% endhighlight %}


I'm quiet sure that there is a better way to write the spec. If you know a way, please let me know.

{% include newsletter.html %}

