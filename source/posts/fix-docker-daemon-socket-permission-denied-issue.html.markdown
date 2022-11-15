---
title: Fix Docker daemon socket permission denied issue
description: Repair the permission denied error while connecting to the Docker daemon socket permanently
date: 2022-11-15
updated: 2022-11-15
twitter_src:
facebook_src:
categories: linux docker
---

[Docker](https://www.docker.com/ "Docker") is a tool to deploy an application as a container to run on the host operation system.

I installed Docker on my Ubuntu System with `$ sudo apt install -y docker.io` (docker.io is a debian package for
docker)


    $ sudo apt install -y docker.io
      Reading state information... Done
      The following additional packages will be installed:
        bridge-utils containerd pigz runc ubuntu-fan
      Suggested packages:
        ifupdown aufs-tools btrfs-progs cgroupfs-mount | cgroup-lite debootstrap docker-doc rinse zfs-fuse | zfsutils
      The following NEW packages will be installed:
        bridge-utils containerd docker.io pigz runc ubuntu-fan
        0 upgraded, 6 newly installed, 0 to remove and 137 not upgraded.
        Need to get 74,2 MB of archives.
        After this operation, 360 MB of additional disk space will be used.
        Get:1 http://de.archive.ubuntu.com/ubuntu focal/universe amd64 pigz amd64 2.4-1 [57,4 kB]
        Get:2 http://de.archive.ubuntu.com/ubuntu focal/main amd64 bridge-utils amd64 1.6-2ubuntu1 [30,5 kB]
        Get:3 http://de.archive.ubuntu.com/ubuntu focal-updates/main amd64 runc amd64 1.0.1-0ubuntu2~20.04.1 [4.155 kB]
        Get:4 http://de.archive.ubuntu.com/ubuntu focal-updates/main amd64 containerd amd64 1.5.5-0ubuntu3~20.04.1 [33,0 MB]
        Get:5 http://de.archive.ubuntu.com/ubuntu focal-updates/universe amd64 docker.io amd64 20.10.7-0ubuntu5~20.04.2 [36,9 MB]
        Fetched 74,2 MB in 19s (3.870 kB/s)
        Preconfiguring packages ...
        Selecting previously unselected package pigz.
        (Reading database ... 558124 files and directories currently installed.)
        Preparing to unpack .../0-pigz_2.4-1_amd64.deb ...
        Unpacking pigz (2.4-1) ...
        Selecting previously unselected package bridge-utils.
        Preparing to unpack .../1-bridge-utils_1.6-2ubuntu1_amd64.deb ...
        Unpacking bridge-utils (1.6-2ubuntu1) ...
        Selecting previously unselected package runc.
        Preparing to unpack .../2-runc_1.0.1-0ubuntu2~20.04.1_amd64.deb ...
        Unpacking runc (1.0.1-0ubuntu2~20.04.1) ...
        Selecting previously unselected package containerd.
        Preparing to unpack .../3-containerd_1.5.5-0ubuntu3~20.04.1_amd64.deb ...
        Unpacking containerd (1.5.5-0ubuntu3~20.04.1) ...
        Selecting previously unselected package docker.io.
        Preparing to unpack .../4-docker.io_20.10.7-0ubuntu5~20.04.2_amd64.deb ...
        Unpacking docker.io (20.10.7-0ubuntu5~20.04.2) ...
        Selecting previously unselected package ubuntu-fan.
        Preparing to unpack .../5-ubuntu-fan_0.12.13_all.deb ...
        Unpacking ubuntu-fan (0.12.13) ...
        Setting up runc (1.0.1-0ubuntu2~20.04.1) ...
        Setting up bridge-utils (1.6-2ubuntu1) ...
        Setting up pigz (2.4-1) ...
        Setting up containerd (1.5.5-0ubuntu3~20.04.1) ...
        Created symlink /etc/systemd/system/multi-user.target.wants/containerd.service → /lib/systemd/system/containerd.service.
        Setting up ubuntu-fan (0.12.13) ...
        Created symlink /etc/systemd/system/multi-user.target.wants/ubuntu-fan.service → /lib/systemd/system/ubuntu-fan.service.
        Setting up docker.io (20.10.7-0ubuntu5~20.04.2) ...
        Adding group `docker' (GID 138) ...
        Done.
        Created symlink /etc/systemd/system/multi-user.target.wants/docker.service → /lib/systemd/system/docker.service.
        Created symlink /etc/systemd/system/sockets.target.wants/docker.socket → /lib/systemd/system/docker.socket.
        Processing triggers for systemd (245.4-4ubuntu3.11) ...
        Processing triggers for man-db (2.9.1-1) ...



In order to verify my installation I run `$ docker run hello-world` and got the following error:


      docker: Got permission denied while trying to connect to the Docker daemon socket at
      unix:///var/run/docker.sock: Post http://%2Fvar%2Frun%2Fdocker.sock/v1.40/containers/create: dial unix
      /var/run/docker.sock: connect: permission denied.


## Temporary socket fix

Make the docker.sock writable for all owner within your system

    $ sudo chmod 666 /var/run/docker.sock


And try to run the hello-world example again:

    $ docker run hello-world
    Unable to find image 'hello-world:latest' locally
    latest: Pulling from library/hello-world
    2db29710123e: Already exists
    Digest: sha256:faa03e786c97f07ef34423fccceeec2398ec8a5759259f94d99078f264e9d7af
    Status: Downloaded newer image for hello-world:latest

    Hello from Docker!

    ...


But the next time you reboot your machine, you will have the same error again. Why?
Because files in `/var/run` always change after a reboot.


## Time for a permanent solution


If you check clearly the installation instructions on the top you can see that the group `docker` was created.


        ...
        Setting up docker.io (20.10.7-0ubuntu5~20.04.2) ...
        Adding group `docker' (GID 138) ...
        Done.
        ...

You can check the group via:

    $ getent group docker
        docker:x:138:


And if I check if the groups of my user:

    $ groups ${USER}
    wm : wm adm cdrom sudo dip plugdev lpadmin lxd sambashare


I see that my user is not in the `docker` group. Let's add it:


    $ sudo usermod -aG docker ${USER}


And showing the groups again:

    $ groups ${USER}
    wm : wm adm cdrom sudo dip plugdev lpadmin lxd sambashare docker


## References

- [math-linux](https://www.math-linux.com/linux/tip-of-the-day/article/got-permission-denied-while-trying-to-connect-to-the-docker-daemon-socket "math-linux")


