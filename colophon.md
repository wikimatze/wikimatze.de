---
layout: default
title: Colophon
---

This website is written by various technologies: [Gumby CSS framework](http://gumbyframework.com/) for the responsive layout, [fancybox 2](http://fancyapps.com/fancybox/) for the images, [rsync](http://en.wikipedia.org/wiki/Rsync) for uploading the static html pages, [markdown](http://daringfireball.net/projects/markdown/) the format in which I'm writing blog posts, [sweetie gem](https://github.com/matthias-guenther/sweetie) for gathering different information of the website like last build date, and [Jekyll](http://jekyllrb.com) for creating the website. For fast hacking and creating new blog posts on the fly [Vim](http://www.vim.org) is my advocate.


## Status of the page

- <span class="danger label">Last build:</span> {{ site.build }}
- <span class="warning label">Number of images:</span> {{ site.images}}
- <span class="success label">Number of links:</span> {{ site.links }}

