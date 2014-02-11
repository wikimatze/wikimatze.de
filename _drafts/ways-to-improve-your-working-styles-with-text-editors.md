---
layout: post
title: Ways to improve your working styles with text editors
meta-description: Learn to love your editor and save a lot of time
---

In a normal text file you are spending much time with reading, finding the right place to edit or correct errors. In a normal text-editor (like_OpenOffice, Microsoft Word or vim_) you are using your gut feeling, sharp eyes or pure luck to find the demanded position. Mainly you will often navigate through the document, search after sections to correct spelling and grammar - navigating consumes much of your time. It would be nice if you will do it as fast as possible.

This article is a guideline how you can boost your speed in editing. I prefer to demonstrate it practically with my favorite editor *Vim*. I will focus on how you can easily move around in a document, search and replace words.

I'm just scratching on the surface of vim and there are hundreds (maybe thousands) of commands you can use in vim (even your own mappings if you would like to) - the vim-experts know what I mean and there is basically every time something to learn in vim.  But mainly it is important to learn the commands which you are using in your daily work. So look at your workflow and determine the process which consumes much of your time. Learn the commands for it, remember them through regularly usage, don't hesitate to ask someone how to better.

h2. Moving around

The following commands can be used to move around in vim. To navigate above, below, left and right you don' have to use arrow-keys (of course you can and in some situations this is the fastest solution). Instead you use letters of your standard writing positions if you are using the ten-finger system.

* *h -* move the cursor left
* *j -* move the cursor down
* *k -* move the cursor up
* *l -* move the cursor right
* *w -* move at the first char of the next word
* *e -* move at the last char of the next word
* *b -* move at the first char of the previous word
* *% -* jump to the according braces _(, {, [_

At first glance this is weird but if you think about it, it is just natural. Instead of switching your finger below to the arrow keys they can just stay where they are. With a lot of time and practice you will see what I mean. Don't give up and practise it, you will see how much progress you will made and (hopefully) wants to learn more about *vim*. The letters *w* and *e* are very handy to easily to the place you want. For the first session this is enough food for your brain and you have to process and learn it, before you can start running in vim like the Jedi Lightsaber through the air with editing.


h2. Searching and replacing

Here is an example of simple tasks which take the benefits of vim's abilites

* search after another occurrence of a word in the text and fast movement
** press / to start the search mode in vim and then you can press the search which you want to find
** press _*_ to see other appearances of the word where the cursor is and press it again to jump to the next fit
** use % to get from a opening brace to the closing brace (works for '(' and '}')

Pretty neat, right? You don't have to open a new window (like in Textmate, gedit) where you type in the phrases you want. You don't have to leave the editor and can just perform many of your daily tasks in the editor.


h2. Conclusion

So you can use windows like a guru. Learning Linux/Unix is exhausting but is this a cause just to keep on working with windows? Remember learning is brainwork you must know what you want and learn the train the right things. It's the same with your favorite text-editor. For me it was the following: I nearly used gedit for two years. At first it was a pain to get started with gedit: I just wanted an editor which can easily compile _LaTeX_ documents for my scripts. After a while I found some usefull plugins for it and could compile documents. But if my documents contain an error I had manually search the text file with the error line and fix it. If you are hacking mathematical formulas you will make a lot of error. But for me, everything was allright. I then started to write my first macros for long commands (eg environments in _LaTeX_).

After learning rails and making several experience with development environment (although I'm owner of a very fast Thinkpad T500) the starting time of these flagships was too long for me. I tried one day emacs but I found it to big. Then something magical happened. During some talk the local ruby user group in Berlin I talked to a developer "(@der_kronn)":http://twitter.com/der_kronn who explained me with wild gestures the perfect editor in the world (at least in his eyes). He gave me some links and motivation to fight me through it.

After working me through the great vimtutor I started to realize what the fellow developer told me about vim: It has everything I dreamed of and much more. The next few days I struggled the web about vim tipps (the best configuration, nice plugins, best tricks, hacks and so on). But my first goal was to find a new environment for _LaTeX_ work flow. It has everything what gedit also had: makros (I had to convert them for vim), syntaxhighlightning and some new features like going directly to the lines in the file where the error during compilation occured or forward-search (open the dvi from the position where your cursor in the editor is) or inverse-search (just click with the mouse in the dvi-file on a ceratin positition and it will directly jump into the sourcecode.

So it is worth spending much time on learning something new? I say yes, but keep in mind to have a specific measurable goal. What are you waiting for, just develop some new skills.

I got the inspiration of this article by "Jonathan McPherson":http://jmcpherson.org|homepage.

Thanks to *Hanna Schütt* for reading drafts of this.


h2. Further reading

* "(newwindow) OpenOffice":http://www.google.com/url?sa=t&source=web&cd=1&ved=0CCAQFjAA&url=http%3A%2F%2Fwww.openoffice.org%2F&rct=j&q=word&ei=EGeQTMTUCYHLON35jcoM&usg=AFQjCNG4DI1xvMIwF8teVaddDpJ0-TogHA&sig2=blevAQJvLyoXbxax3tULZQ&cad=rja
* "(newwindow) Microsoft Word":http://en.wikipedia.org/wiki/Microsoft_Word
* "(newwindow) vim":http://www.vim.org/
* "(newwindow) search and replace in vim":http://www.thegeekstuff.com/2009/04/vi-vim-editor-search-and-replace-examples/#more-453
* "(newwindow) vimcasts":http://vimcasts.org
* "(newwindow) local ruby user-group for Berlin":http://www.rug-b.de
* "(newwindow) gedit":http://projects.gnome.org/gedit
* "(newwindow) LaTeX":http://www.latex-project.org/
* "(newwindow) emacs":http://www.gnu.org/software/emacs/
* "(newwindow) Thinkpad T500":http://www.amazon.com/Lenovo-Thinkpad-15-4-Inch-Black-Laptop/dp/B002SG7LWY
* "(newwindow) vimtutor":http://linuxcommand.org/man_pages/vimtutor1.html
* "(newwindow) vim latex-suite":http://vim-latex.sourceforge.net/documentation/latex-suite-quickstart/
* "(newwindow) vim-command-sheet":http://tnerual.eriogerg.free.fr/vim.html

