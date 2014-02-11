---
layout: post
title:
meta-description: ...
published: false
---
# Setting default browser for opening links in thunderbird
Look for prefs.js file and add the following:

user_pref("network.protocol-handler.app.http", "/usr/bin/google-chrome");
user_pref("network.protocol-handler.app.https", "/usr/bin/google-chrome");



source: http://kb.mozillazine.org/Changing_the_web_browser_invoked_by_Thunderbird


## Conclusion

## Further reading

-
-
-


