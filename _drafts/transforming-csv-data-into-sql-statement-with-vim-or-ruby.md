---
title:
meta-description: ...
published: false
---


## The Problem

During work we had the task to import data from a simple csv file into our database. Here is the structure of the
csv-file:


    Stadt,Bundesland,Top-Stadt
    Wien,Wien,1
    Graz,Steiermark,1
    Linz,Oberösterreich,1
    Salzburg,Salzburg,1
    Innsbruck,Tirol,1
    ....


These files has to be transformed into some SQL insert statement:


    INSERT INTO seo VALUE(1, Wien, Wien),
    ...


## Let's do it with Vim

Here is the regular expression for it:


    %s/\([^,]*\),\([^,]*\),\([^,]*\)/INSERT INTO seo VALUES ("\1","\2","\3"),/


Here is the output when you run the regular expression


    INSERT INTO seo VALUES ("Stadt","Bundesland","Top-Stadt"),
    INSERT INTO seo VALUES ("Wien","Wien","1"),
    INSERT INTO seo VALUES ("Graz","Steiermark","1"),
    INSERT INTO seo VALUES ("Linz","Oberösterreich","1"),
    INSERT INTO seo VALUES ("Salzburg","Salzburg","1"),
    INSERT INTO seo VALUES ("Innsbruck","Tirol",""),
    ...


## Let's Do It With Ruby


    require 'csv'

    CSV.foreach('seo_cities.csv') do |row|
      city = row[0]
      state = row[1]
      top_city = row[2]

      query = %Q(INSERT INTO seo VALUES ("#{city}","#{state}","#{top_city}"),)
      puts query
    end


## Encoding Problem

With Deutsche Umlaut und arabischen Namen it comes to problems with CSV
parsing.

Solution: Convert the file in the correct format:

`iconv -t UTF-8 -f LATIN1 < firstname.csv > tmp.csv`


## Conclusion

## Further reading

-
-
-

