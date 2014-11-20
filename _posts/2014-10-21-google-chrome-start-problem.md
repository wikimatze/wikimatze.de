---
title: Google Chrome Start Problem
description: Fixing a starting google-chrome problem with the diable-gpu option
categories: google-chrome linux
---

After updating my system I could not start chrome anymore. When running `chromium-browser` or `google-chrome` I got the following error message:


```sh
ATTENTION: default value of option force_s3tc_enable overridden by environment.

MESA-LOADER: could not create udev device for fd 26
ATTENTION: default value of option force_s3tc_enable overridden by environment.
VMware: vmw_ioctl_command error Das Argument ist ungültig.
VMware: vmw_ioctl_command error Das Argument ist ungültig.
VMware: vmw_ioctl_command error Das Argument ist ungültig.
[11360:11360:0929/105136:ERROR:gl_renderer.cc(445)] Reached limit of pending sync queries.
[11360:11360:0929/105136:FATAL:gles2_implementation.cc(3487)] Check failed: query->CheckResultsAvailable(helper_).
[1]    11360 abort (core dumped)  chromium-browser
```


You can use the `--disable-gpu` option to start chrome without any gpu for the browser. You can disable this option permanently with in Settings/Show advanced settings and disable the setting for `Use hardware acceleration when available` in the System tab.

