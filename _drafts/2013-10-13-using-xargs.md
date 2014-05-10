---
title: Using Xargs
description:
---
**


Running into the following situation:

```bash
$ pgrep chromium
  4175
  4326
  5615
  5720
  6282
  8392
  8667
  9266
  9414
  9423
  11238
  12996
  13567
  13571
  13572
  13573
  13577
  13622
  13630
  13640
  13657
  13664
  13672
  14382
  16284
  16830
  16845
  17375
  18438
  21390
  23346
  30466
  31115
  31151
  31459
```


Then how can I kill all running processes very easily?

    pgrep chromium | xargs sudo kill -9


## Conclusion


