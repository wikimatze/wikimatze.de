---
title: Playing With The Static Site Generator Hugo
description: Playing With The Static Site Generator Hugo
categories: howto,
---

## Installation

Goto [hugo releases](https://github.com/spf13/hugo/releases "hugo releases") and download the appropriate version for your os and architecture.


## First steps with

To see if everything is running on your machine try `hugo help`:


```sh
hugo help
A Fast and Flexible Static Site Generator built with
love by spf13 and friends in Go.

...
```


Next, let's create a new project:


```sh
hugo new site hugo
```


Then create a new post:


```sh
$ hugo new post/welcome.md
/home/wm/git-repositories/hugo/content/post/welcome.md created
```


Get a nice theme:


```sh
$ git clone https://github.com/SenjinDarashiva/hugo-uno.git themes/hugo-uno
```


Enable the new theme in `config.toml`:


```toml
baseurl = "http://yourSiteHere/"
languageCode = "en-us"
title = "My New Hugo Site"
theme = "hugo-uno"
```


Start hugo:


```sh
hugo server -w
0 of 1 draft rendered
0 future content
0 pages created
0 paginator pages created
0 categories created
0 tags created
```


Make the post `content/post/welcome.md` public:


```md
+++
date = "2015-05-06T06:28:24+02:00"
title = "welcome"
+++

Hier kann dann ein wenig text stehen ...
```



Start the server:


```sh
hugo server -w
0 draft content
0 future content
1 pages created
0 paginator pages created
0 tags created
0 categories created
in 21 ms
Watching for changes in /home/wm/git-repositories/hugo/content
Serving pages from /home/wm/git-repositories/hugo/public
Web Server is available at http://localhost:1313
Press Ctrl+C to stop
```


## Deployment

All generated files are placed in the `public` folder, so there is the file you have to go for.
