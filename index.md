---
layout: layout
description: Writings, and talks by {{ site.name }}. Günther works at MyHammer, loves painting Warhammer figures, writing, giving talks, and enjoys making cakes.
---

I'm currently writing a book about the web framework [Padrino](http://www.padrinorb.com/).

<a href="https://leanpub.com/padrino" title="Padrino book" class="left" target="_blank"><img class="padrino" src="http://farm9.staticflickr.com/8363/8437372665_bbb190e5ed.jpg" alt="Padrino book"/></a>


<h3>Recent articles</h3>

<div class="related">
  <ul>
    {% for post in site.posts %}
    <li>
    <span>{{ post.date | date: "%B %e, %Y" }}</span> <a href="{{ post.url }}">{{ post.title }}</a>
    </li>
    {% endfor %}
  </ul>
</div>

