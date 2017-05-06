---
title: Better zsh with Prezto
date: 2016-01-21
description: Prezto is fast, has completions out of the box, and the nice autosuggestions feature of the fish-shell.
twitter_src: https://farm2.staticflickr.com/1580/23781327554_29a734ccbd_o_d.png
facebook_src: https://farm2.staticflickr.com/1580/23781327554_29a734ccbd_o_d.png
categories: linux zsh prezto
---

I haven't been a user of the [oh-my-zsh](https://github.com/robbyrussell/oh-my-zsh "oh-my-zsh") because I found it too
complicated. I was only interested in it's completion features. Therefore I ripped out this component, copied the completions from it and did the
configuration on my own.


Then I tried [fish-shell](https://github.com/sorin-ionescu/prezto "fish-shell") but wasn't satisfied.
It lacks completion but has very good autosuggestions and amazing VGA terminal colors for certain types of
commands.


[prezto](https://github.com/sorin-ionescu/prezto "prezto") jumps in here - it's an
[optimized version of oh-my-zsh](https://github.com/robbyrussell/oh-my-zsh/issues/377). It is fast,
has completions out of the box, and the nice autosuggestions feature of the fish-shell.


<br>

<img src="https://farm2.staticflickr.com/1580/23781327554_29a734ccbd_o_d.png" class="big center" alt="Here is what you get in the end"/>
<div class="caption">Here is what you get in the end</div>


*(This article has been written with `zsh 5.0.2 (i686-pc-linux-gnu)`, `xfce4-terminal 0.6.3git-f7c72e5`,
`tmux 2.2`, and `prezto 31 Jul 2015`)*


## Installation

Grab the code:


```sh
$ git clone --recursive https://github.com/sorin-ionescu/prezto.git "${ZDOTDIR:-$HOME}/.zprezto"
```


Setup the configs:


```sh
$ setopt EXTENDED_GLOB
$ for rcfile in "${ZDOTDIR:-$HOME}"/.zprezto/runcoms/^README.md(.N); do
ln -s "$rcfile" "${ZDOTDIR:-$HOME}/.${rcfile:t}"
done
```


<hr>
<div class="default alert">
  <h4>Want to read more articles like that?</h4>
  <link href="//cdn-images.mailchimp.com/embedcode/classic-10_7.css" rel="stylesheet" type="text/css">
  <style type="text/css">
    #mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; }
    /* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
       We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
  </style>
  <div id="mc_embed_signup">
  <form action="//wikimatze.us6.list-manage.com/subscribe/post?u=4010f8ce18503766e176536f1&amp;id=863c3ac16a" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
    <div id="mc_embed_signup_scroll">
    <div class="mc-field-group">
      <label for="mce-EMAIL">Email Address </label>
      <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
    </div>
    <div id="mce-responses" class="clear">
      <div class="response" id="mce-error-response" style="display:none"></div>
      <div class="response" id="mce-success-response" style="display:none"></div>
    </div>
      <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_4010f8ce18503766e176536f1_863c3ac16a" tabindex="-1" value=""></div>
      <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
    </div>
  </form>
  </div>
</div>
<hr>


If you do the steps above, you will get the following files on your system:


```sh
lrwxrwxrwx   1 wm   wm       32 Jan 20 20:41 .zlogin -> /home/wm/.zprezto/runcoms/zlogin
lrwxrwxrwx   1 wm   wm       33 Jan 20 20:41 .zlogout -> /home/wm/.zprezto/runcoms/zlogout
drwxrwxr-x   5 wm   wm     4096 Jan 20 20:43 .zprezto
lrwxrwxrwx   1 wm   wm       35 Jan 20 20:42 .zpreztorc -> /home/wm/.zprezto/runcoms/zpreztorc
lrwxrwxrwx   1 wm   wm       34 Jan 20 20:42 .zprofile -> /home/wm/.zprezto/runcoms/zprofile
lrwxrwxrwx   1 wm   wm       25 Jan 20 20:33 .zsh -> /home/wm/git/dotfiles/zsh
lrwxrwxrwx   1 wm   wm       32 Jan 20 20:42 .zshenv -> /home/wm/.zprezto/runcoms/zshenv
-rwx------   1 wm   wm   192662 Jan 20 20:48 .zsh_history
```

I didn't need all the files, so I just cloned the repository as described above and put the following line at the
beginning of my `.zshrc`:


```sh
# Source Prezto.
if [[ -s "${ZDOTDIR:-$HOME}/.zprezto/init.zsh" ]]; then
  source "${ZDOTDIR:-$HOME}/.zprezto/init.zsh"
fi
```


Please note that you will be asked if you wish to overwrite your existing files (like `.zshrc`) or skip them, if they
already exists.


## Configure your .zpreztorc

This is the heart of prezto - here you enable modules and configure them.


The README says that [the order of modules matters](https://github.com/sorin-ionescu/prezto/blob/master/runcoms/zpreztorc#L25 "the modules order matters") - I didn't follow them at first and was wondering why nothing changed:


Here is my `.zpreztorc`:


```sh
# Set the Prezto modules to load (browse modules).
# The order matters.
zstyle ':prezto:load' pmodule \
  'directory' \
  'utility' \
  'completion' \
  'git' \
  'prompt' \
  'syntax-highlighting' \
  'history-substring-search' \
```


- [directory](https://github.com/sorin-ionescu/prezto/tree/master/modules/directory "directory"): sets directory options
- [utility](https://github.com/sorin-ionescu/prezto/tree/master/modules/utility "utility"): defines aliases and functions (highlight matches when pressing `<tab>`)
- [completion](https://github.com/sorin-ionescu/prezto/tree/master/modules/completion "completion"): offers tab-completion
from the [zsh-completions project](https://github.com/zsh-users/zsh-completions "zsh-completions project")
- [git](https://github.com/sorin-ionescu/prezto/tree/master/modules/git "git"): displays git repository information in the terminal
- [prompt](https://github.com/sorin-ionescu/prezto/tree/master/modules/prompt "prompt"): defines a theme for your terminal
- [syntax-highlighting](https://github.com/sorin-ionescu/prezto/tree/master/modules/syntax-highlighting "syntax-highlighting"): offers fish-like-highlighting statuslinecolorful executables, underlined folders, ...
- [history-substring-search](https://github.com/sorin-ionescu/prezto/tree/master/modules/history-substring-search "history-substring-search"): type in a word and press up and down to cycle through matching commands


## Prompt color themes

Press `prompt -l` to get an overview of the available fonts:


```sh
$ prompt -l
Currently available prompt themes:
agnoster cloud damoekri giddie kylewest minimal nicoulaj paradox peepcode powerline pure skwp smiley sorin
steeef adam1 adam2 bart bigfade clint elite2 elite fade fire off oliver pws redhat suse walters zefram
```


And you can change the theme by typing `$ prompt <name-of-the-theme>`


## Custom prompt color theme

I found the [josh prompt](https://gist.github.com/Veraticus/1b30a6b6cbe8dae57e9f#file-prompt_josh_setup-zsh "josh") very handy but changed it with parts from [mseri prompt](http://www.mseri.me/again-on-zsh/ "mseri") to create my own one, where I can see the full path in colors. You can find the theme I'm using as a [gist prompt\_wikimatze\_setup](https://gist.github.com/wikimatze/4c2fbaf8ebe1e8ce0c1f#file-prompt_wikimatze_setup "gist prompt\_wikimatze\_setup").

Place this file in `~/.zprezto/modules/prompt/functions/prompt_wikimatze_setup` and set the theme in your `.zpreztorc`:


```sh
zstyle ':prezto:module:prompt' theme 'wikimatze'
```


## Get rid of options-groups

When pressing tab to complete a command and you don't like the category menus, you need to comment out the following
lines in `~/.zprezto/modules/completion/init.zsh`:


```sh
# Group matches and describe.
zstyle ':completion:*:*:*:*:*' menu select
# zstyle ':completion:*:matches' group 'yes'
# zstyle ':completion:*:options' description 'yes'
# zstyle ':completion:*:options' auto-description '%d'
# zstyle ':completion:*:corrections' format ' %F{green}-- %d (errors: %e) --%f'
# zstyle ':completion:*:descriptions' format ' %F{yellow}-- %d --%f'
# zstyle ':completion:*:messages' format ' %F{purple} -- %d --%f'
# zstyle ':completion:*:warnings' format ' %F{red}-- no matches found --%f'
# zstyle ':completion:*:default' list-prompt '%S%M matches%s'
# zstyle ':completion:*' format ' %F{yellow}-- %d --%f'
# zstyle ':completion:*' group-name ''
# zstyle ':completion:*' verbose yes
```


All credit for this tipp goes to [@jeromedalbert](https://twitter.com/jeromedalbert "jeromedalbert")


<br>

<img src="https://farm2.staticflickr.com/1578/24113994870_9665eba9cf_o_d.png" class="big center" alt="Prezto without options-groups"/>
<div class="caption">Prezto without options-groups</div>


## Problems with tmux

After setting up everything, I started tmux and had a flickering cursor:


<br>

![blinking_tmux](https://cloud.githubusercontent.com/assets/264708/12245132/35b399fe-b8a7-11e5-9e57-22c571a5c185.gif)

<br>


I tried a lot of different options in my `.zpretzorc` file but finally found the source of error in my `tmux.conf` file. I
had to remove some active-window/active-border settings:


```sh
set-window-option -g window-style 'bg=#181818'
set-window-option -g window-active-style 'bg=black'
set-window-option -g pane-active-border-style ''
```


I think the issue is still there but I don't see it. The issue has something to do with asynchronity, as described in the [issue on github](https://github.com/sorin-ionescu/prezto/issues/796 "issue on github").


## Command-line completion speedup with prezto

Measure terminal startup time from a fresh *oh-my-zsh*:


```sh
time zsh -i -c "print -n"
zsh -i -c "print -n"  0,08s user 0,02s system 89% cpu 0,107 total
```


But command-line completions (like `rake <tab>`) take 2 seconds until it prints the available commands.


Measure terminal startup time in *prezto*:


```sh
time zsh -i -c "print -n"
zsh -i -c "print -n"  0,34s user 0,09s system 87% cpu 0,491 total
```


But `rake <tab>` takes around 1,2 seconds until it prints the available commands. And I'm doing this a lot more than
opening new tabs, so that's a real speedup!


<hr>
<div class="default alert">
  <h4>Want to read more articles like that?</h4>
  <link href="//cdn-images.mailchimp.com/embedcode/classic-10_7.css" rel="stylesheet" type="text/css">
  <style type="text/css">
    #mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; }
    /* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
       We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
  </style>
  <div id="mc_embed_signup">
  <form action="//wikimatze.us6.list-manage.com/subscribe/post?u=4010f8ce18503766e176536f1&amp;id=863c3ac16a" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
    <div id="mc_embed_signup_scroll">
    <div class="mc-field-group">
      <label for="mce-EMAIL">Email Address </label>
      <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
    </div>
    <div id="mce-responses" class="clear">
      <div class="response" id="mce-error-response" style="display:none"></div>
      <div class="response" id="mce-success-response" style="display:none"></div>
    </div>
      <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_4010f8ce18503766e176536f1_863c3ac16a" tabindex="-1" value=""></div>
      <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
    </div>
  </form>
  </div>
</div>
<hr>


## Links

- [Shell Awesomeness With Prezto](http://joshsymonds.com/blog/2014/06/12/shell-awesomeness-with-prezto/ "Shell Awesomeness With Prezto")
- [Migrate From Oh-my-zsh to Prezto](http://jeromedalbert.com/migrate-from-oh-my-zsh-to-prezto/ "Migrate From Oh-my-zsh to Prezto")
- [theme overview with pictures](http://mikebuss.com/2014/04/07/customizing-prezto/ "theme overview with pictures")

