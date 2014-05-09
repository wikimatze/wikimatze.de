---
title:
meta-description: ...
published: false
---
# asciitable-for-perl

Wonderful library to create ascii-tables:

To install:

pre. cpan Text:ASCIITable

{% highlight perl %}
use Text::ASCIITable;
$t = Text::ASCIITable->new();

$t->setCols('Id','Name','Price');
$t->addRow(1,'Dummy product 1',24.4);
$t->addRow(2,'Dummy product 2',21.2);
$t->addRow(3,'Dummy product 3',12.3);
$t->addRowLine();
print $t;
{% endhighlight %}

This will produce the wonderful output:

{% highlight  %}
.------------------------------.
| Id | Name            | Price |
+----+-----------------+-------+
|  1 | Dummy product 1 |  24.4 |
|  2 | Dummy product 2 |  21.2 |
|  3 | Dummy product 3 |  12.3 |
'----+-----------------+-------'
{% endhighlight %}

Thats all I wanted and it isn't so difficult to use.

You can use this piece of code to create your schedule.


## Conclusion

## Further reading

-
-
-


