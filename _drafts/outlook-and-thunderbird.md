
# Outlook and Thunderbird

h1. Outlook für Windows einrichten
- Davmail installieren:
{code}
sudo apt-get install openjdk-7-jre libswt-gtk-3-java
wget -O davmail_3.9.7-1870-1_all.deb
"http://downloads.sourceforge.net/project/davmail/davmail/3.9.7/davmail_3.9.7-1870-1_all.deb?r=&ts=1327002026&use_mirror=dfn"
$ sudo dpkg -i davmail_3.9.7-1870-1_all.deb
{code}


- Davmail starten:
   -im Punkt OWS (Exchange) folgenden Eintrag machen:
https://mail.myhammer.de/exchange/
- Mail Setup für Thunderbird (Name und Email ganz normal einen neuen
Account anlegen):
{code}
IMAP Incoming: Serverhost name "localhost" - Port "1143" - SSL "none" -
Authentication "normal password"
SMTP Outgoing: Serverhost name "localhost" - Port "1025" - SSL "none" -
Authentication "normal password"
Username: matthias.guenther
{code}

- re-test sollte keine Fehler ergeben
- Zertifikate akzeptieren
- bei Warning auf "I know the risk" klicken und "Create Account"

## Conclusion

## Further reading

-
-
-


