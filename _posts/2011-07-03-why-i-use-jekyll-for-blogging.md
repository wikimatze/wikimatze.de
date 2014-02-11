---
layout: post
title: Why I use Jekyll for blogging
description: Jekyll is the new way for writing blog-posts in markdown for programmers
---

For several years I wante to write and tried many different platforms like [wordpress](http://wordpress.org/)
[blogger](http://www.blogger.com), or [tumblr](http://www.tumblr.com/). The main problem which kept me away from writing
was just the fact, that every time I want to write I just had to do it in a new environment and not in my favorite
editor [vim](http://www.vim.org/). Every system gives me the freedom to extend it in several ways but in the end it
didn't provide me the freedom to change every tiny piece I want.  With [jekyll](http://jekyllrb.com/) I can use my
favorite text editor and it really "**turned me into a text monster**". This description sounds like a holy grail, but
let me explain its abilities in the following sections.


## What Jekyll is

Jekyll is a static site generator written in [ruby](http://www.ruby-lang.org/en/). It generates static html pages. The
page is presented through several templates and then fires the whole site, were articles are written in a text markup
language like [Textile](http://redcloth.org/textile) or [Markdown](http://daringfireball.net/projects/markdown/) through
the [liquid converters](http://www.liquidmarkup.org/) to generate fully generated compiled website.  Don't think that it
will be so easy for you to do it. First of all you have to learn either Textile or Markdown.  I chose textile for
writing my posts because I use Markdown to create the README files for my github account.


## Setting up the environment

You need to have a valid ruby and [ruby gems](http://rubygems.org/) installation on your machine. A simple `gem install
jekyll` will install the following gems:


- [directory_watcher](https://github.com/TwP/directory_watcher): gives a list of files which change in some intervals
- [liquid](https://github.com/Shopify/liquid): rendering templates in a safe manner
- [open4](https://github.com/ahoward/open4): creates a child process to handle `pid`, `stdout`, etc.
- [maruku](): (Markdown interpreter
- [classifier](http://rubygems.org/gems/classifier): is a Bayes implementation and can be used semantic indexing like to
  display related post - this mechanism is used in machine learning)


To get nice syntax highlighting for your code you have to install [pygments](http://pygments.org/) via
`sudo apt-get install python-pygments` on Ubuntu/Debian. On the "install page(install link for
[jekyll install](https://github.com/mojombo/jekyll/wiki/install) you can get more information about how to setup Jekyll.


## The directories and styles

Here is the basic layout of a typical Jekyll project:


- `_includes`: Small snippets which can be used in every place of the page.
- `_layouts`: You can define layouts for post entries and the general default layout. Posts can have the special **Yaml
  Front Matter**.
- `_posts`: Contains all posts in your specified markup language
- `_config.yml`: Is a file to store configuration data like the styling of the URLs, or some global variables. It is
  also possible to define own variables which can be used as global things on other pages.


Other files can just put on the root directory like an `atom.xml` file (for RSS feed) or `404.html` page. For example my
`post.html` has the following layout:


{% highlight html %}

---
layout: layout
---
<article class="post" role="main">
  <header>
    <section class="author">
    Posted by <a href="http://twitter.com/wikimatze" class="newwindow" title="{{ site.author }}">{{ site.author }}</a> on <time>{{ page.date | date:"%b" }} {{ page.date | date:"%d" }}, {{page.date | date:"%Y"}} </time>
    </section>
    {% include clearer.html %}
  </header>
  {{ content }}
  {% include clearer.html %}
  <footer>
  {% include author.html %}
  </footer>
</article>

{% endhighlight %}


The lines between `---` mark a special [Yaml Front Matter](https://github.com/mojombo/jekyll/wiki/YAML-Front-Matter)
This block is treated as a special block in Jekyll and can contain different components. The `{{content}}` stands for
the content of a post entry.


## Creating a layout

Here is the main template for my blog.


{% highlight html %}

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en-us">
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  {% if page.title %}
    <title>{{ page.title }}</title>
  {% else %}
    <title>{{ site.fullname }}</title>
  {% endif %}
  <meta name="author" content="{{ site.fullname }}" />
  <meta name="description" content="Writings, talks and pictures by {{ site.fullname }}. Günther works at MyHammer, loves painting Warhammer figures, and enjoys making cakes." />
  <link rel="alternate" type="application/rss+xml" href="{{ site.feedurl }}" />
  <meta name="viewport" content="width=device-width, maximum-scale=1.0" />
  <meta name="robots" content="noodp, nodyr" />
  <link rel="stylesheet" href="/css/stylesheets/base.css" type="text/css" media="screen, projection" />
  <link rel="stylesheet" href="/css/stylesheets/syntax.css" type="text/css" />
  <link rel="stylesheet" href="/css/stylesheets/print.css" type="text/css" media="print" />
  <link rel="shortcut icon" href="http://farm8.staticflickr.com/7078/7284507972_a7aa341781_t.jpg" type="image/x-icon" />
  <link rel="canonical" href="{{ page.url }}" />
  <link href="{{ site.feedurl }}" rel="alternate" title="Blog of {{ site.fullname}}" type="application/atom+xml" />
</head>

<body>
  <div id="site" class="round">
    <a href="{{ site.ineturl }}{{ page.url }}#top" id="top"></a>

    <header id="page-header" role="banner">
      <span id="sitetitle">
        <a href="/index.html">wikimatze</a>
      </span>
      {% if page.tagline %}
        <span id="tagline"> &raquo; {{ page.tagline }} </span>
      {% endif %}
      <nav id="navigation">
        <ul>
          <li><a href="/about.html">about</a></li>
          <li><a href="/projects.html">projects</a></li>
          <li><a href="/contact.html">contact</a></li>
          <li><a href="/follow.html">follow</a></li>
          <li><a href="/blog.html">blog</a></li>
          <li><a href="/talks.html">talks</a></li>
          <li><a href="/books.html">books</a></li>
        </ul>
      </nav>
    </header>

    {% include clearer.html %}
    <div id="ribbon">
      <a href="https://github.com/matthias-guenther" rel="me" target="_blank">Fork me on Github</a>
    </div>
    <div class="seperator"></div>
    {% include clearer.html %}
  {% if page.title %}
    <h1>{{ page.title }}</h1>
  {% endif %}
    {{ content }}

    <footer id="page-footer" role="contentinfo">
      <nav>
        &copy;2012 {{ site.fullname }}
        &bull;
        <a rel="nofollow" href="{{ site.ineturl }}{{ page.url }}#top">top</a>
        &bull;
        <a rel="nofollow" href="{{ site.feedurl }}">RSS</a>
        &bull;
        <a rel="nofollow" href="/imprint.html">imprint</a>
        &bull;
        <a rel="nofollow" href="/colophon.html">colophon</a>
        &bull;
        <a rel="nofollow" href="/donate.html">surprise me</a>
        <span id="last-build">last build: {{ site.build }}</span>
      </nav>
    </footer>

  </div>

  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>

  <!-- Add fancyBox -->
  <link rel="stylesheet" href="/js/fancybox/jquery.fancybox.css?v=2.0.6" type="text/css" media="screen" />
  <script type="text/javascript" src="/js/fancybox/jquery.fancybox.pack.js?v=2.0.6"></script>

  <!-- Optionaly add button and/or thumbnail helpers -->
  <link rel="stylesheet" href="/js/fancybox/helpers/jquery.fancybox-buttons.css?v=2.0.6" type="text/css" media="screen" />
  <script type="text/javascript" src="/js/fancybox/helpers/jquery.fancybox-buttons.js?v=2.0.6"></script>
  <script type="text/javascript">
    $(document).ready(function() {
        $(".fancybox").fancybox(
          {
          wrapCSS    : 'fancybox-custom',
          closeClick : true,

          helpers : {
            title : {
              type : 'inside'
            },
            overlay : {
              css : {
                'background-color' : '#eee'
              }
            }
          }
        });
     });
   </script>
</body>

{% endhighlight %}


I'm using the meta-language [Sass](http://sass-lang.com/) to create my CSS. There is one problem with Sass: You have to
compile it every time you made a change. Fortunately, there is the [compass](http://compass-style.org/) which always
compiles my sass file when I change it. When I build my page I started with `compass watch css/ &` a command to automate
Sass building. This is very handy when changing the layout.


## Conclusion

Just look on [other pages](https://github.com/mojombo/jekyll/wiki/Sites) what is possible with Jekyll. You can learn
many new things by looking at other Jekyll blogs and copy what you need. I love to write a little bit and after I
finished an article just perform `rake deploy` to upload my blog.

