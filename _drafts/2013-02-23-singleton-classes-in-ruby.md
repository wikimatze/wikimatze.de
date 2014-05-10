---
title: Singleton Classes in Ruby
description:
---
**


```ruby
alone = Object.new

class << alone
  def test
    puts "Hello"
  end
end

# this is the shortcut for the above mentioned term
def alone.juhu
  puts "Test"

end

alone.test
alone.juhu
```


## Conclusion


## Further reading

