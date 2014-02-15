---
layout: post
title: Method alias in ruby
description: Method alias in ruby help you to apply the DRY-principle
update: 2014-02-14
categories: ['ruby', 'programming']
---

In ruby you can create aliases for a method and variable name. This can be helpful if you want to override the behavior
of some method without changing the origin implementation of it. `alias_method` take a `new_name` as a copy name of the
*old_name* and it has the following syntax.


{% highlight ruby %}

alias_method (new_name, old_name)

{% endhighlight %}

A small example:

{% highlight ruby %}

class Davi
  def capital
    puts "Karaz-a-Karak"
  end

  alias_method :orig_capital, :capital

  def capital
    puts "Karaz-a-Karak rebuild"
    orig_capital
  end
end

davi = Davi.new
davi.capital

# output
"Karaz-a-Karak rebuild"
"Karaz-a-Karak"

{% endhighlight %}


## What is the difference between `alias` and `alias_method`

`alias` is more general than `alias_method` and can be used to create an alias for global variable, regular expression
backreference (like `$&`) or an existing method. Class variables, local variables, instance variables and constants may
not be aliased.


{% highlight ruby %}

def khemri_city
  puts "Nehekhara"
end

alias :orig_khemri_city :khemri_city

def khemri_city
  puts "Nehekhara new"
end

orig_khemri_city
khemri_city

# output
"Nehekhara"
"Nehekhara new"

{% endhighlight %}


`alias_method` must return must be called on a method. So `alias` is more general than
`alias_method`.


## Conclusion

It is possible with `alias_method` to reopen a class, override a method call and you can still use the original call. In
order to maintain backward compatibility `alias_method` are used in plugins, extensions, deprecating variables.
`Alias_method` can be used in Rails to define action with duplicated content and remove duplicated code.

Here the duplicated variant:


{% highlight ruby %}

class UsersController < ApplicationController
  def home
    list
  end

  def find
    list
  end

  def search
    list
  end
end

{% endhighlight %}


The DRY variant:


{% highlight ruby %}

class UsersController < ApplicationController
  def home
    list
  end

  alias_method :find, :home
  alias_method :search, :home
end

{% endhighlight %}


## Further reading

- [alias_method](http://www.ruby-doc.org/core/classes/Module.html#M000447)
- [alias](http://ruby.about.com/od/rubyfeatures/a/aliasing.html)

