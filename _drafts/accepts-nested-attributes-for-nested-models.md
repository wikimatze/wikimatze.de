---
layout: post
title: accepts nested attributes for nested models
meta-description:
published: false
---

The usage of `accepts_nested_attributes` when working with nested models makes it easier to
handle them. Even though they are still a beast which should fight, but when it comes to work with
them, you happy about ebery piece of information you can get about them.

## Small example ##

How not to do it:

{% highlight ruby %}

class City < ActiveRecord::Base
  has_one :bookkeeper
end

class BookKeeper < ActiveRecord::Base
  belongs_to :city
end

## the view
= form_for :city do |form|
  form.text_field :name
  = fields_for :bookkeeper do |keeper|
    = keeper.text_field :bookname

## the controller
class CityController < ApplicationController
  def create
    @city = City.new(params[:city])
    @bookkeeper = Bookkeeper.new(params[:bookkeeper])

    City.creation do
      @city.save!
      @bookkeeper.city = @city
      @bookeeper.save
    end
  end
end
{% endhighlight %}

Now the a far more better method with the `accepts_nested_attributes` method:

{% highlight ruby %}

class City < ActiveRecord::Base
  has_one :bookkeeper
  accepts_nested_attributes_for :bookkeeper
end


## the view is the same

class CityController < ApplicationController
  def create
    @city = City.new(params[:city])
    @bookkeeper = Bookkeeper.new(params[:bookkeeper])

    City.creation do
      @city.save!
      @bookkeeper.city = @city
      @bookeeper.save
    end
  end
end

{% endhighlight %}

Now the City model takes care of saving the bookkeeper model. Note that we have used about a one-to-one
association [^association]. You can use this attribute also in a one-to-many association:

{% highlight ruby %}

class City < ActiveRecord::Base
  has_many :bookkeepers
  accepts_nested_attributes_for :bookkeepers
end

class Bookkeeper < ActiveRecord::Base
  belongs_to :city
end

{% endhighlight %}


## Conclusion ##

If you are getting confused with nested_models, this is no problem, it is better for you to avoid
them. But this is not possible in every moment because you never know what different pieces of rails
applications are out there for you, to eat you.



## Further reading ##

[^association]: [has_many](http://guides.rubyonrails.org/association_basics.html#the-has_many-association "has_many")

