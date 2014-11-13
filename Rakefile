require 'rake'
require 'colorator'

posts_dir = '_drafts'

desc "New post in #{posts_dir}"
task :p do
  require 'fileutils'
  require 'stringex'

  puts "What should we call this post for now?".bold.magenta
  name = STDIN.gets.chomp

  date = Time.now.to_s.split(" ").first

  title = "#{name.gsub(/&/,'&amp;')}"
  filename = "#{posts_dir}/#{date}-#{name.to_url}.md"
  puts "Created new post: #{filename}".bold.green

  post_content = <<-MARKDOWN
---
title: TITLE
---


  MARKDOWN
  post_content = post_content.gsub('TITLE', title)

  open(filename, 'w') do |post|
    system "mkdir -p #{posts_dir}/";
    post.puts post_content
  end

  system "vim #{filename}"
end

desc 'Staging'
task :staging do
  puts '# building the site ..'.green
  puts '# deploying the site ..'.green

  system "rsync -vru -e \"ssh\" --del ?site/* xa6195@xa6.serverdomain.org:/home/www/iso25/"
  puts '# Please refer to http://iso25.wikimatze.de to visit the staging system'.green
end

desc 'Deploy'
task :d => [:generate,:minifycss] do
  require 'sweetie'

  puts 'Sweetie - time to update stats ..'.green
  Sweetie::Conversion.conversion
  #Sweetie::Bitbucket.bitbucket("wikimatze")

  puts 'Building jekyll ..'.green
  system 'jekyll build'

  puts 'Deploying site with lovely rsync ..'.green
  system "rsync -vru -e \"ssh\" --del ?site/* xa6195@xa6.serverdomain.org:/home/www/wikimatze/"

  puts 'Done!'.green
end

desc 'Minify css'
task :minifycss do
  require 'cssminify'

  puts 'Minify css and merge it into one file ..'.yellow

  gumby = CSSminify.compress(File.open('css/gumby.css'))
  style = CSSminify.compress(File.open('css/style.css'))
  pygments = CSSminify.compress(File.open('css/pygments.css'))
  fancybox_buttons = CSSminify.compress(File.open('js/fancybox/source/helpers/jquery.fancybox-buttons.css'))
  fancybox_thumbs = CSSminify.compress(File.open('js/fancybox/source/helpers/jquery.fancybox-thumbs.css'))

  File.open('css/application.css', 'w') do |file|
    file.write(gumby << style << pygments << fancybox_buttons << fancybox_thumbs)
  end

  puts 'Done ..'.green
end

desc 'Minify js'
task :minifyjs do
  require 'uglifier'

  puts 'Minify js and merge it into one file ..'.yellow

  jquery = Uglifier.compile(File.open('js/libs/jquery-2.0.2.min.js'))

  modernizr = Uglifier.compile(File.open('js/libs/modernizr.js'))
  github_commits = Uglifier.compile(File.open('js/github-commits-widget.js'))
  gumby = Uglifier.compile(File.open('js/libs/gumby.js'))
  gumby_toggleswitch = Uglifier.compile(File.open('js/libs/ui/gumby.toggleswitch.js'))
  gumby_init = Uglifier.compile(File.open('js/libs/gumby.init.js'))

  fancybox_pack = Uglifier.compile(File.open('js/fancybox/source/jquery.fancybox.pack.js'))
  fancybox_buttons = Uglifier.compile(File.open('js/fancybox/source/helpers/jquery.fancybox-buttons.js'))
  fancybox_media = Uglifier.compile(File.open('js/fancybox/source/helpers/jquery.fancybox-media.js'))
  fancybox_thumbs = Uglifier.compile(File.open('js/fancybox/source/helpers/jquery.fancybox-thumbs.js'))

  github_widget_configuration = Uglifier.compile(File.read('js/github-commits-widget-configuration.js'))
  fancybox_configuration = Uglifier.compile(File.read('js/fancybox-configuration.js'))

  File.open("js/application.js", "w") do |file|
    file.write (modernizr << jquery << github_commits << gumby << gumby_toggleswitch << gumby_init << fancybox_pack << fancybox_buttons << fancybox_media << fancybox_thumbs << github_widget_configuration << fancybox_configuration)
  end

  puts 'Done ..'.green
end

desc 'Startup Jekyll'
task :s do
  system 'rm -rf _site'
  system 'jekyll build'
  system 'jekyll serve -w'
end

# Credit for this goes to https://gist.github.com/alexyoung/143571
desc 'Create tag page'
task :generate do
  puts 'Generating tags...'.green
  require 'rubygems'
  require 'jekyll'
  include Jekyll::Filters

  options = Jekyll.configuration({})
  site = Jekyll::Site.new(options)
  site.read_posts('')

  html =<<-HTML
---
title: Tags
---

  HTML

  site.categories.sort.each do |category, posts|
  html << <<-HTML
  <h3 id="#{category}">#{category}</h3>
  HTML

  html << '<ul class="posts">'
  posts.each do |post|
  post_data = post.to_liquid
  html << <<-HTML
  <li>
  <div>#{date_to_string post.date}</div>
  <a href="#{post.url}">#{post_data['title']}</a>
  </li>
  HTML
  end
  html << '</ul>'
  end

  File.open('tags.html', 'w+') do |file|
  file.puts html
  end

  puts 'Done.'
end

task :default => :s
