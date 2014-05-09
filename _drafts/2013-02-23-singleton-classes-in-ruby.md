---
title: Singleton Classes in Ruby
description:
---
**


{% highlight ruby %}

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

{% endhighlight %}


## Conclusion


## Further reading

