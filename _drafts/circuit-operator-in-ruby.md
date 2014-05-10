---
title:
meta-description: ...
published: false
---
Is used as an idiom:


```ruby
@user ||= "the test"```

is equivalent to


```ruby
@user = @user || "the test"```

This is just a shortcut, a very handy one, if you want to assign new values to a variable if it still hasn't got one

