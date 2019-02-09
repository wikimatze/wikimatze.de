# Activate and configure extensions
# https://middlemanapp.com/advanced/configuration/#configuring-extensions

# Reload the browser automatically whenever files change
activate :livereload

# pretty URLs with no *.html ending
activate :directory_indexes

page "/test.php", :directory_index => false
page "/mail.php", :directory_index => false
page "/mail/**/*", :directory_index => false


# Layouts
# https://middlemanapp.com/basics/layouts/

# Per-page layout changes
page '/mail.php', layout: false
page '/*.xml', layout: false
page '/*.json', layout: false
page '/*.txt', layout: false
page '/books/*', layout: 'reading'

set :author, 'Matthias Günther'
set :twitter_card_creator, '@wikimatze'
set :host_simplegraph, 'wikimatze.de'
set :host, 'https://wikimatze.de'

# github stats
set :zimki, '2012-07-26'
set :sweetie, '2012-07-26'
set :pmwiki_dropcaps_recipe, '2013-01-20'
set :pmwiki_syntaxlove_recipe, '2013-01-20'
set :pmwiki_twitter_recipe, '2012-07-27'
set :pmwiki_linkicons_recipe, '2013-01-20'
set :pmwiki_headlineimage_recipe, '2013-01-20'

# page stats
set :build, '9-30-2018'
set :images, 75
set :htmlpages, 102
set :links, 606

# for the blog-categories (otherwise building will fail)
ignore '/category.html'


# blog
activate :blog do |blog|
  blog.permalink = '{title}'
  blog.sources = 'posts/{title}.html'
  blog.layout = 'post'
end

# for the blog-categories

ready do
  sitemap.resources
    .map { |r| (r.data['categories'] || "Uncategorized").split (" ") }
         .flatten
         .uniq
         .each do |category|
           if category != 'Uncategorized'
             proxy "/category/#{category.parameterize}/index.html" , 'category.html', locals: { category: category }
           end
         end
end

# General configuration
set :markdown_engine, :redcarpet

# code syntax and code examples in github style
activate :syntax

set :markdown,
  fenced_code_blocks: true,
  smartypants: true,
  footnotes: true,
  link_attributes: { rel: 'nofollow' },
  tables: true


# Build-specific configuration
# https://middlemanapp.com/advanced/configuration/#environment-specific-settings

activate :matomomiddleman do |p|
  p.domain = 'wikimatze.de'
  p.url = 'matomo'
  p.id = 1
end

configure :development do
  set :host, 'localhost'
end


configure :build do
  activate :minify_css
end
