---
title: Talk about devdocs for vim
description: devdocs - offline language programming support for vim. Gave this talk at the Vimberlin March 2019 meetup.
nav: articles
date: 2019-11-17
categories: talk vim vimberlin
---

How to use flog to browse a git repo. Gave this talk at the Vimberlin March 2019 meetup.


## Slides of the talk

<script async class="speakerdeck-embed" data-id="6b71530636aa4a15bbdd0c5a2abbec93" data-ratio="1.33214920071048" src="//speakerdeck.com/assets/embed.js"></script>


## Video of the talk

<div class="video-responsive">
  <iframe src="https://www.youtube-nocookie.com/embed/79g1pl44MAM?controls=0" allowfullscreen></iframe>
</div>


## Content of the talk


- DevDocs combines multiple API documentations in a fast, organized, and searchable interface
- nearly every bigger framework is supported

#### vim and devdocs?

- <https://github.com/rhysd/devdocs.vim>
- <https://github.com/romainl/vim-devdocs>


#### devdocs.vim

- `DevDocsAll <query>` ... search global
- `DevDocsUnderCursor` ... search global after the word under the cursor


#### filetype map


    let g:devdocs_filetype_map = {
        \   'ruby': 'padrino',
        \   'javascript': 'react',
        \ }

#### docdocs locally

- <https://github.com/freeCodeCamp/devdocs#quick-start>


```sh
let g:devdocs_url = 'http://localhost:9292'
```


## Connect with me

You can find the source under [bitbucket](https://bitbucket.org/wikimatze/presentations/branch/devdocs "bitbucket").
I gave this talk at [Vimberlin September 2019 Meetup](https://vimberlin.de/september-2019-meetup/ "Vimberlin September 2019 Meetup").


