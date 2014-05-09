---
title: Named scope to simplify controllers
meta-description: Make notes after reading a book - you can't remember everything
published: false
---

It is often in Rails that you have controllers with complex *find* methods. Conditions can become
long and hard to follow for other developers. It is then harder for them to understand the code and
prevent them from improving the code with refactoring. So Rails gives us the opportunity to put such
code in the models to keep our controllers clean and sexy. In other words: You can share SQL
fragments `aa aa` in your app by defining them in your models. Instead of calling
in your app by defining them in your models. Instead of calling

```ruby

Article.find(:all, :order => 'created_at desc')

```

you can specify in your Article model a *named_scope* in the following way

```ruby

named_scope :famous, :oder => 'created_at desc'

```


## Small example

We have the following code:

```ruby

class ArticleController < ApplicationController
  def index
    @articles    = Article.find(:all, :conditions => { ... }
    @draft_posts = Article.find(:all, :condition => { :status => 'draft'},
                                      :order => 'created_at desc')
  end
end

```

Now puts the conditions in the *Article* model:

```ruby

class Article < ActiveRecord::Base
  named_scope :published, :conditiond => { ... }
  named_scope :draft, :condition => { :status => 'draft'},
                      :order => 'created_at desc'
end

```

Then in your controller you can use:

```ruby

class ArticleController < ApplicationController
  def index
    @articles = Article.published
    @draft_articles = Article.draf
  end
end

```

In my eyes, this looks more comfortable :D.


## Conclusion ##

By moving complex find methods into models you have one place where you can changes hard find
methods and you will just have to change them there instead of going though each controller.
There is a lot more stuff to learn about *named_scope*[^named_scope] in Rails like how to pass
arguments in them, defining namescope


## Further reading ##

[^named_scope]: [Ryan Daigle about named_scope](http://ryandaigle.com/articles/2008/3/24/what-s-new-in-edge-rails-has-finder-functionality "Ryan Daigle about named_scope")

