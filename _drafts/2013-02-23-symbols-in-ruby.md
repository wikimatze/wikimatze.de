---
layout: post
title: Symbols in Ruby
description:
---
**

## What They Are

Symbols are basic strings which are immutable. They are never garbage collect, so they will last until your program
ends. Every instancte of the symbol is the same object, where for normal strings with same content they have a different object_id

## Where are They Used

As hash keys because their hash value can be cached, for enum types and used internally in Ruby to refer to things like
method names. Is is best practise to declare attr_accessor with a symbol.


## Conclusion


## Further reading

