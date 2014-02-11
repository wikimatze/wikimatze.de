---
layout: post
title: Understanding and Using the Law of Demeter
description:
---
**

It expressed that objects should only communicate with objects in their near neighborhood. This lowers the coupling of
your modules and make it more flexible and easier to maintain.


Rules:

A method `a` of a class `B` should only access the following elements:


- methods of `B` only
- arguments from `a`
- any objects created within `a`
- methods of associated objects of `B`


Using this technique will give you loose coupling and the fundamental notion of the principle is that a given object
should assume as little as possible about the structure or anything else in a way of information hiding.

Each unit of the code should only have a limited knowledge about other units, that means that a unit should only talk
to it's friends and not to strangers: *Use only one dot*
That means
that a call of the form `a.b.getName()` is a violation of the rule.


## Conclusion

- [Law of Demeter](http://en.wikipedia.org/wiki/Law_of_Demeter)

