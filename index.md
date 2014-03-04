---
layout: layout
description: Writings, and talks by {{ site.name }}. Günther works at MyHammer, loves painting Warhammer figures, writing, giving talks, and enjoys making cakes.
---

<a href="https://leanpub.com/padrino" title="Padrino book" class="center" target="_blank"><img class="padrino" src="http://farm4.staticflickr.com/3815/12568020363_42ce06330a_o.png" alt="Padrino book"/></a>

I'm currently writing a book about the web framework [Padrino](http://www.padrinorb.com/).  You can learn more about the book under [padrinobook.com](http://padrinobook.com).


### Recent Commits

<div id="github-commits"></div>


### Recent Articles

<div class="related">
  <ul>
    {% for post in site.posts %}
    <li>
    <span>{{ post.date | date: "%B %e, %Y" }}</span> <a href="{{ post.url }}">{{ post.title }}</a>
    </li>
    {% endfor %}
  </ul>
</div>

