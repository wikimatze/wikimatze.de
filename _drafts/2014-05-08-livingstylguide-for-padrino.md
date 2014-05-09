---
title: Livingstylguide For Padrino
categories: ['padrino', 'ruby']
---

{% include leanpub.html %}

The [livingstyleguide](https://github.com/hagenburger/livingstyleguide) by @[hagenburger](https://twitter.com/hagenburger)
let's your easily create living style guides with Markdown, Sass/SCSS and Compass. In this post I describe the steps you
have to take to integrate the livingstylguide for a Padrino project. I set down with Nico and make his Gem [working
with Padrino](https://github.com/hagenburger/livingstyleguide/commit/cc3648e12eaaeaeae23734ccff42c46ae04efe4f).


Generate a new Padrino project:


{% highlight bash %}

$ padrino g project padrino-livingstyleguide -e haml -c sass

{% endhighlight %}


Add the [sprockets](https://github.com/nightsailer/padrino-sprockets), [compass]() and [livingstyleguide](https://github.com/hagenburger/livingstyleguide) gem in the `Gemfile`:


{% highlight ruby %}

# Component requirements
gem 'sass'
gem 'compass'

gem 'livingstyleguide', '1.0.4'

gem 'padrino-sprockets', :require => ['padrino/sprockets'], :git => 'git://github.com/nightsailer/padrino-sprockets.git'

{% endhighlight %}


And register sprockets:


{% highlight ruby %}

module PadrinoLivingstyleguide
  class App < Padrino::Application
    ...
    register Padrino::Sprockets
    sprockets
    ...
  end
end

{% endhighlight %}


Next we need to move our assets files in the correct directory:

- `mkdir app/assets`
- `mv public/javascripts app/assets`
- `mv public/stylesheets app/assets`


And change the path of the `sass_initializer.rb`:


{% highlight ruby %}

module SassInitializer
  def self.registered(app)
    # Enables support for SASS template reloading in rack applications.
    # See http://nex-3.com/posts/88-sass-supports-rack for more details.
    # Store SASS files (by default) within 'app/stylesheets'.
    require 'sass/plugin/rack'
    Sass::Plugin.options[:template_location] = Padrino.root("app/asset/stylesheets")
    Sass::Plugin.options[:css_location] = Padrino.root("app/assets/stylesheets")
    app.use Sass::Plugin::Rack
  end
end

{% endhighlight %}


Next we create a `styleguide.html.lsg` file in the `app/assets/stylesheets` folder:


{% highlight yaml %}

title: "Living Style Guide for Padrino"
source: application.css.scss

{% endhighlight %}


The `application.css.scss` is a container for all other `scss` files:


{% highlight sass %}

@import "compass";
@import "compass/css3";
@import "compass/css3/border-radius";
@import "compass/css3/user-interface";

@import "base/reset";
@import "base/colors";
@import "base/grid";
@import "base/typography";
@import "base/mixins";

@import "modules/layout";
@import "modules/button";
@import "modules/form";

{% endhighlight %}


The documentation for `modules/button` has the following structure:


{% highlight html %}

# Buttons

Buttons can be `<button>` or `<a>` elements:

~~~
<button type="button" class="***button***">Button</button>
<button type="submit" class="***button***">Button</button>
<a class="***button***">Link</a>
~~~

Disabled buttons have different code for `<button>` and `<a>` elements:

~~~
<button type="button" class="button" ***disabled***>Button</button>
<button type="submit" class="button" ***disabled***>Button</button>
<a class="button ***is-disabled***">Link</a>
~~~

Button sizes:

~~~
<button type="button" class="button">Button</button>
<button type="button" class="button ***is-small***">Button</button>
~~~

{% endhighlight %}


If you now start the application with `padrino s` you can see the styleguide under <http://localhost:3000/assets/styleguide.html>


You can find the code on [GitHub]() and a running app under [anynines](http://padrino-livingstyleguide.de.a9sapp.eu/assets/styleguide.html).


{% include newsletter.html %}
