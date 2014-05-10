---
title: Virtual attributes for models
meta-description:
published: false
---

If you have attributes, which you only need for a transaction (e.g. generating a email of a contact form) and
you don't need them in your database, it's a good practise to use virtual attributes[^virtual] in your models.


## Bad smell of passing attributes in the controller of a model ##

We have the following code example:


```ruby
% form_for @user do |form|
  = form.text_field :name
  = form.text_field :email


class ContactController < ApplicationController
  def create
    @user = User.new(params[:user])
    @user.name = params[:name]
    @user.email = params[:email]
  end
end
```

This is not the spirit of the MVC[^mvc], it is not the task of the controller to assign values to
the model. The model is happy for to get something to do.


```ruby
class Contact < ActiveRecord::Base
  def email
    email
  end

  def name
    name
  end

  def email=(email)
    self.email = email
  end

  def name=(name)
    self.name = name
  end
end

class ContactController < ApplicationController
  def create
    @user = User.create(params[:user])
  end
end
```

There is some duplication inside this method, but I will have to clean this up

## Conclusion ##


## Further reading ##

[^virtual]: [text](url "text")
[^mvc]: [Model View Controller](http://en.wikipedia.org/wiki/Model%E2%80%93view%E2%80%93controller "Model View Controller")
