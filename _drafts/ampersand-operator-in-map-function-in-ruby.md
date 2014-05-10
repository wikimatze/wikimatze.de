---
title:
meta-description: ...
published: false
---
# ampersand-in-map
Instead of writing


```ruby
[1,3,5,7].map{ |i| i.to_s }
["1", "3", "5", "7"]
```

you can use the much more short syntax


```ruby
[1,3,5,7].map(&:to_s)
["1", "3", "5", "7"]
```

This convention made it from Rails in the core Ruby language it self.



## Conclusion

## Further reading

-
-
-


