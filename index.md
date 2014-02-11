---
layout: layout
description: Writings, and talks by {{ site.name }}. Günther works at MyHammer, loves painting Warhammer figures, writing, giving talks, and enjoys making cakes.
---

I'm currently writing a book about the web framework [Padrino](http://www.padrinorb.com/).

<a href="https://leanpub.com/padrino" title="Padrino book" class="left" target="_blank"><img class="padrino" src="http://farm9.staticflickr.com/8363/8437372665_bbb190e5ed.jpg" alt="Padrino book"/></a>

<div class="clearer"></div>

<strong>Signup up to stay informed about the progress of the book.</strong>
<!-- Begin MailChimp Signup Form -->
<link href="http://cdn-images.mailchimp.com/embedcode/slim-081711.css" rel="stylesheet" type="text/css">
<style type="text/css">
  #mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; }
  /* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
     We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
</style>
<div id="mc_embed_signup">
<form action="http://wikimatze.us6.list-manage.com/subscribe/post?u=4010f8ce18503766e176536f1&amp;id=198f8c0321" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
  <input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="email address" required>
  <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="btn-large btn-success"></div>
</form>
</div>
<!--End mc_embed_signup-->


<div class="clearer"></div>


<strong>Recent articles</strong>

<ul class="blog">
{% for post in site.posts %}
  <li><a href="{{ post.url }}">{{ post.title }}</a></li>
{% endfor %}
</ul>
