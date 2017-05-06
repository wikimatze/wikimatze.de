module SiteHelpers
  # Used to check if a link goes to the current page by passing in a nav and
  # subnav string to check against the frontmatter within data.page.
  def current?(nav)
    nav == current_resource.data.nav
  end

  def author
    "Matthias Günther"
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

  def update?
    if current_page.data[:update]
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

  # blog-categories
  def categories(page)
    category_array(page.data[:categories])
  end

  def category_path(category)
    "/category/#{category.parameterize}/index.html"
  end

  def all_categories
    @all_categories ||= Hash[all_categories_unsorted.sort]
  end

  def category_array(categories)
    (categories || "Uncategorized").split(" ")
  end

  private

  def all_categories_unsorted
    Hash.new { [] }.tap do |all_categories|
      blog.articles.each do |article|
        categories(article).each do |ac|
          all_categories[ac] <<= article
        end
      end
    end
  end
end

