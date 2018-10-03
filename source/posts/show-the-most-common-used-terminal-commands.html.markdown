---
title: Show the most common used terminal commands
nav: articles
date: 2014-11-12
updated: 2014-11-20
description: Show the most common used terminal commands for bash and zsh, thanks @r00k and @jayeff for the inspiration
categories: linux zsh
---

I watched recently a ["Play by Play"](http://www.pluralsight.com/courses/play-by-play-ben-orenstein) video featuring [Ben Orenstein](https://twitter.com/r00k). He is using a ton of command line alias and presented his work flow: He is searching the command line `history` file of the most common used terms. After that create some nice alias to save you time.


I asked Ben for the snippet:


<blockquote class="twitter-tweet" lang="en"><p><a href="https://twitter.com/wikimatze">@wikimatze</a> history | awk &#39;{a[$2]++}END{for(i in a){print a[i] &quot; &quot; i}}&#39; | sort -rn | head</p>&mdash; Ben Orenstein (@r00k) <a href="https://twitter.com/r00k/status/489436243243974656">July 16, 2014</a></blockquote>
<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>


All you have to do is to call:


```sh
wm~  % history | awk '{a[$2]++}END{for(i in a){print a[i] " " i}}' | sort -rn | head
  4716 git
  4526 vim
  3567 ls
  2140 cd
  1269 bundle
  877 sudo
  755 tig
  725 ..
  723 clear
  513 rm
```


[Johannes Faigle](https://twitter.com/jayeff) pinged me on [twitter](https://twitter.com/jayeff/status/489530404589031424) a more sophisticated variant of the [oh-my-zsh](https://github.com/robbyrussell/oh-my-zsh/blob/217d8f0540a41b2927caf986561e45634fa1952a/lib/functions.zsh#L2):


```sh
function zsh-stats() {
  fc -l 1 | awk '{CMD[$2]++;count++;}END { for (a in CMD)print CMD[a] " " CMD[a]/count*100 "% " a;}' | grep -v "./" | column -c3 -s " " -t | sort -nr | nl | head -n25
}
```


Now calling `zsh-stats` gives you the following overview:


```sh
wm~  % zsh-stats
     1	4716  18.8746%     git
     2	4526  18.1141%     vim
     3	3567  14.276%      ls
     4	2140  8.5648%      cd
     5	1269  5.07884%     bundle
     6	877   3.50997%     sudo
     7	755   3.02169%     tig
     8	725   2.90162%     ..
     9	723   2.89362%     clear
    10	513   2.05315%     rm
    11	406   1.62491%     d
    12	267   1.0686%      v
    13	241   0.96454%     rake
    14	238   0.952533%    exec
    15	222   0.888498%    tmux
    16	216   0.864484%    cf
    17	183   0.73241%     bash
    18	181   0.724406%    tmuxifier
    19	158   0.632354%    gem
    20	152   0.608341%    ruby
    21	146   0.584327%    fg
    22	145   0.580325%    mv
    23	141   0.564316%    ~
    24	121   0.484271%    padrino
    25	121   0.484271%    ack-grep
```


Now go out and create your personal aliases!

