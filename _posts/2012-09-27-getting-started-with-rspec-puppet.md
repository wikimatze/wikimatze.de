---
title: Getting started with RSpec Puppet
update: 2014-03-30
categories: ['ruby', 'howto']
---

<blockquote>
  <p>You never improve if you can't change at all.</p>
  <strong>Tom DeMarco</strong>
</blockquote>


Writing your service configuration with Puppet can be easy. But when it comes to debugging, it can be very difficult to
edit things and to find certain errors. This article presents your the basic of setting up your environment for testing
Puppet modules in a BDD way.


<a href="http://farm9.staticflickr.com/8291/7804199724_37c12fbbc0_b.jpg" title="Prevention of bad code with tests." class="fancybox"><img src="http://farm8.staticflickr.com/8291/7804199724_37c12fbbc0_z.jpg" class="center" alt="Prevention of bad code with tests."/></a>

<div class="caption">Prevention of bad code with tests.</div>


## The tools

The [rspec-puppet gem](https://rubygems.org/gems/rspec-puppet/) is the [Gem](http://docs.rubygems.org/read/chapter/1#page22) setup to get started. It install the `rspec-puppet-init` command which automatically sets up the basic settings for testing. As a text tool we want to use [puppet-lint](http://rubygems.org/gems/puppet-lint/): This tool checks your Puppet manifests against the [Puppet Labs style guide](http://docs.puppetlabs.com/guides/style_guide.html) and alert you to any discrepancies => you have now your constant feedback loop when writing code.


Run the following commands to install the gem:


```bash

$ gem install rspec-puppet
$ gem install puppet-lint

```


You can use `puppet-lint` in your terminal to check a puppet manifest.


```bash

$ puppet-lint <path-to-your-manifest>

```


Let's assume, we have the following puppet file:


```ruby

# manifests/init.pp
class git::init {
  include git:: package
}

```


If we run `puppet-lint` on it:


```bash

$ puppet-lint manifests/init.pp
ERROR: two-space soft tabs not used on line 10
WARNING: unquoted resource title on line 10

```


## Setting up the environment

The next step is to clone the [puppet boilerplate repository](https://github.com/andreashaerter/puppet-boilerplate-modules) . It's perfect for creating a initial skeleton for a new module. After we get the code, we run a script which guides you through the process of creating a new module:


```bash

$ git clone https://github.com/andreashaerter/puppet-boilerplate-modules.git
$ ./puppet-boilerplate-modules/newmodule.sh

```


Answer the questions in this dialog, that means select the module name, the template for it (*0: application-001* is
perfect for the beginning), the location, and the author. When your are done with this, go into the directory of your
new module and perform the following cleanup commands:


```bash

$ cd <your-module-path>
$ rm COPYING CREDITS Modulefile NOTICE README
$ rm -rf files/ templates/

```


The cleanup is necessary to get you focused on the basics of testing. Now, your file structure should look like the following.


```bash

-- manifests
    |-- init.pp
    |-- package.pp
    |-- params.pp

```


This structure follows the **package, config, and service** (okay, we have `params.pp` instead of `service.pp` but this
not bad because the module we create in this example isn't a service) pattern as mentioned by R.I.Pienaar [blog
post](http://www.devco.net/archives/2009/09/28/simple_puppet_module_structure.php).


The last step is to run `rspec-puppet-init` in the directory of your module and it will create all the files for
testing.


```bash

$ cd <your-module-path>
$ rspec-puppet-init
 + spec/
 + spec/classes/
 + spec/defines/
 + spec/functions/
 + spec/hosts/
 + spec/fixtures/
 + spec/fixtures/manifests/
 + spec/fixtures/modules/
 + spec/fixtures/modules/git/
 + spec/fixtures/manifests/site.pp
 + spec/fixtures/modules/git/manifests
 + spec/spec_helper.rb
 + Rakefile

```


And the file structure should be the following:


    |-- manifests
    |   |-- init.pp
    |   |-- package.pp
    |   `-- params.pp
    |-- Rakefile
    `-- spec
        |-- classes
        |-- defines
        |-- fixtures
        |   |-- manifests
        |   |   `-- site.pp
        |   `-- modules
        |       `-- git
        |           `-- manifests -> ../../../../manifests
        |-- functions
        |-- hosts
        `-- spec_helper.rb


The symlinks in the `spec/` directory are linking the manifests folder into your spec folder, so that they are in the
runpath of your specs when you run `rspec`.


## Testing, testing, and testing

First, we want to test that the class `git::package` is created in `manifests/init.pp` manifests. All we need to do is
to create a spec named `init_spec.rb` in the `spec/classes` directory. To make it testable, we need to define a scope
for our `init.pp` manifest.


```ruby

# manifests/init.pp
class git::init {
  class { 'git::package': }
}

```


Let's do the test for it:


```ruby

# spec/classes/init_spec.rb
require 'spec_helper'

describe "git::init" do
  it { should create_class('git::packagee')}
end

```


**Remember:** Run `rake spec` always from the root directory of your module!


```bash

$ cd <your-module-path>
$ rake spec
/home/helex/.rbenv/versions/1.9.2-p320/bin/ruby -S rspec spec/classes/init_spec.rb

git::init
  should contain Class[git::packagee] (FAILED - 1)

Failures:

  1) git::init
     Failure/Error: it { should create_class('git::packagee')}
       expected that the catalogue would contain Class[git::packagee]
     # ./spec/classes/init_spec.rb:4:in `block (2 levels) in <top (required)>'

Finished in 0.05637 seconds
1 example, 1 failure

Failed examples:

rspec ./spec/classes/init_spec.rb:4 # git::init

```


Duh, it's red, what should we do? The catalogue does not contain a class `git::packagee`. Gosh, it's a typo in our
`init_spec.rb` file. Let's fix this:


```ruby

# spec/classes/init_spec.rb
require 'spec_helper'

describe "git::init" do
  it { should create_class('git::package')}
end

```


And run our tests again:


```bash

$ rake spec
/home/helex/.rbenv/versions/1.9.2-p320/bin/ruby -S rspec spec/classes/init_spec.rb

git::init
  should contain Class[git::package]

Finished in 0.03963 seconds
1 example, 0 failures

```


It's green and running - perfect.


## Testing the creation of a package with an attribute

Since we are now sure, that the `package` manifests is integrated, it's time to write a test, that we have the
`git-core` package in our package manifests. Let's write `spec/classes/install_spec.rb`:


```ruby

# spec/classes/package_spec.pp
require 'spec_helper'

describe 'git::package' do

  context 'install git-core' do
    it { should contain_package('git-core')}
  end
end

```


The `contains\_<resource>` *matcher* will test if the manifest contains a particular puppet resource.


And run the tests again with `rake spec` form the root directory of your module:


```bash

$ rake spec
/home/helex/.rbenv/versions/1.9.2-p320/bin/ruby -S rspec spec/classes/package_spec.rb spec/classes/init_spec.rb

git::package
  install git-core
    should contain Package[git-core] (FAILED - 1)

git::init
  should contain Class[git::package]

Failures:

  1) git::package install git-core
     Failure/Error: it { should contain_package('git-core')
       expected that the catalogue would contain Package[git-core]
     # ./spec/classes/package_spec.rb:6:in `block (3 levels) in <top (required)>'

Finished in 0.19843 seconds
2 examples, 1 failure

Failed examples:

rspec ./spec/classes/package_spec.rb:6 # git::package install git-core

```


Let's edit `manifests/package.pp` file:


```ruby

# manifests/package.pp
class git::package {
  package { 'git-core':}
}

```


And run the tests again:


```bash

$ rake spec
/home/helex/.rbenv/versions/1.9.2-p320/bin/ruby -S rspec spec/classes/package_spec.rb spec/classes/init_spec.rb

git::package
  install git-core
    should contain Package[git-core]

git::init
  should contain Class[git::package]

Finished in 0.19894 seconds
2 examples, 0 failures

```


Next we want to add the **ensure** attribute to the get the latest version of the `git-core package`. Let's write a
failing test first:


```ruby

# spec/classes/package_spec.pp
require 'spec_helper'

describe 'git::package' do

  context 'install git-core' do
    it { should contain_package('git-core')
         .with_ensure('latest')
    }
  end
end
```


The `with\_*` and `without\_*` *matcher* can test the presence or absence of the parameter of resources. Run our tests, to see they are failing:


```bash

$ rake spec
/home/helex/.rbenv/versions/1.9.2-p320/bin/ruby -S rspec spec/classes/package_spec.rb spec/classes/init_spec.rb

git::package
  install git-core
    should contain Package[git-core] with ensure => "latest" (FAILED - 1)

git::init
  should contain Class[git::package]

Failures:

  1) git::package install git-core
     Failure/Error: .with_ensure('latest')
       expected that the catalogue would contain Package[git-core] with ensure set to `"latest"` but it is set to `nil` in the catalogue
     # ./spec/classes/package_spec.rb:7:in `block (3 levels) in <top (required)>'

Finished in 0.19862 seconds
2 examples, 1 failure

Failed examples:

rspec ./spec/classes/package_spec.rb:6 # git::package install git-core

```


Time to fix it:


```ruby

# manifests/package.pp

class git::package {
  package { 'git-core':
    ensure => latest
  }
}

```


If we run now our tests again, it should work:


```bash

$ rake spec
/home/helex/.rbenv/versions/1.9.2-p320/bin/ruby -S rspec spec/classes/package_spec.rb spec/classes/init_spec.rb

git::package
  install git-core
    should contain Package[git-core] with ensure => "latest"

git::init
  should contain Class[git::package]

Finished in 0.20456 seconds
2 examples, 0 failures

```


If you have problems with understanding the syntax of RSpec, just checkout the
["The RSpec Book"](http://pragprog.com/book/achbd/the-rspec-book) by David Chelimsky.


## Refactor

Since we now have green tests, we can play with the code. Let's make `manifests.init.pp` nicer:


```ruby

# manifests/init.pp

class git::init {
  # don't like the class declaration syntax: class { 'git::package': }
  include git::package # much better
}

```


Run the test:


```bash

$ rake spec
/home/helex/.rbenv/versions/1.9.2-p320/bin/ruby -S rspec spec/classes/package_spec.rb spec/classes/init_spec.rb

git::package
  install git-core
    should contain Package[git-core] with ensure => "latest"

git::init
  should contain Class[git::package]

Finished in 0.20158 seconds
2 examples, 0 failures

```


Your catalog is still valid. Have beer because you have written your first tests for puppet and refactored your first manifest.


## Conclusion

Testing is important - even or especially with the environment settings for your systems. It take some time to get used
to it and you will find it in the beginning very cumbersome to write the code double. But when you are writing 4000
lines of code long manifest you will be happy to have structure, and confidence in your code with your lovely tests.


## Further reading

- [rspec-puppet page](http://rspec-puppet.com/)
- [puppet-lint page](http://puppet-lint.com/)
- [Tim Sharp - author of rspec-puppet and puppet-lint](http://bombasticmonkey.com/)
- [Puppet core type cheatsheet](http://docs.puppetlabs.com/puppet_core_types_cheatsheet.pdf)

