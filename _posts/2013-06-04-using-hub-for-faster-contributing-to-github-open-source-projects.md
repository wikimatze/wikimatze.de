---
title: Using Hub for Faster Contributing to GitHub Open-Source Projects
update: 2014-11-20
categories: howto programming learning git
---
*Ever wondering how you can easily fork and contribute to an Open-Source project without forking a repository manually in your browser? Then you should have a look into the [hub gem](https://github.com/defunkt/hub).*


Hub is a command-line wrapper for [git](http://git-scm.com/) written by [defunkt](http://defunkt.io/). With it, you can easily create forks of repositories, making pull requests, and get code from other forks with no problems. If you are a maintainer of a very popular repository like [twitter bootstrap](https://github.com/twitter/bootstrap) with over ~23k forks, this tool makes your life a lot easier.


*Update*: [gh](https://github.com/jingweno/gh) is the hub implementation written in [Go](http://golang.org/).
It is faster and will [be a replacement](https://github.com/github/hub/issues/475) of the pure hub in the future - thanks [@\_ZKH](https://twitter.com/_ZPH) for showing me this.


## Installing hub

Run perform the following command:


```bash
$ gem install hub
$ hub hub standalone > ~/bin/hub && chmod +x ~/bin/hub
```


## Workflow to get things done

What I normally do when using Open-Source technologies like the [Gumby CSS Framework](http://gumbyframework.com/) is trying to give something back. For example  by improving documentation, reporting bugs, or solving problems.


First of all let's get the code:


```bash
$ hub clone GumbyFramework/Gumby
  Cloning into 'Gumby'...
  remote: Reusing existing pack: 3607, done.
  remote: Total 3607 (delta 0), reused 0 (delta 0)
  Receiving objects: 100% (3607/3607), 1.63 MiB | 545.00 KiB/s, done.
  Resolving deltas: 100% (1925/1925), done.
  Checking connectivity... done
```


Now let's make a branch for fixing some documentation issues:


```bash
$ git checkout -b readme-fixes
```


Now you make your changes and run a `git commit -m "Fixed documentation"` and you are ready to [fork the repo](https://help.github.com/articles/fork-a-repo):


```bash
$ hub fork
```


Now you need to push the changes to your remote and open a pull request:


```bash
$ git push -u wikimatze readme-fixes
$ hub pull-request
```


That's it. If you want to see a list of open issues, you can use the following command:


```bash
$ hub browser -- issues
```

This will open the issue site in your browser. In our case this would be [https://github.com/GumbyFramework/Gumby/issues](https://github.com/GumbyFramework/Gumby/issues).


## Conclusion

The idea for this blog came out of my first remote paring session with my friend [@\_ZPH](https://twitter.com/_ZPH) where I wanted to show him this gem but wasn't able to explain him the work flow. So this little snippet is a reminder for him and me.


## Further Reading

- [hub documentation](http://defunkt.io/hub)

