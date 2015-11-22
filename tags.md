---
layout: default
---

{% capture tags %}
  {% for tag in site.categories %}
    {{ tag[0] }}
  {% endfor %}
{% endcapture %}
{% assign sortedtags = tags | split:' ' | sort %}

{% for tag in sortedtags %}
<h3 id="{{ tag }}">{{ tag }}</h3>
<ul>
{% for post in site.categories[tag] %}
  <li>
    <div>{{ post.date | date_to_string }}</div>
    <a href="{{ post.url }}">{{ post.title }}</a>
  </li>
{% endfor %}
</ul>
{% endfor %}

