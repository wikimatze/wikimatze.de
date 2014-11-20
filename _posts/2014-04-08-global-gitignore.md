---
title: Global Gitignore
update: 2014-11-20
categories: git learning
---

For all my projects I was creating a local `.gitignore` files which keeps track of files I don't want to have under version control. The most common ones are for me `.*.sw*`, `.DS_Store`, `log/**/*` or `tags` files. You don't want to repeat yourself and you can put those file in a global gitignore file with the following command:


```bash
git config --global core.excludesfile ~/.gitignore
```


It will create an entry in your `~/.gitconfig` file like the following:


```bash
[user]
  name = Matthias Guenther
  email = matthias@wikimatze.de
[apply]
  whitespace = nowarn
[core]
  editor = vim
  autocrlf = input
  excludesfile = ~/.gitignore
  pager = cat
```


My personal `.gitignore` has the following contents:


```bash
----------
| Jekyll |
----------
_site/*

--------
| Ruby |
--------
*.gem
*.thor
bundle/**/*


-----------
| Padrino |
-----------
application.css
application.js
coverage/*
tags.html


--------
| Vim  |
--------
*.spl
*.sw*
backup/*
tags
yankring.txt
.netrwhist


----------------------
| Logs and databases |
----------------------
*.log
*.sql
*.sqlite


----------------------
| OS generated files |
----------------------
.DS_Store
.DS_Store?
.Spotlight-V100
.Trashes
._*
Thumbs.db
```

