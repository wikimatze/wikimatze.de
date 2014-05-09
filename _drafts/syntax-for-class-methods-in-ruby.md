---
title:
meta-description: ...
published: false
---

{% highlight ruby %}

class << self
  def authenticate(email, submitted_password)
    ...
  end
end

{% endhighlight %}

The methods defined in _class << self_ are automatically class methods. You can write the whole method above in the following style

{% highlight ruby %}
def User.authenticate(email, submitted_password)
  ...
end
{% endhighlight %}

It's good to know to know the strange syntax so you know what it means when you will see it.

## Conclusion

## Further reading

-
-
-


