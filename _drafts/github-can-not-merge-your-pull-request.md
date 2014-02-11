---
layout: post
title:
meta-description: ...
published: false
---

You have an Pull Request on one of your projects and GitHub complains that it can't merge the request automatically for you. This happens when two users modified the same line of the same file concurrently. So GitHub doesn't know which of the changes is the correct one. You have to manually resolves this conflict.

First we need to add the remote repository to our projects:

    git remote add luca https://github.com/lucapette/padrino-book

Next, we want to get the latest updates of this remote repository:

    git fetch luca
    remote: Counting objects: 5, done.
    remote: Compressing objects: 100% (1/1), done.
    remote: Total 3 (delta 2), reused 3 (delta 2)
    Unpacking objects: 100% (3/3), done.
    From https://github.com/lucapette/padrino-book
     * [new branch]      master     -> luca/master
     * [new branch]      tweak-words-in-01 -> luca/tweak-words-in-01

Next we want to go into the branch to get the changeset I want to merge

    git checkout luca/tweak-words-in-01
    git log

    commit 80f2b0683db9312d11ab3a5e77750f66b709163d
    Author: lucapette <lucapette@gmail.com>
    Date:   Sun Aug 12 18:41:20 2012 +0200

        Fix various typos and changes some words

Go back into the master branch and merge the single commit from the

    git checkout master
    git merge luca/tweak-words-in-01 80f2b0683db9312d11ab3a5e77750f66b709163d
    Trying simple merge with 80f2b0683db9312d11ab3a5e77750f66b709163d
    Simple merge did not work, trying automatic merge.
    Auto-merging 01-introduction.md
    ERROR: content conflict in 01-introduction.md
    fatal: merge program failed
    Automated merge did not work.
    Should not be doing an Octopus.
    Merge with strategy octopus failed.

If you look at the file `01-introduction.md` you can see the conflicts. It's time to start the `git mergetool`:

    git mergetool
    Merging:
    01-introduction.md

    Normal merge conflict for '01-introduction.md':
      {local}: modified file
      {remote}: modified file
    Hit return to start merge resolution tool (vimdiff):

As you can see, I'm using vimdiff for handling conflicts and that's it basically


## Conclusion

## Further reading

-
-
-

