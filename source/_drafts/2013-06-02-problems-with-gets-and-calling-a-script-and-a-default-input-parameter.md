---
title: Problems With Gets and Calling a Script and a Default Input Parameter
description:
---
**

ruby test.rb 1

using input = gets.chomp will not work, because it is using Basically, Kernel#gets just calls ARGF.gets

If you really want to read from the input you have to use $stdin.gets from http://rubydoc.info/stdlib/core/IO%3agets

## Conclusion


## Further reading

