---
description: Writings, and talks by Matthias Günther. Günther works at MyHammer, loves painting Warhammer figures, writing, giving talks, and enjoys making cakes.
---

<a href="https://leanpub.com/padrinobook" title="Padrino book" class="center" target="_blank"><img class="padrino" src="https://farm8.staticflickr.com/7016/13441187154_58d220c784_o_d.png" alt="Padrino book"/></a>


I'm currently writing a book about the web framework [Padrino](http://www.padrinorb.com/).  You can learn more about the book under [padrinobook.com](http://padrinobook.com).

<div class="ui-progress-bar ui-container" id="progress_bar">
  <div class="ui-progress" style="width: 25%;">
    <span class="ui-label">
      Book status: <b class="value">25%</b>
    </span>
  </div>
</div>

<br/>

**Recent Commits Of The Book**

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

