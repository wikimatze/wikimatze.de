---
title: Proc in Ruby
description:
---
**

Procs are a way of storing code in an object, just like an object. It takes parameters, evaluates code and return a
result.


```ruby
double = Proc.new { |num| num * 2}
double.call(2)
```


Another for a Proc is a closure. They keep the environment they were defined in even if they get passed into a new
scope.


## Conclusion


## Further reading

