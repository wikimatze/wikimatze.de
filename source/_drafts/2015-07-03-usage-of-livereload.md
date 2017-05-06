---
title: Usage of livereload
description: Usage of livereload
categories: ,
---

# package.json


```json
{
  "devDependencies": {
    "grunt": "~0.4.5",
    "grunt-concurrent": "^1.0.0",
    "grunt-contrib-connect": "^0.10.1",
    "grunt-contrib-watch": "^0.6.1",
    "time-grunt": "~1.0.0",
    "load-grunt-tasks": "^3.1.0",
    "simple-jekyll-search": "~1.0.2"
  }
}
```

npm install



# Gruntfile


```javascript

module.exports = function (grunt) {
  'use strict';

  require('load-grunt-tasks')(grunt); // auto include grunt vendors
  //Chrome Plugin https://chrome.google.com/webstore/detail/livereload/jnihajbhpnppcggbcgedagnkighmdlei/related

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    concurrent: {
          watcher: {
        tasks: ['watch'],
          },
        template_watcher: {
        tasks: ['watch:files',  'connect:swu_basis:keepalive'],
        options: {
          logConcurrentOutput: true
        }
          },
        },
    connect: {
      swu_basis: {
        options: {
          port: 9003,
          base: {
            path: '_site/',
            options: {
              index: 'index.html'
            }
          }
        }
      }
    },
    watch: {
      files: {
        files: ['_site/**/*.css', '_site/**/*.js', '_site/**/*.html' ],
        tasks: [],
        options: {
          livereload: true
        }
      }
    }
      });
  grunt.registerTask('swu', ['concurrent:template_watcher']);
};
```



# Extensions

http://livereload.com/extensions/
