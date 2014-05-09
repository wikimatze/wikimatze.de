---
title: Using Rdesktop to Connect to Remote Machines
description: redesktop is the terminal command which makes you happy
---
*When you are doing testing the views of your applications on different operating system, you have to login the
different
machines. You can use your terminal to get the job done.*


## A simple rdesktop bash script

Let's assume that you have to test your application on Internet Explorer 7, 8, and 9. We want to have script that takes
the name of the machine as an input and connect to the machine with which you are calling the script:


```bash

IE=$1
USER=Test

case "$IE" in
 "ie7")
  PC=IE7TestWinXP
  ;;
 "ie8")
  PC=IE8TestWin7
  ;;
 "ie9")
  PC=IE9TestWin7
  ;;
 *)
  echo "unknown remote pc"
  exit 1
esac

rdesktop -g 1600x900 -P -z -x l -r sound:off -k de -u $USER $PC

```


Let's go through the options:


- `-g`: Let's you specify the resolution of the you want to have on your host when you connect to the remote
machine.
- `-P`: TBD
- `-z`: TBD
- `-x`: TBD
- `l`: TBD
- `-r`: sound option
- `-k`: Define the keyboard layout
- `-u`: Specify the login user of your application


## Conclusion

Putting the command above in a file (like `rdesktop.sh`), make it executable (with `chmod a+rwx rdesktop.sh`), and move
the script into your bin directory `$HOME/bin`. Now you can use it every in your commandline.


