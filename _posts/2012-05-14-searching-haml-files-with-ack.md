---
layout: post
title: Searching Haml files with ack
description: Ack is great for searching files but you need to extend it
categories: ['vim']
---

*This article describes how you can configure your ack settings to search for additionals files.
UPATE: [Andy Lester](http://petdance.com/), the author of ack, give me feedback about this article.*


Recently I was working on a Rails project and was using Vim with the `:Ack <pattern>` command to search after a certain
typed string "Übreschrift" and would like to replace it with the correct version "Überschrift". I typed into the console
`:Ack Übreschrift` and I couldn't find a single match. What went wrong?


## Questions to answer

Why couldn't I find the file with that content? Was I in the wrong directory? No:


    $pwd
    -> $HOME/git-repositories/brokenlifts


Did I used the wrong pattern? No, I searched after the right word "Übreschrift". Did I used the wrong command?  No, I
tried `ack-grep` in the terminal to search for other common words like *test* or *string* and could only find results in
*.rb, *.js files but not in `*.html.haml` files. Tada, found the mistake, `ack` is per default not configured to include
these very special file types. If your press `ack -f` (thanks [Andy Lester](http://petdance.com/) for this note) you
will get the output of all files ack will go through - and this command didn't displayed `*.html.haml` files.


## Solve problems .ackrc

I created the `$HOME/.ackrc` and added the entries to include these special filename:


{% highlight sh %}

--type-add
html=.html.haml

{% endhighlight %}


Now my search worked and I got hits in `*.html.haml` files for searching the term "Übreschrift".


## Further refinements

Since I'm working with Rails there are other file types like `sass, erb, less, scss, ..` I would like to include into
the search:


{% highlight sh %}

--type-add
html=.html.erb,.html.haml,.haml
--type-add
css=.sass,.less,.scss

{% endhighlight %}


And there might be directories I don't want to have in my search path. Let's ignore them and speed up our search:


{% highlight sh %}

--type-set
ignorables=.log,.tmp,.pdf
--ignore-dir=vendor
--ignore-dir=log
--ignore-dir=tmp
--ignore-dir=doc
--ignore-dir=coverage

{% endhighlight %}


If you would like to see the specified files for your grep environment search, just use `ack --help types` - this will
print all information you need. Here is an example:


{% highlight sh %}

$ ack --help types
=>
  --[no]actionscript .as .mxml
  --[no]ada          .ada .adb .ads
  --[no]asm          .asm .s
  --[no]batch        .bat .cmd
  --[no]binary       Binary files, as defined by Perl's -B op (default: off)
  --[no]cc           .c .h .xs
  --[no]cfmx         .cfc .cfm .cfml
  --[no]cpp          .cpp .cc .cxx .m .hpp .hh .h .hxx
  --[no]csharp       .cs
  --[no]css          .css .sass .less .scss
  --[no]elisp        .el
  --[no]erlang       .erl .hrl
  --[no]fortran      .f .f77 .f90 .f95 .f03 .for .ftn .fpp
  --[no]haskell      .hs .lhs
  --[no]hh           .h
  --[no]html         .htm .html .shtml .xhtml .html.erb .html.haml .haml
  --[no]ignorables   .log .tmp .pdf
  --[no]java         .java .properties
  --[no]js           .js
  --[no]jsp          .jsp .jspx .jhtm .jhtml
  --[no]lisp         .lisp .lsp
  --[no]lua          .lua
  --[no]make         Makefiles
  --[no]mason        .mas .mhtml .mpl .mtxt
  --[no]objc         .m .h
  --[no]objcpp       .mm .h
  --[no]ocaml        .ml .mli
  --[no]parrot       .pir .pasm .pmc .ops .pod .pg .tg
  --[no]perl         .pl .pm .pod .t
  --[no]php          .php .phpt .php3 .php4 .php5 .phtml
  --[no]plone        .pt .cpt .metadata .cpy .py
  --[no]python       .py
  --[no]rake         Rakefiles
  --[no]ruby         .rb .rhtml .rjs .rxml .erb .rake
  --[no]scala        .scala
  --[no]scheme       .scm .ss
  --[no]shell        .sh .bash .csh .tcsh .ksh .zsh
  --[no]skipped      Files, but not directories, normally skipped by ack (default: off)
  --[no]smalltalk    .st
  --[no]sql          .sql .ctl
  --[no]tcl          .tcl .itcl .itk
  --[no]tex          .tex .cls .sty
  --[no]text         Text files, as defined by Perl's -T op (default: off)
  --[no]tt           .tt .tt2 .ttml
  --[no]vb           .bas .cls .frm .ctl .vb .resx
  --[no]vim          .vim
  --[no]xml          .xml .dtd .xslt .ent
  --[no]yaml         .yaml .yml

{% endhighlight %}


## Further reading

- [ack](http://betterthangrep.com/)

