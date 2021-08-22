---
title: Bashtop an awesome good looking resource monitoring tool
description: Bashtop is terminal-based and displays statistics of your memory, CPU, running processes, and bandwith in a very good overview
twitter_src:
facebook_src:
categories:
---


Bashtop is terminal-based and displays statistics of your memory, CPU, running processes, and bandwith in a very good game-inspired overview.
It's available for mac and linux like systems.


## Installation


From source:


```sh
$ git clone https://github.com/aristocratos/bashtop.git
$ cd bashtop
$ sudo make install
```


For Ubuntu with snap:


```sh
$ snap install bashtop
```


For Ubuntu via apt:


```sh
$ sudo add-apt-repository ppa:bashtop-monitor/bashtop
$ sudo apt update
$ sudo apt install bashtop
```


## First start


When `bashtop` is installed just start it with:


```sh
$ bashtop
```


Initialization screen:

~/Desktop/bashtop_initialization_screen.png


Stats after running a while:

~/Desktop/bashtop_running_a_while.png


## Configuration

Location of the config file is under `~/.config/bashtop/bashtop.cfg`. Example configuration can be found under https://github.com/aristocratos/bashtop#configurability.


## Getting around

Just press `ESC` to get to the main menu:

~/Desktop/bashtop_esc.png


## bpytop

It's an updated version of Bashtop and completely written in python. More details under

<https://github.com/aristocratos/bpytop>

