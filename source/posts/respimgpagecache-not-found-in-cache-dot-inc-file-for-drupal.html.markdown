---
title: RespImgPageCache not found in cache.inc file for Drupal
date: 2014-06-05
categories: php drupal
---

I'm working with Drupal and [installing a new module](https://drupal.org/documentation/install/modules-themes/modules-7) is probably no problem. After installing the [webform module](https://drupal.org/project/webform) I got the following error on the QA system:


```bash
Fatal error: Class 'RespImgPageCache' not found in /var/www/releases/drupal/releases/20140603132022/includes/cache.inc on line 31
```


I removed the module, and clear the cache with `drush cache-clear` - in the end I still got the error.


After searching for this error I found the solution on a [Drupal thread](https://drupal.org/node/1706596). I inserted
the following snippet in the `cache.inc` file:


```php
<?php
$cache_class_cache_page_old = variable_get('resp_img_cache_class_cache_page_old');
  if (isset($cache_class_cache_page_old)) {
    variable_set('cache_class_cache_page', $cache_class_cache_page_old);
  }
  else {
    variable_del('cache_class_cache_page');
  }
  variable_del('resp_img_cache_class_cache_page_old');
```


After this commit, you have to call some Drupal page where the loading will take a while. After the loading is finished
you still get white pages now you have to remove the code snippet from above in another commit. Now the
`RespImgPageCache` error was gone.


The strange thing was, that the [webform module](https://drupal.org/project/webform) didn't had any dependencies to the
`RespImgPageCache` module. Hopefully, this post will help other developers save a lot of time.

