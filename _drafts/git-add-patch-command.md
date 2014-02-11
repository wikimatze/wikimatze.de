---
layout: post
title:
meta-description: ...
published: false
---
# git add --patch
With Git, on the other hand, you first add all the changes you want to be in the next commit to the index via git add and git rm (Doing this is normally called “staging” and “unstaging”). Normally, calling git add <file> will add all the changes in that file to the index, but add supports an interesting option: --patch, or -p for short. I use this option so often that I’ve added a git alias for easy access: git config alias.pa "add --patch".

  git add --edit opens an individual file or all of your changes in a single diff (like you would see in git diff) that you can edit. Changed lines you delete from this diff won’t be staged (but will still be waiting to be committed). This is really handy if you want to break up a cluster of changed lines that git is considering a single edit in patch mode.

    # On branch master
    # Changes to be committed:
    #   (use "git reset HEAD <file>..." to unstage)
    #
    #	modified:   ha.txt
    #
    # Changes not staged for commit:
    #   (use "git add <file>..." to update what will be committed)
    #   (use "git checkout -- <file>..." to discard changes in working directory)
    #
    #	modified:   bla.txt
    #	modified:   ga.txt
    #	modified:   ha.txt

Now running git add --patch is perfect for doing a code review before staging the files for a commit:


    git add -p
    diff --git a/bla.txt b/bla.txt
    index d9712bd..267a15d 100644
    --- a/bla.txt
    +++ b/bla.txt
    @@ -2,3 +2,6 @@ aa
     bb
     cc

    +
    +aaaa
    +
    Stage this hunk [y,n,q,a,d,/,e,?]?

Pressing ? will give you a briefly explanation about the shortcuts:


    Stage this hunk [y,n,q,a,d,/,e,?]? ?
    y - stage this hunk
    n - do not stage this hunk
    q - quit; do not stage this hunk nor any of the remaining ones
    a - stage this hunk and all later hunks in the file
    d - do not stage this hunk nor any of the later hunks in the file
    g - select a hunk to go to
    / - search for a hunk matching the given regex
    j - leave this hunk undecided, see next undecided hunk
    J - leave this hunk undecided, see next hunk
    k - leave this hunk undecided, see previous undecided hunk
    K - leave this hunk undecided, see previous hunk
    s - split the current hunk into smaller hunks
    e - manually edit the current hunk
    ? - print help

We just want to stage this hunk, so we press `y` and go direclty to the next file:

    diff --git a/ga.txt b/ga.txt
    index 5ce1bb2..4dbd7e0 100644
    --- a/ga.txt
    +++ b/ga.txt
    @@ -1,12 +1,14 @@
     fdfnsdfn
    +Test
     cc
     aaa
     bbb
     dd
     jo

    +aaa
     dnfdsfd

    -
    +Test
     fsdfa
    Stage this hunk [y,n,q,a,d,/,s,e,?]?

As you can see we have the `s` option to manually add the hunks of the file we want to add. This only works if there’s unchanged
lines between the changes in the displayed hunk. This is the case:


    Stage this hunk [y,n,q,a,d,/,s,e,?]? s
    Split into 3 hunks.
    @@ -1,7 +1,8 @@
     fdfnsdfn
    +Test
     cc
     aaa
     bbb
     dd
     jo

    Stage this hunk [y,n,q,a,d,/,j,J,g,e,?]? y
    @@ -2,9 +3,10 @@
     cc
     aaa
     bbb
     dd
     jo

    +aaa
     dnfdsfd

    Stage this hunk [y,n,q,a,d,/,K,j,J,g,e,?]? y
    @@ -8,5 +10,5 @@
     dnfdsfd

    -
    +Test
     fsdfa
    Stage this hunk [y,n,q,a,d,/,K,g,e,?]? n

We don't want a second `Test` in our commit. After that, we go directly in the diff of the next commit:

    diff --git a/ha.txt b/ha.txt
    index 6c888e2..d70387f 100644
    --- a/ha.txt
    +++ b/ha.txt
    @@ -3,9 +3,12 @@ bbb
     aaa


    +aaa
    +

     nnn


    +aaaa
     def bla
     this is awesome
    Stage this hunk [y,n,q,a,d,/,s,e,?]?

if you now run `gitk`, you will see that you have staged changes und unstaged. The unstaged changes are for example the `Test` line
in the file of `ga.txt`


## Conclusion

## Further reading

-
-
-


