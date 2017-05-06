---
title: How to Remove a Submodule in Git
description:
---
**

 Got a whole repo consisting only of submodules, and one modules causes pain:

Subproject commit ba346bd63a98aa6b9cb0be2bc669e7b592a96392-dirty

Changing created it new, doesn't change anything the repo was still dirty:

Solution:

, To remove a submodule you need to:

    Delete the relevant section from the .gitmodules file.
    Stage the .gitmodules changes git add .gitmodules
    Delete the relevant section from .git/config.
    Run git rm --cached path_to_submodule (no trailing slash).
    Run rm -rf .git/modules/submodule_name
    Commit
    Delete the now untracked submodule files
    rm -rf path_to_submodule


 Simple steps

    Remove config entries:
    git config -f .git/config --remove-section submodule.$submodulepath
    git config -f .gitmodules --remove-section submodule.$submodulepath
    Remove directory from index:
    git rm --cached $submodulepath
    Commit
    Delete unused files:
    rm -rf $submodulepath
    rm -rf .git/modules/$submodulepath

Please note: $submodulepath doesn't contain leading or trailing slashes.


 Background

When you do git submodule add, it only adds it to .gitmodules, but once you did git submodule init, it added to .git/config.

So if you wish to remove the modules, but be able to restore it quickly, then do just this:

git rm --cached $submodulepath
git config -f .git/config --remove-section submodule.$submodulepath

It is a good idea to do git rebase HEAD first and git commit at the end, if you put this in a script.

Reference: http://stackoverflow.com/questions/1260748/how-do-i-remove-a-git-submodule
## Conclusion


## Further reading

