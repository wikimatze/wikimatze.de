---
title: Benchmarking SSD
description: Rock'n roll with SSD
---

You can use various tools for the commandline. What we need to test is read and write speed of your SSD

With the help of the `hdparm` commandline tool you can check the read line speed of your SSD:


# hdparm:

`hdparm` is a tool for getting for getting or setting SATA/IDE - where `SATA` stands for ... and `IDE` is an acronym
for .... . We use the `-T` flag to perform benchmarking for timing of cache reads for benchmark and comparision
purposes. To measure timings for device reads we use the `-t` option.


    hdparm -Tt /dev/sda
    [sudo] password for wikimatze:

    SSD netbook:
    /dev/sda1:
    Timing cached reads:   1158 MB in  2.00 seconds = 578.53 MB/sec
    Timing buffered disk reads: 330 MB in  3.02 seconds = 109.36 MB/sec


    HDD old
    Timing cached reads:   7862 MB in  2.00 seconds = 3933.12 MB/sec
    Timing buffered disk reads: 396 MB in  3.01 seconds = 131.69 MB/sec

Make a small comparison to old HDD and SSD

-T: Perform timings of cache reads for benchmark and comparison purposes.
-t: Perform  timings  of device reads for benchmark and comparison purposes


You can use `dd` command to test the write speed of your SSD:


    dd if=/dev/zero of=/tmp/output bs=8k count=10k; rm -f /tmp/output

    Netbook:
    10240+0 records in
    10240+0 records out
    83886080 bytes (84 MB) copied, 0,68551 s, 122 MB/s

    HD old
    10240+0 records in
    10240+0 records out
    83886080 bytes (84 MB) copied, 0.907572 s, 92.4 MB/s


Another point of view is that all modern filesystems use caching on file operations. To really measure disk speed and not memory, we must `sync` the filesystem to get rid of the caching effect. That can be easily done by with the `conv=fdatasync` option:


    dd if=/dev/zero of=/tmp/output conv=fdatasync bs=8k count=10k; rm -f /tmp/output

    Netbook:
    10240+0 records in
    10240+0 records out
    83886080 bytes (84 MB) copied, 1,16875 s, 71,8 MB/s

    HD old

    10240+0 records in
    10240+0 records out
    83886080 bytes (84 MB) copied, 1.07784 s, 77.8 MB/s


Health Check:

    sudo udisks --dump
    ========================================================================
    Showing information for /org/freedesktop/UDisks/devices/sda
      native-path:                 /sys/devices/pci0000:00/0000:00:1f.2/ata1/host0/target0:0:0/0:0:0:0/block/sda
      device:                      8:0
      device-file:                 /dev/sda
        presentation:              /dev/sda
        by-id:                     /dev/disk/by-id/ata-Corsair_Neutron_SSD_13227919000098560081
        by-id:                     /dev/disk/by-id/scsi-SATA_Corsair_Neutron13227919000098560081
        by-path:                   /dev/disk/by-path/pci-0000:00:1f.2-scsi-0:0:0:0
      detected at:                 Di 17 Sep 2013 07:40:13 CEST
      system internal:             1
      removable:                   0
      has media:                   1 (detected at Di 17 Sep 2013 07:40:13 CEST)
        detects change:            0
        detection by polling:      0
        detection inhibitable:     0
        detection inhibited:       0
      is read only:                0
      is mounted:                  0
      mount paths:
      mounted by uid:              0
      presentation hide:           0
      presentation nopolicy:       0
      presentation name:
      presentation icon:
      automount hint:
      size:                        64023257088
      block size:                  512
      job underway:                no
      usage:
      type:
      version:
      uuid:
      label:
      partition table:
        scheme:                    mbr
        count:                     3
      drive:
        vendor:                    ATA
        model:                     Corsair Neutron SSD
        revision:                  M310
        serial:                    13227919000098560081
        WWN:
        detachable:                0
        can spindown:              1
        rotational media:          No
        write-cache:               enabled
        ejectable:                 0
        adapter:                   Unknown
        ports:
        similar devices:
        media:
          compat:
        interface:                 ata
        if speed:                  (unknown)
        ATA SMART:                 Updated at Di 17 Sep 2013 07:40:44 CEST
          overall assessment:      Good
    ===============================================================================
     Attribute       Current|Worst|Threshold  Status   Value       Type     Updates
    ===============================================================================
     raw-read-error-rate         166|146|  6   good    24          Pre-fail Online
     reallocated-sector-count    253|253| 36   good    0 sectors   Old-age  Online
     power-on-hours              100|100|  0    n/a    11,9 days   Old-age  Online
     power-cycle-count           100|100| 20   good    191         Old-age  Online
     program-fail-count          253|253|  0    n/a    0           Old-age  Online
     erase-fail-count            253|253|  0    n/a    0           Old-age  Online
     program-fail-count-total    253|253|  0    n/a    0           Old-age  Online
     erase-fail-count-total      253|253|  0    n/a    0           Old-age  Online
     temperature-celsius-2        46|n/a|  0    n/a    46C / 115F  Old-age  Online
     soft-read-error-rate        100|100|  0    n/a    0           Old-age  Online
     shock-count-write-open      100|100|  0    n/a    1           Old-age  Online
     temperature-celsius         253|253| 10   good    2,27e-14C / 32F Pre-fail Online
     uncorrectable-ecc-count     100|100|  0    n/a    3747 sectors Old-age  Online
     total-lbas-written          100|100|  0    n/a    7516        Old-age  Online
     total-lbas-read             100|100|  0    n/a    8120        Old-age  Online
     read-error-retry-rate       100|100|  0    n/a    420         Old-age  Online

    OLD HD

    ========================================================================
    Showing information for /org/freedesktop/UDisks/devices/sda
      native-path:                 /sys/devices/pci0000:00/0000:00:11.0/ata2/host1/target1:0:0/1:0:0:0/block/sda
      device:                      8:0
      device-file:                 /dev/sda
        presentation:              /dev/sda
        by-id:                     /dev/disk/by-id/ata-ST500DM002-1BD142_Z2ARNP4C
        by-id:                     /dev/disk/by-id/scsi-SATA_ST500DM002-1BD1_Z2ARNP4C
        by-id:                     /dev/disk/by-id/wwn-0x5000c5004079c23c
        by-path:                   /dev/disk/by-path/pci-0000:00:11.0-scsi-0:0:0:0
      detected at:                 Wed 18 Sep 2013 06:12:53 PM CEST
      system internal:             1
      removable:                   0
      has media:                   1 (detected at Wed 18 Sep 2013 06:12:53 PM CEST)
        detects change:            0
        detection by polling:      0
        detection inhibitable:     0
        detection inhibited:       0
      is read only:                0
      is mounted:                  0
      mount paths:
      mounted by uid:              0
      presentation hide:           0
      presentation nopolicy:       0
      presentation name:
      presentation icon:
      automount hint:
      size:                        500107862016
      block size:                  512
      job underway:                no
      usage:
      type:
      version:
      uuid:
      label:
      partition table:
        scheme:                    mbr
        count:                     5
      drive:
        vendor:                    ATA
        model:                     ST500DM002-1BD142
        revision:                  KC45
        serial:                    Z2ARNP4C
        WWN:                       5000c5004079c23c
        detachable:                0
        can spindown:              1
        rotational media:          Yes, at 7200 RPM
        write-cache:               enabled
        ejectable:                 0
        adapter:                   Unknown
        ports:
        similar devices:
        media:
          compat:
        interface:                 ata
        if speed:                  (unknown)
        ATA SMART:                 Updated at Wed 18 Sep 2013 06:13:23 PM CEST
          overall assessment:      Good
    ===============================================================================
     Attribute       Current|Worst|Threshold  Status   Value       Type     Updates
    ===============================================================================
     raw-read-error-rate         116| 99|  6   good    115427976   Pre-fail Online
     spin-up-time                100| 99|  0    n/a    0           Pre-fail Online
     start-stop-count            100|100| 20   good    857         Old-age  Online
     reallocated-sector-count    100|100| 36   good    0 sectors   Pre-fail Online
     seek-error-rate              78| 60| 30   good    62739713    Pre-fail Online
     power-on-hours               99| 99|  0    n/a    66.2 days   Old-age  Online
     spin-retry-count            100|100| 97   good    0           Pre-fail Online
     power-cycle-count           100|100| 20   good    807         Old-age  Online
     runtime-bad-block-total     100|100|  0    n/a    0           Old-age  Online
     end-to-end-error            100|100| 99   good    0           Old-age  Online
     reported-uncorrect          100|100|  0    n/a    0 sectors   Old-age  Online
     command-timeout             100| 99|  0    n/a    4           Old-age  Online
     high-fly-writes             100|100|  0    n/a    0           Old-age  Online
     airflow-temperature-celsius  59| 45| 45 FAIL_PAST 41C / 106F  Old-age  Online
     temperature-celsius-2        41| 55|  0    n/a    41C / 106F  Old-age  Online
     hardware-ecc-recovered       47| 38|  0    n/a    115427976   Old-age  Online
     current-pending-sector      100|100|  0    n/a    0 sectors   Old-age  Online
     offline-uncorrectable       100|100|  0    n/a    0 sectors   Old-age  Offline
     udma-crc-error-count        200|200|  0    n/a    0           Old-age  Online
     head-flying-hours           100|253|  0    n/a    68.0 days   Old-age  Offline
     total-lbas-written          100|253|  0    n/a    61189293917 Old-age  Offline
     total-lbas-read             100|253|  0    n/a    137341392451 Old-age  Offline

Another tool you can use it `bonnie++j` for stress testing your harddisk but it doesn't track any errors. You can use it with the following command:

    bonnie++ -d ~/Downloads -r 1000
    Old HD:

    Writing a byte at a time...done
    Writing intelligently...done
    Rewriting...done
    Reading a byte at a time...done
    Reading intelligently...done
    start 'em...done...done...done...done...done...
    Create files in sequential order...done.
    Stat files in sequential order...done.
    Delete files in sequential order...done.
    Create files in random order...done.
    Stat files in random order...done.
    Delete files in random order...done.
    Version  1.96       ------Sequential Output------ --Sequential Input- --Random-
    Concurrency   1     -Per Chr- --Block-- -Rewrite- -Per Chr- --Block-- --Seeks--
    Machine        Size K/sec %CP K/sec %CP K/sec %CP K/sec %CP K/sec %CP  /sec %CP
    mg               2G   624  97 83917  17 40261  14  2015  87 999552  41  2840  19
    Latency             21169us     408ms     310ms   38707us   25734us    8033us
    Version  1.96       ------Sequential Create------ --------Random Create--------
    mg                  -Create-- --Read--- -Delete-- -Create-- --Read--- -Delete--
                  files  /sec %CP  /sec %CP  /sec %CP  /sec %CP  /sec %CP  /sec %CP
                     16 28438  34 +++++ +++ +++++ +++ 14767  13 +++++ +++ 26551  21
    Latency             38544us     430us     441us     266us      78us     566us
    1.96,1.96,mg,1,1379531733,2G,,624,97,83917,17,40261,14,2015,87,999552,41,2840,19,16,,,,,28438,34,+++++,+++,+++++,+++,14767,13,+++++,+++,26551,21,21169us,408ms,310ms,38707us,25734us,8033us,38544us,430us,441us,266us,78us,566us


References:
[bonnie+](http://unix.stackexchange.com/questions/72563/is-there-a-good-drive-torture-test-tool)



## Conclusion


