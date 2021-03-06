---
title: Method alias in ruby
nav: articles
date: 2011-10-01
updated: 2014-11-20
categories: ruby programming
---

You can create aliases for a method and variable name in ruby. This can be helpful if you want to override the behavior of some method without changing the origin implementation of it. `alias_method` take a `new_name` as a copy name of the `old_name` and it has the following syntax.


```ruby
alias_method (new_name, old_name)
```

A small example:


```ruby
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
```


## What is the difference between `alias` and `alias_method`

`Alias` will looks at the value of self lexically where the aliased keyword lies. `Alias_method` use the value of self during runtime which may be a subclass where the call is lexically located. Consider the following example to understand what I mean:


```ruby
class A
  def self.swap
    alias bar foo
  end
  def foo; "A foo"; end
end
class B < A
  def foo; "B foo"; end
  swap
end
puts B.new.bar
# => "A foo"

class Y
  def self.swap
    alias_method :bar, :foo
  end
  def foo; "Y foo"; end
end
class Z < Y
  def foo; "Z foo"; end
  swap
end
puts Z.new.bar
# => "Z foo"
```


## Conclusion

It is possible with `alias_method` to reopen a class, override a method call and you can still use the original call. In order to maintain backward compatibility `alias_method` are used in plugins, extensions, deprecating variables.  `Alias_method` can be used in Rails to define action with duplicated content and remove duplicated code.

Here the duplicated variant:


```ruby
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
```


The DRY variant:


```ruby
class UsersController < ApplicationController
  def home
    list
  end

  alias_method :find, :home
  alias_method :search, :home
end
```


## Further reading

- [alias](http://ruby-doc.org/stdlib-1.9.1/libdoc/rdoc/rdoc/RDoc/Alias.html)
- [alias_method](http://www.ruby-doc.org/core-2.1.0/Module.html#method-i-alias_method)

