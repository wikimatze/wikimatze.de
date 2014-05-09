---
title: Modules in Ruby
description:
---
**

Modules are like classes. They contains methods, constants, and classes. But you can't instantiate them


## Giving the module's functionality to just one object



module OurModule
  def meth
    'method from M'
  end
end


```ruby

obj = Object.new
class << obj
  include OurModule
end

```


The shortcut for this one above is


```ruby


obj = Object.new
obj.extend OurModule

```


Modules are great for namespacing so that they don't clashes with namespaces of other scripts.



## Conclusion


## Further reading

