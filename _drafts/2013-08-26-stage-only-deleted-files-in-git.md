---
layout: post
title: Stage Only Deleted Files in Git
description:
---
**


Sometimes it happened that you get rid of files in git without using git rm.


```
wikimatze~/Dropbox/dotfiles(master↑65|✚19…) % git status
# On branch master
# Your branch is ahead of 'origin/master' by 65 commits.
#   (use "git push" to publish your local commits)
#
# Changes not staged for commit:
#   (use "git add/rm <file>..." to update what will be committed)
#   (use "git checkout -- <file>..." to discard changes in working directory)
#
#	modified:   awesome/rc.lua
#	modified:   awesome/theme.lua
#	modified:   bashrc
#	modified:   config/Terminal/terminalrc
#	modified:   scripts/gem_install.sh
#	modified:   scripts/symlink_install.sh
#	modified:   scripts/vim_install_linux.sh
#	deleted:    zsh-completions/_ack
#	deleted:    zsh-completions/_bundle
#	deleted:    zsh-completions/_gem
#	deleted:    zsh-completions/_github
#	deleted:    zsh-completions/_hub
#	deleted:    zsh-completions/_padrino
#	deleted:    zsh-completions/_tmuxinator
#	deleted:    zsh-completions/_vagrant
#	deleted:    zsh-lib/command_line_completion.zsh
#	deleted:    zsh-lib/completion.zsh
#	deleted:    zsh-lib/fasd_settings.zsh
#	modified:   zshrc
#
# Untracked files:
#   (use "git add <file>..." to include in what will be committed)
#
#	zsh/
no changes added to commit (use "git add" and/or "git commit -a")
```


My normal workflow was to do a `git add -u` to include also the untracked files to the commit. After that I did a `git reset HEAD <name all files>`. But there is a better way to do it:

git ls-files --deleted | xargs git rm




## Conclusion


