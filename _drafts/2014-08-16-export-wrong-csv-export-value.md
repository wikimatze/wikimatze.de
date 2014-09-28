---
title: Export wrong CSV export value
---

Got a CSV from windows with the following content:





ssen<81>berdachung ;;),

477508;2;2;6518;0;Terrassen<81>berdachung ;;),

477509;2;2;6518;0;Terrassen<81>berdachung ;;),

477510;2;2;6518;0;Terrassen<81>berdachung ;;),

477511;2;2;6518;0;Terrassen<81>berdachung ;;),

477513;2;2;6518;0;Terrassen<81>berdachung ;;),



Checking the file with `file` gave me the following output:



                Non-ISO extended-ASCII text, with CRLF line terminators





There is the tool `icconf` tool:



                iconv -f ASCII -t utf-8//IGNORE < Raumausstatter_Bilderdatenbank.csv > escaped_file.csv



Checking the file with `file` gave me the following output:



                escaped_file.csv: ASCII text, with CRLF line terminators



