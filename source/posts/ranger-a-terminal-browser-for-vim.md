---
title: Ranger a terminal browser for Vim
nav: articles
date: 2016-05-30
update: 2016-05-41
description: Ranger a terminal browser for Vim
categories: vim tool
---

[Ranger](http://ranger.nongnu.org/ "Ranger") is a file manager with VI key bindings. It provides a minimalistic and nice curses
interface with a view on the directory hierarchy. I stumbled upon this tool during a
[vimberlin meetup](http://vimberlin.de/ "vimberlin meetup").


## Installation

Per package:


```sh
$ sudo apt-get install ranger
```


Or per source:


```sh
$ git clone git://git.savannah.nongnu.org/ranger.git /tmp/ranger && cd /tmp/ranger && git checkout v1.7.2 && sudo make install ```


## First start

```sh
$ ranger
```

TBD: Image

What you see are `Miller columns`, where the middle pane is the current directory, the left pane is the parent
directory, and the right pane displays a preview for the file your are currently browser in the middle column. All in
all it looks like [Finder](https://en.wikipedia.org/wiki/Finder_(software) "Finder") tool for Mac.


Text files are displayed with the [less program](https://en.wikipedia.org/wiki/Less_(Unix) "less program"). PDFs are
converted to text for displaying preview and images are shown either with ASCII images or your default image viewer.

And get out of it via `q`.


## Navigation shortcuts

- `gg` ... Go to the top of the list
- `G` ... Go to the bottom of the list
- `<C-f>` ...  Page down
- `<C-b>` ...  Page up
- `J` ... Page down 1/2 page
- `K` ... Page up 1/2 page
- `H` ... Go back through navigation history
- `L` ... Go forward through navigation history
- `o` ... will open order context and after which filter you want to see the files
- `zh` ... toggle show hidden files


## Working with Files:

- `i` ... display the file
- `E|I` ... edit the file
- `r` ... open file with the chosen program
- `cw` ... rename file
- `/` ... search for files (`n|p` jump to next/previous match)
- `dd` .. mark file for cut
- `ud` ... uncut
- `p` ... paste file
- `yy` .. copy/yank file
- `zh` ... show hidden files


## General shortcuts

- `R` ... reload current directory
- `<C-n>` ... creates an new tab
- `<C-w>` ... close the current tab
- `<Tab>` ... jump to the next tab
- `<Shift-Tab>` ... jump to the previous tab
- `q` ... will quit ranger
- `?` ... open the man, keybindings, commands, or settings



## Command interface

- `:delete` ... delete the selected file
- `:mkdir` ... create a directory
- `:touch` ... create a file
- `:rename` ... rename file
- `:help` ... show help (and then pressing `k` will print the shortcuts)


## Customizing ranger

```sh
$ ranger --copy-config=all
```

It will create the `rifle.conf`, `commands.py`, `commands_full.py`, `rc.conf`, and `scope.sh`
files in your `~/.config/ranger` folder. `rifle.conf` is rangers file executor/opener.

E.g.:

```sh
#--------------------------------------------
# Audio without X
#-------------------------------------------
mime ^audio|ogg$, terminal, has mplayer  = mplayer -- "$@"
mime ^audio|ogg$, terminal, has mplayer2 = mplayer2 -- "$@"
mime ^audio|ogg$, terminal, has mpv      = mpv -- "$@"
ext midi?,        terminal, has wildmidi = wildmidi -- "$@"
```


`commands_full.py` defines commands for your `rc.conf` as well as terminal commands - if you want to create your own
commands put them into `commans.py`. The `scope.sh` handles previews for ranger so that you can see the results of file
in ranger instead of opening an external command.


### rc.conf

Contains basic configuration like displaying hidden files and shortcuts


```sh
# Jumping around
map J     history_go -2
map K     history_go 0
```

My file is pretty empty because I want only that.


## Vim command to start the browser mode

```sh
function RangerExplorer()
    exec "silent !ranger --choosefile=/tmp/vim_ranger_current_file " . system('echo "' . expand("%:p:h") . '" | sed -E "s/\ /\\\ /g"')
    if filereadable('/tmp/vim_ranger_current_file')
      exec 'edit ' . system('cat /tmp/vim_ranger_current_file | sed -E "s/\ /\\\ /g"')
      call system('rm /tmp/vim_ranger_current_file')
  endif
redraw!
endfun

map <Leader>r :call RangerExplorer()<CR>
```


There are a bunch of plugins out there, which all uses Ranger in different ways:

- [vim-ranger will open files in tabs instead of buffers](https://github.com/Mizuchi/vim-ranger "vim-ranger will open files in tabs instead of buffers")
- [ranger.vim several commands for splitting selected files](https://github.com/rafaqz/ranger.vim "ranger.vim several commands for splitting selected files")


I prefer [ranger.vim](https://github.com/francoiscabrol/ranger.vim "ranger.vim") because it quickly opens a file browser
and open the selected files in a new buffer.


## VCS awareness

Edit `rc.conf`:


```sh
# Be aware of version control systems and display information.
set vcs_aware true

# State of the three backends git, hg, bzr. The possible states are
# disabled, local (only show local info), enabled (show local and remote
# information).
set vcs_backend_git enabled
set vcs_backend_hg disabled
set vcs_backend_bzr disabled
```


https://github.com/hut/ranger/wiki/VCS-integration


But then loading a big repo may slow down opening ranger.


## Links

- [Using Vim as a file explorer](https://www.everythingcli.org/use-ranger-as-a-file-explorer-in-vim/ "Using Vim as a file explorer")
- [vim-ranger on mac](https://illidiumq36.wordpress.com/2012/03/17/ranger-the-best-file-manager-for-mac-if-you-like-vim/ "vim-ranger on mac")
- [official way to use ranger as vim-file choose](https://github.com/hut/ranger/blob/master/examples/vim_file_chooser.vim "Icewind Dale - The Ultimate Collection")
- [Vifm - an ncurses based file manager with vi like key bindings, which also borrows some useful ideas from mutt](https://github.com/vifm/vifm "Vifm - an ncurses based file manager with vi like key bindings, which also borrows some useful ideas from mutt")
- [Differences between vifm and ranger](https://wiki.vifm.info/index.php?title=Ideology#Vifm_or_ranger "Differences between vifm and ranger")

