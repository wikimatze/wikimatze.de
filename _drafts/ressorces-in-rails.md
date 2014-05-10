---
title:
meta-description: ...
published: false
---
# ressources-rails
The "_resources function_" can be used in your routes.rb to get full access to all REST methods of the action. This is very useful if you don't want to define all methods on your own.


```ruby
SampleApp::Application.routes.draw do
  resources :posts
  resources :sessions, :only => [:new, :create, :destroy]
  ...
end
```

This provides you with the following layout to all ressources (actions) of the posts controller:

|_. HTTP request |_. action |_. route |_. purpose
| GET | /posts | index | posts_path | page to list all posts
| GET /posts/1 | show | post_path(1) | page to show post with id 1
| GET /posts/new | new | new_post_path | page to make a new post (signup)
| POST  /posts | create | posts_path | create a new post
| GET /posts/1/edit | edit | edit_post_path(1) | page to edit post with id 1
| PUT /posts/1 | update | post_path(1)  update post with id 1
| DELETE  /posts/1 | destroy | post_path(1) |  delete post with id 1

If you want to call the posts/1 without specifiyng the ressources :posts you will get an _Routing Error_ in your Browser.

The resources also defines the following named routes

|_. name |_. path
|posts_path |/posts
|post_path(@post) | /posts/1
|new_post_path | /posts/new
|edit_post_path(@post) | /posts/1/edit
|posts_url | http://localhost:3000/posts
|post_url(@post) | http://localhost:3000/posts/1
|new_post_url | http://localhost:3000/posts/new
|edit_post_url(@post) | http://localhost:3000/posts/1/edit

With the _:only_ param you can specify for which actions you want to have the magical generated methods by rails. So for


```ruby
resource :sessions, :only => [:new, :create, :destroy]
```

Only the actions _:new, :create, :destroy_ will get the routes.



## Conclusion

## Further reading

-
-
-


