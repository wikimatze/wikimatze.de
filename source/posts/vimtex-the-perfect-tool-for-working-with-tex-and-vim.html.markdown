---
title: Vimtex the perfect tool for working with tex and Vim and Zathura
nav: articles
date: 2016-05-15
description: Vimtex the perfect tool for working with tex and Vim and Zathura
categories: vim latex tools
---

In the past I have used first [vim-latex](https://github.com/jcf/vim-latex "vim-latex") for compiling my LaTeX projects.
And later on I discoverd [vim-latexsuite](http://vim-latex.sourceforge.net/ "vim-latexsuite"), wich amazed me because of
[forward searching](http://vim-latex.sourceforge.net/documentation/latex-suite/forward-searching.html "forward searching")
and [backward searching](http://vim.wikia.com/wiki/Backward_search_for_LaTeX_documents "backward searching") which were
totally new to me. Then the config stopped working for me when I updated vim.


Searching the famous LaTeX plugins for vim, I've discovered [vimtex](https://github.com/lervag/vimtex "vimtex") by
[Karl Yngve Lervåg](https://github.com/lervag "Karl Yngve Lervåg"). At first I was happy that it easily compiled my
latex documents with `\ll` as well as opening the generated pdf with `\lv`. I wanted more, I wanted my forward and
backward searching back.


(Works with [latexmk 4.45](http://users.phys.psu.edu/~collins/software/latexmk-jcc/ "latexmk 4.45"),
[zathura 0.3.6 - requires zathura compiled with linsynctex, otherwise take another version but the forward/backward searching may not work](https://pwmt.org/projects/zathura/download/ "zathura 0.3.6"), [vimtex](https://github.com/lervag/vimtex "vimtex"))


## Benefits of using this plugin

- you can chose between different PDF viewer ([MuPDF](http://mupdf.com/ "MuPDF"), [Zathura](https://pwmt.org/projects/zathura/ "Zathura"),
[Okular](https://okular.kde.org/ "Okular"), [qpdfview](https://launchpad.net/qpdfview "qpdfview") or [SumatraPDF](http://www.sumatrapdfreader.org/free-pdf-reader.html "SumatraPDF"))
- continuous compilation if a file has changed
- text-objects:
  - `ae` ... LaTeX environments (e.g. \begin{itemize})
  - `ac` ... commands
  - `i$` ... inline math structure
  - `a$` ... whole math structure
- motions and mappings:
  - `[[|]]` ... move to next/previous section
  - `%` ... move between matching delimeters
  - `dse|cse` ... delete/change the surrounding environment
  - `dsc|csc` ... delete/change the surrounding command
- rename environments
- omni completion, improved syntax highlighting and indentation


## latexmk installation and configuration

Think of [bibtex](http://www.bibtex.org/Using/ "bibtex") or your [toc]( "toc") - everytime you have to run pdflatex several times
to update the entries. Vimtex uses [latexmk](http://users.phys.psu.edu/~collins/software/latexmk-jcc/)
to compile the LaTeX document.
[latexmk](http://users.phys.psu.edu/~collins/software/latexmk-jcc/ "latexmk") is a perl script that runs the desired/necessary LaTeX command the correct number of times to resolve cross references.

The version of `latexmk` in the Ubuntu repositories is old (2012). I therefore
suggest to remove it with `sudo apt-get remove latexmk` and then instead
grab the [latest version](http://users.phys.psu.edu/~collins/software/latexmk-jcc/versions.html "latest version").


```sh
$ cd /tmp
$ wget http://users.phys.psu.edu/%7Ecollins/software/latexmk-jcc/latexmk-445.zip
$ unzip latexmk*.zip
$ sudo cp latexmk/latexmk.pl /usr/local/bin
$ sudo mv /usr/local/bin/latexmk.pl /usr/local/bin/latexmk
```


Normally, you don't have to create a custom `latexmkrc` because Vimtex does all the magic for your
like adding the `synctex` option or specifying the output with `-pdf` - all of this is automatically done
by the plugin.


But if you want to run `latexmk` manually, you can create your own `~/.latexmkrc`. I have the
following content:


```sh
# how pdflatex will be executed
$pdflatex = 'pdflatex --shell-escape %O %S';
```

A typical `latexmk` run looks like the following:


```sh
$ latexmk
Latexmk: This is Latexmk, John Collins, 22 April 2016, version: 4.45.
Latexmk: All targets (kanban.pdf) are up-to-date
$ vim kanban.tex # make some changes
$ latexmk
Latexmk: This is Latexmk, John Collins, 22 April 2016, version: 4.45.
Latexmk: applying rule 'pdflatex'...
Rule 'pdflatex': File changes, etc:
   Changed files, or newly in use since previous run(s):
      'kanban.tex'
------------
Run number 1 of rule 'pdflatex'
------------
------------
Running 'pdflatex --shell-escape -synctex=1  -recorder  "kanban.tex"'
------------
This is pdfTeX, Version 3.1415926-2.5-1.40.14 (TeX Live 2013/Debian)
 \write18 enabled.
entering extended mode
(./kanban.tex
LaTeX2e <2011/06/27>
Babel <3.9h> and hyphenation patterns for 7 languages loaded.
...
Output written on kanban.pdf (16 pages, 141131 bytes).
SyncTeX written on kanban.synctex.gz.
Transcript written on kanban.log.
Latexmk: References changed.
Latexmk: Log file says output to 'kanban.pdf'
Latexmk: applying rule 'pdflatex'...
Rule 'pdflatex': File changes, etc:
   Changed files, or newly in use since previous run(s):
      'kanban.aux'
      'kanban.out'
      'kanban.toc'
------------
Run number 2 of rule 'pdflatex'
------------
Running 'pdflatex --shell-escape -synctex=1  -recorder  "kanban.tex"'
------------
This is pdfTeX, Version 3.1415926-2.5-1.40.14 (TeX Live 2013/Debian)
 \write18 enabled.
entering extended mode
(./kanban.tex
LaTeX2e <2011/06/27>
Babel <3.9h> and hyphenation patterns for 7 languages loaded.
...
Output written on kanban.pdf (16 pages, 141117 bytes).
SyncTeX written on kanban.synctex.gz.
Transcript written on kanban.log.
Latexmk: Log file says output to 'kanban.pdf'
Latexmk: All targets (kanban.pdf) are up-to-date
```


The `synctex` option is needed for forward/backward search.


## Ensure that libsynctex and libgtk-3-dev is on your system

One must also ensure that `libsynctex` exists in the system! The normal way to do it, is to:


```sh
$ sudo apt-get update
$ sudo apt-get install libsynctex-dev
$ sudo apt install libgtk-3-dev
```


Since I'm still running Ubuntu 14.04 I needed to install the packages on my own:


- http://packages.ubuntu.com/xenial/libsynctex1
- http://packages.ubuntu.com/xenial/libsynctex-dev


linsynctex1 is needed for libsynctex-dev.


The following script will help you installing it (either on amd64 or ):


```sh
#!/bin/bash
cd /tmp && rm -rf libsynctex*

if [ "$(uname -m)" == "x86_64" ]
then
  wget http://de.archive.ubuntu.com/ubuntu/pool/main/t/texlive-bin/libsynctex1_2015.20160222.37495-1_amd64.deb
  wget http://de.archive.ubuntu.com/ubuntu/pool/main/t/texlive-bin/libsynctex-dev_2015.20160222.37495-1_amd64.deb
else
  wget http://de.archive.ubuntu.com/ubuntu/pool/main/t/texlive-bin/libsynctex1_2015.20160222.37495-1_i386.deb
  wget http://de.archive.ubuntu.com/ubuntu/pool/main/t/texlive-bin/libsynctex-dev_2015.20160222.37495-1_i386.deb
fi

sudo dpkg -i libsynctex1* && sudo dpkg -i libsynctex-dev*
```


## girara and zathura installation

I've decided to use [zathura](http://jhshi.me/2016/03/09/zathura-pdf-viewer-for-vim-lovers/index.html "zathura")
as my default pdfviewer because of it's vim bindings.


```sh
#!/bin/bash
GIRARA_VERSION=0.2.6
ZATHURA_VERSION=0.3.6

# otherwise the own girara compilation will not work
sudo apt-get remove libgirara-dev

# need for zathura compilation
sudo apt-get install libmagic-dev

rm -rf /tmp/girara /tmp/zathura

cd /tmp && git clone https://git.pwmt.org/pwmt/girara.git && cd girara && git checkout $GIRARA_VERSION && make && sudo make install
cd /tmp && git clone https://git.pwmt.org/pwmt/zathura.git && cd zathura && git checkout $ZATHURA_VERSION && make WITH_SYNCTEX=1 && sudo make install
```

Look during the compilation on the following line:


```sh
...
zathura build options:
CFLAGS  = -std=c11 -pedantic -Wall -Wno-format-zero-length -Wextra -pthread -I/usr/include/gtk-3.0
-I/usr/include/atk-1.0 -I/usr/include/at-spi2-atk/2.0 -I/usr/include/pango-1.0 -I/usr/include/gio-unix-2.0/
-I/usr/include/cairo -I/usr/include/gdk-pixbuf-2.0 -I/usr/include/glib-2.0 -I/usr/lib/i386-linux-gnu/glib-2.0/include
-I/usr/include/harfbuzz -I/usr/include/freetype2 -I/usr/include/pixman-1 -I/usr/include/libpng12   -pthread
-I/usr/include/gtk-3.0 -I/usr/include/atk-1.0 -I/usr/include/at-spi2-atk/2.0 -I/usr/include/pango-1.0
-I/usr/include/gio-unix-2.0/ -I/usr/include/cairo -I/usr/include/gdk-pixbuf-2.0 -I/usr/include/glib-2.0
-I/usr/lib/i386-linux-gnu/glib-2.0/include -I/usr/include/harfbuzz -I/usr/include/freetype2 -I/usr/include/pixman-1
-I/usr/include/libpng12   -pthread -I/usr/include/glib-2.0 -I/usr/lib/i386-linux-gnu/glib-2.0/include   -pthread
-I/usr/include/glib-2.0 -I/usr/lib/i386-linux-gnu/glib-2.0/include   -I/usr/include/glib-2.0
-I/usr/lib/i386-linux-gnu/glib-2.0/include      -I/usr/include/synctex
LIBS    = -lgirara-gtk3   -lgtk-3 -lgdk-3 -latk-1.0 -lgio-2.0 -lpangocairo-1.0 -lgdk_pixbuf-2.0 -lcairo-gobject
-lpango-1.0 -lcairo -lgobject-2.0 -lglib-2.0   -pthread -lgthread-2.0 -lglib-2.0   -pthread -lgmodule-2.0 -lglib-2.0
-lglib-2.0   -lpthread -lm -lsqlite3   -lmagic -lsynctex
DFLAGS  = -g
CC      = cc
make[1]: Entering directory `/tmp/zathura/po'
make[1]: Nothing to be done for `all'.
make[1]: Leaving directory `/tmp/zathura/po'
make[1]: Entering directory `/tmp/zathura/doc'
make[1]: Nothing to be done for `man'.
make[1]: Leaving directory `/tmp/zathura/doc'
[INSTALL] header files
[INSTALL] pkgconfig file
[INSTALL] man pages
[INSTALL] D-Bus interface definitions
[INSTALL] AppData file
[INSTALL] executeable file
 [INSTALL] desktop file
 make -C po install
 make[1]: Entering directory `/tmp/zathura/po'
```


And look if you can find `-I/usr/include/synctex`.


The `make WITH_SYNCTEX=1` is the most important thing if you want to have forward/backward integration ([see my issue report GitHub](https://github.com/lervag/vimtex/issues/454 "see my issue report GitHub"))


Please note that girara is needed for the zathura version 0.3.6.


## vimtex basics

Install the plugin in the way you like (either manually or with some plugin manager).  Next, just open your your tex file and press
`\ll|:VimtexCompileToggle`.  You will see in your statusline a message like `latexmk compile: started continuous mode` and it will open the pdf
in your prefered pdf-viewer. If you don't configure anything, it will take the default system pdf viewer. In my case, I
want zathura, so I need the following config:


```sh
let g:vimtex_view_method = 'zathura'
```


If you just want to see the plain generated pdf, it's nearly everything you need.


## vimtex forward and backward search for zathura

To get forward/backward searching running, you need to open the file with [vim's servername feature](http://vim.wikia.com/wiki/Enable_servername_capability_in_vim/xterm):


```sh
$ vim --servername vim test.tex
```

If one uses `gvim` or similar, then the client-server is automatically enabled.


**Forward search** is easy: Just place the cursor in your tex-file and press `\lv` you will then get the compiled PDF jump
to this point with a green line:

<img src="https://farm8.staticflickr.com/7575/26756231470_64ed735892_z_d.jpg" class="big center" alt="Vimtex forward search"/>
<div class="caption">"Vimtex forward search"</div>

**Backward search** can be easily triggered if you just press `<C-Enter>` on the PDF and you jump right to the place in
the terminal.

A quote from the author of the plugin:

> This should work automatically with zathura, but it is also the only viewer
where this will work automatically. In general, backward search should be
configured on the viewer end. Luckily, vimtex may parse command line arguments
that does this for zathura. Combined with the vi-keys in zathura, this is one
of the main reasons I prefer zathura.


## Useful vimtex commands

- `:VimtexTocOpen|:VimtexTocToggle`: open a clickable toc in the left pane (`q` will close the window)
<img src="https://farm8.staticflickr.com/7449/27510532801_c1051f0766_z_d.jpg" class="big center" alt="Vimtex view toc"/>
<div class="caption">"Vimtex view toc"</div>
- `:VimtexInfo`: prints basic information

    ```yaml
    b:vimtex : kanban
      pid : 0
      root : '/home/wm/ownCloud/latex/projekte/kanban'
      aux : '/home/wm/ownCloud/latex/projekte/kanban/kanban.aux'
      log : '/home/wm/ownCloud/latex/projekte/kanban/kanban.log'
      out : '/home/wm/ownCloud/latex/projekte/kanban/kanban.pdf'
      tex : '/home/wm/ownCloud/latex/projekte/kanban/kanban.tex'
      base : 'kanban.tex'
      viewer
        xwin_id : 0
        class : 'Zathura'
        init : function('182')
        view : function('183')
        start : function('184')
        forward_search : function('185')
        latexmk_callback : function('186')
        latexmk_append_argument : function('187')
        xwin_exists : function('<SNR>178_xwin_exists')
        xwin_get_id : function('<SNR>178_xwin_get_id')
    ```

- `:VimtexCountWords|:VimtexCountLetters`: count the number of words/letters in the document. It will also show the number of math environments, and similar.

  ```yaml
  File: kanban.tex
  Encoding: utf8
  Sum count: 3265
  Words in text: 3156
  Words in headers: 66
  Words outside text (captions, etc.): 7
  Number of headers: 24
  Number of floats/tables/figures: 0
  Number of math inlines: 36
  Number of math displayed: 0

  (errors:8)
  ```

- `:VimtexLabelsOpen|:VimtexLabelsToggle`: open table of labels.
<img src="https://farm8.staticflickr.com/7167/26976864533_1185526752_z_d.jpg" class="big center" alt="Vimtex view labels toc"/>
<div class="caption">"Vimtex view labels toc"</div>
- `:VimtexCompileOutput`: show the output form the compilation command (i.e. from `latexmk`)
- `:VimtexErrors`:  open quickfix window if there are errors or warnings.
- `:VimtexClean`: clean auxilliary files like `*.aux`, `*.out`, and so on files. Use `:VimtexClean!` to remove everything, including the generated pfd file.
