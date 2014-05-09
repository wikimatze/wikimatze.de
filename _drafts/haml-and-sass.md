---
title: Method alias in ruby
meta-description:
published: true
---


* they are both template languages
* *Haml generates html*
* *Sass (Syntactically Awesome StyleSheets) generates css*
* "http://haml":http://haml-lang.com/try.html
* "http://haml":http://haml-lang.com/docs/yardoc/file.HAML_REFERENCE.html
* [["http://newwiki.rubyonrails.org/howtos/templates/haml":http://newwiki.rubyonrails.org/howtos/templates/haml|Haml-Tut and installation for rails]]
* "http://sass":http://sass-lang.com/


h1. Intention of Haml

* markup should be DRY
* markup should be beautiful
* structure should be clear
* main principle: *"Markup should be beautiful"*


h1. Syntax von Haml

* intendation = structure
* tags begins with %
* tags close themselves
* use hashes for attributes
* *= means evaluating ruby code which stands after the =*


h1. Examples Haml


h2. basics

'''
<h1>Bla</h1>
%h1 Bla
------------------------------
<h1>Bla,

<%= @name %></h1>
%h1= "Bla, #{@name}"
------------------------------
<div id="color">Red</div
%div#color Red
'''

'''
##color Red /* geht so auch
'''


h2. nesting

simply goes with intendation
'''
<div id='content'>
  <div class='left column'>
    <h2>Welcome to our site!</h2>
    <p><%= print_information %></p>
  </div>
  <div class="right column">
    <%= render :partial => "sidebar" %>
  </div>
</div>
------------------------------
##content
  .left.column
    %h2 Welcome to our site!
    %p= print_information
  .right.column
    = render :partial => "sidebar"
'''


h2. loops

'''
<ul id="friends">
<% @friends.each do |friend| %>
<li><%= friend.name %></li>
<% end %>
</ul>

------------------------------

%ul#friends

- @friends.each do |friend|

  %li= friend.name
'''



h2. attributes

'''
<ul id="friends" class="list">

  <li>Bla</li>
</ul>

------------------------------

ul{:id=>"friends", :class=>"list"}

- @friends.each do |friend|

  %li= friend.name
'''


=== Escaping via \ ===
* just one line
'''
%title
  = @title
  \= @title
------------------------------

<title>
  MyPage
  = @title
</title>
'''

* several lines

''  %p This doesn't render...''
''  %div''
''    %h1 Because it's commented out!''
''------------------------------''
''<!--''
''  <p>This doesn't render...</p>''
''  <div>''
''    <h1>Because it's commented out!</h1>''
''  </div>''
''-->''

* haml comments (they don't even show up in
  '''
  %p foo
  -# This is a comment
  %p bar
  ------------------------------
  <p>foo</p>
  <p>bar</p>
  '''

or just another example of haml comments

'''
%p foo
-#
  This won't be displayed
    Nor will this
%p bar
------------------------------
<p>foo</p>
<p>bar</p>
'''


h1. Sass



h2. basics

'''
##box{
  border: 0;
  color: black;
}

------------------------------

##box
  :border 0
  :color black
'''


h2. nesting

'''
##box{
  border: 0;
  color: black;
}
'''

'''
##box .orange{
  border: 1px orange;
}
'''

'''
------------------------------
'''

'''
##box
  :border 0
  :color black
  .orange
    :border 1 px orange
'''


h2. variables
'''
##box{
  border: 0;
  color: black;
}
'''

'''
## box .pink{
  border: #f3;
}
'''

'''
------------------------------
'''

'''
$pink: #f3
##box
  :border 0
  :color black
  .pink
    :border $pink
'''


h1. hints

* use ._haml_ or ._html.haml_ in your Rails apps
* use _.sass_


http://www.alistapart.com/articles/getting-started-with-sass/

