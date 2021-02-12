<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <meta name="description" content="<?= $this->event['description'] ?>">
  <meta name="keywords" content="<?= $this->event['keywords'] ?>">
	
  <!-- FACEBOOK -->
    <meta property="og:title" content="<?= $this->event['title'] ?>" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="<?= base_url() ?>" />
    <meta property="og:image" content="<?= $this->event['image_fb_share'] ?>" />
    <meta property="og:image:type" content="image/jpeg" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />
    <meta property="og:site_name" content="https://www.bangkokpost.com" />
    <meta property="og:description" content="<?= $this->event['description'] ?>" />
    <meta property="fb:app_id" content="476233699157604" />
    <!-- TWIITER -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:creator" content="">
    <meta id="page_tw_og_title" name="twitter:title" content="<?= $this->event['title'] ?>">
    <meta id="page_tw_og_desc" name="twitter:description" content="<?= $this->event['description'] ?>">
    <meta id="page_tw_og_image" name="twitter:image" content="<?= $this->event['image_tw_share'] ?>">
  <!-- HTML5 Shim for IE -->
  <!--[if IE]>
    <script src="<?= $_STATIC_URL ?>assets/js/html5.js<?= $ASSETS_VERSION ?>"></script>
  <![endif]-->
	
<title><?= $this->event['title'] ?></title>

<?php if(isset($_isHome) && $_isHome){ ?>
  <!-- Google Tag Manager -->
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-MLF6WTD');</script>
    <!-- End Google Tag Manager -->
<?php } ?>
	
  <script type="text/javascript" src="<?= $_STATIC_URL ?>assets/js/jquery.min.js<?= $ASSETS_VERSION ?>"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js<?= $ASSETS_VERSION ?>"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js<?= $ASSETS_VERSION ?>"></script>

  <link rel="stylesheet" href="<?= $_STATIC_URL ?>assets/bootstrap/css/bootstrap.css<?= $ASSETS_VERSION ?>">
  <script src="<?= $_STATIC_URL ?>assets/bootstrap/js/bootstrap.min.js<?= $ASSETS_VERSION ?>"></script>
  <link href="<?= $_STATIC_URL ?>assets/fontawesome-5.6.3/css/all.css<?= $ASSETS_VERSION ?>" rel="stylesheet">
  <link href="<?= $_STATIC_URL ?>assets/css/animate.min.css<?= $ASSETS_VERSION ?>" rel="stylesheet">
  	
  <link href="<?= $_STATIC_URL ?>assets/plugins/aos/aos.css<?= $ASSETS_VERSION ?>" rel="stylesheet">
  <script src="<?= $_STATIC_URL ?>assets/plugins/aos/aos.js<?= $ASSETS_VERSION ?>"></script>

  <link href="<?= $_STATIC_URL ?>assets/css/style.css<?= $ASSETS_VERSION ?>" rel="stylesheet" type="text/css">
  <script type="text/javascript" src="<?= $_STATIC_URL ?>assets/js/scripts.js<?= $ASSETS_VERSION ?>"></script>
	
  <?php if(isset($_isHome) && $_isHome){ ?>
  <script>
    console.log('AAA')
    window.history.pushState('<?= $_CURRENT_URL ?>', 'Title', '<?= $_URL ?>');
  </script>
  <script type="text/javascript">
        function popitup(url) {
            newwindow = window.open(url, 'bkp_popup', 'height=500,width=650');
            if (!newwindow) {
                alert('We have detected that you are using popup blocking software...');
            }
            if (window.focus) {
                newwindow.focus()
            }
            return false;
        }
        function share_social(type, url, message) {
            var _url_decode = encodeURI(url);
            var _message_decode = '';
            if (typeof message != 'undefined') {
                _message_decode = encodeURIComponent(message);
            }
            switch (type) {
                case 'facebook':
                
                    popitup('https://www.facebook.com/sharer.php?u=' + _url_decode);
                    break;
                case 'line':
                    popitup('https://social-plugins.line.me/lineit/share?url=' + _url_decode + '&text=' + _message_decode + '&from=boi6');
                    break;
                case 'twitter':
                    popitup('https://twitter.com/share?text=' + _message_decode + '&amp;url=' + _url_decode);
                    break;
                case 'linkedin':
                    popitup('https://www.linkedin.com/sharing/share-offsite/?url=' + _url_decode );
                    break;
            }
        }
    </script>
    <?php } ?>
</head>

<body>
<?php if(isset($_isHome) && $_isHome){ ?>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MLF6WTD"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
  <?php } ?>