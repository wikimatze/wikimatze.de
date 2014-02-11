---
layout: post
title: Ruby openstruct
meta-description: OpenStruct helps you creating flexible Value Objects
published: false
---
*This article will dive into the OpenStruct construct in Ruby, give examples, and in which situation you should use it.*

`Ostruct` is a small wrapper around hashes, providing setters and getters for all hash enries. Openstruct allows you to create
objects with their attributes initialized.


## First example

Let's start with a `Struct` that defines the basic layout of a Dwarf.


{% highlight ruby %}

require 'ostruct2'

dawi = OpenStruct.new
dawi.name = "Gotrek Gurnisson"
dawi.clan = "Slayer"
dawi.age = 120

>> dawi
=> #<OpenStruct name="Gotrek Gurnisson", clan="Slayer", age=120>

{% endhighlight %}


Since OpenStruct emplys a Hash, it can even initialized with one


{% highlight code %}

dawi = OpenStruct.new(:name => "Gotrek Gurnisson", :clan => "Slayer", :age => 120)

{% endhighlight %}


If you want to remove a field from the struct, you have to run the `delete_field(name)` method. Otherwise, the method will be
still there:


{% highlight ruby %}


dawi_one = OpenStruct.new(:name => "Gotrek Gurnisson", :clan => "Slayer", :age => 120)
dawi_two = OpenStruct.new(:name => "Gotrek Gurnisson", :clan => "Slayer")
dawi_one.age = nil

dawi_one == dawi_two
=> false

dawi_one.delete_field(:age)

dawi_one == dawi_two
=> true

{% endhighlight %}


## Reading a YAML file and saving the attributes in a Struct object

First we define some YAML file:


{% highlight ruby %}
# data.yml

title: Small Test
date: 21.10.2012

{% endhighlight %}


And the code to transform the data from the YAML file in a struct


{% highlight ruby %}

require 'yaml'
require 'ostruct2'

file = File.open('data.yml')
data_hash = YAML.load_file(file)

data_container = OpenStruct.new(data_hash)
data_container.inspect
=> "#<OpenStruct title="Small Test", date="21.10.2012">"

{% endhighlight %}


## Conclusion

`OpenStruct` define a fixed number at runtime but may add new variables in case the requirements of a certain constructs are
changing. The first time you try to assign a value to an attribute, that doesn't exist, `OpenStruct` class will create it for you
Use them, if you quikcly want objects at hand for mocking via setter and getters.


## Further reading

- [OpenStruct](http://www.ruby-doc.org/stdlib-1.9.3/libdoc/ostruct/rdoc/OpenStruct.html#method-i-new_ostruct_member)
- [ostruct2](https://github.com/rubyworks/ostruct2)

