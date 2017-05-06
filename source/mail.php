<?php
require_once './mail/vendor/autoload.php';

$helperLoader = new SplClassLoader('Helpers', './mail/vendor');
$mailLoader   = new SplClassLoader('SimpleMail', './mail/vendor');

$helperLoader->register();
$mailLoader->register();

use Helpers\Config;
use SimpleMail\SimpleMail;

$config = new Config;
$config->load('./mail/config/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email   = stripslashes(trim($_POST['form-email']));
    $subject = stripslashes(trim($_POST['form-subject']));
    $message = stripslashes(trim($_POST['form-message']));
    $pattern = '/[\r\n]|Content-Type:|Bcc:|Cc:/i';

    if (preg_match($pattern, $email) || preg_match($pattern, $subject)) {
        die("Header injection detected");
    }

    $emailIsValid = filter_var($email, FILTER_VALIDATE_EMAIL);

    if ($email && $emailIsValid && $subject && $message) {
        $mail = new SimpleMail();

        $mail->setTo($config->get('emails.to'));
        $mail->setFrom($config->get('emails.from'));
        $mail->setSenderEmail($email);
        $mail->setSubject($config->get('subject.prefix') . ' ' . $subject);

        $body = "
        <!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
        <html>
            <head>
                <meta charset=\"utf-8\">
            </head>
            <body>
                <h1>{$subject}</h1>
                <p><strong>{$config->get('fields.message')}:</strong> <br>{$message}</p>
            </body>
        </html>";

        $mail->setHtml($body);
        $mail->send();

        $emailSent = true;
    } else {
        $hasError = true;
    }
}
?><!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" name="viewport">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="True" name='HandheldFriendly'>

    <meta content="wikimatze" property="og:site_name">
    <meta content="Writings, and talks by Matthias Günther. Günther works as a developer and agile coach at MyHammer, loves painting Warhammer figures, writing, giving talks, and enjoys making cakes." property="og:description">
    <meta content="https://wikimatze.de" property="og:url">
    <meta content="website" property="og:type">
    <meta content="https://farm1.staticflickr.com/305/30960365443_dc82235ae2_b_d.jpg" property="og:image">

    <meta content="summary" name="twitter:card">
    <meta content="@wikimatze" name="twitter:creator">
    <meta content="@wikimatze" name="twitter:site">
    <meta content="Writings, and talks by Matthias Günther. Günther works as a developer and agile coach at MyHammer, loves painting Warhammer figures, writing, giving talks, and enjoys making cakes." name="twitter:description">
    <meta content="https://wikimatze.de" name="twitter:url">
    <meta content="https://farm1.staticflickr.com/305/30960365443_dc82235ae2_b_d.jpg" name="twitter:image:src">

    <!-- Use title if it's in the page YAML frontmatter -->
    <title>Contact wikimatze - Matthias Günther </title>
    <meta name="description" content="Write me a message and wait for an answer. Sometimes it can be so easy.">

    <link rel="apple-touch-icon" sizes="180x180" href="/images/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="/images/favicons/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/images/favicons/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="/images/favicons/manifest.json">
    <link rel="mask-icon" href="/images/favicons/safari-pinned-tab.svg" >
    <link rel="shortcut icon" href="/images/favicons/favicon.ico">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-TileImage" content="/images/favicons/mstile-144x144.png">
    <meta name="msapplication-config" content="/images/favicons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">

    <link rel="alternate" type="application/rss+xml" title="Blog feed for wikimatze.de" href="https://www.feedio.co/@wikimatze/feed" />
    <link href='//fonts.googleapis.com/css?family=Lato:300,400' rel='stylesheet' type='text/css'>
    <link href="/stylesheets/site.css" rel="stylesheet" type="text/css" />
    <script src="/javascripts/all.js" type="text/javascript"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/anchor-js/3.2.2/anchor.min.js" type="text/javascript"></script>
  </head>

  <body>
    <div class="row">
      <div class="large-12 columns">
        <span id="title">
          <a href="/">wikimatze</a>
        </span>
        <div class="title-bar" data-responsive-toggle="example-menu" data-hide-for="medium">
          <button class="menu-icon" type="button" data-toggle></button>
          <div class="title-bar-title"> Navigation</div>
        </div>

        <div class="top-bar navbar" id="example-menu">
          <div class="top-bar-right" data-hide-for="medium">
            <ul class="menu">
            </ul>
          </div>
          <div class="top-bar-left">
            <ul class=" medium-horizontal vertical dropdown menu" data-responsive-menu="accordion medium-dropdown">
              <li><a href="/articles" title="Overview of latest articles">Articles</a></li>
              <li><a href="/about" title="Some words about me">About</a></li>
              <li><a href="http://eepurl.com/cFwsEP" title="Newsletter sign up link">Newsletter</a></li>
            </ul>
          </div>
          <div class="top-bar-right">
            <ul class=" medium-horizontal vertical dropdown menu" data-responsive-menu="accordion medium-dropdown">
              <li><a href="http://www.feedio.co/@wikimatze" title="Follow my RSS feed" target="_blank"><i class="fa fa-rss"></i></a></li>
              <li><a href="https://twitter.com/wikimatze" title="Follow @wikimatze on twitter" target="_blank"><i class="fa fa-twitter"></i></a></li>
              <li><a href="https://github.com/wikimatze" title="Follow wikimatze on GitHub" target="_blank"><i class="fa fa-github"></i></a></li>
              <!--
              <li><a rel="nofollow" data-open="modal"><i class="fa fa-share"></i></a></li>
              -->
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="large-12 columns content">
        <article>
        <header>
          <h1 class="lead">Contact</h1>
        </header>

      <?php if(!empty($emailSent)): ?>
          <div class="col-md-6 col-md-offset-3">
              <div class="alert alert-success text-center"><?php echo $config->get('messages.success'); ?></div>
          </div>
      <?php else: ?>
          <?php if(!empty($hasError)): ?>
          <div class="col-md-5 col-md-offset-4">
              <div class="alert alert-danger text-center"><?php echo $config->get('messages.error'); ?></div>
          </div>
          <?php endif; ?>

          <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" enctype="application/x-www-form-urlencoded" id="contact-form" class="form-horizontal" method="post">
              <div class="form-group">
                  <label for="form-email" class="col-lg-2 control-label"><?php echo $config->get('fields.email'); ?></label>
                  <div class="col-lg-10">
                      <input type="email" class="form-control" id="form-email" name="form-email" placeholder="<?php echo $config->get('fields.email'); ?>" required>
                  </div>
              </div>
              <div class="form-group">
                  <label for="form-subject" class="col-lg-2 control-label"><?php echo $config->get('fields.subject'); ?></label>
                  <div class="col-lg-10">
                      <input type="text" class="form-control" id="form-subject" name="form-subject" placeholder="<?php echo $config->get('fields.subject'); ?>" required>
                  </div>
              </div>
              <div class="form-group">
                  <label for="form-message" class="col-lg-2 control-label"><?php echo $config->get('fields.message'); ?></label>
                  <div class="col-lg-10">
                      <textarea class="form-control" rows="5" id="form-message" name="form-message" placeholder="<?php echo $config->get('fields.message'); ?>" required></textarea>
                  </div>
              </div>
              <div class="form-group">
                  <div class="col-lg-offset-2 col-lg-10">
                      <button type="submit" class="button large expanded"><?php echo $config->get('fields.btn-send'); ?></button>
                  </div>
              </div>
          </form>
        <?php endif; ?>
        </article>
      </div>
    </div>

    <footer data-hide-for="small">
      <div class="row">
        <div class="large-12 columns">
          <hr>
        </div>
      </div>
      <div class="row">
        <div class="large-12 columns">
          <ul class="menu">
            <li>
              <i class="fa fa-copyright"> Matthias Günther</i>
            </li>
            <li>
              <a href="http://www.feedio.co/@wikimatze" title="Follow my RSS feed" target="_blank"><i class="fa fa-rss"></i></a>
            </li>
            <li>
              <a href="https://twitter.com/wikimatze" title="Follow @wikimatze on twitter" target="_blank"><i class="fa fa-twitter"></i></a>
            </li>
            <li>
              <a href="https://github.com/wikimatze" title="Follow wikimatze on GitHub" target="_blank"><i class="fa fa-github"></i></a>
            </li>
            <li>
              <a href="https://bitbucket.org/wikimatze" title="Follow wikimatze on bitbucket" target="_blank"><i class="fa fa-bitbucket"></i></a>
            </li>
            <!--
            <li>
              <a rel="nofollow" data-open="modal"><i class="fa fa-share"></i></a>
            </li>
            -->
            <li>
              <a href="/reading" title="What I'm reading so far">reading</a>
            </li>
            <li>
              <a href="/projects" title="Projects I'm working on">projects</a>
            </li>
            <li>
              <a rel="nofollow" title="Information who is behind this page" href="/imprint">imprint</a>
            </li>
            <li>
              <a rel="nofollow" title="Contact wikimatze" href="/mail.php">contact</a>
            </li>
            <li>
              <a rel="nofollow" title="The colophon" href="/colophon">colophon</a>
            </li>
          </ul>
        </div>
      </div>
    </footer>

    <script>
       $(document).ready(function() {
         $(document).foundation();
       })
    </script>

    <script type="text/javascript">
      var _paq = _paq || [];
      _paq.push(['trackPageView']);
      _paq.push(['enableLinkTracking']);
      (function() {
      var u=(("https:" == document.location.protocol) ? "https" : "http") + "://wikimatze.de/piwik/";
      _paq.push(['setTrackerUrl', u+'piwik.php']);
      _paq.push(['setSiteId', 1]);
      var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0]; g.type='text/javascript';
      g.defer=true; g.async=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
      })();
    </script>

    <noscript><p><img src="https://wikimatze.de/piwik/piwik.php?idsite=1" style="border:0;" alt="" /></p></noscript>

    <!-- Hotjar Tracking Code for http://wikimatze.de/ -->
    <script>
        (function(h,o,t,j,a,r){
            h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
            h._hjSettings={hjid:370621,hjsv:5};
            a=o.getElementsByTagName('head')[0];
            r=o.createElement('script');r.async=1;
            r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
            a.appendChild(r);
        })(window,document,'//static.hotjar.com/c/hotjar-','.js?sv=');
    </script>

  <script type="text/javascript" src="mail/public/js/contact-form.js"></script>
  <script type="text/javascript">
      new ContactForm('#contact-form');
  </script>
  </body>
</html>
