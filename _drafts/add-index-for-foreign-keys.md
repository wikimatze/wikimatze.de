---
title: add index for foreign keys
meta-description: ...
published: false
---

If you create models which contains foreign keys[^foreign keys] it is best to `add_index` to the
keys.

## Example

Migration without an index


{% highlight ruby %}

class CreateClans < ActiveRecord::Migration
  def self.up
    create_table "clans" do |t|
      t.string :content
      t.integer :city_id
      t.integer :king_id
    end
  end

  def self.down
    drop_table "clans"
  end
end

{% endhighlight %}


And now with index:


{% highlight ruby %}

class CreateClans < ActiveRecord::Migration
  def self.up
    create_table "clans" do |t|
      t.string :content
      t.integer :city_id
      t.integer :king_id
    end

    add_index :clans, :city_id
    add_index :clans, :king_id
  end

  def self.down
    drop_table "clans"
  end
end

{% endhighlight %}


## Conclusion

Foreigns keys helps you to fasten your sql queries and helps when columns need to be sorted or
rearranged,


## Further reading

[^foreign keys]: [foreign keys](http://en.wikipedia.org/wiki/Foreign_key "foreign keys")

