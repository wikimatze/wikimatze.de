---
title:
meta-description: ...
published: false
---
# Uploading a showoff presentation on heroku

- get an account
- upload your ssh keys on heroku with
    heroku keys:add
    Found existing public key: /home/helex/.ssh/id_rsa.pub
    Uploading SSH public key /home/helex/.ssh/id_rsa.pub... done
- clone the repo from heroku: git clone git@heroku.com:puppet-and-rspec-puppet.git
- put your files in there and init a git repository

- look at your gem file that it contains the following

    source :rubygems

    gem 'showoff', '~>0.7.0'
    gem 'gli', '1.6.0'
    gem 'heroku'
    gem 'rb-readline'

=> run `bundle`

- herokirize your presentation:

      $ bundle exec showoff heroku puppet-and-rspec-puppet => initialisation
      heroku create puppet-and-rspec-puppet
      bundle install

When you run `$ bundle exec showoff heroku puppet-and-rspec-puppet => initialisation` don't follow the instructions because they have changed
Now you have to clone the repository on heroku and put in there the files of the previous folder where the files of your presentation are inside. Commit all files

      git add .
      git commit -m 'herokuized'

And push the files on heroku:


    git push origin master
    Counting objects: 30, done.
    Delta compression using up to 4 threads.
    Compressing objects: 100% (26/26), done.
    Writing objects: 100% (30/30), 1.54 MiB | 114 KiB/s, done.
    Total 30 (delta 0), reused 0 (delta 0)

    -----> Heroku receiving push
    -----> Ruby/Rack app detected
    -----> Installing dependencies using Bundler version 1.2.1
           Running: bundle install --without development:test --path vendor/bundle --binstubs bin/ --deployment
           Fetching gem metadata from http://rubygems.org/.......
           Installing addressable (2.3.2)
           Installing blankslate (2.1.2.4)
           Installing bluecloth (2.2.0) with native extensions
           Installing excon (0.16.4)
           Installing gli (1.6.0)
           Installing heroku-api (0.3.5)
           Installing launchy (2.1.2)
           Installing netrc (0.7.7)
           Installing mime-types (1.19)
           Installing rest-client (1.6.7)
           Installing rubyzip (0.9.9)
           Installing heroku (2.32.8)
           Installing json (1.7.5) with native extensions
           Installing nokogiri (1.5.5) with native extensions
           Installing parslet (1.4.0)
           Installing rack (1.4.1)
           Installing rack-protection (1.2.0)
           Installing rb-readline (0.4.2)
           Installing tilt (1.3.3)
           Installing sinatra (1.3.3)
           Installing showoff (0.7.0)
           Using bundler (1.2.1)
           Your bundle is complete! It was installed into ./vendor/bundle
           Post-install message from heroku:
           !    Heroku recommends using the Heroku Toolbelt to install the CLI.
           !    Download it from: https://toolbelt.heroku.com
           Cleaning up the bundler cache.
    -----> Discovering process types
           Procfile declares types     -> (none)
           Default types for Ruby/Rack -> console, rake, web
    -----> Compiled slug size: 4.4MB
    -----> Launching... done, v3
           http://lessons-learned-with-vimscript.herokuapp.com deployed to Heroku

    To git@heroku.com:lessons-learned-with-vimscript.git
     * [new branch]      master -> master

- visit the URL: http://puppet-and-rspec-puppet.herokuapp.com/





## Conclusion

## Further reading

-
-
-


