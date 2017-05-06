---
title: Viewing man in vim
description: Viewing man pages in vim either with vim-superman or via bash export
categories: vim
---

I have created a lot to use many things in vim. So why not reading [man pages](https://en.wikipedia.org/wiki/Man_page "man pages") in vim instead of using the default
reader [less](https://en.wikipedia.org/wiki/Less_(Unix) "less").


Here is the normal view:

<img src="https://farm8.staticflickr.com/7324/27768612602_b8a9a1abd9_h_d.jpg" class="big center" alt="Viewing man with less"/>
<div class="caption">"Viewing man with less"</div>


## Using vman

[vim-superman](https://github.com/jez/vim-superman "vim-superman") is a tool which I've used in the past to view
manpages. After installing the plugin, you need to configure your shell:

```sh
vman() {
  vim -c "SuperMan $*"

  if [ "$?" != "0" ]; then
    echo "No manual entry for $*"
  fi
}

compdef vman="man"
```


Now opening a a manual with `$ vman git` gives you the following view:

<img src="https://farm8.staticflickr.com/7393/27793960971_cd6eb4254b_h_d.jpg" class="big center" alt="Viewing man with vman"/>
<div class="caption">"Viewing man with vman"</div>


## Export bash for viewing man pages

All credits for the following snippets goes to [Zameer Manji blog post](https://zameermanji.com/blog/2012/12/30/using-vim-as-manpager/ "Zameer Manji blog post")


```sh
export MANPAGER="col -b | vim -c 'set ft=man ts=8 nomod nolist nonu noma' -"
```


And now it looks like the following when using `$ man git`:

<img src="https://farm8.staticflickr.com/7041/27768612972_93865b4a13_h_d.jpg" class="big center" alt="Viewing man with Vim"/>
<div class="caption">"Viewing man with Vim"</div>


## Using manpager.vim

On my [commit](https://github.com/wikimatze/vimfiles/commit/e019f2ec00b0b6ccde1baeb97ca68289c13bed9b "commit") a user
told me that vim already has a build-in manpager. Looking into `:h manpager.vim` gives you hint to enable vim as the
default page view with:


```sh
export MANPAGER="env MAN_PN=1 vim -M +MANPAGER -"
```


Opening a file with `$ man git` should have the same effect as the line above. If you are under a word and wants to find help for it, just press `K` to open it and press
`q` to close the window.


To start using the ":Man" command you need to source this script from your startup vimrc file: >


```vim
runtime ftplugin/man.vim
```


You can enable folding with:


```sh
setlocal foldmethod=indent foldenable
```

<img src="https://farm8.staticflickr.com/7541/27299385994_9770bed360_h_d.jpg" class="big center" alt="Viewing man with manpager.vim"/>
<div class="caption">"Viewing man with manpager.vim"</div>


## Alternative: vim-man plugin

[vim-man](https://github.com/vim-utils/vim-man "vim-man") gives you the the `:Man` command from which you can views man
in a split window as well as [man related commands](https://github.com/vim-utils/vim-man#when-inside-a-man-page-buffer "man related commands") to move faster around.

