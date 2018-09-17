require 'rake'
require 'colorator'

posts_dir = 'source/_drafts'

desc "New post in #{posts_dir}"
task :p do
  require 'fileutils'
  require 'stringex'

  puts "What should we call this post for now?".bold.magenta
  name = STDIN.gets.chomp

  date = Time.now.to_s.split(" ").first

  title = "#{name.gsub(/&/, '&amp;')}"
  filename = "#{posts_dir}/#{name.to_url}.md"
  puts "Created new post: #{filename}".bold.green

  post_content = <<-MARKDOWN
---
title: TITLE
description: TITLE
twitter_src:
facebook_src:
categories:
---

  MARKDOWN

  open(filename, 'w') do |post|
    system "mkdir -p #{posts_dir}/";
    post.puts post_content
  end

  system "vim #{filename}"
end

desc 'Staging'
task :staging => :b do
  puts 'Deploying site with lovely rsync ..'.bold.green

  system "rsync -vru -e \"ssh\" --del build/* xa6195@xa6.serverdomain.org:/home/www/stagingwikimatze/"
  puts '# Please refer to https://staging.wikimatze.de to visit the staging system'.green
end

desc 'Deploy'
task :deploy  do
  system 'middleman b'
  puts 'Deploying site with lovely rsync ..'.bold.green
  system "rsync -vru -e \"ssh\" --del build/* xa6195@xa6.serverdomain.org:/home/www/wikimatze/"

  puts 'Done!'.green
end

task :b do
  puts 'Building middleman ..'.bold.green
  system 'middleman b'
end

desc 'Startup Middleman'
task :s => :b do
  puts 'Middleman is finished with building..'.bold.green
  system 'middleman s'
end

require 'sweetie'

desc 'write stats in the config.rb file'
task :create_stati do
  sweetie = Sweetie::Conversion.new('./build', './config.rb')
  sweetie.create_stati
end


task :default => :s
