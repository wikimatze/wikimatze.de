---
title: Talk about Vim flog
description: How to use flog to browse a git repo. Gave this talk at the Vimberlin March 2019 meetup.
nav: articles
date: 2019-04-13
categories: talk vim vimberlin
---

How to use flog to browse a git repo. Gave this talk at the Vimberlin March 2019 meetup.


## Slides of the talk

<script async class="speakerdeck-embed" data-id="918f4c9919bf4b1f845e2e95fbe061b3" data-ratio="1.33214920071048" src="//speakerdeck.com/assets/embed.js"></script>


## Video of the talk

<div class="video-responsive">
  <iframe src="https://www.youtube-nocookie.com/embed/7cHvO5NXsJY?controls=0" allowfullscreen></iframe>
</div>


## Content of the talk

### Features

- find and checkout Branches (with autocompletion)
- explore history


### Custom mappings

- normally `ZZ` to close windows
- I prefer pressing `q`:

```vim
augroup flog
  au FileType git map <buffer><silent>q :bw<cr>
  au FileType floggraph map <buffer><silent>q :bw<cr>
augroup END
```


### Configs

- change display format of git messages:

```vim
let g:flog_default_date_format = 'format:%Y-%m-%d %H:%M:%S'
```


### Get all commits concerning a file

```vim
:Flog -path=archive.md
```


### Comparison to gitv

- only necessary features
- loads fast
- has API to be able to easy add new features


### References:

- <https://github.com/rbong/vim-flog>
- <https://medium.com/@r.l.bongers/announcing-flog-a-new-git-branch-viewer-for-vim-from-the-former-maintainer-of-gitv-e9db68977810>


## Connect with me

You can find the source under [bitbucket](https://bitbucket.org/wikimatze/presentations/branch/vim-and-flog "bitbucket").
I gave this talk at [Vimberlin March 2019 Meetup](https://vimberlin.de/march-2019-meetup/ "Vimberlin March 2019 Meetup").


