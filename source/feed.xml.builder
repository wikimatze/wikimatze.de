xml.instruct! :xml, :version => '1.0'
xml.rss :version => '2.0',  'xmlns:atom' => "http://www.w3.org/2005/Atom" do
  xml.channel do
    xml.title 'wikimatze'
    xml.description 'Writings and talks by Matthias Günther.'
    xml.link 'https://wikimatze.de/'
    xml.image 'https://farm1.staticflickr.com/499/30960448893_a37fe6418f_q_d.jpg'
    site_url = 'https://wikimatze.de/'
    blog.articles.each do |article|
      xml.item do
        xml.title article.title
        xml.link URI.join(site_url, article.url)
        xml.description article.body
        xml.pubDate article.date.to_date.rfc822
        xml.guid URI.join(site_url, article.url)
      end
    end
  end
end

