---
title: Git Diff Is Showing Weird Output in the Terminal
description: Getting back the beauty of a git diff
---

Recently running `git diff README.md` gave me the following strange output:


{% highlight bash %}

ESC[1;30mdiff --git a/mappings.md b/mappings.mdESC[m
ESC[1;30mindex 2fcd88b..fb73590 100644ESC[m
ESC[1;30m--- a/mappings.mdESC[m
ESC[1;30m+++ b/mappings.mdESC[m
ESC[1;35m@@ -152,7 +152,7 @@ESC[m
   pattern. In this case we delete lines that don’t match what we’re looking for.ESC[m
 - `:help :global` ... is how we can run a given command (in this case a :normal command) for each line thatESC[m
   matches a pattern.  example :g/def/normal Ai -> will insert at the end of each line containing theESC[m
ESC[1;31m-  def word a 'i' toESC[m
ESC[1;32m+ESC[mESC[1;32m  def word a 'i'ESC[m
 - `&` ... repeats the last substitution command `%s/.../<options>`ESC[m
 - `&&` ... the first `&` forms the Ex command which repeats the last :substitute command, the secondESC[m
   `&` indicates, that the flags from the previous :substitute command should be reusedESC[m
- (1/1) Line 1/13

{% endhighlight %}


Instead of showing nicely colored output, it escaped all the sequences. I played around a little with the diff tools
but this was not the root of the problem. In fact it was a pagers problem. Running `git --no-page diff README.md` gave
me back my colors:


{% highlight bash %}

diff --git a/README.md b/README.md
index 85a8fba..4e8a9b3 100644
--- a/README.md
+++ b/README.md
@@ -1,5 +1,7 @@
 # Vim settings

+Test
+
 I'm always eager to learn, but I can't remember everything. Here is the list of the plugins I'm using - it is a reminder
 of the most important commands and settings for each plugin.

{% endhighlight %}


But I want to use a pager. So I wanted to check my git settings `git config --list | grep pager` and there was entry.
Instead I want to use `less` as my default pager:


{% highlight bash %}

$ git config --global core.pager less

{% endhighlight %}


But this didn't solve my issue. I then set page to `cat` and it worked


{% highlight bash %}

$ git config --global core.pager cat

{% endhighlight %}



Another simpler solution to this problem would have been to disable the coloring with `git config color.ui never` but
that would leave me away with lovely syntax coloring :(.
