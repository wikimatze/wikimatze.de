---
title: Revert Merge Commits Containing Unmerged Conflicts
---


```bash

~/git/orchestra(master ✗) git reset --hard HEAD
HEAD is now at b866b85 Keep QA01
~/git/orchestra(master ✗) git status
# On branch master
# Your branch and 'origin/master' have diverged,
# and have 1 and 9 different commits each, respectively.
#
# Untracked files:
#   (use "git add <file>..." to include in what will be committed)
#
#       davmail.log
#       davmail.log.1
#       davmail.log.2
#       hs_err_pid14587.log
#       hs_err_pid14609.log
#       hs_err_pid2081.log
#       hs_err_pid22016.log
#       hs_err_pid26075.log
#       hs_err_pid28779.log
#       hs_err_pid5833.log
#       hs_err_pid8019.log
#       hs_err_pid8676.log
#       libpeerconnection.log
#       src/MyHammer/UserBundle/Entity/test.sql
#       test.sh
#       web/fonts-65d80b6.css
#       web/fonts-65d80b6_embed-local-fonts_1-d58067e.css
#       web/fonts.css
#       web/fonts_embed-local-fonts_1.css
nothing added to commit but untracked files present (use "git add" to track)
~/git/orchestra(master ✗) git branch
  IM-3819
  TWA-151
  TWA-151_2
* master
  werbepartner-box-at
~/git/orchestra(master ✗) git branch -r
  origin/HEAD -> origin/master
  origin/UpdateCustomer_EventBranch
  origin/adSenseTradesmanSearchResults
  origin/alteBundles
  origin/bootstrap3
  origin/datastructer_tmp
  origin/distanceCalculation
  origin/gui
  origin/gw-14-4-5_sitemaps
  origin/gw-14-6-4-remove-ff
  origin/master
  origin/restfulWatchlist
  origin/roleRemoveGroupBranch
  origin/search-box-js-refactoring
  origin/tgw-14-6-1
  origin/tradesmanUser_inheritance_branch
  origin/update-2-4
~/git/orchestra(master ✗) git reset --hard origin

```

