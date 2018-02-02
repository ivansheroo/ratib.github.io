<?php
function ValidateEmail($email)
{
   $pattern = '/^([0-9a-z]([-.\w]*[0-9a-z])*@(([0-9a-z])+([-\w]*[0-9a-z])*\.)+[a-z]{2,6})$/i';
   return preg_match($pattern, $email);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['formid']) && $_POST['formid'] == 'form1')
{
   $mailto = '';
   $mailfrom = isset($_POST['email']) ? $_POST['email'] : $mailto;
   ini_set('sendmail_from', $mailfrom);
   $subject = '';
   $message = 'هذا البريد تمت استبلامه من الموقع  ratib film 

هذه البريد يتضمن رسائل الزبون';
   $success_url = './succ.html';
   $error_url = './index.php';
   $error = '';
   $mysql_server = 'localhost';
   $mysql_database = 'id3975264_msg';
   $mysql_table = 'msn';
   $mysql_username = 'id3975264_ivanshero';
   $mysql_password = 'ivanshero1995ivo995';
   $eol = "\n";
   $boundary = md5(uniqid(time()));

   $header  = 'From: '.$mailfrom.$eol;
   $header .= 'Reply-To: '.$mailfrom.$eol;
   $header .= 'MIME-Version: 1.0'.$eol;
   $header .= 'Content-Type: multipart/mixed; boundary="'.$boundary.'"'.$eol;
   $header .= 'X-Mailer: PHP v'.phpversion().$eol;
   if (!empty($error))
   {
      $errorcode = file_get_contents($error_url);
      $replace = "##error##";
      $errorcode = str_replace($replace, $error, $errorcode);
      echo $errorcode;
      exit;
   }

   $internalfields = array ("submit", "reset", "send", "filesize", "formid", "captcha_code", "recaptcha_challenge_field", "recaptcha_response_field", "g-recaptcha-response");
   $message .= $eol;
   $message .= "IP Address : ";
   $message .= $_SERVER['REMOTE_ADDR'];
   $message .= $eol;
   $logdata = '';
   foreach ($_POST as $key => $value)
   {
      if (!in_array(strtolower($key), $internalfields))
      {
         if (!is_array($value))
         {
            $message .= ucwords(str_replace("_", " ", $key)) . " : " . $value . $eol;
         }
         else
         {
            $message .= ucwords(str_replace("_", " ", $key)) . " : " . implode(",", $value) . $eol;
         }
      }
   }
   $body  = 'This is a multi-part message in MIME format.'.$eol.$eol;
   $body .= '--'.$boundary.$eol;
   $body .= 'Content-Type: text/plain; charset=ISO-8859-1'.$eol;
   $body .= 'Content-Transfer-Encoding: 8bit'.$eol;
   $body .= $eol.stripslashes($message).$eol;
   if (!empty($_FILES))
   {
       foreach ($_FILES as $key => $value)
       {
          if ($_FILES[$key]['error'] == 0)
          {
             $body .= '--'.$boundary.$eol;
             $body .= 'Content-Type: '.$_FILES[$key]['type'].'; name='.$_FILES[$key]['name'].$eol;
             $body .= 'Content-Transfer-Encoding: base64'.$eol;
             $body .= 'Content-Disposition: attachment; filename='.$_FILES[$key]['name'].$eol;
             $body .= $eol.chunk_split(base64_encode(file_get_contents($_FILES[$key]['tmp_name']))).$eol;
          }
      }
   }
   $body .= '--'.$boundary.'--'.$eol;
   if ($mailto != '')
   {
      mail("{$mailto} <{$mailto}>", $subject, $body, $header, '-f'.$mailfrom);
   }
   $search = array("ä", "Ä", "ö", "Ö", "ü", "Ü", "ß", "!", "§", "$", "%", "&", "/", "\x00", "^", "°", "\x1a", "-", "\"", " ", "\\", "\0", "\x0B", "\t", "\n", "\r", "(", ")", "=", "?", "`", "*", "'", ":", ";", ">", "<", "{", "}", "[", "]", "~", "²", "³", "~", "µ", "@", "|", "<", "+", "#", ".", "´", "+", ",");
   $replace = array("ae", "Ae", "oe", "Oe", "ue", "Ue", "ss");
   foreach($_POST as $name=>$value)
   {
      $name = str_replace($search, $replace, $name);
      $name = strtoupper($name);
      $form_data[$name] = $value;
   }
   $db = mysqli_connect($mysql_server, $mysql_username, $mysql_password) or die('Failed to connect to database server!<br>'.mysqli_error($db));
   mysqli_query($db, "CREATE DATABASE IF NOT EXISTS $mysql_database");
   mysqli_select_db($db, $mysql_database) or die('Failed to select database<br>'.mysqli_error($db));
   mysqli_query($db, "CREATE TABLE IF NOT EXISTS $mysql_table (ID int(9) NOT NULL auto_increment, `DATESTAMP` DATE, `TIME` VARCHAR(8), `IP` VARCHAR(15), `BROWSER` TINYTEXT, PRIMARY KEY (id))");
   foreach($form_data as $name=>$value)
   {
      mysqli_query($db ,"ALTER TABLE $mysql_table ADD $name VARCHAR(255)");
   }
   mysqli_query($db, "INSERT INTO $mysql_table (`DATESTAMP`, `TIME`, `IP`, `BROWSER`)
                VALUES ('".date("Y-m-d")."',
                '".date("G:i:s")."',
                '".$_SERVER['REMOTE_ADDR']."',
                '".$_SERVER['HTTP_USER_AGENT']."')")or die('Failed to insert data into table!<br>'.mysqli_error($db)); 
   $id = mysqli_insert_id($db);
   foreach($form_data as $name=>$value)
   {
      mysqli_query($db, "UPDATE $mysql_table SET $name='".mysqli_real_escape_string($db, $value)."' WHERE ID=$id") or die('Failed to update table!<br>'.mysqli_error($db));
   }
   mysqli_close($db);
   header('Location: '.$success_url);
   exit;
}
?>
<!doctype html>
<html <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/ar_AR/sdk.js#xfbml=1&version=v2.11&appId=309179826244688&autoLogAppEvents=1';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>>
<head>
<meta charset="utf-8">
<title>Ratib-Film</title>
<meta name="author" content="Ratib Film">
<meta name="robots" content="index, follow">
<meta name="revisit-after" content="365 days">
<meta property="og:title" content="Ratib Film">
<meta property="og:description" content="تصوير احترافي للحفلات والاغاني والاعراس">
<meta property="og:type" content="video.movie">
<meta property="og:image" content="www.s-eivi.com/ratib/images/Screenshot_12.png">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="dfdfsPSD.png" rel="shortcut icon" type="image/x-icon">
<link href="dfdfsPSD.png" rel="apple-touch-icon" sizes="838x804">
<link href="Ratip.css" rel="stylesheet">
<link href="index.css" rel="stylesheet">
<script src="jquery-1.12.4.min.js"></script>
<script src="https://www.youtube.com/iframe_api"></script>
<script>
var playerYouTube1;
var playerYouTube4;
var playerYouTube5;
var playerYouTube6;
var playerYouTube7;
var playerYouTube8;
var playerYouTube9;
var playerYouTube10;
var playerYouTube11;
var playerYouTube12;
function onYouTubeIframeAPIReady() {
   playerYouTube1 = new YT.Player('YouTube1', {
      events: {
      }
   });
   playerYouTube4 = new YT.Player('YouTube4', {
      events: {
      }
   });
   playerYouTube5 = new YT.Player('YouTube5', {
      events: {
      }
   });
   playerYouTube6 = new YT.Player('YouTube6', {
      events: {
      }
   });
   playerYouTube7 = new YT.Player('YouTube7', {
      events: {
      }
   });
   playerYouTube8 = new YT.Player('YouTube8', {
      events: {
      }
   });
   playerYouTube9 = new YT.Player('YouTube9', {
      events: {
      }
   });
   playerYouTube10 = new YT.Player('YouTube10', {
      events: {
      }
   });
   playerYouTube11 = new YT.Player('YouTube11', {
      events: {
      }
   });
   playerYouTube12 = new YT.Player('YouTube12', {
      events: {
      }
   });
}
</script>
<script src="magnificpopup/jquery.magnific-popup.min.js"></script>
<link rel="stylesheet" href="magnificpopup/magnific-popup.css">
<link rel="alternate" type="application/rss+xml" title="RSS Feed" href="rss.xml">
<script src="pace/pace.min.js"></script>
<link href="pace/pace-theme-loading-bar.css" rel="stylesheet" />
<script src="wwb12.min.js"></script>
<script>
function displaylightbox(url, options)
{
   options.items = { src: url };
   options.type = 'iframe';
   $.magnificPopup.open(options);
}
</script>
<script>
$(document).ready(function()
{
   function PanelText1Scroll()
   {
      var $obj = $("#wb_PanelText1");
      if (!$obj.hasClass("in-viewport") && $obj.inViewPort(true))
      {
         $obj.addClass("in-viewport");
         AnimateCss('wb_PanelText1', 'animate-fade-in-up', 500, 1000);
      }
      else
      if ($obj.hasClass("in-viewport") && !$obj.inViewPort(true))
      {
         $obj.removeClass("in-viewport");
         AnimateCss('wb_PanelText1', 'animate-fade-out', 0, 0);
      }
   }
   if (!$('#wb_PanelText1').inViewPort(true))
   {
      $('#wb_PanelText1').addClass("in-viewport");
   }
   PanelText1Scroll();
   $(window).scroll(function(event)
   {
      PanelText1Scroll();
   });
   function PanelText2Scroll()
   {
      var $obj = $("#wb_PanelText2");
      if (!$obj.hasClass("in-viewport") && $obj.inViewPort(true))
      {
         $obj.addClass("in-viewport");
         AnimateCss('wb_PanelText2', 'animate-fade-in-up', 500, 1000);
      }
      else
      if ($obj.hasClass("in-viewport") && !$obj.inViewPort(true))
      {
         $obj.removeClass("in-viewport");
         AnimateCss('wb_PanelText2', 'animate-fade-out', 0, 0);
      }
   }
   if (!$('#wb_PanelText2').inViewPort(true))
   {
      $('#wb_PanelText2').addClass("in-viewport");
   }
   PanelText2Scroll();
   $(window).scroll(function(event)
   {
      PanelText2Scroll();
   });
   function PanelText3Scroll()
   {
      var $obj = $("#wb_PanelText3");
      if (!$obj.hasClass("in-viewport") && $obj.inViewPort(true))
      {
         $obj.addClass("in-viewport");
         AnimateCss('wb_PanelText3', 'animate-fade-in-up', 500, 1000);
      }
      else
      if ($obj.hasClass("in-viewport") && !$obj.inViewPort(true))
      {
         $obj.removeClass("in-viewport");
         AnimateCss('wb_PanelText3', 'animate-fade-out', 0, 0);
      }
   }
   if (!$('#wb_PanelText3').inViewPort(true))
   {
      $('#wb_PanelText3').addClass("in-viewport");
   }
   PanelText3Scroll();
   $(window).scroll(function(event)
   {
      PanelText3Scroll();
   });
   $("a[href*='#LayoutGrid2']").click(function(event)
   {
      event.preventDefault();
      $('html, body').stop().animate({ scrollTop: $('#wb_LayoutGrid2').offset().top }, 600, 'linear');
   });
   function LayoutGrid2Scroll()
   {
      var $obj = $("#wb_LayoutGrid2");
      if (!$obj.hasClass("in-viewport") && $obj.inViewPort(false))
      {
         $obj.addClass("in-viewport");
         AnimationResume('FontAwesomeIcon1');
         AnimationResume('FontAwesomeIcon2');
         AnimationResume('FontAwesomeIcon3');
         AnimationResume('FontAwesomeIcon4');
         AnimationResume('wb_Heading1');
         AnimationResume('wb_Heading2');
         AnimationResume('wb_Heading3');
         AnimationResume('wb_Heading4');
         AnimationResume('wb_Text1');
         AnimationResume('wb_Text2');
         AnimationResume('wb_Text3');
         AnimationResume('wb_Text4');
      }
   }
   LayoutGrid2Scroll();
   $(window).scroll(function(event)
   {
      LayoutGrid2Scroll();
   });
   function LayoutGrid3Scroll()
   {
      var $obj = $("#wb_LayoutGrid3");
      if (!$obj.hasClass("in-viewport") && $obj.inViewPort(false))
      {
         $obj.addClass("in-viewport");
         AnimationResume('FontAwesomeIcon1');
         AnimationResume('FontAwesomeIcon2');
         AnimationResume('FontAwesomeIcon3');
         AnimationResume('FontAwesomeIcon4');
         AnimationResume('wb_Heading1');
         AnimationResume('wb_Heading2');
         AnimationResume('wb_Heading3');
         AnimationResume('wb_Heading4');
         AnimationResume('wb_Text1');
         AnimationResume('wb_Text2');
         AnimationResume('wb_Text3');
         AnimationResume('wb_Text4');
      }
   }
   LayoutGrid3Scroll();
   $(window).scroll(function(event)
   {
      LayoutGrid3Scroll();
   });
});
</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-111189569-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-111189569-1');
</script>


 
 <script>// <![CDATA[  
                             
  redirectTime = "1";
 redirectURL = "http://www.s-eivi.com/mob";
     var mobile = (/iphone|ipad|ipod|android|blackberry|mini|windows\sce|palm/i.test(navigator.userAgent.toLowerCase()));  
     if (mobile) {  
  setTimeout("location.href = redirectURL;",redirectTime);
     } else{
  
     document.write('   ');
     }
 // ]]></script> 

<script src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script src="gmaps.js"></script>
<script>
$('#map').prepend('<div id="map-inner" style="position:absolute;left:0;top:0;width:100%;height:100%"></div>');

var map = new GMaps({
   el: '#map-inner',
   lat: 40.770401,
   lng: -73.967635
});

map.addMarker({
  lat: 40.7699459,
  lng: -73.9735114,
  title: 'Central Park',
  click: function(e) 
  {
    alert('You clicked in this marker');
  }
});
</script>
</head>
<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/ar_AR/sdk.js#xfbml=1&version=v2.12&appId=309179826244688&autoLogAppEvents=1';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div id="PageHeader1" style="position:fixed;text-align:right;left:0;top:0;right:0;height:32px;z-index:89;">
<div id="PageHeader1_Container" style="width:1322px;position:relative;margin-left:auto;margin-right:0;text-align:left;">
<input type="submit" id="Button28" name="" value="للتواصل معنا انتقل الى الاسفل" style="position:absolute;left:692px;top:7px;width:179px;height:25px;z-index:0;" disabled>
<div id="wb_Text16" style="position:absolute;left:71px;top:8px;width:136px;height:23px;z-index:1;" onclick="window.location.href='./mob/index.php';return false;">
<span style="color:#FFFFFF;font-family:'Comic Sans MS';font-size:16px;">Ratib-film</span></div>
<div id="wb_ClipArt1" style="position:absolute;left:22px;top:13px;width:12px;height:12px;z-index:2;">
<img src="images/img0001.png" id="ClipArt1" alt="" style="width:12px;height:12px;"></div>
<div id="wb_ClipArt2" style="position:absolute;left:7px;top:7px;width:43px;height:25px;filter:alpha(opacity=80);opacity:0.80;z-index:3;">
<img src="images/img0004.gif" id="ClipArt2" alt="" style="width:43px;height:25px;"></div>
<div id="Html4" style="position:absolute;left:1118px;top:6px;width:152px;height:21px;z-index:4">
<script src="https://apis.google.com/js/platform.js"></script>

<div class="g-ytsubscribe" data-channelid="UCww5mfjXRFXYOWy0ACjRwwA" data-layout="default" data-count="default"></div></div>
<div id="Html2" style="position:absolute;left:923px;top:6px;width:152px;height:21px;z-index:5">
<div class="fb-like" data-href="https://www.facebook.com/Ratib-film-1697201330552577/?hc_ref=ARRicMqJp4ZeijeexIc_8ZjUqt3KqtDmrlQ-WUarlWOULm9Fdukx7tOxPQJQvyWH4uU&amp;pnref=story" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div></div>
<input type="submit" id="Button30" onclick="window.location.href='https://www.facebook.com/Ratib-film-1697201330552577/';return false;" name="" value="صفحتنا على الفيسبوك" style="position:absolute;left:419px;top:7px;width:147px;height:25px;z-index:6;">
<input type="submit" id="Button3" onclick="window.location.href='https://www.youtube.com/channel/UCww5mfjXRFXYOWy0ACjRwwA/featured';return false;" name="" value="قناتنا على اليوتيوب" style="position:absolute;left:577px;top:7px;width:96px;height:25px;z-index:7;">
<a href="rss.xml"><img id="RssFeed1" src="images/rss.png" alt="RSS Feed" style="position:absolute;left:195px;top:12px;z-index:8;"></a>
</div>
</div>
<div id="FlexBoxContainer1">
</div>

<div id="socialmedia_sticky" style="position:fixed;text-align:left;left:auto;right:-128px;top:80px;width:162px;height:153px;z-index:77;" title="Social Media Sticky">
<a href="https://www.youtube.com/channel/UCww5mfjXRFXYOWy0ACjRwwA/featured"><img src="images/img0003.png" id="socialmedia_youtube" alt="" title="" style="border-width:0;position:absolute;left:0px;top:91px;width:150px;height:45px;z-index:9"></a>
<a href="javascript:displaylightbox('https://www.facebook.com/Ratib-film-1697201330552577/',{})" target="_self"><img src="images/img0005.png" id="socialmedia_facebook" alt="" title="" style="border-width:0;position:absolute;left:0px;top:1px;width:150px;height:45px;z-index:10"></a>
<a href="#"><img src="images/img0006.png" id="socialmedia_rss" alt="" title="" style="border-width:0;position:absolute;left:0px;top:46px;width:150px;height:45px;z-index:11" onclick="window.open('https://www.youtube.com/channel/UCww5mfjXRFXYOWy0ACjRwwA/featured');return false;"></a>
</div>
<div id="FlexBoxContainer2">
<div id="FlexBoxContainer6">
<div id="wb_YouTube2" style="display:inline-block;width:1058px;height:595px;z-index:12;">
<iframe id="YouTube2" src="https://www.youtube.com/embed/9h_IqNS8gjE?rel=0&amp;loop=1&amp;playlist=9h_IqNS8gjE&amp;autoplay=1&amp;modestbranding=1&amp;showinfo=0&amp;controls=0&amp;ap=%2526fmt%3D18&amp;autohide=1"></iframe>
</div>
</div>
</div>
<div id="wb_LayoutGrid1">
<div id="LayoutGrid1">
<div class="row">
<div class="col-1">
<div id="wb_YouTube1" style="display:inline-block;width:100%;z-index:14;">
<iframe id="YouTube1" src="https://www.youtube.com/embed/4DN8gsYEXuA?rel=0&amp;showinfo=0&amp;enablejsapi=1&amp;ap=%2526fmt%3D18&amp;autohide=1"></iframe>
</div>
<div id="wb_PanelText1">
<span style="color:#000000;font-family:Arial;font-size:24px;"><strong>ji ber hisnata<br></strong></span><span style="color:#000000;font-family:Arial;font-size:11px;"><strong><br></strong></span><span style="color:#0000FF;font-family:'Trebuchet MS';font-size:17px;"><strong>Ratib Şêxmûs</strong></span><span style="color:#BC8F8F;font-family:Arial;font-size:15px;"><strong><br></strong></span><span style="color:#000000;font-family:Arial;font-size:15px;"><br><br>غناء : راتب شيخموس <br>تصوير : فريق راتب للتصوير<br>داخل الاستوديو <br>احد الاعمال الخاصة بالفريق </span>
</div>
</div>
<div class="col-2">
<div id="wb_YouTube4" style="display:inline-block;width:100%;z-index:16;">
<iframe id="YouTube4" src="https://www.youtube.com/embed/YQeYdLKR40s?rel=0&amp;showinfo=0&amp;enablejsapi=1&amp;ap=%2526fmt%3D18&amp;autohide=1"></iframe>
</div>
<div id="wb_PanelText3">
<span style="color:#000000;font-family:Arial;font-size:24px;"><strong>Bella caw</strong></span><span style="color:#000000;font-family:Arial;font-size:11px;"><strong><br><br></strong></span><span style="color:#0000FF;font-family:'Trebuchet MS';font-size:17px;"><strong>Ratib Şêxmûs<br></strong></span><span style="color:#5B7B9D;font-family:Arial;font-size:15px;"><strong><br><br></strong></span><span style="color:#000000;font-family:Arial;font-size:15px;">غناء : راتب شيخموس <br>تصوير : فريق راتب للتصوير<br>داخل الاستوديو <br>احد الاعمال الخاصة بالفريق </span>
</div>
</div>
<div class="col-3">
<div id="wb_YouTube3" style="display:inline-block;width:100%;z-index:18;">
<iframe id="YouTube3" src="https://www.youtube.com/embed/cJxRStw_2qA?rel=0&amp;ap=%2526fmt%3D18&amp;autohide=1"></iframe>
</div>
<div id="wb_PanelText2">
<span style="color:#000000;font-family:Arial;font-size:24px;"><strong>Dîtinata </strong></span><span style="color:#000000;font-family:Arial;font-size:21px;"><strong><br></strong></span><span style="color:#000000;font-family:Arial;font-size:11px;"><strong><br></strong></span><span style="color:#0000FF;font-family:'Trebuchet MS';font-size:17px;"><strong>Ratib Şêxmûs</strong></span><span style="color:#5B7B9D;font-family:Arial;font-size:15px;"><strong><br><br><br></strong></span><span style="color:#000000;font-family:Arial;font-size:15px;">غناء : راتب شيخموس <br>تصوير : فريق راتب للتصوير<br>داخل الاستوديو <br>احد الاعمال الخاصة بالفريق </span>
</div>
</div>
</div>
</div>
</div>
<div id="FlexBoxContainer3">
<div id="wb_ClipArt9" style="display:inline-block;width:59px;height:69px;z-index:20;position:relative;">
<img src="images/img0013.png" id="ClipArt9" alt="" style="width:59px;height:69px;">
</div>
</div>
<div id="wb_LayoutGrid2">
<div id="LayoutGrid2">
<div class="row">
<div class="col-1">
<div id="wb_YouTube5" style="display:inline-block;width:100%;z-index:21;">
<iframe id="YouTube5" src="https://www.youtube.com/embed/GFIob72iOTw?rel=0&amp;showinfo=0&amp;enablejsapi=1&amp;ap=%2526fmt%3D18&amp;autohide=1"></iframe>
</div>
<div id="wb_Heading5" style="display:inline-block;width:100%;text-align:center;z-index:22;">
<h1 id="Heading5">Mesûd û Sedar</h1>
</div>
<div id="wb_Text7">
<span style="color:#000000;font-family:Arial;font-size:15px;"><br>Raman Darî Şêxanî<br><br>Film : Ratip Film<br><br>للمشاهدى على اليوتيوب</span>
</div>
<div id="wb_Shape1" style="display:inline-block;width:125px;height:36px;z-index:24;position:relative;">
<a href="https://www.youtube.com/watch?v=GFIob72iOTw" target="_blank"><div id="Shape1"><div id="Shape1_text"><span style="color:#FFFFFF;font-family:Arial;font-size:12px;">شاهدها على اليوتيوب</span></div></div></a>
</div>
</div>
<div class="col-2">
<div id="wb_YouTube6" style="display:inline-block;width:100%;z-index:25;">
<iframe id="YouTube6" src="https://www.youtube.com/embed/cJiQD0QG08Y?rel=0&amp;showinfo=0&amp;enablejsapi=1&amp;autohide=1"></iframe>
</div>
<div id="wb_Heading6" style="display:inline-block;width:100%;text-align:center;z-index:26;">
<h1 id="Heading6">Reşîd û Arıya</h1>
</div>
<div id="wb_Text1">
<span style="color:#000000;font-family:Arial;font-size:15px;"><br>Azîz û Fehmî<br><br>Film : Ratip Film<br><br>للمشاهدى على اليوتيوب</span>
</div>
<div id="wb_Shape2" style="display:inline-block;width:125px;height:36px;z-index:28;position:relative;">
<a href="https://www.youtube.com/watch?v=cJiQD0QG08Y" target="_blank"><div id="Shape2"><div id="Shape2_text"><span style="color:#FFFFFF;font-family:Arial;font-size:12px;">شاهدها على اليوتيوب</span></div></div></a>
</div>
</div>
<div class="col-3">
<div id="wb_YouTube7" style="display:inline-block;width:100%;z-index:29;">
<iframe id="YouTube7" src="https://www.youtube.com/embed/FN-UCtTN9do?rel=0&amp;showinfo=0&amp;enablejsapi=1&amp;autohide=1"></iframe>
</div>
<div id="wb_Heading7" style="display:inline-block;width:100%;text-align:center;z-index:30;">
<h1 id="Heading7">Roder û Zoya</h1>
</div>
<div id="wb_Text2">
<span style="color:#000000;font-family:Arial;font-size:15px;"><br>Menhel Silêman- Şêxanî<br><br>Film : Ratip Film<br><br>للمشاهدى على اليوتيوب</span>
</div>
<div id="wb_Shape3" style="display:inline-block;width:125px;height:36px;z-index:32;position:relative;">
<a href="https://www.youtube.com/watch?v=FN-UCtTN9do&t=389s" target="_blank"><div id="Shape3"><div id="Shape3_text"><span style="color:#FFFFFF;font-family:Arial;font-size:12px;">شاهدها على اليوتيوب</span></div></div></a>
</div>
</div>
<div class="col-4">
<div id="wb_YouTube8" style="display:inline-block;width:100%;z-index:33;">
<iframe id="YouTube8" src="https://www.youtube.com/embed/oWfT0AK3SnU?rel=0&amp;showinfo=0&amp;enablejsapi=1&amp;autohide=1"></iframe>
</div>
<div id="wb_Heading8" style="display:inline-block;width:100%;text-align:center;z-index:34;">
<h1 id="Heading8">Idrîs û Gulîstan</h1>
</div>
<div id="wb_Text3">
<span style="color:#000000;font-family:Arial;font-size:15px;"><br>Xembar Ebdê<br><br>Film : Ratip Film<br><br>للمشاهدى على اليوتيوب</span>
</div>
<div id="wb_Shape4" style="display:inline-block;width:125px;height:36px;z-index:36;position:relative;">
<a href="https://www.youtube.com/watch?v=oWfT0AK3SnU" target="_blank"><div id="Shape4"><div id="Shape4_text"><span style="color:#FFFFFF;font-family:Arial;font-size:12px;">شاهدها على اليوتيوب</span></div></div></a>
</div>
</div>
</div>
</div>
</div>
<div id="wb_LayoutGrid3">
<div id="LayoutGrid3">
<div class="row">
<div class="col-1">
<div id="wb_YouTube12" style="display:inline-block;width:100%;z-index:37;">
<iframe id="YouTube12" src="https://www.youtube.com/embed/XZApdjkmIhQ?rel=0&amp;showinfo=0&amp;enablejsapi=1&amp;ap=%2526fmt%3D18&amp;autohide=1"></iframe>
</div>
<div id="wb_Heading4" style="display:inline-block;width:100%;text-align:center;z-index:38;">
<h1 id="Heading4">Ahmed û Rexda</h1>
</div>
<div id="wb_Text4">
<span style="color:#000000;font-family:Arial;font-size:15px;"><br>Sebah Haco<br><br>Film : Ratip Film<br><br>للمشاهدى على اليوتيوب</span>
</div>
<div id="wb_Shape5" style="display:inline-block;width:125px;height:36px;z-index:40;position:relative;">
<a href="https://www.youtube.com/watch?v=XZApdjkmIhQ" target="_blank"><div id="Shape5"><div id="Shape5_text"><span style="color:#FFFFFF;font-family:Arial;font-size:12px;">شاهدها على اليوتيوب</span></div></div></a>
</div>
</div>
<div class="col-2">
<div id="wb_YouTube9" style="display:inline-block;width:100%;z-index:41;">
<iframe id="YouTube9" src="https://www.youtube.com/embed/O3Pk3AyroIs?rel=0&amp;showinfo=0&amp;enablejsapi=1&amp;autohide=1"></iframe>
</div>
<div id="wb_Heading1" style="display:inline-block;width:100%;text-align:center;z-index:42;">
<h1 id="Heading1">Ulaş û Bihar</h1>
</div>
<div id="wb_Text5">
<span style="color:#000000;font-family:Arial;font-size:15px;"><br>kamanca Xebat Nico<br><br>Film : Ratip Film<br><br>للمشاهدى على اليوتيوب</span>
</div>
<div id="wb_Shape6" style="display:inline-block;width:125px;height:36px;z-index:44;position:relative;">
<a href="https://www.youtube.com/watch?v=cJiQD0QG08Y" target="_blank" title="https://www.youtube.com/watch?v=O3Pk3AyroIs"><div id="Shape6"><div id="Shape6_text"><span style="color:#FFFFFF;font-family:Arial;font-size:12px;">شاهدها على اليوتيوب</span></div></div></a>
</div>
</div>
<div class="col-3">
<div id="wb_YouTube11" style="display:inline-block;width:100%;z-index:45;">
<iframe id="YouTube11" src="https://www.youtube.com/embed/t_7y6BUYDPE?rel=0&amp;showinfo=0&amp;enablejsapi=1&amp;autohide=1"></iframe>
</div>
<div id="wb_Heading2" style="display:inline-block;width:100%;text-align:center;z-index:46;">
<h1 id="Heading2">Efrîn </h1>
</div>
<div id="wb_Text6">
<span style="color:#000000;font-family:Arial;font-size:15px;"><br>Ratib Şêxmûs<br><br>Film : Ratip Film<br><br>للمشاهدى على اليوتيوب</span>
</div>
<div id="wb_Shape8" style="display:inline-block;width:125px;height:36px;z-index:48;position:relative;">
<a href="https://www.youtube.com/watch?v=t_7y6BUYDPE" target="_blank"><div id="Shape8"><div id="Shape8_text"><span style="color:#FFFFFF;font-family:Arial;font-size:12px;">شاهدها على اليوتيوب</span></div></div></a>
</div>
</div>
<div class="col-4">
<div id="wb_YouTube10" style="display:inline-block;width:100%;z-index:49;">
<iframe id="YouTube10" src="https://www.youtube.com/embed/3XZHBMomKvg?rel=0&amp;showinfo=0&amp;enablejsapi=1&amp;autohide=1"></iframe>
</div>
<div id="wb_Heading3" style="display:inline-block;width:100%;text-align:center;z-index:50;">
<h1 id="Heading3">Logo </h1>
</div>
<div id="wb_Text8">
<span style="color:#000000;font-family:Arial;font-size:15px;"><br>NO MUSIC**<br><br>Film : Ratip Film<br><br>للمشاهدى على اليوتيوب</span>
</div>
<div id="wb_Shape7" style="display:inline-block;width:125px;height:36px;z-index:52;position:relative;">
<a href="https://www.youtube.com/watch?v=3XZHBMomKvg" target="_blank"><div id="Shape7"><div id="Shape7_text"><span style="color:#FFFFFF;font-family:Arial;font-size:12px;">شاهدها على اليوتيوب</span></div></div></a>
</div>
</div>
</div>
</div>
</div>
<div id="FlexBoxContainer4">
<input type="button" id="Button1" onclick="window.location.href='https://www.youtube.com/channel/UCww5mfjXRFXYOWy0ACjRwwA/featured';return false;" name="" value="... المزيد" style="display:block;width:96px;height:25px;z-index:53;">
</div>
<div id="map" style="position:relative;text-align:center;width:82.2239%;;height:533px;float:left;clear:left;display:block;z-index:84;" class="api-map">
<div id="map_Container" style="width:1087px;position:relative;margin-left:auto;margin-right:auto;text-align:left;">
<div id="wb_Shape9" style="position:absolute;left:84px;top:61px;width:855px;height:433px;z-index:59;">
<img src="images/img0022.png" id="Shape9" alt="" style="width:855px;height:433px;z-index:9999 !important;"></div>
<div id="wb_Heading9" style="position:absolute;left:287px;top:83px;width:443px;height:50px;text-align:center;z-index:60;">
<h1 id="Heading9">تواصل معنا</h1></div>
<div id="wb_Heading10" style="position:absolute;left:112px;top:146px;width:257px;height:27px;z-index:61;">
<h2 id="Heading10">Ratb Film</h2></div>
<div id="wb_Text9" style="position:absolute;left:112px;top:192px;width:278px;height:112px;z-index:62;">
<span style="color:#FFFFFF;font-family:Arial;font-size:13px;"><strong>Emden</strong> <br><br><strong>PHONE<br></strong>01738544054 <br><br><strong>EMAIL<br></strong>ratip783@gmail.com </span></div>
<div id="wb_Heading11" style="position:absolute;left:530px;top:146px;width:257px;height:27px;text-align:right;z-index:63;">
<h2 id="Heading11">املئ  الحقول</h2></div>


<div id="wb_Form1" style="position:absolute;left:544px;top:173px;width:379px;height:299px;z-index:66;">
<form name="Form1" method="post" action="<?php echo basename(__FILE__); ?>" enctype="multipart/form-data" id="Form1">
<input type="hidden" name="formid" value="form1">
<input type="text" id="Editbox1" style="position:absolute;left:5px;top:9px;width:359px;height:28px;line-height:28px;z-index:54;" name="name" value="" spellcheck="false" placeholder="&#1575;&#1604;&#1575;&#1587;&#1605;*">
<input type="text" id="Editbox2" style="position:absolute;left:5px;top:54px;width:359px;height:28px;line-height:28px;z-index:55;" name="email" value="" spellcheck="false" placeholder="&#1575;&#1604;&#1575;&#1610;&#1605;&#1610;&#1604;*">
<input type="text" id="Editbox3" style="position:absolute;left:5px;top:99px;width:359px;height:28px;line-height:28px;z-index:56;" name="phone" value="" spellcheck="false" placeholder="&#1585;&#1602;&#1605; &#1575;&#1604;&#1607;&#1575;&#1578;&#1601; &#1604;&#1604;&#1578;&#1608;&#1575;&#1589;&#1604; &#1605;&#1593;&#1603;">
<textarea name="TextArea1" id="TextArea1" style="position:absolute;left:5px;top:145px;width:359px;height:92px;z-index:57;" rows="4" cols="57" spellcheck="false" placeholder="&#1575;&#1603;&#1578;&#1576; &#1585;&#1587;&#1575;&#1604;&#1578;&#1603;"></textarea>
<input type="submit" id="Button2" name="" value="ارسال" style="position:absolute;left:243px;top:256px;width:130px;height:34px;z-index:58;">
</form>
</div>
</div>
</div>
<div id="FlexBoxContainer5">
</div>
<!-- facebook -->
<div id="Html6" style="position:absolute;left:341px;top:2861px;width:716px;height:499px;z-index:86">
<div class="fb-comments" data-href="https://m.facebook.com/story.php?story_fbid=2000057476933626&amp;id=1697201330552577" data-numposts="1"></div></div>

<div id="PageFooter1" style="position:fixed;overflow:hidden;text-align:center;left:0;right:0;bottom:0;height:41px;z-index:88;">
<div id="PageFooter1_Container" style="width:1322px;position:relative;margin-left:auto;margin-right:auto;text-align:left;">
<div id="wb_Text10" style="position:absolute;left:566px;top:12px;width:251px;height:16px;z-index:73;">
<span style="color:#FFFFFF;font-family:Arial;font-size:13px;">Copyright ©&nbsp; RatibFilm&nbsp;&nbsp; 2017-2018</span></div>
</div>
</div>
</body>
</html>