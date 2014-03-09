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
layout: post
title: TITLE
description:
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
task :d => [:generate] do
  require 'sweetie'

  puts '1. Sweetie - time to update stats ..'.green
  Sweetie::Conversion.conversion
  Sweetie::Bitbucket.bitbucket("wikimatze")

  puts '2. Building jekyll ..'.green
  system 'jekyll build'

  puts '3. Deploying site with lovely rsync ..'.green
  system "rsync -vru -e \"ssh\" --del ?site/* xa6195@xa6.serverdomain.org:/home/www/wikimatze/"

  puts '4. Done!'.green
end

desc 'Startup Jekyll'
task :s do
  system 'rm -rf _site'
  system 'jekyll build'
  system 'jekyll serve --watch'
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
layout: layout
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

task :default => :start
