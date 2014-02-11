require 'rake'
require 'colorator'

posts_dir = '_posts'

def say(text, color=:magenta)
  n = { :bold => 1, :red => 31, :green => 32, :yellow => 33, :blue => 34, :magenta => 35 }.fetch(color, 0)
  puts "\e[%dm%s\e[0m" % [n, text]
end

desc "New post in #{posts_dir}"
task :p do
  require 'fileutils'
  require 'stringex'
  require './_plugins/titlecase.rb'

  say "What should we call this post for now?"
  name = STDIN.gets.chomp

  date = Time.now.to_s.split(" ").first

  mkdir_p "#{posts_dir}"
  title = "#{name.gsub(/&/,'&amp;').titlecase}"
  filename = "_posts/#{date}-#{name.to_url}.md"
  say "Created new post: #{filename}", :green

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
  say '# building the site ..', :green
  say '# deploying the site ..', :green

  system "rsync -vru -e \"ssh\" --del ?site/* xa6195@xa6.serverdomain.org:/home/www/iso25/"
  say '# Please refer to http://iso25.wikimatze.de to visit the staging system', :green
end

desc 'Deploy'
task :d do
  require 'sweetie'

  say '1. Sweetie - time to update stats ..', :green
  Sweetie::Conversion.conversion
  Sweetie::Bitbucket.bitbucket("wikimatze")

  say '2. Building jekyll ..', :green
  system 'jekyll build'

  say '3. Deploying site with lovely rsync ..', :green
  system "rsync -vru -e \"ssh\" --del ?site/* xa6195@xa6.serverdomain.org:/home/www/wikimatze/"

  say '4. Done!', :green
end

desc 'Startup Jekyll'
task :s do
  system 'rm -rf _site'
  system 'jekyll build'
  system 'jekyll serve --watch'
end

task :default => :start
