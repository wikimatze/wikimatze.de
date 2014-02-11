---
layout: post
title: Tab Completion for History Commands in the Zsh
description:
---
You often want to search after a certain ssh login on some machine. My normal workflow was the following:

Having the following history

{% highlight bash %}

$ history | grep foreman
  767  ssh root@foreman.it.mau.myhammer.net
 1028  ssh root@foreman.it.mau.myhammer.net
 1030  ssh-copy-id root@foreman.it.mau.myhammer.net
 1032  ssh root@foreman.it.mau.myhammer.net
 1240  history | grep foreman
 1241  ssh root@foreman.it.mau.myhammer.net
 1932  root@foreman.it.mau.myhammer.net
 1933  ssh root@foreman.it.mau.myhammer.net
 2026  ping foreman.it.mau.myhammer.net
 2119  ssh root@foreman.it.mau.myhammer.net
 2422  history | grep foreman
 2423  ssh root@foreman.it.mau.myhammer.net
 2981  ssh root@foreman.it.mau.myhammer.net
 3725  history | grep foreman
 3726  ssh root@foreman.it.mau.myhammer.net
 4034  ssh root@foreman.it.mau.myhammer.net
 4468  ssh root@foreman.it.mau.myhammer.net
 4480  ssh root@foreman.it.mau.myhammer.net
 4483  ssh root@foreman.it.mau.myhammer.net
 4655  ping foreman.it.mau.myhammer.net
 4657  ssh root@foreman.it.mau.myhammer.net
 4658  ping foreman.it.mau.myhammer.net
 4659  ssh root@foreman.it.mau.myhammer.net
 4793  ssh root@foreman.it.mau.myhammer.net
 4796  ssh root@foreman.it.mau.myhammer.net
 4814  ssh root@foreman.it.mau.myhammer.net
 4864  ssh root@foreman.it.mau.myhammer.net
 4989  ssh root@foreman.it.mau.myhammer.net
 5016  ssh root@foreman.it.mau.myhammer.net
 5138  ssh root@foreman.it.mau.myhammer.net
 5251  ssh root@foreman.it.mau.myhammer.net
 7662  ssh root@foreman.it.mau.myhammer.net
 7664  ssh root@foreman.it.mau.myhammer.net
 7670  ping foreman.it.mau.myhammer.net
 7724  ssh root@foreman.it.mau.myhammer.net
 8138  curl -H "Content-Type:application/json" -H "Accept:application/json"  http://foreman/hosts
 8139  curl -H "Content-Type:application/json" -H "Accept:application/json" foreman.it.mau.myhammer.net
 8140  curl -H "Content-Type:application/json" -H "Accept:application/json" foreman.it.mau.myhammer.net/hosts
 8141  curl -H "Content-Type:application/json" -H "Accept:application/json" https://foreman.it.mau.myhammer.net/hosts
 8143  vim foreman.rb
 8145  ruby foreman.rb
 8146  vim foreman.rb
 8149  ruby foreman.rb
 8151  ruby foreman.rb
 8157  ruby foreman.rb
 8158  vim foreman.rb
 8160  ruby foreman.rb
 8166  ruby foreman.rb
 8201  ruby foreman.rb
 8265  mv bla.rb foreman_update.rb

{% endhighlight %}


The I would go into copy mode of [tmux]() and grab the command I'm searching for. But when you are working in the zsh
you probably want something better like `$ ssh <Tab>` to do fuzzy searching after the most relevant usage of the
matching command. Please add the following code into your `.zshrc`:


{% highlight bash %}

# Press <C-X><C-X> to start autocompletion for commands typed into the history
autoload -Uz history-beginning-search-menu
zle -N history-beginning-search-menu
bindkey '^X^X' history-beginning-search-menu

{% endhighlight %}


Now you can `<C-X><C-X>` and the diget of the command you want to have for your shell. An example would be the
following:


{% highlight bash %}

$ ls
Enter digit:
1 ls -la  2 ls -la project  3 ls -la | grep projects  4 ls options/

{% endhighlight %}


When you press `2` your prompt shell will be filled with `ls -la project`.

