---
title: Arrays in Ruby
description:
---
**


## Arrays

Are ordered lists of objects


```ruby

array = ["Dwarf", "Dark Elves", "Imperium"]

```


You can access the each element of the array with the index


```ruby

array[0] # => "Dwarf"
array[1] # => "Dark Elves"
array[2] # => "Imperium"
array[3] # => nil

```


You can also use negative numbers as indices. In this way we are referencing the entries of the array backwards from the
end to the beginning:


```ruby

array[-1] # => "Imperium"
array[-2] # => "Dark Elves"
array[-3] # => "Dwarf"
array[-4] # => nil

```


## Iteration Over Arrays

You can use the `each` operator to iterate over each element in the array. You can pass a block to do certain things
with the elements:


```ruby

array.each { |elem| puts "#{elem} is a race from Warhammer"}
 # Dwarf is a race from Warhammer
 # Dark Elves is a race from Warhammer
 # Imperium is a race from Warhammer

```


Use map to make a new array out of the elements returned by the block:


```ruby

warhammer_array = array.map { |elem| "#{elem} is a race from Warhammer"}

array
# => ["Dwarf", "Dark Elves", "Imperium"]

warhammer_array
# => ["Dwarf is a race from Warhammer", "Dark Elves is a race from Warhammer", "Imperium is a race from Warhammer"]

```


What if we want to slice out a number of elements in an array? You can use the `each_slice` method. It iterates the
given block for each slice of <n> elements. If no block is given, returns an enumerator.


```ruby

result = []
array.each_slice(1) { |elem| result << elem}
result
# => [["Dwarf"], ["Dark Elves"], ["Imperium"]]


result = []
array.each_slice(2) { |elem| result << elem}
result
# => [["Dwarf", "Dark Elves"], ["Imperium"]]


result = []
array.each_slice(2) { |elem| result << elem}
# => [["Dwarf", "Dark Elves", "Imperium"]]


enum = array.each_slice(10)
enum
# => #<Enumerator: ["Dwarf", "Dark Elves", "Imperium"]:each_slice(10)>

```


If we want to get all possible combination of the elements of an array, we can use the `premutation` function. All it
does is to use the faculty. So it runs the n! operation. Since our array has three elements `3! = 1 * 2 *3 = 6`. Let's
see how we can write this in code:


```ruby

array.permutation { |perm| p perm}
# =>
# ["Dwarf", "Dark Elves", "Imperium"]
# ["Dwarf", "Imperium", "Dark Elves"]
# ["Dark Elves", "Dwarf", "Imperium"]
# ["Dark Elves", "Imperium", "Dwarf"]
# ["Imperium", "Dwarf", "Dark Elves"]
# ["Imperium", "Dark Elves", "Dwarf"]

```


## Filtering

You can use `select` to create a new of only the elements you want. The block will include only elements that are
truthly values. Say that we want only the elements that contains the character `a`:


```ruby

array.select { |elem| elem.include?('a') }
# => ["Dark Elves", "Dwarf"]

```


The opposite of `select` is `reject`. It creates a new array only with the elements with false values:


```ruby

array.reject { |elem| elem.include?('a') }
# => ["Imperium"]

array.reject { |elem| !elem.include?('a') }
# => ["Dark Elves", "Dwarf"]

```


## Conclusion


## Further reading

