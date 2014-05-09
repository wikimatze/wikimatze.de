---
title: Factory girl
meta-description: ...
published: false
---

Factory girl is an replacement of the fixtures in Rails. You can specifiy factories in spec/factories.rb

{% highlight ruby %}

Factory.define :user do |user|
  user.name "Matthias Guenther"
  user.email "mguenther@example.com"
  user.password "foobar"
  user.confirmation
end

{% endhighlight %}

In your test you can use the factory with:

{% highlight ruby %}

@user = Factory(:user)

{% endhighlight %}

Test bla und so weiter kann es gehen wenn du meinst, dass es damit zu tun hat.


## Conclusion

## Further reading

-
-
-


