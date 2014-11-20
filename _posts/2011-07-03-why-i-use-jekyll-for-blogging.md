---
title: Why I use Jekyll for blogging
update: 2014-11-20
categories: writing
---

For several years I want to write and tried many different platforms like [WordPress](http://wordpress.org/) [blogger](http://www.blogger.com), or [tumblr](http://www.tumblr.com/). The main problem which kept me away from writing was just the fact, that every time I want to write I had to do it in a new environment and not in my favorite editor [vim](http://www.vim.org/). Every system gives me the freedom to extend it in several ways but in the end it didn't provide me the freedom to change every tiny piece I want.  With [jekyll](http://jekyllrb.com/) I can use my favorite text editor and it really "**turned me into a text monster**". This description sounds like a holy grail, but let me explain its abilities in the following sections.


## What Jekyll is

Jekyll is a static site generator written in [ruby](http://www.ruby-lang.org/en/). It generates static html pages. The page is presented through several templates and then fires the whole site, were articles are written in a text markup language like [Textile](http://redcloth.org/textile) or [Markdown](http://daringfireball.net/projects/markdown/) through the [liquid converters](http://www.liquidmarkup.org/) to generate fully generated compiled website. Don't think that it will be easy for you to do it. First of all you have to learn either Textile or Markdown. I chose textile for writing my posts because I use Markdown to create the README files for my GitHub account.


## Setting up the environment

You need to have a valid ruby and [ruby gems](http://rubygems.org/) installation on your machine. A simple `gem install jekyll` will install the following gems:


- [directory\_watcher](https://github.com/TwP/directory_watcher): gives a list of files which change in some intervals
- [liquid](https://github.com/Shopify/liquid): rendering templates in a safe manner
- [open4](https://github.com/ahoward/open4): creates a child process to handle `pid`, `stdout`, etc.
- [maruku](): (Markdown interpreter
- [classifier](http://rubygems.org/gems/classifier): is a Bayes implementation and can be used semantic indexing like to
  display related post - this mechanism is used in machine learning)


To get nice syntax highlighting for your code you have to install [pygments](http://pygments.org/) via `sudo apt-get install python-pygments` on Ubuntu/Debian. On the "install page(install link for [jekyll install](https://github.com/mojombo/jekyll/wiki/install) you can get more information about how to setup Jekyll.


## The directories and styles

Here is the basic layout of a typical Jekyll project:


- `_includes`: Small snippets which can be used in every place of the page.
- `_layouts`: You can define layouts for post entries and the general default layout. Posts can have the special **Yaml
  Front Matter**.
- `_posts`: Contains all posts in your specified markup language
- `_config.yml`: Is a file to store configuration data like the styling of the URLs, or some global variables. It is
  also possible to define own variables which can be used as global things on other pages.


Other files can put on the root directory like an `atom.xml` file (for RSS feed) or `404.html` page. For example my `post.html` has the following layout:


```html
---
layout: default
---
<article>
  <header>
    <div class="author">
      Posted on <time datetime="{{page.date | date:"%Y-%m-%d"}}" pubdate>{{page.date | date:"%Y-%m-%d"}}</time>
    </div>
    {% include sharing.html %}
    <div class="clearfix"></div>
  </header>
  <div class="clearfix"></div>
  {{ content }}
  <br>
  <aside>
    {% include comments.html %}
  </aside>
</article>
```


The lines between `---` mark a special [Yaml Front Matter](http://jekyllrb.com/docs/frontmatter/) This block is treated as a special block in Jekyll and can contain different components. The `{{content}}` stands for the content of a post entry.


## Creating the layout

Here is the main template for my blog.


```html
<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9" lang="en"> <![endif]-->
<!-- Consider adding an manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 9]><!--> <html class="no-js" lang="en" itemscope itemtype="http://schema.org/Product"> <!--<![endif]-->
<head>
  <meta charset="utf-8">

  <title>{% if page.title %}{{ page.title}}{% else %}Matthias Günther{% endif %}</title>

  {% if page.meta-description %}<meta name="description" content="{{ page.meta-description }}"> {% else %}
  <meta name="description" content="Writings, and talks by Matthias Günther. Günther works at MyHammer, loves painting Warhammer figures, and enjoys making cakes.">
  {% endif %}
  ...
</head>

<body>
  <div class="navbar row" id="nav2">
    <a class="toggle" gumby-trigger="#nav2 > ul" href="#"><i class="icon-menu"></i></a>
    <h1 class="four columns logo">
      <span id="title">
        <a href="/index.html">wikimatze</a>
      </span>
    </h1>
    <ul class="eight columns">
      ...
    </ul>
  </div>

  <div class="row">
    <div class="push_one ten columns">
    {% if page.title %}
    <header><h1 class="lead">{{ page.title }}</h1></header>
    {% endif %}
    {{ content }}
    </div>
  </div>

  <div class="modal" id="modal1">
    <div class="content">
      <a class="close switch" gumby-trigger="|#modal1"><i class="icon-cancel" /></i></a>
      <div class="row">
        <div class="ten columns centered">
          <h2>Contact</h2>
          ...
        </div>
      </div>
    </div>
  </div>

  <footer class="row">
    <nav>
      ...
    </nav>
  </footer>

  <!-- Grab Google CDN's jQuery, fall back to local if offline -->
  <!-- 2.0 for modern browsers, 1.10 for .oldie -->
  <script>
  var oldieCheck = Boolean(document.getElementsByTagName('html')[0].className.match(/\soldie\s/g));
  if(!oldieCheck) {
    document.write('<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"><\/script>');
  } else {
    document.write('<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"><\/script>');
  }
  </script>
  <script>
  if(!window.jQuery) {
    if(!oldieCheck) {
      document.write('<script src="js/libs/jquery-2.0.2.min.js"><\/script>');
    } else {
      document.write('<script src="js/libs/jquery-1.10.1.min.js"><\/script>');
    }
  }
  </script>

  <!--
  Include gumby.js followed by UI modules followed by gumby.init.js
  Or concatenate and minify into a single file -->
  <script gumby-touch="/js/libs" src="js/libs/gumby.js"></script>
  ...
</html>
```


I'm using the meta-language [Sass](http://sass-lang.com/) to create my CSS. There is one problem with Sass: You have to compile it every time you made a change. Fortunately, there is the [compass](http://compass-style.org/) which always compiles my sass file when I change it. When I build my page I started with `compass watch css/ &` a command to automate Sass building. This is very handy when changing the layout.


## Conclusion

Look on [other pages](https://github.com/mojombo/jekyll/wiki/Sites) what is possible with Jekyll. You can learn many new things by looking at other Jekyll blogs and copy what you need. I love to write a little bit and after I finished an article perform `rake d` to upload my blog.

