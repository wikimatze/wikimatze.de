---
title: Regular Expressions in Ruby
description:
---
**

Regex begin and end with slashes.


## Ways of matching strings

`=~` operator comes from the PERL world and returns the first index of the match or nil


If you pass a regular expression to a String's [] method, then it will return where it matches.


If you pass it to the scan method, it will return an array of all the matches.


## Regex Characters

Use brackets to declare a set of characters to match Match any character not in the set by leading it with a caret.


The dot will match any character except newlines.


To match the beginning of a line, use the caret (outside of the
brackets) and to match the end, use the dollar sign.


You can match the boundaries between alphanumeric
and non-alphanumeric with \b


## Groups

You can logically group multiple characters with parentheses
Each will be captured according in variables $1, $2, ...
regex = /(.).(.).(.)/


A pipe acts as an "or"

## Conclusion


## Further reading

