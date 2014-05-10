---
title: Blocks in Ruby
description:
---
**

Blocks are what we call a proc when we pass it into a method


You can pass blocks into methods by using the ampersand (&)operator:


```ruby
def bla(&block)
  block.call.downcase
end
```


## Conclusion


## Further reading

