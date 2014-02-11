---
layout: post
title: Convert a Mercurial Repository Into Git
description:
---
**


git clone  git://github.com/schacon/hg-git.git
vim ~/.hgrc with the following content

  [extensions]
  hggit = /home/wikimatze/Dropbox/bitbucket/hg-git/hggit

Next create a new git repository on Github. And now go into the mercurical repository you want to export and type in
the following command:

$ cd hg-git # (a Mercurial repository)
$ hg bookmark -r default master # make a bookmark of master for default, so a ref gets created

hg clone ssh://hg@bitbucket.org/wikimatze/vim-autocomplpop
destination directory: vim-autocomplpop
requesting all changes
adding changesets
adding manifests
adding file changes
added 70 changesets with 117 changes to 6 files
updating to branch default
5 files updated, 0 files merged, 0 files removed, 0 files unresolved


## Conclusion


