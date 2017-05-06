###
# Page options, layouts, aliases and proxies
###

# Per-page layout changes:
#
# With no layout
page '/*.xml', layout: false
page '/*.json', layout: false
page '/*.txt', layout: false
page '/books/*', layout: 'reading'

# With alternative layout
# page "/path/to/file.html", layout: :otherlayout

# Proxy pages (http://middlemanapp.com/basics/dynamic-pages/)
# proxy "/this-page-has-no-template.html", "/template-file.html", locals: {
#  which_fake_page: "Rendering a fake page with a local variable" }

set :author, 'Matthias Günther'

# github stats
set :zimki, '2012-07-26'
set :sweetie, '2012-07-26'
set :pmwiki_dropcaps_recipe, '2013-01-20'
set :pmwiki_syntaxlove_recipe, '2013-01-20'
set :pmwiki_twitter_recipe, '2012-07-27'
set :pmwiki_linkicons_recipe, '2013-01-20'
set :pmwiki_headlineimage_recipe, '2013-01-20'

# page stats
set :build, '03-07-2017'
set :images, 77
set :htmlpages, 85
set :links, 677

#
# details under http://www.murraysum.com/blog/2017/02/23/estimating-article-reading-times-with-middleman/?utm_source=blog&utm_medium=twitter
require 'readingtime'

# blog
activate :blog do |blog|
  blog.permalink = '{title}'
  blog.sources = 'posts/{title}.html'
  blog.layout = 'post'
end

# sitemap
set :url_root, 'https://wikimatze.de'
activate :search_engine_sitemap,
         default_priority: 0.5,
         default_change_frequency: 'monthly',
         process_url: ->(url) { url.chomp('/') }

# piwik tracking
activate :piwik do |p|
  p.id = 1
  p.domain = 'wikimatze.de'
  p.url = '/piwik'
end

# for the blog-categories
ready do
  sitemap.resources
         .map { |r| category_array(r.data['categories']) }
         .flatten
         .uniq
         .each do |category|
           if category != 'Uncategorized'
             proxy category_path(category), 'category.html', locals: { category: category }
           end
         end
end

# for the blog-categories (otherwise building will fail)
ignore '/category.html'

# Make heading anchors with custom render
require 'middleman-core/renderers/redcarpet'
class CustomRenderer < Middleman::Renderers::MiddlemanRedcarpetHTML
  def header(text, header_level)
    "<h%s id=\"%s\">%s</h%s>" % [header_level, text.parameterize, text, header_level]
  end
end

# General configuration
set :markdown,
  fenced_code_blocks: true,
  smartypants: true,
  footnotes: true,
  link_attributes: { rel: 'nofollow' },
  tables: true,
  renderer: CustomRenderer

# code syntax and code examples in github style
set :markdown_engine, :redcarpet
activate :syntax

# pretty URLs with no *.html ending
activate :directory_indexes

# Reload the browser automatically whenever files change
configure :development do
  activate :livereload
end

# Build-specific configuration
configure :build do
  # Minify CSS on build
  # activate :minify_css

  # Minify Javascript on build
  # activate :minify_javascript
end
