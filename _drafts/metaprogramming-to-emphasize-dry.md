---
layout: post
title: metaprogramming to emphasize DRY
meta-description:
published: false
---

You can use metaprogramming[^metaprogramming] to become a better code when you have controllers, where you have
reoccurring method. Let's examine the following piece of code:

{% highlight ruby %}

class Dwarf < ActiveRecord::Base

  class << self
    def all_slayer
      find(:all, :condition => { :status => 'slayer'})
    end

    def all_kings
      find(:all, :condition => { :status => 'king'})
    end

    def bearer_of_great_honor
      find(:all, :condition => { :status => 'bearer'})
    end
end

{% endhighlight %}

Right, the methods differ only in the `:status` symbol. We use the `define_method` to refactor this
code in a better way:


{% highlight ruby %}

class Dwarf < ActiveRecord::Base
  STATUS = %w(slayer, king, bearer)

  class << self
    STATUS.each do |name|
      define_method "all_#{name}" do
        find(:all, :condition => { :status => name})
      end
    end
  end
end
{% endhighlight %}

Now the code is easy to extend or to remove status from the array, the methods are then generated on
the fly.


## Conclusion

Metaprogramming is a great way to save you a lot of work writing code but require a lot experience
by the user.


## Footnotes

[^metaprogramming]: [metaprogramming](http://en.wikipedia.org/wiki/Metaprogramming "metaprogramming")


## Further reading

* [metaprogramming course](http://ruby-metaprogramming.rubylearning.com/ "metaprogramming course")

