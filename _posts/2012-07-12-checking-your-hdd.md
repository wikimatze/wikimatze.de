---
layout: post
title: Checking your HDD
meta-description: Checking your HDD is a good choice
categories: ['howto', 'linux', 'learning']
---

<blockquote>
  <p>Do one thing and do it well.</p>
  <strong>Unix Philosophy</strong>
</blockquote>


*This article describes a tool for testing your HDD on a daily basis and how can you fill it completely with zeros or
random numbers to check it for broken sectors.*


I was spending a whole day installing and configuring 4 different operating systems on my new Desktop PC - didn't
virtualize my Windows because I wanted to use it for gaming (especially [Fallout 3](http://fallout.bethsoft.com/)).
After four weeks the disasters happened: My hard disk drive was broken. Before spending a whole installing your new
systems, it is worth spending a day to check your new HDD (*Hard Disk Drive*).


## Symptoms of a breaking HDD

If you encounter any of the following things you can be sure that your HDD will break soon:

- working with Blue Screens and occasionally system fall downs
- problems with installing new OS - even on Knoppix
- overwriting the harddisk completely
- blinking LED even if you are not working - is a sign that the HDD disk is writing the content into still valid sectors


## Checking your new HDD with smartools

[Smartmontools](http://en.wikipedia.org/wiki/Smartmontools) is an analysis tool for Linux/Unix systems which allows you
to check your hard disk - even on your regular usage. The program consists of two parts: `smartctl` (checking and
evaluating HDD parameters) and `smartd` (is daemon to check your HDD on a regularly state).


Install the tool with the following command:


{% highlight bash %}

$ sudo apt-get install smartmontools

{% endhighlight %}


## Using smartctl for HDD diagnosing

To get an overview of your new HDD please perform:


{% highlight bash %}

$ sudo smartctl -H /dev/sda

{% endhighlight %}


Important of the output is the parameter **"passed"**, it tells you that the test is over:


{% highlight bash %}

smartctl 5.41 2011-06-09 r3365 [i686-linux-3.2.0-23-generic] (local build)
Copyright (C) 2002-11 by Bruce Allen, http://smartmontools.sourceforge.net

=== START OF INFORMATION SECTION ===
Device Model:     ST500DM002-1BD142
Serial Number:    Z2ARNP4C
LU WWN Device Id: 5 000c50 04079c23c
Firmware Version: KC45
User Capacity:    500,107,862,016 bytes [500 GB]
Sector Sizes:     512 bytes logical, 4096 bytes physical
Device is:        Not in smartctl database [for details use: -P showall]
ATA Version is:   8
ATA Standard is:  ATA-8-ACS revision 4
Local Time is:    Thu Jul 12 06:54:59 2012 CEST
SMART support is: Available - device has SMART capability.
SMART support is: Enabled

=== START OF READ SMART DATA SECTION ===
SMART overall-health self-assessment test result: PASSED

General SMART Values:
Offline data collection status:  (0x82) Offline data collection activity
          was completed without error.
          Auto Offline Data Collection: Enabled.
Self-test execution status:      (   0) The previous self-test routine completed
          without error or no self-test has ever
          been run.
Total time to complete Offline
data collection:    (  600) seconds.
Offline data collection
capabilities:        (0x7b) SMART execute Offline immediate.
          Auto Offline data collection on/off support.
          Suspend Offline collection upon new
          command.
          Offline surface scan supported.
          Self-test supported.
          Conveyance Self-test supported.
          Selective Self-test supported.
SMART capabilities:            (0x0003) Saves SMART data before entering
          power-saving mode.
          Supports SMART auto save timer.
Error logging capability:        (0x01) Error logging supported.
          General Purpose Logging supported.
Short self-test routine
recommended polling time:    (   1) minutes.
Extended self-test routine
recommended polling time:    (  81) minutes.
Conveyance self-test routine
recommended polling time:    (   2) minutes.
SCT capabilities:          (0x303f) SCT Status supported.
          SCT Error Recovery Control supported.
          SCT Feature Control supported.
          SCT Data Table supported.

SMART Attributes Data Structure revision number: 10
Vendor Specific SMART Attributes with Thresholds:
ID# ATTRIBUTE_NAME          FLAG     VALUE WORST THRESH TYPE      UPDATED  WHEN_FAILED RAW_VALUE
  1 Raw_Read_Error_Rate     0x000f   107   099   006    Pre-fail  Always       -       12627760
  3 Spin_Up_Time            0x0003   100   100   000    Pre-fail  Always       -       0
  4 Start_Stop_Count        0x0032   100   100   020    Old_age   Always       -       76
  5 Reallocated_Sector_Ct   0x0033   100   100   036    Pre-fail  Always       -       0
  7 Seek_Error_Rate         0x000f   064   060   030    Pre-fail  Always       -       2705616
  9 Power_On_Hours          0x0032   100   100   000    Old_age   Always       -       84
 10 Spin_Retry_Count        0x0013   100   100   097    Pre-fail  Always       -       0
 12 Power_Cycle_Count       0x0032   100   100   020    Old_age   Always       -       74
183 Runtime_Bad_Block       0x0032   100   100   000    Old_age   Always       -       0
184 End-to-End_Error        0x0032   100   100   099    Old_age   Always       -       0
187 Reported_Uncorrect      0x0032   100   100   000    Old_age   Always       -       0
188 Command_Timeout         0x0032   100   100   000    Old_age   Always       -       0
189 High_Fly_Writes         0x003a   100   100   000    Old_age   Always       -       0
190 Airflow_Temperature_Cel 0x0022   061   049   045    Old_age   Always       -       39 (Min/Max 22/39)
194 Temperature_Celsius     0x0022   039   051   000    Old_age   Always       -       39 (0 21 0 0)
195 Hardware_ECC_Recovered  0x001a   045   039   000    Old_age   Always       -       12627760
197 Current_Pending_Sector  0x0012   100   100   000    Old_age   Always       -       0
198 Offline_Uncorrectable   0x0010   100   100   000    Old_age   Offline      -       0
199 UDMA_CRC_Error_Count    0x003e   200   200   000    Old_age   Always       -       0
240 Head_Flying_Hours       0x0000   100   253   000    Old_age   Offline      -       110127256436820
241 Total_LBAs_Written      0x0000   100   253   000    Old_age   Offline      -       3616779477
242 Total_LBAs_Read         0x0000   100   253   000    Old_age   Offline      -       1189576021

SMART Error Log Version: 1
No Errors Logged

SMART Self-test log structure revision number 1
Num  Test_Description    Status                  Remaining  LifeTime(hours)  LBA_of_first_error
# 1  Conveyance offline  Completed without error       00%         2         -
# 2  Extended offline    Aborted by host               90%         2         -
# 3  Conveyance offline  Completed without error       00%         2         -
# 4  Short offline       Completed without error       00%         1         -
# 5  Extended offline    Aborted by host               40%         1         -
# 6  Short offline       Aborted by host               80%         1         -

SMART Selective self-test log data structure revision number 1
 SPAN  MIN_LBA  MAX_LBA  CURRENT_TEST_STATUS
    1        0        0  Not_testing
    2        0        0  Not_testing
    3        0        0  Not_testing
    4        0        0  Not_testing
    5        0        0  Not_testing
Selective self-test flags (0x0):
  After scanning selected spans, do NOT read-scan remainder of disk.
If Selective self-test is pending on power-up, resume after 0 minute delay.

{% endhighlight %}


You can perform longer tests of your harddisk with:


{% highlight bash %}

$ sudo smartctl -t long /dev/sda

{% endhighlight %}


Depending on the size of your HDD, it takes some time. For checking a whole 500 GB the program runs about 80 minutes.

It is even possible to check if your HDD has damage incurred during transporting the drive with the `conveyance` option:


{% highlight bash %}

$ sudo smartctl -t conveyance /dev/sda

{% endhighlight %}


## Performing long time diagnostic with smartd

The first step is to give the daemon the permission to run checks in the background:


{% highlight bash %}

$ vim /etc/default/smartmontools
> start_smartd=yes

{% endhighlight %}


Find the line with and uncomment it:


{% highlight bash %}

# uncomment to start smartd on system startup¬
#start_smartd=yes¬

{% endhighlight %}


The configuration file for the daemon can be found under `/etc/smartd.conf`. Here only one line is sufficient to check
all HDDs:


{% highlight bash %}

DEVICESCAN -m root@<your-os-name> -M exec /usr/share/smartmontools/smartd-runner

{% endhighlight %}


Let's get through each line step-by-step:

- `DEVICESCAN`: will scan all HDDs in the range between `/dev/hd[a-I] .. /dev/sd[a-z]`, which support SMART
- `-m matthias.guenther@wikimatze.de`: in case of an error, an email will be sent to this address
- `-M`: the frequency of emails departure
  - `-M exec`: don't send testmails
  - `-M test`: send a testmail (when using this option, you must leave out the `/usr/share/smartmontools/smartd-runner`)
  - `-M daily`: send daily reports


Now it's time to test our configuration:


{% highlight bash %}

$ smartd -q onecheck

{% endhighlight %}


You can check your internal mails with `$ sudo mail` (you need install [Postfix](http://www.postfix.org/) on your OS)
and rebooting the daemon:


{% highlight bash %}

/etc/init.d/smartmontools restart

{% endhighlight %}


If you want to have a graphical client for this tool, you need to run:


{% highlight bash %}

$ sudo apt-get install gsmartcontrol

{% endhighlight %}


You need then to start the program in sudo mode to detect all HDDs `sudo gsmartcontrol`.



## Checking the whole space on your HDD

You know these tiny small `dd` commands? No, it's time to learn and understand them. They are very handy to fill your
your whole HDD with lovely zeros and ones.

`dd` stands for **data definition**. It has direct access on the harddisk and can read boot sectors - it is even used to
create iso files of CDs.


### Writing zeros or random numbers


{% highlight bash %}

$ dd if=/dev/zero of=/dev/sda

{% endhighlight %}


Take from the **input file** (`if`) the zeros (`/dev/zero`) and write them on the **output file** (`of`) `/dev/sda`. If
the command has written the whole hard disk, it will end.


### Speeding up the process with faster writing

Normally, each block of the hard disk has the size of 512 KB. To set the blocksize on 1 MB (1024 KB), we can speed up
the writing speed with the factor two. We can achieve do this with the `bs` option.


{% highlight bash %}

$ dd if=/dev/zero of=/dev/sda bs=1024

{% endhighlight %}


### Jump over errors

`dd` will end, if it detects a broken sector. With the `conv=noerror` option, `dd` will write till the HDD is full even
over broken sectors:


{% highlight bash %}

$ dd if=/dev/zero conv=noerror of=/dev/sda bs=1024

{% endhighlight %}

Other useful parameters are `notrunc` (write the output file completely) or `sync` (write with the full length).


### Running the dd command with status display

We can use the [pv](http://manpages.ubuntu.com/manpages/dapper/man1/pv.1.html) command to monitor the progress of data
through a pipe. First we need to install it:


{% highlight bash %}

$ sudo apt-get install pv

{% endhighlight %}


To get an overview about how many MB or GB have already be written, use the following command:


{% highlight bash %}

$ dd if=/dev/random conv=notrunc,sync bs=1024 | pv > /dev/sda

{% endhighlight %}


## Conclusion

A broken HDD is a bad thing, but if you know the symptoms it saves you a lot of time because you you know that you have
to buy new hardware. Always have backup on an external HDD so that you can easily replace you data.

It is good to run a couple of tests before you start implementing your whole system.


## Further reading

- [smartmontools project page](http://sourceforge.net/apps/trac/smartmontools/wiki)
- [smartmontools help on Ubuntu](https://help.ubuntu.com/community/Smartmontools)

