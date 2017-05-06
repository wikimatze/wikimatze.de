---
title: Sudoes file syntax error and how to fix it
description: Sudoes file syntax error and how to fix it
categories: ,
---

1.       VM neustarten und GLEICH „EING“ drücken, um in den Boot-Screen zu kommen

2.       „recovery mode“ auswählen

3.       „root„  auswählen

4.       mount -o rw,remount /

5.       chmod +w /etc/sudoers

6.       vim /etc/sudoers

7.       folgende Zeile richtig schreiben (ALLE Kommas setzen)

a.       ALL=NOPASSWD: RESTART_APACHE, STOP_COM_CENTER_CONSUMER, START_COM_CENTER_CONSUMER, RESTART_COM_CENTER_CONSUMER, STOP_PHANTOMJS_CONSUMER, START_PHANTOMJS_CONSUMER, RESTART_PHANTOMJS_CONSUMER, STOP_MAIL_CONSUMER, START_MAIL_CONSUMER, RESTART_MAIL_CONSUMER

8.       shutdown –r now

9.       Dann sollte es wieder klappen

10.   Wenn nicht, dann gleichzeitig an der Antenne, dem Stromkabel ziehen und im Kreis tanzen


