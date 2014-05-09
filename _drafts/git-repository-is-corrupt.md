---
title:
meta-description: ...
published: false
---
# git rep corrupt

git status
error: object file .git/objects/45/9d0bf0aa91989e8034c1a4ae870f94930a3440 is empty
fatal: loose object 459d0bf0aa91989e8034c1a4ae870f94930a3440 (stored in .git/objects/45/9d0bf0aa91989e8034c1a4ae870f94930a3440) is corrupt

After deleting the file, I got

git status
fatal: bad object HEAD


Next idea git fsck --full

Checking object directories: 100% (256/256), done.
error: HEAD: invalid sha1 pointer 459d0bf0aa91989e8034c1a4ae870f94930a3440
error: refs/heads/master does not point to a valid object!
error: 2d796598eefdb6c77e9a7191ee4faeb6086eec77: invalid sha1 pointer in cache-tree
broken link from  commit 6143ffc51c51ed3e12435b3407e59cb761009408
              to    tree 013fa76d21b85e447ec65fbb8e4322efa1553a3b
missing tree 013fa76d21b85e447ec65fbb8e4322efa1553a3b
missing blob 9f9f353f5876a1cc42299252d17b453fe1b1afa9

After reading http://stackoverflow.com/questions/11706215/how-to-fix-git-error-object-file-is-empty I decided to delete the repository and to check it out again. It was faster than deleting files and finding the right SHA head with some obscure commands to be performed in the command-line



## Conclusion

## Further reading

-
-
-


