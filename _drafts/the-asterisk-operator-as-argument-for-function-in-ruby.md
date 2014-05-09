---
title:
meta-description: ...
published: false
---
# the-*-operator-as-argument

The * operator in method arguments allows us to use an array as normal function parameters:

{% highlight ruby %}
def test(a, b)
  a + b
end

test(*[1, 2]) == test(1, 2)
{% endhighlight %}

## Conclusion

## Further reading

-
-
-


