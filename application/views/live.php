<?php
	$activeTH =" style=\"display:none\" ";
	$activeEN ="";

if(isset($_GET["lang"]) && $_GET["lang"] == "th"){
	$activeTH = "";
	$activeEN =" style=\"display:none\" ";
}

//$embedEN = '<iframe src="https://www.facebook.com/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2Fbangkokpost%2Fvideos%2F382464709132290%2F&show_text=1&width=560" width="560" height="450" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media" allowFullScreen="true"></iframe>'; // v2 

 $embedEN = '<iframe src="https://www.facebook.com/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2Fbangkokpost%2Fvideos%2F130825251909937%2F&show_text=0&width=560" width="100%" class="responsive-iframe" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media" allowFullScreen="true"></iframe>'; // v1

 $embedTH = '<iframe src="https://www.facebook.com/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2FPosttoday%2Fvideos%2F820722792085822%2F&show_text=0&width=560" width="100%"  class="responsive-iframe" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allowFullScreen="true"></iframe>'; // 2 version en th 

//$embedTH = $embedEN; // en only

?>

<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title><?PHP echo $this->event['title']?></title>
	<meta name="description" content="<?PHP echo $this->event['description']?>">
	<meta name="keywords" content="<?PHP echo $this->event['keywords']?>">
	<meta name="author" content="The Bangkokpost PCL.">
	<meta http-equiv="cleartype" content="on">
	<meta name="HandheldFriendly" content="True">

  <link rel="canonical" href="<?= base_url() ?>" />

		<meta name="twitter:card" content="summary_large_image">
		<meta name="twitter:site" content="@bangkokpostnews">
		<meta name="twitter:creator" content="">
		<meta id="page_tw_og_title" name="twitter:title" content="<?= $this->event['title'] ?>">
		<meta id="page_tw_og_desc" name="twitter:description" content="<?= $this->event['description'] ?>">
		<meta id="page_tw_og_image" name="twitter:image" content="<?= $this->event['image_tw_share'] ?>"> 

		<meta property="og:title" content="<?= $this->event['title'] ?>" />
		<meta property="og:type" content="article" />
		<meta property="og:url" content="<?= base_url() ?>live" />
		<meta property="og:image" content="<?= $this->event['image_fb_share'] ?>" />
		<meta property="og:image:type" content="image/jpeg" />
		<meta property="og:site_name" content="https://www.bangkokpost.com" />
		<meta property="og:description" content="<?= $this->event['description'] ?>" />
		<meta property="fb:app_id" content="476233699157604" />

  <!-- Google Tag Manager -->
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-MLF6WTD');</script>
		<!-- End Google Tag Manager -->	

  <!-- HTML5 Shim for IE -->
  <!--[if IE]>
    <script src="assets/js/html5.js"></script>
  <![endif]-->
	
	
  <script type="text/javascript" src="<?PHP echo base_url(); ?>assets/live/js/jquery.min.js"></script>

  <link rel="stylesheet" href="<?PHP echo base_url(); ?>assets/live/bootstrap/css/bootstrap.css">
  <script src="<?PHP echo base_url(); ?>assets/live/bootstrap/js/bootstrap.min.js"></script>
  <link href="<?PHP echo base_url(); ?>assets/live/css/animate.min.css" rel="stylesheet">
  

  <link href="<?PHP echo base_url(); ?>assets/live/css/style.css<?= $this->config->item('asset_version') ?>" rel="stylesheet" type="text/css">
  <script type="text/javascript" src="<?PHP echo base_url(); ?>assets/live/js/scripts.js<?= $this->config->item('asset_version') ?>"></script>
	<style>
    .iframe-container {
    position: relative;
    overflow: hidden;
    width: 100%;
    padding-top: 56.25%; /* 16:9 Aspect Ratio (divide 9 by 16 = 0.5625) */
  }

    .responsive-iframe {
      position: absolute;
      top: 0;
      left: 0;
      bottom: 0;
      right: 0;
      width: 100%;
      height: 100%;
    }

    .invalid-feedback{
      text-align: center;
      font-weight:bold;
    }
  </style>
</head>

<body class="bgCover-live">
  
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MLF6WTD"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->
  <script>console.log('<?= $get_cookie ?>')</script>
<!-- Alert popup -->
<?php 
$popup_show = false; 
$get_cookie = $this->input->cookie($this->cookie_live,true);
 if(isset($_GET['dev']) || !$get_cookie || $get_cookie == 'false' ||  (date("Y-m-d") >= date("2020-09-03") && date("Y-m-d") <= date("2020-09-04")) ){ 
  $popup_show = true;
} 
?>

<!-- popup -->
<div id="popup-before-watch" class="popup-before-watch" style="<?= $popup_show ? '' : 'display:none;' ?>">
	<div>
    <div class="list-logogroup">
      <ul>
        <li><img src="<?= $this->event['base_static'] ?>assets/live/images/logo-bkp.png" alt=""></li>
        <li><img src="<?= $this->event['base_static'] ?>assets/live/images/logo-ptd.png" alt=""></li>
      </ul>
    </div>
    <div class="popup--title">REGISTER NOW TO WATCH<br>THE BANGKOK POST INTERNATIONAL FORUM 2020</div>
    <div class="popup--boxbtn">
      <a href="javascripts:;" id="register--popup" class="popup--btn">REGISTER</a> &nbsp;&nbsp; 
      <a href="javascripts:;" id="login--popup" class="popup--btn" id="close--popup">LOGIN</a>
    </div>
  </div>
</div>

<!-- register popup -->
<div id="register-form" class="popup-before-watch" style="display:none;">
	<div>
  <?=form_open(base_url().'live_register',' class="register" id="registerForm" ')?>
    <div class="list-logogroup">
      <ul>
        <li><img src="<?= $this->event['base_static'] ?>assets/live/images/logo-bkp.png" alt=""></li>
        <li><img src="<?= $this->event['base_static'] ?>assets/live/images/logo-ptd.png" alt=""></a></li>
      </ul>
    </div>
    <div class="popup--title">Register now to watch the<br>Bangkok Post Inter Forum 2020</div>
    <div>
      <input name="firstname" id="firstname-register" type="text" class="popup--input" placeholder="Name:">
      <div id="invalid-register-firstname" class="invalid-feedback" style="display:none;">*Please fill in your first name.</div>
      <input name="lastname" id="lastname-register" type="text" class="popup--input" placeholder="Surname:">
      <div id="invalid-register-lastname"  class="invalid-feedback" style="display:none;">*Please fill in your last name.</div>
      <input name="email" id="email-register" type="text" class="popup--input" placeholder="Email:">
      <div id="invalid-register-email"  class="invalid-feedback" style="display:none;">*Please fill in your active email.</div>
    </div>
    <div class="popup--txt">By subscribing, you accept the terms and conditions in our <a onclick="/*dataLayer.push({'event' : 'GAEvent','eventCategory' : 'Register forum live', 'eventAction' : 'click', 'eventLabel' : 'Click privacy policy'});*/ location.href='/policy/'; " href="javascript:void(0);">privacy policy</a>.</div>
    <div class="popup--boxbtn">
      <!-- <a href="javascripts:;" class="popup--btn">RETURN TO HOMEPAGE</a> -->
      <input name="submit" type="submit" class="popup--btn" id="register-btn" value="REGISTER" >
    </div>
    <div class="popup--link"><a id="no-thank" href="javascript:void(0);">No thanks</a></div>
    <?=form_close()?>
  </div>
  <script>
    function registerCancel(e)
    {
      e.preventDefault();
      $('input').val(''); 
    }
  </script>
</div>

<!-- login popup -->
<div id="login-form" class="popup-before-watch" style="display:none;">
	<div>
  <?=form_open(base_url().'live_login',' class="register" id="loginForm" ')?>
    <div class="list-logogroup">
      <ul>
        <li><img src="<?= $this->event['base_static'] ?>assets/live/images/logo-bkp.png" alt=""></li>
        <li><img src="<?= $this->event['base_static'] ?>assets/live/images/logo-ptd.png" alt=""></a></li>
      </ul>
    </div>
    <div class="popup--title">Login now to watch the<br>Bangkok Post Inter Forum 2020</div>
    <div>
      <input name="email" id="email-login" type="text" class="popup--input" placeholder="Email:">
      <div id="invalid-login-email" class="invalid-feedback" style="display:none;">*Please fill in your active email.</div>
    </div>    <div class="popup--boxbtn">
      <!-- <a href="javascripts:;" class="popup--btn">RETURN TO HOMEPAGE</a> -->
      <input name="submit" type="submit" class="popup--btn" id="login-btn" value="SUBMIT" >
      
    </div>
    <div class="popup--link"><a id="back-to-register" onclick="/*dataLayer.push({'event' : 'GAEvent','eventCategory' : 'Register forum live', 'eventAction' : 'click', 'eventLabel' : 'Click No thanks'});*/ /*location.href='<?= base_url() ?>';*/ " href="javascript:void(0);">Back to register</a></div>
    <?=form_close()?>
  </div>
</div>

<div class="overlay-bg" style="<?= $popup_show ? '' : 'display:none;' ?>"></div>

<?php if($popup_show){ ?>
<script>

  function validateEmail(email) {
      var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
      return emailReg.test( email );
  }
</script>
<?php } ?>
<!-- /popup -->

<section class="section-page">
  <div class="container">
    <div class="row">
    <div class="col-12">
        <div class="list-logogroup">
          <ul>
            <li><a href="https://www.bangkokpost.co.th/" target="_blank"><img src="<?= $this->event['base_static'] ?>assets/images/logo-bkp74.png<?= $this->config->item('asset_version') ?>" alt=""></a></li>
            <li><a href="https://www.bangkokpost.com/" target="_blank"><img src="<?= $this->event['base_static'] ?>assets/images/logo-bkp.png<?= $this->config->item('asset_version') ?>" alt=""></a></li>
            <li><a href="https://www.posttoday.com/" target="_blank"><img src="<?= $this->event['base_static'] ?>assets/images/logo-ptd.png<?= $this->config->item('asset_version') ?>" alt=""></a></li>
          </ul>
        </div>
        <div class="list-logosponser">
          <ul>
            <li><a href="javascript:;"><img src="<?= $this->event['base_static'] ?>assets/images/logo_sponsor/HUAWEI.jpg<?= $this->config->item('asset_version') ?>" class="img-fluid" alt=""></a></li>
            <li><a href="javascript:;"><img src="<?= $this->event['base_static'] ?>assets/images/logo_sponsor/ptted35.jpg<?= $this->config->item('asset_version') ?>" class="img-fluid" alt=""></a></li>
            <li><a href="javascript:;"><img src="<?= $this->event['base_static'] ?>assets/images/logo_sponsor/tencent.jpg<?= $this->config->item('asset_version') ?>" class="img-fluid" alt=""></a></li>
            <li><a href="javascript:;"><img src="<?= $this->event['base_static'] ?>assets/images/logo_sponsor/ngerntidlor.jpg<?= $this->config->item('asset_version') ?>" class="img-fluid" alt=""></a></li>
            <li><a href="javascript:;"><img src="<?= $this->event['base_static'] ?>assets/images/logo_sponsor/kbank.jpg<?= $this->config->item('asset_version') ?>" class="img-fluid" alt=""></a></li>
          </ul>
        </div>
      </div>

      <div class="col-12 col-lg-4">
        <div class="img-live"><img src="<?= $this->event['base_static'] ?>assets/live/images/img-live.png<?= $this->config->item('asset_version') ?>" class="img-fluid" alt=""></div>
      </div>
      <div class="col-12 col-lg-8">

        <div class="tabs-forumlive">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="live-tab" data-toggle="tab" href="#live" role="tab" aria-controls="live" aria-selected="true" onclick="dataLayer.push({'event' : 'GAEvent','eventCategory' : 'Register forum live', 'eventAction' : 'click', 'eventLabel' : 'Click Live Tab'});" ><span class="animate-live"></span> LIVE</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="programe-tab" data-toggle="tab" href="#programe" role="tab" aria-controls="programe" aria-selected="false" onclick="dataLayer.push({'event' : 'GAEvent','eventCategory' : 'Register forum live', 'eventAction' : 'click', 'eventLabel' : 'Click Programme Tab'});">Programme</a>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="live" role="tabpanel" aria-labelledby="live-tab">
              <div>
                <div class="nav-lang lang en" <?php echo $activeEN;?>><span><u>EN</u></span> | <a href="javascript:void(0);" onclick="dataLayer.push({'event' : 'GAEvent','eventCategory' : 'Register forum live', 'eventAction' : 'click', 'eventLabel' : 'Click TH Language'});">TH</a></div>
                <div class="nav-lang lang th" <?php echo $activeTH;?>><a href="javascript:void(0);" onclick="dataLayer.push({'event' : 'GAEvent','eventCategory' : 'Register forum live', 'eventAction' : 'click', 'eventLabel' : 'Click EN Language'});">EN</a> | <span><u>TH</u></span></div>
                <div>
                  <?php if(isset($_GET['dev'])){ ?>
                  <!--FACEBOOK LIVE DISABLED-->
                  
                  <img src="<?= $this->event['base_static'] ?>assets/live/images/text_live_bp.jpg<?= $this->config->item('asset_version') ?>" class="img-fluid" alt="">
                  <?php }else{ ?>

                  <!-- FACEBOOK LIVE VIDEO -->
                  
                  <div id="iframe-en" class="iframe-container" <?php echo $activeEN;?>> 
                      <?php echo $embedEN; ?>
                  </div>
                  <div id="iframe-th" class="iframe-container" <?php echo $activeTH;?> >
                      <?php echo $embedTH; ?>
                  </div>
                  <?php } ?>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="programe" role="tabpanel" aria-labelledby="programe-tab">
            <div class="div-programe">
                <ul>
                  <li><span>12.30 - 13.20</span> <span>Registration</span></li>
                  <li><span>13.20 - 13.30</span> <span>Welcome Speech by<br>
                    Worachai Bhicharnchitr, Vice Chairman, Bangkok Post Public Company Limited</span></li>
                  <li><span>13.30 - 14.30</span> <span>Keynote speaker:<br>
                    H.E. Arkom Termpittayapaisith, Minister of Finance</span></li>
                  <li><span>14.30 - 14.45</span> <span>Keynote speaker:<br>
                    Sen. Ladda Tammy Duckworth, U.S. Senator (Video address)</span></li>
                  <li><span>14.45 - 16.00</span> <span>Panel discussion:<br>
                    Beyond the Crisis: How companies will adapt for the new era<br><br>
                    Panelists:<br>
                    • Aloke Lohia;, Group Chief Executive Officer, Indorama Ventures<br>
                    • Dr Boon Vanasin, Chairman, Thonburi Healthcare Group (THG)<br>
                    • Harald Link, Chairman, B. Grimm <br>
                    • Michael MacDonald, Chief Digital Officer, Huawei Southeast Asia<br>
                    • Suphajee Suthumpun, Group Chief Executive Officer, Dusit Thani Pcl.<br><br>
                    Moderator: Varin Sachdev, News Anchor
                  </span></li>
                  <li><span>16.00 - 16.15</span> <span>Coffee break</span></li>
                  <li><span>16.15 - 17.30</span> <span>Panel discussion:<br>
                    A New Path Forward: Building a digital future<br><br>
                    Panelists:<br>
                    • Chang Foo, Chief Operating Officer, Tencent Thailand<br>
                    • Jack Zhang, Chief Executive Officer, LAZADA Thailand<br>
                    • Dr Joshua Pas, Managing Director and Investment Committee, AddVentures Capital by SCG<br>
                    • Pinya Nittayakasetwat, Chief Executive Officer, Gojek Thailand<br>
                    • Ruangroj Poonpol, Chairman, KASIKORN Business-Technology Group (KBTG)<br><br>
                    Moderator: Varin Sachdev, News Anchor
                  </span></li>
                </ul>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>


<script type="text/javascript">
$(document).ready(function() { 
    //--- popup
    var $docEl = $('html, body'),
    scrollTop;

    var overlayClose = function() {
      $docEl.css({
        height: "",
        overflow: ""
      });

      window.scrollTo(0, scrollTop);
      window.setTimeout(function () {
        scrollTop = null;
      }, 0);
    }
    

   $('#login--popup').click(function(e) {
    $('#login-form').show();
    $('#register-form').hide();
    $('#popup-before-watch').hide();
      e.preventDefault();
    });

    $('#register--popup').click(function(e) {
      $('#register-form').show();
      $('#login-form').hide();
      $('#popup-before-watch').hide();
      e.preventDefault();
    });

  var overlayOpen = function() {
    if(window.pageYOffset) {
      scrollTop = window.pageYOffset;
    }

    $docEl.css({
      height: "100%",
      overflow: "hidden"
    });
  }

  <?php if($popup_show){ ?>
    overlayOpen();
  <?php }else{ ?>
    overlayClose();
  <?php } ?>
//-- /popup

  //Login Form
  $('#login-btn').click(function (evt) {

  var _is_validated = true;

  evt.preventDefault();

  var enews_email = $('#email-login').val();

  if (!isEmail(enews_email)) {
    console.log('aaa'+enews_email)
    $('#invalid-login-email').text('*Please fill in your active email.');
    $('#invalid-login-email').show();
    _is_validated = false;
  }

    if (_is_validated) {
      var _url_action = "<?= base_url() ?>live_login";
      console.log(enews_email);
      $.post(_url_action, {
        xEmail: enews_email
      }).done(function (data) {
        if (data == 1) {
          // console.log('อีเมลไม่ซ้ำ');
          $('#invalid-login-email').text('Please register before you start watching.');
          $('#invalid-login-email').show();
        } else if (data == 2) {
          console.log('อีเมลซ้ำ');
          $('#register-form').hide();
          $('#login-form').hide();
          $('#popup-before-watch').hide();
          $('.overlay-bg').hide();
          overlayClose();
          document.cookie = "video_live_register=1; expires=60*60*24*1; path=/";
        }
        
      }).fail(function (xhr, status, error) {
        // console.log("err some thing!");
        $('#invalid-login-email').text('*Please fill in your email.');
        $('#invalid-login-email').show();
      });
    }
  });

  $('#back-to-register').click(function()
  {
    $('#register-form').show();
    $('#login-form').hide();
    $('.invalid-feedback').text('');
    $('.invalid-feedback').hide();
    $('input[type="text"]').val('');
  });


  //Register Form
  $('#register-btn').click(function (evt) {

    var _is_validated = true;

    evt.preventDefault();

    var enews_email = $('#email-register').val();

    if(!$('#firstname-register').val())
    {
      $('#invalid-register-firstname').show();
      _is_validated = false;
    }else{
      $('#invalid-register-firstname').hide();
      _is_validated = true;
    }

    if(!$('#lastname-register').val())
    {
      $('#invalid-register-lastname').show();
      _is_validated = false;
    }else{
      $('#invalid-register-lastname').hide();
      _is_validated = true;
    }

    if (!isEmail(enews_email)) {
      $('#invalid-register-email').show();
      _is_validated = false;
    }else{
      $('#invalid-register-email').hide();
      _is_validated = true;
    }

    if (_is_validated) {
      var _url_action = "<?= base_url() ?>live_register";
      $.post(_url_action, {
        xFirstname: $('#firstname-register').val(),
        xLastname: $('#lastname-register').val(),
        xEmail: enews_email
      }).done(function (data) {
        if (data == 1) {
          // console.log('อีเมลไม่ซ้ำ');
          $('#register-form').hide();
          $('#login-form').hide();
          $('#popup-before-watch').hide();
          $('.overlay-bg').hide();
          document.cookie = "video_live_register=1; expires=60*60*24*1; path=/"; 

        } else if (data == 2) {
          // console.log('อีเมลซ้ำ');
          $('#invalid-register-email').text('This email has been used. Please use another email. ');
          $('#invalid-register-email').show();
        }
        
      }).fail(function (xhr, status, error) {
        console.log('status - '+status);
        console.log("err some thing!");
        $('#invalid-register-firstname').text('*Please fill in your first name.');
        $('#invalid-register-firstname').show();
        $('#invalid-register-lastname').text('*Please fill in your last name.');
        $('#invalid-register-lastname').show();
        $('#invalid-register-email').text('*Please fill in your email.');
        $('#invalid-register-email').show();
      });
    }
  });

  $('#no-thank').click(function()
  {
      $('#register-form').hide();
      $('#login-form').hide();
      $('#popup-before-watch').show();
      $('.invalid-feedback').text('');
      $('.invalid-feedback').hide();
      $('input[type="text"]').val('');
  });

});

function isEmail(email) {
		var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		return regex.test(email);
	}
</script>


<!-- Facebook Live -->
<script type="text/javascript">
		$.get( "https://graph.facebook.com/v2.12/?id=https%3A%2F%2Fwww.bangkokpost.com%2Fevents%bangkokpostforum%2Fasia2020&fields=og_object{engagement}&access_token=476233699157604|45908d15efbbdf717699987f3f1968b9", function( data ) {
		  
		  var count_fb = 0;
          if(data.og_object ){
          var count_fb = data.og_object.engagement.count;
          }
		  if (!$.isNumeric(count_fb)) {
			  count_fb = 0;
		  }
		  $('#facebook_share_count_top').html(abbreviate_number(count_fb));
		});
		
		function abbreviate_number(num) {
			var sizes = ['', 'K', 'M', 'G', 'T', 'P', 'E', 'Z', 'Y'];
			if (num < 1000) return num;
			var i = parseInt(Math.floor(Math.log(num) / Math.log(1000)));
			return ((i == 0) ? (num / Math.pow(1000, i)) : (num / Math.pow(1000, i)).toFixed(1)) + '' + sizes[i]; // use .round() in place of .toFixed if you don't want the decimal
		};
		
		
		
 		$('.lang.en').click(function(event){
			$('.lang.th').show();
			$('.lang.en').hide();
			$('#iframe-th').show();
			$('#iframe-en').hide();
			
			$('#iframe-th').html('<?php echo $embedTH; ?>');
			$('#iframe-en').html('');
			
			// console.log('TH lang');
			
		});
		
		$('.lang.th').click(function(event){
			$('.lang.en').show();
			$('.lang.th').hide();
			$('#iframe-en').show();
			$('#iframe-th').hide();
			
			$('#iframe-en').html('<?php echo $embedEN; ?>');
			$('#iframe-th').html('');
			event.preventDefault();
			
			// console.log('EN lang');
			
		});

	</script>
</body>
</html>
