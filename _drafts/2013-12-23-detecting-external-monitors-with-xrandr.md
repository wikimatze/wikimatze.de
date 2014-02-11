---
layout: post
title: Detecting External Monitors With Xrandr
description:
---

- xrandr -q # will print out the information of the plugged in systems
    LVDS1 connected 1024x600+0+0 (normal left inverted right x axis y axis) 220mm x 129mm
       1024x600       65.0*+
       800x600        60.3     56.2
       640x480        59.9
    VGA1 connected (normal left inverted right x axis y axis)
       1280x1024      60.0 +   75.0
       1152x864       75.0
       1024x768       75.1     70.1     60.0
       832x624        74.6
       800x600        72.2     75.0     60.3     56.2
       640x480        72.8     75.0     66.7     60.0
       720x400        70.1
- xrandr --output VGA1 --mode 1280x1024 --right-of LVDS # will extend the view of the whole screen
- xrandr --output LVDS1 --off # will turn of the main screen so that the whole view is only displayed on the external screen
- xrandr --output LVDS --auto --output VGA --auto --same-as LVDS



