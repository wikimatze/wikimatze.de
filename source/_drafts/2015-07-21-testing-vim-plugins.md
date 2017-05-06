---
title: Testing Vim Plugins
description: Testing Vim Plugins
categories: vim,
---

Vimscript is even hard to learn and I finally wanted to find a way to test my plugins I've written with Vim.


## The Tools

There are several tools available. I will briefly go through each of them and finally explain my chose d


- [vim-vspec](https://github.com/kana/vim-vspec "vim-vspec") is written by [Kana](http://whileimautomaton.net/
"Kana"). The tools lays a focus on [RSpec](http://rspec.info/ "RSpec"). This tool does not setup an test environment
automatically (like dependencies, where they are and how they are installed in a test run). There is even another
plugin called [vim-flavor](https://github.com/kana/vim-flavor "vim-flavor") which helps you to setup a
test-environment for your plugins. It uses [rake](https://github.com/ruby/rake "rake") under the hood to run the tests.
- [vim-unit](http://dsummersl.github.io/vimunit/ "vim-unit") is written by Staale Flock and is a simple unit testing
frameworks to reseamble JUnit's interface definitions (implementing only `junit.Assert` and
`junit.TestResult`). It runs as a shell-script, has no dependencies to other programs, is not maintained and
lacks documentation
- [vim-UT](https://github.com/LucHermitte/vim-UT "vim-UT") is written by [Luc Hermitte](http://luchermitte.github.io/ "Luc Hermitte") and fill Vim's [quickfix window](http://vimdoc.sourceforge.net/htmldoc/quickfix.html "quickfix window") with Assertions. It has a good documentation, lots of examples and nearly no dependencies.
- [vimrunner](https://github.com/AndrewRadev/vimrunner "vimrunner") written by [Andrew Radev](http://andrewradev.com/ "Andrew Radev") uses Vim's `+clientserver` functionality and run commands and plugins on server instances of Vim. It uses [RSpec](http://rspec.info/ "RSpec") under the hut and you can even use [cucumber](https://github.com/AndrewRadev/cucumber-vimscript/blob/master/lib/cucumber/vimscript.rb "cucumber") to test your plugins
- [vimbot](https://github.com/maxbrunsfeld/vimbot "vimbot") is written by [Max Brunsfeld](https://github.com/maxbrunsfeld "Max Brunsfeld") and it is similar to vimrunner and uses RSPec to test Vim instances remotely.
- [VimDriver](https://github.com/svermeulen/VimDriver "VimDriver") is written by [Steve Vermeulen](https://github.com/svermeulen "Steve Vermeulen") and is like vimbot just written in Python
- [vader.vim](https://github.com/junegunn/vader.vim "vader.vim") is written by [Junegunn Choi](http://junegunn.kr/ "Junegunn Choi") and it has no dependencies, uses pure Vimscript, has the `Given`, `Then`, `Expect` syntax



## Vimrunner


# Install the dependencies

Add a `Gemfile` in the root of your vim-plugin:


``ruby

source 'http://rubygems.org'

gem 'vimrunner', '0.3.1'
gem 'rspec', '3.3.0'
``


Now you are ready to create the test, but before go on we need to setup the `spec_helper.rb` file:


``ruby
require 'vimrunner'
require 'vimrunner/rspec'

Vimrunner::RSpec.configure do |config|
  config.reuse_server = true

  config.start.vim do
    vim = Vimrunner.start

    vim.add_plugin(File.expand_path('.'), 'autoload/banshee.vim')
    vim.add_plugin(File.expand_path('.'), 'plugin/banshee.vim')

    vim.kill
  end
end
``


## Further reading

- [Tools for testing vim plugins](http://stackoverflow.com/questions/3029882/tools-for-testing-vim-plugins "Tools for testing vim plugins")
- [How to set up a Vim Plugin to be tested by vspec](http://whileimautomaton.net/2013/02/13211500 "How to set up a Vim Plugin to be tested by vspec")
- [Testing Vim Plugins with RSpec and Vimrunner on Travis CI](http://mudge.name/2012/04/18/testing-vim-plugins-on-travis-ci-with-rspec-and-vimrunner.html "Testing Vim Plugins with RSpec and Vimrunner on Travis CI")
- [Driving Vim With Ruby and Cucumber](http://andrewradev.com/2011/11/15/driving-vim-with-ruby-and-cucumber/ "Driving Vim With Ruby and Cucumber")
