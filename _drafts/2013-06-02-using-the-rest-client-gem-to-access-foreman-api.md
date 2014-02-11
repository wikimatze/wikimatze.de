---
layout: post
title: Using the Rest-client Gem to Access Foreman Api
description:
---
**

{% highlight ruby %}

require 'rest-client'
require 'json'

def get_hostname(decision, hosts)
  if decision == 'y'
    puts "\nPlease choose the number of the host you want to update:"
    host_number = \$stdin.gets.chomp
    host_name = hosts[host_number.to_i]["host"]["name"]
  else
    puts "The host you want to update is #{ARGV[1]}"
    host_name = ARGV[1]
  end
end

def get_hostgroup_id(decision, client)
  if decision == 'y'
    hostnames = ''
    # Get all available hostgroups to get the availble hosts
    hostgroups = JSON.parse(client['hostgroups'].get).each do |host|
      hostnames << "  Hostname: #{host['hostgroup']['label']} | id: #{host['hostgroup']['id']}\n"
    end

    puts "\nThe available hostnames are:\n #{hostnames}"
    puts "Please specifiy the id you want to have for the host"
    \$stdin.gets.chomp.to_s
  else
    ARGV[2].chomp.to_s
  end
end

def get_client(url, user, password)
  RestClient::Resource.new(url,
                           :user     => user,
                           :password => password,
                           :headers  => { :accept => :json })
end

def print_hostnames(hosts)
  hosts.to_enum.with_index(1).each do |host, index|
    host_name = host["host"]["name"]
    puts "#{index-1}: #{host_name}"
  end
end

def process(decision)
  client = get_client('https://foreman.it.mau.myhammer.net/', 'admin', 'changeme')

  # Get the hostname
  puts "Available hosts:\n"
  hosts = JSON.parse(client['hosts'].get).flatten

  unless decision == 'n'
    print_hostnames(hosts)
  end

  host_name = get_hostname(decision, hosts)
  hostgroup_id = get_hostgroup_id(decision, client)

  # Make the update
  client["hosts/#{host_name}"].put( :host => {"hostgroup_id" => hostgroup_id.to_i})

  puts "Done!"
end

unless ARGV[0].empty?
  decision = ARGV[0].to_s
  if decision == 'y' || decision == 'n'
    process(decision)
  else
    puts %q(Wrong options - you have to take either 'y' or 'n')
  end
end

{% endhighlight %}
## Conclusion


## Further reading

