---
title: Insert-the-current-date-in-Vim-at-eol
published: false
meta-description: Press one button to insert the current date in Vim
---
*This article describes the creation of a function to insert the current time at the end of line in Vim.*

I'm constantly working with the [note](url) plugin to organize myself. After finishing a task, I'm changing the **TODO** to
a **DONE**. What I recently did was manually go at the end of the line and insert the actual finishing date. With this simple
system I can see what I accomplished during a certain period of time. Instead of doing


## First approach: native method

Firstly, I wanted to create a mapping to insert the current date with one keystroke. [strftime](url) is the function of your
choice. After reading the documentation I came upon a very simple version:


{% highlight bash %}

nnoremap <F5> "=strftime("%F")<CR>
inoremap <F5> <C-R>=strftime("%F")<CR>

{% endhighlight %}


It nearly does what I want, but the downtime of this solution was that I had to press every time `$ <Space> F5` to insert the
current date at the end of the line. This needs to be improved.


## Second approach: Clever function

Calling a built-in function in Vim is not enough to do what I want. What we need is to define a function. Inside the function we
save the resulting date in a register and run a Vim command for inserting the contents of the register at the end of the current
line.


{% highlight bash %}

function! InsertSpaceDate()
  let @x = " "
  let @x = @x . strftime("%Y-%m-%d")
  normal! "xp
endfunction

{% endhighlight %}


- line 1: declare a function with the name ic
- line 2: create a register (to reflect registers you need to prepend the variable name with the ic)
- line 3: appends the current date with Vim *strftime* build-in function to register x
- line 4: pasting (`p`) the contents of the register (`x`)


We are not yet done yet. We define a mapping to call the function with only one keystroke:


{% highlight bash %}

noremap <silent> <F5> :call InsertSpaceDate()<CR>

{% endhighlight %}


## Conclusion

After writing this article it came into my mind that I can improve the function further: Automatically replace **TODO** with **DONE** and add the current finishing date at the end of the line. As you can see, it is not so difficult to write your own functionality in Vim.

