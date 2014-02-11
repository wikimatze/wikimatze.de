---
layout: post
title:
meta-description: ...
published: false
---

h2. Einrichtung
* folgendes in die Header-Datei einfügen
      <pre>
        <link rel="stylesheet" href="css/blueprint/screen.css" type="text/css" media="screen, projection">
        <link rel="stylesheet" href="css/blueprint/print.css" type="text/css" media="print">
        <!--[if lt IE 8]>
          <link rel="stylesheet" href="css/blueprint/ie.css" type="text/css" media="screen, projection">
        <![endif]-->
      </pre>
* Remember to add trailing slashes if you're using XHTML (" />").


h2. Source-Files
Wichtig ist, dass man die folgenden Datein nicht verändert, da diese sonst bei neuen Versionen des Frameworks nicht überschrieben werden können

* reset.css
** löscht alle Standardeinstellungen der Browser
* typography.css
** setzt Standardschriftart, die nach listapart besonders Nutzerfreundlich ist
* grid.css
** managt das Grid-Layout der Seite
* ie.css
** macht automatisch css für IE!!
* print.css
** was wie gedruckt wird
* forms.css
** wie Buttons aussehen


h2. Aufbau
* alles muss um ein div mit class=container umschlossen sein, sonst funktioniert es nicht
* falls man <div class="container showgrid"> eingibt, so wird die Seite im Grid-Layout angezeigt
* The rightmost column in a grid must have use the 'last' class

h2. Beispiel


h2. Links
* [["http://www.blackrocksoftware.com/blog/quick":http://www.blackrocksoftware.com/blog/quick_blueprint_guide|Einführung]]
* [["http://net.tutsplus.com/tutorials/html":http://net.tutsplus.com/tutorials/html-css-techniques/a-closer-look-at-the-blueprint-css-framework/|Theoretische Grundlagen ausführlich erklärt]]
* [["http://kematzy.com/blueprint":http://kematzy.com/blueprint-generator/|Grid-Generator]]


## Conclusion

## Further reading

-
-
-


