---
title:
meta-description: ...
published: false
---
# Difference between symbols and instance variables
if you use symbol :post it creates

<form action="/posts" method="post">
if you use the instance @post

for @post = Post.new you will get

<form action="/posts/create" class="new_account" id="new_account" method="post">
for @post = Post.find(1) you will get

<form action="/posts/update" class="edit_account" id="edit_account_1" method="post">
<input name="_method" type="hidden" value="put">


## Conclusion

## Further reading

-
-
-


