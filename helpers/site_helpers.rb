module SiteHelpers
  # Used to check if a link goes to the current page by passing in a nav and
  # subnav string to check against the frontmatter within data.page.
  def current?(nav)
    nav == current_resource.data.nav
  end

  def current_page_type
    if current_resource.data.nav == 'articles'
      'articles'
    else
      'website'
    end
  end

  def author
    app.config[:author]
  end

  def host_simplegraph
    app.config[:host_simplegraph]
  end

  def twitter_card_creator
    app.config[:twitter_card_creator]
  end

  def host
    app.config[:host]
  end

  def title
    "wikimatze - Matthias Günther "
  end

  def description
    "Writings, and talks by Matthias Günther. Günther works as a developer and agile coach at MyHammer, loves painting Warhammer figures, writing, giving talks, and enjoys making cakes."
  end

  def icke
    "https://farm1.staticflickr.com/305/30960365443_dc82235ae2_b_d.jpg"
  end

  def share_url
    "https://wikimatze.de#{current_page.url}".chomp('/')
  end

  def updated?
    if current_page.data[:updated]
      return true
    end
    return false
  end

  def date?
    if current_page.data[:date]
      return true
    end
    return false
  end

  def share_title
    require 'uri'
    URI.escape(current_page.data.title)
  end

  # link to blog-categories
  def category_path(category)
    "/category/#{category.parameterize}/index.html"
  end
end

