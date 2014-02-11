---
layout: post
title: Using Sprockets to Manage the Asset Pipeline in Padrino
description: Learn how to use Sprockets in Padrino
---
{% include leanpub.html %}


[Sprockets](https://github.com/sstephenson/sprockets) are a way to manage serving your assets like CSS, and JavaScript
compiling all the different files in one summarized file for each type. They make it easy to take advantage to use a
preprocessor to write your assests with [Sass](http://sass-lang.com/), [Coffesscript](http://coffeescript.org/), or
[LESS](http://lesscss.org/).


To implement Sprockets in Padrino there the following strategies:


- [rake-pipeline](https://github.com/livingsocial/rake-pipeline): Define filters that transforms directory trees.
- [grunt](http://gruntjs.com/): Set a task to compile and manage assets in JavaScript.
- [sinatra-assetpack](https://github.com/rstacruz/sinatra-assetpack): Let's you define you assets transparently in
  Sinatra.
- [padrino-sprockets](https://github.com/nightsailer/padrino-sprockets): Integrate sprockets with Padrino in the Rails
  way.


## Padrino Sprockets

First we will create a new Padrino app:


{% highlight bash %}

$ padrino g project job-vacancy -d activerecord -t rspec -s jquery -e erb -a sqlite

{% endhighlight %}


We are using the **padrino-sprockets** gem. Let's add it to our Gemfile:


{% highlight ruby %}

# Gemfile
gem 'padrino-sprockets', :require => ['padrino/sprockets'], :git => 'git://github.com/nightsailer/padrino-sprockets.git'

{% endhighlight %}


Next we need to move all our assets from the public folder in the assets folder:


{% highlight bash%}

$ cd <path-to-your-padrino-app>
$ mkdir -p app/assets
$ mv app/public/javascript app/assets
$ mv app/public/stylesheets app/assets
$ mv app/public/images app/assets

{% endhighlight %}


Now we have to register Padrino-Sprockets in this application:


{% highlight ruby %}

# app/app.rb
module JobVacancy
  class App < Padrino::Application
    ...
    register Padrino::Sprockets
    sprockets
    ...
  end
end

{% endhighlight %}

Next we need to determine the order of the loaded CSS files:


{% highlight css %}

# app/assets/stylesheets/application.css
/*
 * This is a manifest file that'll automatically include all the stylesheets available in this directory
 * and any sub-directories. You're free to add application-wide styles to this file and they'll appear at
 * the top of the compiled file, but it's generally better to create a new file per style scope.
 * require_self: Puts the CSS contained within this file at the precise location (puts this command
 * at the top of the generated css file
 * require_tree . means, that requiring all stylesheets from the current directory.
 *
 *= require_self
 *= require bootstrap
 *= require bootstrap-responsive
 *= require site
*/

{% endhighlight %}


First we are loading the `bootstrap` default css, then `bootstrap-response`, and finally our customized `site` CSS. The
`require_self` loads the file itself, to define the order that the files are loaded. This is helpful if you want to
check the order of the loaded CSS as a comment above your application without ever have to look into the source of it.


Next let's have a look into our JavaScript files:


{% highlight javascript %}

# app/assets/javascript/application.js

// This is a manifest file that'll be compiled into including all the files listed below.
// Add new JavaScript/Coffee code in separate files in this directory and they'll automatically
// be included in the compiled file accessible from http://example.com/assets/application.js
// It's not advisable to add code directly here, but if you do, it'll appear at the bottom of the
// the compiled file.
//
//= require_tree .

{% endhighlight %}


The interesting thing here is the `require_tree .` option. This option tells Sprockets to include all
JavaScript files in the assets folder with no specific order.


Now, we can clean up the include statements in our application template:


{% highlight html %}

# app/views/application.erb

<!DOCTYPE html>
<html lang="en-US">
<head>
  <title>Job Vacancy - find the best jobs</title>
  <%= stylesheet_link_tag '/assets/application' %>
  <%= javascript_include_tag '/assets/application' %>
</head>

{% endhighlight %}


## Enable Compression for CSS and JavaScript

Now we want to enable compression for our CSS and JavaScript files. For CSS compression Padrino Sprockets is using
[YUI compressor](https://github.com/sstephenson/ruby-yui-compressor) and for JS compression the
[Uglifier](https://github.com/lautis/uglifier). We need to add these these Gems in our `Gemfiles`:


{% highlight ruby %}

# Gemfile
...
gem 'padrino-sprockets', :require => 'padrino/sprockets', :git => 'git://github.com/nightsailer/padrino-sprockets.git'
gem 'uglifier', '2.1.1'
gem 'yui-compressor', '0.9.6'

{% endhighlight %}


And finally we need to enable minifying in our production environment:


{% highlight ruby %}

# app/app.rb
module JobVacancy
  class App < Padrino::Application
    ...
    register Padrino::Sprockets
    sprockets :minify => (Padrino.env == :production)
  end
end

{% endhighlight %}

