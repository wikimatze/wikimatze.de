---
title: Code Coverage Tools For Padrino
description: Beside writing an application it is very important to know how you can deploy it
categories: ['padrino', 'ruby']
---

{% include leanpub.html %}

{% include newsletter.html %}


As long as your application exists, some developers leave others will join. It's good to have some metrics about certain code smells. A code smell is part of your source code which may be the root of a design problem but is not actually a bug. It's good to have some tools to be "lord of the smells" for [Padrino](http://www.padrinorb.com/) - don't let smells lower the quality of your project.


(Note: This post is tested with [padrino 0.12.2](http://www.padrinorb.com/blog/padrino-0-12-0-activesupport-4-rewritten-reloader-smarter-rendering-and-loads-more), [simplecov 0.9](https://github.com/colszowka/simplecov), [metric_fu 4.11.1](https://github.com/metricfu/metric_fu/), and [ruby 2.1.2p95](https://www.ruby-lang.org/en/news/2013/09/23/ruby-2-1-0-preview1-is-released/))


## Available Tools

I will go through the following tools and will explain how you can use them.

- [simplecov](https://github.com/colszowka/simplecov): It will automatically detect the tests you are using Rubies 1.9's [built-in Coverage library](http://www.ruby-doc.org/stdlib-1.9.3/libdoc/coverage/rdoc/Coverage.html) to gather code coverage data.
- [metric_fu](https://github.com/metricfu/metric_fu/): Creates churn, code smells, and other coverage tools that generate reports about your code.
- [codeclimate.com](https://codeclimate.com/): Online tool for measuring quality and security for your application.


## Simplecov

Add the gem to your `Gemfile`:


```ruby
gem 'simplecov'
```


Next, I want to start the code coverage generation every time I run the tests. So we need to add the following line to the `spec_helper.rb`:


```ruby
require 'simplecov'
SimpleCov.start
```


And that's all. Next time when you run the tests you can detect lines with the following output:


```bash
Coverage report generated for RSpec to ~/git/job-vacancy/coverage. 209 / 252 LOC (82.94%) covered.
/
```


After all tests have been passed, you can see the output in the `coverage/index.html` file:


<a href="http://farm4.staticflickr.com/3754/13240488444_f4a2a02afc_o.png" title="Simplecover overview without any special configuration" class="fancybox"><img src="http://farm4.staticflickr.com/3754/13240488444_f9a39d216a_c.jpg" class="big center" alt="Simplecover overview without any special configuration"/></a>
<div class="caption">Simplecover overview without any special configuration</div>


<a href="http://farm8.staticflickr.com/7341/13240163115_7acfa5bab0_o.png" title="Simplecov with an detailed view" class="fancybox"><img src="http://farm8.staticflickr.com/7341/13240163115_6abdb36689_c.jpg" class="big center" alt="Simplecov with an detailed view"/></a>
<div class="caption">Clicking on a single class will give you a brief overview which lines are not tested</div>


It is also possible to divide parts of your application into several groups. Add options to the `Simplecov.start` block:


```ruby
SimpleCov.start do
  add_group "Models", "app/models"
  add_group "Controllers", "app/controllers"
  add_group "Helpers", "app/helpers"
  add_group "Mailers", "app/mailers"
end
```


<a href="http://farm8.staticflickr.com/7302/13240489074_f8fce593fb_o.png" title="Simplecov grouped output" class="fancybox"><img src="http://farm8.staticflickr.com/7302/13240489074_d38bff94b8_c.jpg" class="big center" alt="Simplecov grouped output"/></a>
<div class="caption"> Simplecov - a more structured view of different components</div>


## metric_fu

Add the following line to your `Gemfile`:


```ruby
gem 'metric_fu'
```


When this is done you need to start the `metric_fu` command from your commandline:


```bash
$ ~/git/job-vacancy: metric_fu
******* STARTING METRIC reek
******* ENDING METRIC reek
******* STARTING METRIC flog
******* ENDING METRIC flog
******* STARTING METRIC flay
******* ENDING METRIC flay
******* STARTING METRIC saikuro
******* ENDING METRIC saikuro
******* STARTING METRIC roodi
******* ENDING METRIC roodi
******* STARTING METRIC cane
******* ENDING METRIC cane
******* STARTING METRIC churn
******* ENDING METRIC churn
******* STARTING METRIC stats
******* ENDING METRIC stats
******* STARTING METRIC hotspots
******* ENDING METRIC hotspots
******* SAVING REPORTS
******* GENERATING GRAPHS
*****Generating graphs
*****Generating graphs for tmp/metric_fu/_data/20140318.yml
all done
```


It will generate a `tmp/metric_fu` directory with the following contents:


```bash
tmp/metric_fu
├── _data
│   └── 20140318.yml
├── output
│   ├── app_app.rb.html
│   ├── app_controllers_page.rb.html
│   ├── app_controllers_sessions.rb.html
│   ├── app_controllers_users.rb.html
│   ├── app_helpers_page_helper.rb.html
│   ├── app_helpers_sessions_helper.rb.html
│   ├── app_helpers_users_helper.rb.html
│   ├── app_mailers_confirmation.rb.html
│   ├── app_mailers_registration.rb.html
│   ├── app_models_job_offer.rb.html
│   ├── app_models_user_observer.rb.html
│   ├── app_models_user.rb.html
│   ├── app_views_application.erb.html
│   ├── app_views_users_edit.erb.html
│   ├── app_views_users_new.erb.html
│   ├── bluff-min.js
│   ├── cane.html
│   ├── cane.js
│   ├── churn.html
│   ├── excanvas.js
│   ├── flay.html
│   ├── flay.js
│   ├── flog.html
│   ├── flog.js
│   ├── Gemfile.html
│   ├── Gemfile.lock.html
│   ├── hotspots.html
│   ├── index.html
│   ├── js-class.js
│   ├── lib_tasks_auth_token_attribute.rake.html
│   ├── reek.html
│   ├── reek.js
│   ├── roodi.html
│   ├── roodi.js
│   ├── saikuro.html
│   ├── spec_app_controllers_users_controller_spec.rb.html
│   ├── stats.html
│   └── stats.js
├── report.yml
└── scratch
    └── churn
        └── 873660ae5973b77b09c47d1dcf03577222095d6e.json

4 directories, 41 files
```


The following metrics are created by



`cane` can be used if code quality thresholds are met.


<a href="http://farm3.staticflickr.com/2828/13240306993_93fe770af0_o.png" title="Cane metric to measure code quality thresholds." class="fancybox"><img src="http://farm3.staticflickr.com/2828/13240306993_eb90332075_c.jpg" class="big center" alt="Cane metric to measure code quality thresholds."/></a>


`churn` measures the change ratio of files and you can use this indicator to have more code review, refactoring, more tests for this **beast of a file**.


<a href="http://farm3.staticflickr.com/2857/13240489654_ed48447f93_o.png" title="Churn measures the change ratio of files" class="fancybox"><img src="http://farm3.staticflickr.com/2857/13240489654_8ffbb16bae_c.jpg" class="big center" alt="Churn measures the change ratio of files"/></a>


`flog` a high flog score is an indicator for code complexity.


<a href="http://farm8.staticflickr.com/7036/13240164005_baca449841_o.png" title="Flog measures the complexity of a file by giving several flaws in the code a certain ranking." class="fancybox"><img src="http://farm8.staticflickr.com/7036/13240164005_35459cc33c_z.jpg" class="big center" alt="Flog measures the complexity of a file by giving several flaws in the code a certain ranking."/></a>


`flay` analyzes code similarities in your code base - good way to stay clean with [DRY](http://en.wikipedia.org/wiki/Don%27t_repeat_yourself).


<a href="http://farm4.staticflickr.com/3715/13240307803_6f636cbb78_o.png" title="Flay measures code duplication." class="fancybox"><img src="http://farm4.staticflickr.com/3715/13240307803_7f55db88f8_c.jpg" class="big center" alt="Flay measures code duplication."/></a>


`reek` checks your classes and modules after code smells. Under the [reek wiki](https://github.com/troessner/reek/wiki/Code-Smells) you can find all code smells and what they actually mean.


<a href="http://farm8.staticflickr.com/7026/13240165265_9cf883ab3c_o.png" title="Check your classes, and modules after code smells." class="fancybox"><img src="http://farm8.staticflickr.com/7026/13240165265_dc06f44db4_c.jpg" class="big center" alt="Check your classes, and modules after code smells."/></a>


`hotspot` a gathering of the flog, flay and reek score of the files in your application.


<a href="http://farm8.staticflickr.com/7444/13240490574_534f559005_o.png" title="Hotspot measure overview." class="fancybox"><img src="http://farm8.staticflickr.com/7444/13240490574_536339c8df_c.jpg" class="big center" alt="Hotspot measure overview."/></a>


<a href="http://farm8.staticflickr.com/7430/13240491094_2dce09ded0_o.png" title="Hotspot measure detailed." class="fancybox"><img src="http://farm8.staticflickr.com/7430/13240491094_1dcb0e3188_c.jpg" class="big center" alt="Hotspot measure detailed."/></a>


`roodi` scans your code and informs you about design issues you may have.


<a href="http://farm8.staticflickr.com/7202/13240309053_b1e0daae4f_o.png" title="Roodi detect issues with your design." class="fancybox"><img src="http://farm8.staticflickr.com/7202/13240309053_1686a6705d_c.jpg" class="big center" alt="Roodi detect issues with your design."/></a>


`saikuro` generates a list of cyclomatic complexity of each method found in your application.


<a href="http://farm3.staticflickr.com/2869/13240165955_a94efe5ab2_o.png" title="Sailuro meases the cyclomatic complexity of all methods in your application." class="fancybox"><img src="http://farm3.staticflickr.com/2869/13240165955_8113b4c859_z.jpg" class="big center" alt="Sailuro meases the cyclomatic complexity of all methods in your application."/></a>


## Code Climate

Go to the website [codeclimate.com](https://codeclimate.com) and register. Once you are logged, you can add any ruby
related open source project for free.


<a href="http://farm4.staticflickr.com/3699/13245245445_fd8fbd0efb_o.png" title="Code Climate - add a repository." class="fancybox"><img src="http://farm4.staticflickr.com/3699/13245245445_50c46c74d2_z.jpg" class="big center" alt="Code Climate - add a repository."/></a>


It will take a while till the metrics are generated for your application:


<a href="" title="Refreshing the metrics takes a while on Code Climate" class="fancybox"><img src="http://farm4.staticflickr.com/3682/13245246155_8679cb3c79_c.jpg" class="big center" alt="Refreshing the metrics takes a while on Code Climate"/></a>



But when it's ready, you get a nice overview:


<a href="http://farm4.staticflickr.com/3682/13245246155_8b39d98dc1_o.png" title="Code Climate overview" class="fancybox"><img src="http://farm4.staticflickr.com/3682/13245246155_8679cb3c79_c.jpg" class="big center" alt="Code Climate overview"/></a>


Or a more detailed overview of single classes:


<a href="https://farm3.staticflickr.com/2900/14748209173_3bae7b4524_o.png" title="Detailed information about a single file in Code Climate" class="fancybox"><img src="https://farm3.staticflickr.com/2900/14748209173_2d561a0e99_c.jpg" class="big center" alt="Detailed information about a single file in Code Climate"/></a>
<div class="caption">Detailed information about a single file in Code Climate</div>

{% include newsletter.html %}

