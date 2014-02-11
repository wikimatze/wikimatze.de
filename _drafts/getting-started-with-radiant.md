---
layout: post
title: Getting started with radiant
meta-description: A briefly introduction in radiant - really briefly
---

After working several years with pmwiki it was time for me to start something new. For my company
_codenauten_ we are using the Radiant cms to manage our web presentation. After working with pmwiki
in practice it becomes obvious to me that managing more and more content get a pain because no
graphical interface exist (and if you have people who aren't familiar with working in a console. you
see what I mean).


h2. What is special about radiant

Radiant was written in 2006 by _John W. Long_ and was designed for small teams to manage their web content. Here is a list

* It has an easy user interface to manage the whole content.
* You can use snippets to reuse repeating parts of your code in different places
* You can have a hierarchy thus managing permissions

And the best is, it is written pure ruby - you can easily extend it with you own tested plugins.


h2. Creating a first project

First of all you need to install the gem @sudo gem install radiant@ (more about system specific
installation process can be found under "Radiant
installation":https://github.com/radiant/radiant/wiki/Installation). With the command @$ radiant
--database=sqlite3 radiantblog@ a project with the name _radiant blog_ was created. Then create your
database with @rake development db:bootstrap@. Now go into the directory and type @./script/server@
to start your application. It's running under _http://0.0.0.0:3000/_ in your webbrowser.

<center>
  <a href="/images/blog/radiant_1.jpg" title="Radiant with Roaster default template." class="blog"><img src="/images/blog/radiant_1_thumbnail_normal.jpg" alt="radiant_1.jpg"/></a>
</center>


h2. Managing your content

Ones you login under @~/admin@
See the following picture

<center>
  <a href="/images/blog/radiant_2.jpg" title="The user interface of the admin panel" class="blog"><img src="/images/blog/radiant_2_thumbnail_normal.jpg" alt="radiant_2.jpg"/></a>
</center>

* *Content*: Display all the content pages
* *Design*: Managing the layout and snippets
* *Settings*: Creating new members and enable extensions


h2. Creating your own snippet

This is very easy, just got to _Design => Snippets_ in the admin panel. Give the snippet a name and the wanted functionality. In my example I named the snippet _owner_ and this snippet will insert my name. To use the snippet in different files in your project, use it with @<r:snippet name="owner"/>@.

<center>
  <a href="/images/blog/radiant_3.jpg" title="Creating own snippets." class="blog"><img src="/images/blog/radiant_3_thumbnail_normal.jpg" alt="radiant_3.jpg"/></a>
</center>

The good thing about snippets is, that you can put everything in these tiny things.


h2. Radiant tags

Tags can be used in your radiant system like HTML-tags to retrieve the url or the current title of
the webpage with @<r:url/>@ or @<r:title/>@. They can also be used to iterate over the page
hierarchy in Radiant and to find certain pages. More information about other tags can be found under
"Radiant tags":https://github.com/radiant/radiant/wiki/Radius-Tags.


h2. Extensions

For Radiant exist a bunch of useful extensions (see "Extensions for Radiant":http://ext.radiantcms.org/). Here is a list of my favorite extensions:

* "(newwindow) ray":https://github.com/jomz/radiant-wym-editor-filter-extension managing Radiant extensions
* "(newwindow) wym editor":https://github.com/jomz/radiant-wym-editor-filter-extension nice build in editor
* "(newwindow) audit":https://github.com/digitalpulp/radiant-audit-extension tracking who logs in and what they did
* "(newwindow) Flash":https://github.com/ceaser/radiant-flash_content-extension
* "(newwindow) haml filter":https://github.com/saturnflyer/radiant-haml_filter-extension can use haml to create html files
* "(newwindow) robot.txt":https://github.com/jfqd/radiant-robots_txt-extension


h2. Conclusion


h2. Further reading

* "(newwindow) radiant":http://radiantcms.org/
* "(newwindow) John W. Long":http://wiseheartdesign.com/
* "(newwindow) SQLite":http://www.sqlite.org/

