---
layout: post
title: Merge two commits into One in git
description:
---

http://stackoverflow.com/questions/2563632/how-can-i-merge-two-commits-into-one


Running git rebase --interactive HEAD~2 gives you an editor with

pick b76d157 b
pick a931ac7 c

# Rebase df23917..a931ac7 onto df23917
#
# Commands:
#  p, pick = use commit
#  r, reword = use commit, but edit the commit message
#  e, edit = use commit, but stop for amending
#  s, squash = use commit, but meld into previous commit
#  f, fixup = like "squash", but discard this commit's log message
#
# If you remove a line here THAT COMMIT WILL BE LOST.
# However, if you remove everything, the rebase will be aborted.
#
Changing b's pick to squash will result in the error you saw, but if instead you squash c into b by changing the text to

pick b76d157 b
s a931ac7 c



s for skipped means, that this commit will be removed. If there is a problem with the commit message, you can still use the --amend option to edit the post.


