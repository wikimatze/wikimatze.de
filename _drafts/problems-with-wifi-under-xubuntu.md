---
layout: post
title:
meta-description: ...
published: false
---
# Problems with wlan under xubuntu

I disabled the wlan in a nice (evil GUI) and then the option to enable it was gone. The problem was, that
it turned of the wlan on the hardware site of the system. I turned it on and wasn't able to connect to my
local network. Time to turn on the console and check the problem.

## Checking the current status

Of course we can do this with the famous `ifconfig` command:


    $ ifconfig
    eth0      Link encap:Ethernet  HWaddr 00:26:18:25:9b:c5
              UP BROADCAST MULTICAST  MTU:1500  Metric:1
              RX packets:0 errors:0 dropped:0 overruns:0 frame:0
              TX packets:0 errors:0 dropped:0 overruns:0 carrier:1
              collisions:0 txqueuelen:1000
              RX bytes:0 (0.0 B)  TX bytes:0 (0.0 B)
              Interrupt:44

    lo        Link encap:Local Loopback
              inet addr:127.0.0.1  Mask:255.0.0.0
              inet6 addr: ::1/128 Scope:Host
              UP LOOPBACK RUNNING  MTU:16436  Metric:1
              RX packets:9818 errors:0 dropped:0 overruns:0 frame:0
              TX packets:9818 errors:0 dropped:0 overruns:0 carrier:0
              collisions:0 txqueuelen:0
              RX bytes:876009 (876.0 KB)  TX bytes:876009 (876.0 KB)


As you can see, I'm not connect to the Internet because I have `inet addr`. The next step was to check, if
my wlan card is still installed:


    $ ifconfig wlan0
    wlan0     Link encap:Ethernet  HWaddr 00:25:d3:1b:3c:a3
              BROADCAST MULTICAST  MTU:1500  Metric:1
              RX packets:0 errors:0 dropped:0 overruns:0 frame:0
              TX packets:0 errors:0 dropped:0 overruns:0 carrier:0
              collisions:0 txqueuelen:1000
              RX bytes:0 (0.0 B)  TX bytes:0 (0.0 B)


Next step was to activate the existing wlan0 card to our `ifconfig` settings:

  $ ifup wlan0
  Ignoring unknown interface wlan0=wlan0.
  # ifconfig
    eth0      Link encap:Ethernet  HWaddr 00:26:18:25:9b:c5
              UP BROADCAST MULTICAST  MTU:1500  Metric:1
              RX packets:0 errors:0 dropped:0 overruns:0 frame:0
              TX packets:0 errors:0 dropped:0 overruns:0 carrier:1
              collisions:0 txqueuelen:1000
              RX bytes:0 (0.0 B)  TX bytes:0 (0.0 B)
              Interrupt:44

    lo        Link encap:Local Loopback
              inet addr:127.0.0.1  Mask:255.0.0.0
              inet6 addr: ::1/128 Scope:Host
              UP LOOPBACK RUNNING  MTU:16436  Metric:1
              RX packets:10055 errors:0 dropped:0 overruns:0 frame:0
              TX packets:10055 errors:0 dropped:0 overruns:0 carrier:0
              collisions:0 txqueuelen:0
              RX bytes:897597 (897.5 KB)  TX bytes:897597 (897.5 KB)

    wlan0     Link encap:Ethernet  HWaddr 00:25:d3:1b:3c:a3
              UP BROADCAST MULTICAST  MTU:1500  Metric:1
              RX packets:0 errors:0 dropped:0 overruns:0 frame:0
              TX packets:0 errors:0 dropped:0 overruns:0 carrier:0
              collisions:0 txqueuelen:1000
              RX bytes:0 (0.0 B)  TX bytes:0 (0.0 B)

So the wlan card is now recognized in our settings, but is still we have no connection.


## Using wpa with wpa_supplicant

Just run the following command:

   $ wpa_supplicant

You will get a bunch of different options, but what is most interesting is the command at the end of the
console output:

   $ wpa_supplicant -Dwext -iwlan0 -c/etc/wpa_supplicant.conf

Next, it complains, taht it couldn't find the `wpa_supplicant.conf` key. And it wasn't there, so let's open
it with sudo right:


  $ vim /etc/wpa_supplicant.conf

And insert the following settings for a normal WPA2 encoded WLAN:


    network={
    key_mgmt=WPA-PSK
    ssid="<Name-of-Wlan>"
    psk="<Passkey-of-wlan>"
    priority=-9999999
    }

If everything is correct, it should work:

    sudo wpa_supplicant -Dwext -iwlan0 -c/etc/wpa_supplicant.conf
    ioctl[SIOCSIWENCODEEXT]: Invalid argument
    ioctl[SIOCSIWENCODEEXT]: Invalid argument
    Trying to associate with 00:1c:4a:05:70:55 (SSID='Pepe' freq=2452 MHz)
    Associated with 00:1c:4a:05:70:55
    WPA: Key negotiation completed with 00:1c:4a:05:70:55 [PTK=CCMP GTK=TKIP]
    CTRL-EVENT-CONNECTED - Connection to 00:1c:4a:05:70:55 completed (auth) [id=0 id_str=]
    ^[[24~WPA: Group rekeying completed with 00:1c:4a:05:70:55 [GTK=TKIP]
    WPA: Group rekeying completed with 00:1c:4a:05:70:55 [GTK=TKIP]
    jWPA: Group rekeying completed with 00:1c:4a:05:70:55 [GTK=TKIP]


Since evyrthing is running, we need to get a DHCP address from our wlan. Please run:

    $ dhclient wlan0

## Connecting to a hidden network


network={
key_mgmt=WPA-PSK
ssid="<Name-of-Wlan>"
scan_ssid=1
psk="<Passkey-of-wlan>"
priority=-9999999
}


## Further reading
- [ubuntu wiki](http://wiki.ubuntuusers.de/WLAN/wpa_supplicant)



## Conclusion

## Further reading

-
-
-


