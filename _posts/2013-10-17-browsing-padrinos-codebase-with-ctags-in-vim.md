---
layout: post
title: Browsing Padrino's Code Base With Ctags in Vim
update: 2014-03-30
categories: ['padrino', 'vim']
---

{% include leanpub.html %}

{% include newsletter.html %}

Working effectively with ctags has been a topic I avoided for a long time because I was too lazy to invest the time to learn about it.

I was working on my application and needed to constantly consult [Padrino's API docs](http://www.padrinorb.com/api/index.html) in the browser. It would have been more effective if I could do the searching directly in [Padrino's code](https://github.com/padrino/padrino-framework). Even better would be if I didn't have to leave the terminal and could stay in the flow of coding. It's possible with `ctags`!


## What is ctags

[Ctags](http://ctags.sourceforge.net/ "ctags") is a tool which make it easy for you to shift rapidly through code.
It does this by indexing classes, methods, variables and other things. All this information is stored in a `tags` file - one line in this file contains one tag.


Ctags is the tool to browse a large code base like [Padrino](http://www.padrinorb.com/ "Padrino"), where you might not know the project layout and class/method definitions.  Being able to jump forward and backward between variables, classes, modules, and methods is essential in getting to know a code base.


## Installing ctags

Depending on your operation system, you can install it on Ubuntu/Debian with the following packages:


{% highlight bash %}

$ sudo apt-get install exuberant-ctags

{% endhighlight %}


Why I'm installing `exuberant-ctags` instead of `ctags`? *Ctags* was originally written by [Ken Arnold](http://en.wikipedia.org/wiki/Ken_Arnold "Ken Arnold") (the author of the ["Rogue video game"](http://en.wikipedia.org/wiki/Rogue_%28video_game%29 "Rogue video game")) and was first introduced in *BSD Unix*. *Exuberant ctags* is a variant of `ctags` and was distributed with [Vim 6.0](http://vimdoc.sourceforge.net/htmldoc/version6.html#ctags-gone "Vim 6.0"). The main benefit of *exuberant ctags* is that it support over 40 languages and has regular expression support which make it easier to create your own [custom language parser](http://ctags.sourceforge.net/EXTENDING.html "Exuberant ctags language parser") for creating the `tags` file. The `tags` contains the collected information about the things you want to know.


## Generating ctags for the Padrino's code base

Clone [Padrino](https://github.com/padrino/padrino-framework) and run the following command at the root of the project:


{% highlight bash %}

$ git clone https://github.com/padrino/padrino-framework
$ cd padrino-framework
$ ctags -R .

{% endhighlight %}


The command will run recursively through the directory and will tag all sources and files it can find. During running the `ctags -R .` command I got the following error:



{% highlight bash %}

ctags: Warning: ignoring null tag in padrino-admin/lib/padrino-admin/generators/templates/assets/javascripts/bootstrap/bootstrap.min.js

{% endhighlight %}


Okay, we are actually interested in all the things, except [JavaScript](https://en.wikipedia.org/wiki/JavaScript "Javascript"). Let's exclude those files with the following command:


{% highlight bash %}

    $ ctags -R --exclude="*.js" .

{% endhighlight %}


If you are done with the command, you have a `tags` file created in the current directory. Let's open the generated `tags` file and try to understand the basic nature of the file:


{% highlight ruby %}

    !_TAG_FILE_FORMAT	2	/extended format; --format=1 will not append ;" to lines/
    !_TAG_FILE_SORTED	1	/0=unsorted, 1=sorted, 2=foldcase/
    !_TAG_PROGRAM_AUTHOR	Darren Hiebert	/dhiebert@users.sourceforge.net/
    !_TAG_PROGRAM_NAME	Exuberant Ctags	//
    !_TAG_PROGRAM_URL	http://ctags.sourceforge.net	/official site/
    !_TAG_PROGRAM_VERSION	5.9~svn20110310	//
    <<	padrino-core/lib/padrino-core/logger.rb	/^    def <<(message = nil)$/;"	f
    ==	padrino-core/lib/padrino-core/mounter.rb	/^    def ==(other)$/;"	f	class:Padrino.Mounter
    AbstractFormBuilder	padrino-helpers/lib/padrino-helpers/form_builder/abstract_form_builder.rb	/^      class AbstractFormBuilder # @private$/;"	c	class:Padrino.Helpers.FormBuilder
    AbstractHandler	padrino-helpers/lib/padrino-helpers/output_helpers/abstract_handler.rb	/^      class AbstractHandler$/;"	c	class:Padrino.Helpers.OutputHelpers
    AccessControl	padrino-admin/lib/padrino-admin/access_control.rb	/^    module AccessControl$/;"	m	class:Padrino.Admin
    AccessControlError	padrino-admin/lib/padrino-admin/access_control.rb	/^    class AccessControlError < StandardError # @private$/;"	c	class:Padrino.Admin
    Account	padrino-admin/test/fixtures/data_mapper.rb	/^class Account$/;"	c
    Actions	padrino-admin/lib/padrino-admin/generators/actions.rb	/^      module Actions$/;"	m	class:Padrino.Generators.Admin
    ...

{% endhighlight %}


The header of each tag file gives you basic information about the creation of the file:


{% highlight ruby %}

    !_TAG_FILE_FORMAT	2	/extended format; --format=1 will not append ;" to lines/
    !_TAG_FILE_SORTED	1	/0=unsorted, 1=sorted, 2=foldcase/
    !_TAG_PROGRAM_AUTHOR	Darren Hiebert	/dhiebert@users.sourceforge.net/
    !_TAG_PROGRAM_NAME	Exuberant Ctags	//
    !_TAG_PROGRAM_URL	http://ctags.sourceforge.net	/official site/
    !_TAG_PROGRAM_VERSION	5.9~svn20110310	//

{% endhighlight %}


As you can see, the tags are sorted, folded, and you can see the version of ctags in which they were created.  If you take a look close in the example above, you can see detect a tag name schema: Let's consider our first tag:


{% highlight ruby %}

<<	padrino-core/lib/padrino-core/logger.rb	/^    def <<(message = nil)$/;"	f

{% endhighlight %}


First of all you have the **tagname** `<<`, then a tab as separator (it isn't visible in the code examples above), then **tagfile** `padrino-core/lib/padrino-core/logger.rb` where the tag can be found, followed by a tab, and finally the **tagaddress** the exact location of the tag inside the *tagfile*. The **tagaddress** is a regular expression - the special characters in a search pattern are `^` (begin-of-line) and `$` (indicates the end of the line). Finally a **term** marked with `;"` which indicates if the tag is either a class (`c`), module (`m`), or function (`f`). The *term* may differ for which language constructs you are going to create your tags.


## Jumping into our first tag

Let's open the `padrino-core/lib/padrino-core.rb` file and place your cursor on `server` on line 13:

{% highlight ruby %}

require 'sinatra/base'
require 'padrino-core/version'
require 'padrino-core/support_lite'
require 'padrino-core/application'

require 'padrino-core/caller'
require 'padrino-core/command'
require 'padrino-core/loader'
require 'padrino-core/logger'
require 'padrino-core/mounter'
require 'padrino-core/reloader'
require 'padrino-core/router'
require 'padrino-core/server'
require 'padrino-core/tasks'
require 'padrino-core/module'

# The Padrino environment (falls back to the rack env or finally develop)
PADRINO_ENV  = ENV["PADRINO_ENV"]  ||= ENV["RACK_ENV"] ||= "development"  unless defined?(PADRINO_ENV)
# The Padrino project root path (falls back to the first caller)
PADRINO_ROOT = ENV["PADRINO_ROOT"] ||= File.dirname(Padrino.first_caller) unless defined?(PADRINO_ROOT)

module Padrino
  ...
end

{% endhighlight %}


Now press `<C-]>`- you'll directly to the `Server` class in the `padrino-core/lib/padrino-core/server.rb` file. Awesome,
that is what you know now what you want to know and you can jump back to your previous position with `<C-o>` or
`<C-t>`.


You can also jump to the tag you want the commandline mode in Vim and use the [:tag](http://vimdoc.sourceforge.net/htmldoc/tagsrch.html#:tag "Vim :tag") command. Type in the name of the class or method you want to jump to. For example, if you type in `:tag Padrino` you will jump to a tag. But you already have a suspicion that `Padrino` exists in more than one file. You may think this is a mistake but ctags keeps up a list of all the tags you have explored so far.


If you searched after `:tag Padrino` again you can message line beyond in your command window: `tag 1 of 81 or more`.  There are 81 searchable matchings tags available. Per default Vim will take the first matching tag if your search for the first time in your vim session after `:tag Padrino`. Use `:tselect` followed by a number to jump to the tag you want:


{% highlight ruby %}

  # pri kind tag               file
> 1 F C m    Padrino           padrino-admin/lib/padrino-admin.rb
               module Padrino
  2 F   m    Padrino           padrino-admin/lib/padrino-admin/access_control.rb
               module Padrino
  3 F   m    Padrino           padrino-admin/lib/padrino-admin/generators/actions.rb
               module Padrino
  4 F   m    Padrino           padrino-admin/lib/padrino-admin/generators/admin_app.rb
               module Padrino
  5 F   m    Padrino           padrino-admin/lib/padrino-admin/generators/admin_page.rb
  ...

{% endhighlight %}


You can chose what you want to have. There a bunch of more commands you can use to navigate multiple tags:


- `:tnext (or :tn)` - Goes to the next tag in the `:tselect` list.
- `:tprev (or :tp)` - Goes to the previous tag in the `:tselect` list.
- `:tfirst (or :tf)` - Goes to the first tag in the `:tselect` list.
- `:tlast (or :tl)` - Goes to the last tag in the `:tselect` list.


Before going to add the tags for the Padrino project as well as any other sources you are using on your project, we need
to understand how we can get a big tag file of all our installed gems and after that limit our scope to these parts we
only need.


## Ctag for installed gems

Let's say you are using [rbenv](https://github.com/sstephenson/rbenv "rbenv") to manage your ruby versions and you want
to get a global tag file of all your installed gems. Please run the following command:


{% highlight bash %}

$ ctags -R -f gems.tag * ~/.rbenv/versions/<your-ruby-version>/lib

{% endhighlight %}


I have ove 269 installed gems on my system (use `gem list | wc -l`) and it took around 7 seconds to generate a tag file with over 200.000 lines. The chances are high that you have errors in your `tags` file occur and I really don't want to load such a big tag file into my vim session. Please note, that the generated tag file `gems.tag` instead of `tags`.


## Generating Ctags project specific ones gems

If you think about a ruby project, it is very likely that you will have `Gemfile` with all the specified extensions you need for your project. [Andrew Radev](http://andrewradev.com/2011/06/08/vim-and-ctags/ "Andrew Radev") has created a [ruby snippet](https://gist.github.com/893236 "ruby snippet") that uses [Bundler API](http://bundler.io/ "Bundler API") for retrieving the used Gemfile in your project and builds a tag file. Instead of using the script you can also perform the following one-liner on the route of your application:


{% highlight bash %}

ctags -R -f gems.tags `bundle show --paths`

{% endhighlight %}


You have a Padrino project (like my [Job Vacancy](https://github.com/matthias-guenther/job-vacancy)) with the following `Gemfile` for example:


{% highlight ruby %}

source 'https://rubygems.org'

# Server requirements
gem 'thin', '1.5.1'

# Project requirements
gem 'rake', '10.0.4'
gem 'uglifier', '2.1.1'
gem 'yui-compressor', '0.9.6'

# Component requirements
gem 'erubis', '~> 2.7.0'
gem 'activerecord', '~> 3.2.9', :require => 'active_record'
gem 'sqlite3', '~> 1.3.6'

# Test requirements
group :test do
  gem 'rspec' , '2.13.0'
  gem 'factory_girl', '4.2.0'
  gem 'rack-test', '0.6.2', :require => 'rack/test'
end

gem 'guard-rspec'
gem 'libnotify'

# Security
gem 'bcrypt-ruby', '3.0.1', :require => 'bcrypt'

# Padrino Stable Gem
gem 'wirble', '0.1.3'
gem 'pry', '0.9.12'
gem 'tilt', '1.3.7'

# Padrino edge
gem 'padrino', :git => "git://github.com/padrino/padrino-framework.git"

{% endhighlight %}


`bundle show --paths` will print the absolute path of the used Gems in the following form:


{% highlight sh %}

/home/helex/.rbenv/versions/2.0.0-p247/lib/ruby/gems/2.0.0/gems/open4-1.3.0
/home/helex/.rbenv/versions/2.0.0-p247/lib/ruby/gems/2.0.0/bundler/gems/padrino-framework-0c1317b0c897/padrino
/home/helex/.rbenv/versions/2.0.0-p247/lib/ruby/gems/2.0.0/bundler/gems/padrino-framework-0c1317b0c897/padrino-admin
/home/helex/.rbenv/versions/2.0.0-p247/lib/ruby/gems/2.0.0/bundler/gems/padrino-framework-0c1317b0c897/padrino-cache
/home/helex/.rbenv/versions/2.0.0-p247/lib/ruby/gems/2.0.0/bundler/gems/padrino-framework-0c1317b0c897/padrino-core
/home/helex/.rbenv/versions/2.0.0-p247/lib/ruby/gems/2.0.0/bundler/gems/padrino-framework-0c1317b0c897/padrino-gen
/home/helex/.rbenv/versions/2.0.0-p247/lib/ruby/gems/2.0.0/bundler/gems/padrino-framework-0c1317b0c897/padrino-helpers
/home/helex/.rbenv/versions/2.0.0-p247/lib/ruby/gems/2.0.0/bundler/gems/padrino-framework-0c1317b0c897/padrino-mailer
/home/helex/.rbenv/versions/2.0.0-p247/lib/ruby/gems/2.0.0/bundler/gems/padrino-sprockets-8f4f6150b2d9
/home/helex/.rbenv/versions/2.0.0-p247/lib/ruby/gems/2.0.0/gems/polyglot-0.3.3
/home/helex/.rbenv/versions/2.0.0-p247/lib/ruby/gems/2.0.0/gems/pry-0.9.12
/home/helex/.rbenv/versions/2.0.0-p247/lib/ruby/gems/2.0.0/gems/rack-1.5.2

{% endhighlight %}

When you start vim in the root of your project, it will only load the `tags` file but not the `gems.tags` file. Just
open the commandline in vim and type in `:set tags+=gems.tags`.


If you find yourself doing it over and over again for different project, you have to setup the following setting in your
`.vimrc`


{% highlight vim %}

set tags=tags,./tags,gems.tags,./gems.tags

{% endhighlight %}


Vim will search for the file named `tags`, starting with the directory of the current file. Since padrino is seperated into different parts you want to jump to the parent directory to find the tag files so you have to enable [uppward search](http://vimdoc.sourceforge.net/htmldoc/editing.html#file-searching) with the `;` symbol at the end of the search term


{% highlight vim %}

set tags=./tags;,./gems.tags;

{% endhighlight %}


and then recursively to the directory one level above, till it either locates the `tags` file or reaches the
root directory. It will do exactly the same for the `gems.tags` file.


## Autogenerate tags with Autotags.vim

During the coding you are going to change the name of the method or class and have to generate the tags by hand.
Do you really want to leave the terminal and generate the tags on your own? Tada, there is [Autotags.vim](http://www.vim.org/scripts/script.php?script_id=1343 "Autotags vim plugin"). It deletes all tags that are no longer present and calls `ctags -a` to append the new tags to your existing tag file. To try it out, create a new directory with a the following class definition inside the file:


{% highlight ruby %}

class Ctags

end

{% endhighlight %}


Now create the tags with `ctags -R .` search after the tag `Ctags` with `:tag Ctags`, after that change the class name
from `Ctags` to `VimCtags`. If this doesn't work for you, it means that you don't have python support enabled for
your vim version. You can check it with `vim --version | grep python` - a `+python` means that you have it.
I have written a blog post about how to [install vim with python support](/compiling-vim-from-source-for-ubuntu-and-mac-with-rbenv.html) for the case you have problems with this.


## Fuzzy like tag search with Ctrlp plugin

As we have learned before it is possible that we partially know the name of the class or method name we want to use. This
is wherre you have to use [ctrlp.vim](http://kien.github.io/ctrlp.vim/) plugin. Ones installed, it gives you the
`:CtrlPTag` tag command which make it possible to do a fuzzy like tag search.


If you find yourself using this command very often, you have to add the following mapping into your `vimrc`:


{% highlight bash %}

nnoremap <leader>. :CtrlPTag<cr>

{% endhighlight %}

if the Ctrlp doesn't provide you enough hits, please use `:tselect`.


## Further Reading

- [Video about ctags](http://lanyrd.com/2013/navigating-a-codebase-with-vim/scgkmx/)
- [Good introduction](http://blog.stwrt.ca/2012/10/31/vim-ctags)
- [Specialize ctags for ruby](http://andrewradev.com/2011/06/08/vim-and-ctags/)
- [Browsing programs with tags](http://vim.wikia.com/wiki/Browsing_programs_with_tags)

{% include newsletter.html %}

