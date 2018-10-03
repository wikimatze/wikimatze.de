---
title: Mail Client in Java
date: 2011-10-22
updated: 2014-11-20
categories: programming howto
---

<blockquote>
  <p>Most people spend more time and energy going around problems than trying to solve them.</p>
  <p><strong>Henry Ford</strong></p>
</blockquote>


During the summer term 2007 we had the task to create a [Thunderbird](http://www.mozilla.org/en-US/thunderbird) like email client [Java](http://www.java.com/de/download/manual.jsp).  The GUI should be created either with [Swing](http://java.sun.com/docs/books/tutorial/uiswing/) or [AWT](http://java.sun.com/javase/6/docs/technotes/guides/awt/). Beside the graphical implementation, we had to check and study the functionality of [POP3](http://en.wikipedia.org/wiki/Post_Office_Protocol) and
[SMTP](http://en.wikipedia.org/wiki/Simple_Mail_Transfer_Protocol). Only the correct numbers in this protocols are important because they stands for each transactions if it was a success or a failure.  A first attempt this functionality was done with plain old *sockets* to get a feeling how POP3 and SMTP works.


After we a running function the basic functions of the mail client, we had to implement some extra-functions like attachments (mime parts in an email) or the handling of emails with drag-and-drop. I implemented this big project with the help of [NetBeans IDE](http://netbeans.org/).


## Images

By means of the following images I will describe the basic layout of my email client.


<img src="http://farm8.staticflickr.com/7228/7257429146_a8e69185f7_b.jpg" class="center" alt="The basic surface when the program starts.  If you press on the upper task bar a drag-and-drop menu will open."/>
<div class="caption">The basic surface when the program starts. If you press on the upper task bar a drag-and-drop menu will open.</div>


<img src="http://farm8.staticflickr.com/7071/7257429010_90c8c37b00_z.jpg" class="center" alt="mail_client_2.jpg"/>
<div class="caption">In this window you can add data of a new account.</div>


<img src="http://farm9.staticflickr.com/8022/7257428772_387fce2670_b.jpg" class="center" alt="mail_client_3.jpg"/>
<div class="caption">Get the mail of an already existing account.</div>


<img src="http://farm8.staticflickr.com/7243/7257428880_ebf4f8e24c_z.jpg" class="center" alt="mail_client_4.jpg"/>
<div class="caption">The window where to write a new email.</div>


<img src="http://farm8.staticflickr.com/7088/7257428050_f021ac4ffc.jpg" class="center" alt="mail_client_5.jpg"/>
<div class="caption">Drag-and-Drop window to manage emails.</div>


## Installation for NetBeans

- get the [sources from github](https://github.com/wikimatze/mailclient)
- extract the *javamail-1.4.zip* => this package contains a Java library for handling emails
- create a new project under NetBeans and copy all files of the *Mail Client* directory in the *src* directory of you
  NetBeans project
- then you have to insert the *mail.jar* file in your project in the following way:
  - click right on Libraries in the near of the view of your NetBeans project and chose *Add JAR*
  - navigate to *javamail-1.4* folder and select the *mail.jar*
  - when you now select the files *GUIMailsend.java* and *GUIMailsget.java* should not show any errors
- now you have to adopt the paths in the file *GUIMain.java* `(static File f, String dir, FileReader file)` and
  *GUITree* `(File driveC, File source, File ziel)` to your NetBeans project folder through absolute paths => I know
  it's cumbersome but due to this date I couldn't do any other
- set the *GuiMain.java* as the main file in your project and start the program
- the standard account is *MG kontoinfos.kondat* which contains the necessary data to access my spam account (you can
  guess how to change the data)
- the directory *Inbox MG* saves all read mails of the user MG, further accounts have to be created each in an own
  directory
- *MailApi.java* is not necessary for the mail client, this will be used to check the correctness of the POP3
  settings via the terminal
- main cause of error messages:
  - wrong paths to your project
  - POP3 and SMTP
  - *mail.jar* is not included correct in the project, but this will be shown in NetBeans


## Conclusion

This project was my first big piece of software and I used all my gathered knowledge about Java. The classes are not bug-free, manually tested, has a size over 1000 LOCs, has absolute paths, and the function are sometimes very big. In the end it was just hacking down the software without using certain patterns or careful development with clean code. I tested my code with `System.out.println` and I lost much time with this stupid testing. One good thing I did: I created comments and was able to get the program running even after two year.


Nowadays programming methodologies like [Agile](http://en.wikipedia.org/wiki/Agile_software_development), Rapid-Prototyping or Model-Driven development together with the framework Rails let you develop my application with much more less effort and is more maintainable by driving the Test-Driven way- you can refactor your code and don't need to manual test part of your basis if you have tests available.


This project shows that it is possible to develop modular software in Java but in even greater projects it is easy to get lost in the lost in Java code if you don't rely on a framework.

