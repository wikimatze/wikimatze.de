---
title:
meta-description: ...
published: false
---
* [["http://cruisecontrolrb.thoughtworks.com/documentation/getting":http://cruisecontrolrb.thoughtworks.com/documentation/getting_started |Anleitung]]

h2. cruisecontroll einrichten
* ''cruisecontroll entpacken ''in das Verzeichnis wechseln, wo man cruisecontroll angelegt hat und die Rechte af 777 setzen
* Projekt hinzufügen: ./cruise add Railsair -r file:_/home/helex/Aptana\ RadRails\ Workspace/Railsair/.git/ -s git
* dann cruise-Server starten: *./cruise start*
* unter *localhost:3333 aufrufen*



=== how to configure that automatically emails are send, if a build fails ===
* go to ''~/.cruise/project/<bla>/cruise_config.rb''
** there you can set the variables
** ''project.email_notifier.emails = ['lordmatze@googlemail.com']''
** ''project.email_notifier.from = 'm6guma2@uni-jena.de'''
* then you must configure the mail server to send: go into ''~/.cruise/site_config.rb''
** ''ActionMailer::Base.smtp_settings = {''
  '''
     :tls => true,
     :address =>        "smtp.gmail.com",
     :port =>           587,
     :domain =>         "wikimatze.de",
     :authentication => :plain,
     :user_name =>      "lordmatze@googlemail.com",
     :password =>       "****"
  }
  '''

* if you get an error in this form you then have to edit the smtp_tls.rb in [[~/cruisecontrol/lib/]]
** replace the lines
    ''check_auth_args user, secret, authtype if user or secret ''

     with

      '''
      check_auth_args user, secret if user or secret
      '''

    '''
        check_auth_method authtype
    '''

## Conclusion

## Further reading

-
-
-


