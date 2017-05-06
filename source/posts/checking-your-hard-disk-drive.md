---
title: Checking your HDD
date: 2012-07-12
update: 2017-01-21
categories: howto linux learning
---

<blockquote>
  <p>Do one thing and do it well.</p>
  <p><strong>Unix Philosophy</strong></p>
</blockquote>


*This article describes a tool for testing your HDD on a daily basis and how can you fill it completely with zeros or random numbers to check it for broken sectors.*


I was spending a whole day installing and configuring 4 different operating systems on my new Desktop PC - I didn't use virtualization my Windows because I wanted to use it for gaming (especially [Fallout 3](http://fallout.bethsoft.com/)). After four weeks the disasters happened: My hard disk drive (HDD) was broken. Before spending a whole installing your new systems, it is worth spending a day to check your new HDD.


## Symptoms of a breaking HDD

If you encounter any of the following things you can be sure that your HDD will break soon:

- working with Blue Screens and occasionally system fall downs
- problems with installing new OS - even on Knoppix
- overwriting the hard disk completely
- blinking LED even if you are not working - is a sign that the HDD disk is writing the content into still valid sectors


## Checking your new HDD with smartools

[Smartmontools](http://en.wikipedia.org/wiki/Smartmontools) is an analysis tool for Linux/Unix systems which allows you to check your hard disk - even on your regular usage. The program consists of two parts: `smartctl` (checking and evaluating HDD parameters) and `smartd` (is daemon to check your HDD on a regularly state).


Install the tool with the following command:


```bash
$ sudo apt-get install smartmontools
```


## Using smartctl for HDD diagnosing

To get an overview of your new HDD please perform:


```bash
$ sudo smartctl -A /dev/sda
```


The `-A` options says that it will only print the vendor specific informations:


```bash
$ sudo smartctl -A /dev/sda
smartctl 6.2 2013-04-20 r3812 [i686-linux-3.11.0-15-generic] (local build)
Copyright (C) 2002-13, Bruce Allen, Christian Franke, www.smartmontools.org

=== START OF READ SMART DATA SECTION ===
SMART Attributes Data Structure revision number: 1
Vendor Specific SMART Attributes with Thresholds:
ID# ATTRIBUTE_NAME          FLAG     VALUE WORST THRESH TYPE      UPDATED  WHEN_FAILED RAW_VALUE
  5 Reallocated_Sector_Ct   0x0033   100   100   010    Pre-fail  Always       -       0
  9 Power_On_Hours          0x0032   099   099   000    Old_age   Always       -       199
 12 Power_Cycle_Count       0x0032   099   099   000    Old_age   Always       -       114
177 Wear_Leveling_Count     0x0013   099   099   000    Pre-fail  Always       -       9
179 Used_Rsvd_Blk_Cnt_Tot   0x0013   100   100   010    Pre-fail  Always       -       0
181 Program_Fail_Cnt_Total  0x0032   100   100   010    Old_age   Always       -       0
182 Erase_Fail_Count_Total  0x0032   100   100   010    Old_age   Always       -       0
183 Runtime_Bad_Block       0x0013   100   100   010    Pre-fail  Always       -       0
187 Uncorrectable_Error_Cnt 0x0032   100   100   000    Old_age   Always       -       0
190 Airflow_Temperature_Cel 0x0032   055   055   000    Old_age   Always       -       45
195 ECC_Error_Rate          0x001a   200   200   000    Old_age   Always       -       0
199 CRC_Error_Count         0x003e   100   100   000    Old_age   Always       -       0
235 POR_Recovery_Count      0x0012   099   099   000    Old_age   Always       -       8
241 Total_LBAs_Written      0x0032   099   099   000    Old_age   Always       -       2076944882
```

By using the following command


```bash
$ sudo smartctl --all /dev/sda
```


you will get all any information about your hard disk:


```bash
$ smartctl --all /dev/sda
smartctl 6.2 2013-04-20 r3812 [i686-linux-3.11.0-15-generic] (local build)
Copyright (C) 2002-13, Bruce Allen, Christian Franke, www.smartmontools.org

=== START OF INFORMATION SECTION ===
Model Family:     Samsung based SSDs
Device Model:     Samsung SSD 840 PRO Series
Serial Number:    S1ATNEAD710430B
LU WWN Device Id: 5 002538 5503e9703
Firmware Version: DXM05B0Q
User Capacity:    256.060.514.304 bytes [256 GB]
Sector Size:      512 bytes logical/physical
Rotation Rate:    Solid State Device
Device is:        In smartctl database [for details use: -P show]
ATA Version is:   ACS-2, ATA8-ACS T13/1699-D revision 4c
SATA Version is:  SATA 3.1, 6.0 Gb/s (current: 6.0 Gb/s)
Local Time is:    Sat Feb 22 08:38:14 2014 CET
SMART support is: Available - device has SMART capability.
SMART support is: Enabled

=== START OF READ SMART DATA SECTION ===
SMART overall-health self-assessment test result: PASSED

General SMART Values:
Offline data collection status:  (0x00)	Offline data collection activity
					was never started.
					Auto Offline Data Collection: Disabled.
Self-test execution status:      ( 244)	Self-test routine in progress...
					40% of test remaining.
Total time to complete Offline
data collection: 		(53956) seconds.
Offline data collection
capabilities: 			 (0x53) SMART execute Offline immediate.
					Auto Offline data collection on/off support.
					Suspend Offline collection upon new
					command.
					No Offline surface scan supported.
					Self-test supported.
					No Conveyance Self-test supported.
					Selective Self-test supported.
SMART capabilities:            (0x0003)	Saves SMART data before entering
					power-saving mode.
					Supports SMART auto save timer.
Error logging capability:        (0x01)	Error logging supported.
					General Purpose Logging supported.
Short self-test routine
recommended polling time: 	 (   2) minutes.
Extended self-test routine
recommended polling time: 	 (  20) minutes.
SCT capabilities: 	       (0x003d)	SCT Status supported.
					SCT Error Recovery Control supported.
					SCT Feature Control supported.
					SCT Data Table supported.

SMART Attributes Data Structure revision number: 1
Vendor Specific SMART Attributes with Thresholds:
ID# ATTRIBUTE_NAME          FLAG     VALUE WORST THRESH TYPE      UPDATED  WHEN_FAILED RAW_VALUE
  5 Reallocated_Sector_Ct   0x0033   100   100   010    Pre-fail  Always       -       0
  9 Power_On_Hours          0x0032   099   099   000    Old_age   Always       -       199
 12 Power_Cycle_Count       0x0032   099   099   000    Old_age   Always       -       114
177 Wear_Leveling_Count     0x0013   099   099   000    Pre-fail  Always       -       9
179 Used_Rsvd_Blk_Cnt_Tot   0x0013   100   100   010    Pre-fail  Always       -       0
181 Program_Fail_Cnt_Total  0x0032   100   100   010    Old_age   Always       -       0
182 Erase_Fail_Count_Total  0x0032   100   100   010    Old_age   Always       -       0
183 Runtime_Bad_Block       0x0013   100   100   010    Pre-fail  Always       -       0
187 Uncorrectable_Error_Cnt 0x0032   100   100   000    Old_age   Always       -       0
190 Airflow_Temperature_Cel 0x0032   055   055   000    Old_age   Always       -       45
195 ECC_Error_Rate          0x001a   200   200   000    Old_age   Always       -       0
199 CRC_Error_Count         0x003e   100   100   000    Old_age   Always       -       0
235 POR_Recovery_Count      0x0012   099   099   000    Old_age   Always       -       8
241 Total_LBAs_Written      0x0032   099   099   000    Old_age   Always       -       2077259002

SMART Error Log Version: 1
No Errors Logged

SMART Self-test log structure revision number 1
No self-tests have been logged.  [To run self-tests, use: smartctl -t]


SMART Selective self-test log data structure revision number 1
 SPAN    MIN_LBA    MAX_LBA  CURRENT_TEST_STATUS
    1          0          0  Not_testing
    2          0          0  Not_testing
    3          0          0  Not_testing
    4          0          0  Not_testing
    5          0          0  Not_testing
  255  203828736  203894271  Read_scanning was never started
Selective self-test flags (0x0):
  After scanning selected spans, do NOT read-scan remainder of disk.
If Selective self-test is pending on power-up, resume after 0 minute delay.
```


Important of the output is the parameter **"PASSED"**, it tells you that the test is over. You can perform longer tests of your hard disk with:


```bash
$ sudo smartctl -t long /dev/sda
```


Depending on the size of your HDD, it takes some time. For checking a whole 500 GB the program runs about 80 minutes. It is even possible to check if your HDD has damage incurred during transporting the drive with the `conveyance` option:


```bash
$ sudo smartctl -t conveyance /dev/sda
```


## Performing long time diagnostic with smartd

The first step is to give the daemon the permission to run checks in the background:


```bash
$ vim /etc/default/smartmontools
> start_smartd=yes
```


Find the line with and uncomment it:


```bash
# uncomment to start smartd on system startup
# start_smartd=yes
```


The configuration file for the daemon can be found under `/etc/smartd.conf`. Here only one line is sufficient to check
all HDDs:


```bash
DEVICESCAN -m matthias@wikimatze.de -M exec /usr/share/smartmontools/smartd-runner
```


Let's get through each line step-by-step:

- `DEVICESCAN`: will scan all HDDs in the range between `/dev/hd[a-I] .. /dev/sd[a-z]`, which support SMART
- `-m matthias@wikimatze.de`: in case of an error, an email will be sent to this address
- `-M`: the frequency of emails departure
  - `-M exec`: don't send testmails
  - `-M test`: send a testmail (when using this option, you must leave out the `/usr/share/smartmontools/smartd-runner`)
  - `-M daily`: send daily reports Now it's time to test our configuration: `bash $ smartd -q onecheck`


You can check your internal mails with `$ sudo mail` (you need install [Postfix](http://www.postfix.org/) on your OS) and rebooting the daemon:


```bash
/etc/init.d/smartmontools restart
```


If you want to have a graphical client for this tool, you need to run:


```bash
$ sudo apt-get install gsmartcontrol
```


You need then to start the program in sudo mode to detect all HDDs `sudo gsmartcontrol`.


## Checking the whole space on your HDD

You know these tiny small `dd` commands? No, it's time to learn and understand them. They are very handy to fill your your whole HDD with lovely zeros and ones.

`dd` stands for **data definition**. It has direct access on the hard disk and can read boot sectors - it is even used to
create iso files of CDs.


### Writing zeros or random numbers


```bash
$ dd if=/dev/zero of=/dev/sda
```


Take from the **input file** (`if`) the zeros (`/dev/zero`) and write them on the **output file** (`of`) `/dev/sda`. If
the command has written the whole hard disk, it will end.


### Speeding up the process with faster writing

Normally, each block of the hard disk has the size of 512 KB. To set the blocksize on 1 MB (1024 KB), we can speed up the writing speed with the factor two. We can achieve do this with the `bs` option.


```bash
$ dd if=/dev/zero of=/dev/sda bs=1024
```


### Jump over errors

`dd` will end, if it detects a broken sector. With the `conv=noerror` option, `dd` will write till the HDD is full even over broken sectors:


```bash
$ dd if=/dev/zero conv=noerror of=/dev/sda bs=1024
```

Other useful parameters are `notrunc` (write the output file completely) or `sync` (write with the full length).


### Running the dd command with status display

We can use the [pv](http://manpages.ubuntu.com/manpages/dapper/man1/pv.1.html) command to monitor the progress of data through a pipe. First we need to install it:


```bash
$ sudo apt-get install pv
```


To get an overview about how many MB or GB have already be written, use the following command:


```bash
$ dd if=/dev/random conv=notrunc,sync bs=1024 | pv > /dev/sda
```


## Conclusion

A broken HDD is a bad thing, but if you know the symptoms it saves you a lot of time because you you know that you have to buy new hardware. Always have backup on an external HDD to have a save data replacement.


It is good to run a couple of tests before you start implementing your whole system.


## Further reading

- [smartmontools project page](http://sourceforge.net/apps/trac/smartmontools/wiki)
- [smartmontools help on Ubuntu](https://help.ubuntu.com/community/Smartmontools)

