---
layout: post
title: Git Message No Submodule Found
description:
---
**

 in ~/.git/modules the jenkins module was still there but I wasn't using it anymore

Solution check http://stackoverflow.com/questions/14720034/no-submodule-mapping-found-in-gitmodules-for-path:

check that you have the proper setting in .git/modules as well. Since a few versions ago, git adds an entry there.

Also, the tree probably has a commit object at that path. To get rid of it you can

git rm --cached Classes/lib/AFKissXMLRequestOperation

that should get rid of it once and for all.

## Conclusion


## Further reading

