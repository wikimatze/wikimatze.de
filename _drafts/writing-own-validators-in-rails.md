---
layout: post
title: Writing own validators in rails
meta-description: How can you write your own validators in Rails 3
---

Under "railscast(railscasts)":http://railscasts.com/episodes/211-validations-in-rails-3 you can find a nice plugin how to do it. But


h2. Create something only for one model

Just write the method directly in your model


h2. Write a global validator for all models

The idea is to put the validator in the lib folder. We want to write a absence-validator


{% highlight ruby %}
class AbsenceValidator < ActiveModel::EachValidator
  def validate_each(object, attribute, value)
    object.errors[attribute] << "a bot tried to fill this formula" if !value.blank?
  end
end
{% endhighlight %}


In your model you can then use your new validator with @:absence => true@

Putting your validator in a model __app/model/user.rb__:

{% highlight ruby %}
class IpRequest < DatabaseLooseModel
  column :description, :string
  validates :mother_middle_name,
            :absence => true
end
{% endhighlight %}

In the model above I used the @:absence => true@ hash and there you get it. To use it in the form, you need something like @form.text_field(:name, :id => 'hidden', :value => '') @. Finally set in your css the .hidden class on display: none and there you get your own honeypot captcha without killing your users with unreadable captchas. I chose the name because it is like a bait for the bots out there.

h2. Conclusion

h2. Further reading

## "validations":http://databasically.com/2010/11/08/gettings-started-with-custom-rails3-validators/
## "sexy validations":http://thelucid.com/2010/01/08/sexy-validation-in-edge-rails-rails-3/
## "railscast":http://railscasts.com/episodes/211-validations-in-rails-3
## "custom-validators":http://www.perfectline.ee/blog/building-ruby-on-rails-3-custom-validators

