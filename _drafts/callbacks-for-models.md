---
title: callbacks for models
meta-description:
published: false
---

You can put enomrous amount of logic in your controller in a callback in your model, which checks
certain conditions before a *post create* action in your controller is performed.


## Small example ##


```ruby
class DwarfController < ApplicationController
  def create
    @dwarf = Dwarf.new(params[:post])

    if params[:tag] == 1
      @dwarf.tag = 'Karaz-a-Karak'
    else
      @dwarf.tag = ''
    end

    @dwarf.save
end
```

This controller is just blown up with to much logic inside the controller. Here now the even more
better solution for this. We add a before_filter[^before_filter] in the *Dwarf* model.

{% highlight rubx %}
class Dwarf < ActiveRecord::Base
  attr_accessor :tag
  before_save :generate_tag

  private
    def generate_tag
      if tag == '1' ? : self.tag = 'Karaz-a-Karak'
    end
end

class DwarfController < ApplicationController
  def create
    @dwarf = Dwarf.new(params[:dwarf])
    @dwarf.save
  end
end
```


## Conclusion ##

You can use callbacks, to check if a user is signed in, retrict the access to certain actions, and
many more stuff.

## Further reading ##

[^before_filer]: [callbacks in rails](http://api.rubyonrails.org/classes/ActiveRecord/Callbacks.html "callbacks in rails")

