---
layout: post
title: Using Hub for Faster Contributing to GitHub Open-Source Projects
description: Learn how you can faster work with Open-Source projects
---
*Ever wondering how you can easily fork and contribute to an Open-Source project without forking a repository manually
in your browser? Then you should have a look into the [hub gem](https://github.com/defunkt/hub).*


Hub is a command-line wrapper for [git](http://git-scm.com/) written by [defunkt](http://defunkt.io/). With it, you can
easily create forks of repositories, making pull requests, and get code from other forks with no problems. If you are a
maintainer of a very popular repository like [twitter bootstrap](https://github.com/twitter/bootstrap) with over ~16k
forks, this tool makes your life a lot easier.


## Installing hub

Just perform the following command:


{% highlight bash %}

$ gem install hub
$ hub hub standalone > ~/bin/hub && chmod +x ~/bin/hub

{% endhighlight %}


## Workflow to get things done

What I normally do when using Open-Source technologies like the [Gumby CSS Framework](http://gumbyframework.com/)
is trying to give something back. For example  by improving documentation, reporting bugs, or solving problems.


First of all let's *clone*the code from the framework:


{% highlight bash %}

$ hub clone GumbyFramework/Gumby
  Cloning into 'Gumby'...
  remote: Counting objects: 1106, done.
  remote: Compressing objects: 100% (547/547), done.
  remote: Total 1106 (delta 597), reused 1051 (delta 551)
  Receiving objects: 100% (1106/1106), 845.91 KiB | 20 KiB/s, done.
  Resolving deltas: 100% (597/597), done.

{% endhighlight %}


Now let's make a branch for fixing some documentation issues:


{% highlight bash %}

$ git checkout -b readme-fixes

{% endhighlight %}


Now you make your changes and run a `git commit -m "Fixed documentation"` and you are ready to
[fork the repo](https://help.github.com/articles/fork-a-repo):


{% highlight bash %}

$ hub fork

{% endhighlight %}


Now you need to push the changes to your remote and open a pull request:


{% highlight bash %}

$ git push -u matthias-guenther readme-fixes
$ hub pull-request

{% endhighlight %}


That's it. If you want to see a list of open issues, you can use the following command:


{% highlight bash %}

$ hub browser -- issues

{% endhighlight %}

This will open the issue site in your browser. In our case this would be [https://github.com/GumbyFramework/Gumby/issues](https://github.com/GumbyFramework/Gumby/issues).


## Conclusion

The idea for this blog came out of my first remote paring session with my friend [@_ZPH](https://twitter.com/_ZPH) where
I wanted to show him this gem but wasn't able to explain him the workflow. So this little snippet is a reminder for him
and me.


## Further Reading

- [hub documentation](http://defunkt.io/hub/)
