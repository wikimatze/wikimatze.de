---
title: Creation of a Ruby Gem
update: 2014-03-30
categories: ['ruby', 'programming']
---

<blockquote>
  <p>Everything should be made as simple as possible, but not simple.</p>
  <strong>Albert Einstein</strong>
</blockquote>

*This article describes the crafting of a Ruby gem.*


The situation: For [Jekyll](http://jekyllrb.com/) I wanted to get an overview of how many pages, links, when the last
build was, how many images I used in my blog, and when I lastly updated my
[Bitbucket repositories](https://bitbucket.org/wikimatze/). But before we dive deep into the creation, I will explain
what a gem is and how you get started with writing your own gem. Don't be afraid if you are writing a gem that already
exists, your goal is to learn how to write a gem.


## Ruby Gem

A Ruby gem is a self contained Ruby application which is packed as software. It can be downloaded and then used in other
programs.  Gems extends the core Ruby language through functions that are commonly used and may be of usage by other
programmers. Many gems provides command line operations and help to automate tasks. Not all gems needs to contain a
binary, like my [sweetie gem](https://github.com/wikimatze/sweetie).


## Basic structure of a Gem

Below is a typical structure of gem:


    .
    ├── README.md
    ├── Rakefile
    ├── lib
    │   ├── sweetie
    │   │   ├── bitbucket.rb
    │   │   ├── conversion.rb
    │   │   └── helper.rb
    │   │   ...
    │   └── sweetie.rb
    │   ...
    ├── spec
    │   ├── sweetie_bitbucket_spec.rb
    │   └── sweetie_conversion_spec.rb
    │   ...
    └── sweetie.gemspec


A typical gem consists of the main class file (like `sweetie.rb`). This file contains other ruby-files (normally a list
of *require* statements). The `README.md` briefly explains what the gem does, how to install it, explains the license,
and should include small use cases for the gem (please checkout the
[README](https://github.com/wikimatze/sweetie/blob/master/README.md) of the sweetie gem to see what I mean). The
`sweetie.gemspec` file contains meta-information like who invented the gem, declare runtime environment dependencies,
etc. A gem should have test-files, that other people can contribute to the Gem without damaging the main functionality.


## Gemfile structure

First of all we create a `Gemfile` which defines important informations for the [rubygems.org](http://rubygems.org/)
website. The site shows the author, the sources, the homepage, and some statistics (e.g. how often the gem was
installed) - and by the way, it's a nice place to sniff in the code of other hackers.


Here is an example `sweetie.gemspec`:


```ruby
$:.push File.expand_path("../lib", __FILE__)
require 'sweetie/version'

Gem::Specification.new do |s|
  s.name             = 'sweetie'
  s.version          = Sweetie::VERSION
  s.date             = '2012-06-05'
  s.authors          = ['Matthias Guenther']
  s.email            = 'matthias.guenther@wikimatze.de'
  s.homepage         = 'https://github.com/wikimatze/sweetie'

  s.summary          = %q{Be short and precice!}
  s.description      = %q{Here you can write more and describe detailed features!}

  s.files            = `git ls-files`.split("\n")
  s.test_files       = `git ls-files -- {test,spec,features}/*`.split("\n")
  s.require_paths    = ["lib"]

  s.extra_rdoc_files = ["README.md"]

  s.add_runtime_dependency 'nokogiri', ">= 1.4.6"
  s.add_runtime_dependency 'json', ">= 1.6.1"
  s.add_development_dependency 'rake'
  s.add_development_dependency 'rspec'
  s.add_development_dependency 'yard'
end
```


Let's explain the stuff which aren't obvious:


- `$:.push` - magic line that ensures "../lib" is in the load path
- `require 'sweetie/version'` - we need this line, because the module `sweetie/version.rb` contains the version number of the gem
- `s.files` -  uses a clever git command which lists all files under version-control - these files are directly included in the gem
- `s.test_files` - again, a clever git listing command with ruby's `split()` method - files that are used for testing the gem (the line supports [TestUnit](https://github.com/test-unit/test-unit), [MiniTest](https://github.com/seattlerb/minitest), [Machinist](https://github.com/notahat/machinist), [RSpec](https://github.com/rspec/rspec), [Cucumber](http://cukes.info/), and others
- `s.require_paths` - these paths will be added to *$LOAD_PATH* when the gem is activated
- `s.summary` - short summary of the gem's description => will be displayed when running `gem list -d`
- `s.description` - a long description of this gem => it goes more into detail than `s.summary`
- `s.extra_rdoc_files` - here you can add files which can be used for the [RubyDoc](http://rubydoc.info) site - here the .gemspec *README.md* is the "main homepage" of the generated documentation
- `s.add_runtime_dependency` - additional gems that will be installed when using this gem
- `s.add_development_dependency` - additional gems needed when hacking on the gem (e.g.  [Rake](http://en.wikipedia.org/wiki/Rake_%28software%29) is used for building and deploying the gem)


## Building and Installing the Gem

Once you have created some code (it doesn't matter how small the code is, except it must be valid and tested ruby code),
you should build it on your local machine before making it public:


```ruby
$ gem build sweetie.gemspec
=> Successfully built RubyGem
  Name: sweetie
  Version: 1.0.0
  File: sweetie-1.0.0.gem
```


Now you can install the gem *locally*:


```ruby
$ gem install sweetie-1.0.0.gem
```


And test the installation with:


```ruby
$ gem list | grep sweetie
$ irb
>> require 'sweetie'
=> true
```


It's working and you can experiment with the script locally.


## Publishing your gem

First, you need to register on [rubygems.org](http://rubygems.org/). After that you can push the gem there with one simple command:


```ruby
gem push sweetie-1.0.0.gem
Pushing gem to RubyGems.org...
Successfully registered gem: sweetie (1.0.0)
```


If you want to check if your gem is online, the console is your friend:


```ruby
gem list -r sweetie

...

sweetie (1.0.0)
```


This will print all the gems which fit to the specified gem.


## Conclusion


It is easy to write an gem for ruby. Start small, create a repository on [GitHub](https://github.com/) get
something similar to *hello world* running, test your code with , and create a briefly documentation
(read [Zach Holman documentation talk](http://zachholman.com/posts/documentation/) to see why) about what the gem does,
and give small examples. After this test your gem, deploy it on [rubygems.org](http://rubygems.org/) and spread the word
about your accomplished on [twitter](http://www.twitter.com/) - time to drink a beer!


## Further reading

- [Great article on rubygems.org](http://guides.rubygems.org/make-your-own-gem/)
- [Writing a ruby gem part one](http://rakeroutes.com/blog/lets-write-a-gem-part-one/)
- [Writing a ruby gem part two](http://rakeroutes.com/blog/lets-write-a-gem-part-two/)
- [Gemspec specification](http://guides.rubygems.org/specification-reference/)

