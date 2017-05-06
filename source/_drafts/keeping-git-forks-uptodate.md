

- Was working on padrino-framework fork and detected mistakes
- how update fork?

git clone git@github.com:wikimatze/padrino-framework.git
git remote add --track master padrino git://github.com/padrino/padrino-framework.git
git fetch padrino
git merge padrino/master
git push

Now you are ready to edit again and create more and more pull-requests.




Further reading:
- http://bradlyfeeley.com/2008/09/03/update-a-github-fork-from-the-original-repo/
