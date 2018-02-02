<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Ratib Film</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="meeee/jquery.mobile.theme-1.4.5.css" rel="stylesheet">
<link href="meeee/jquery.mobile.icons-1.4.5.min.css" rel="stylesheet">
<link href="jquery.mobile.structure-1.4.5.min.css" rel="stylesheet">
<link href="font-awesome.min.css" rel="stylesheet">
<link href="Ratip_mobile.css" rel="stylesheet">
<link href="index.css" rel="stylesheet">
<script src="jquery-1.12.4.min.js"></script>
<script src="jquery-ui.min.js"></script>
<script src="skrollr.min.js"></script>
<script>
$(document).on("mobileinit", function()
{
   $.mobile.ajaxEnabled = false;
});
</script>
<script src="jquery.mobile-1.4.5.min.js"></script>
<script>
$(document).on("pagecreate", "#index", function(event)
{
   $("a[href*='#contact']").click(function(event)
   {
      event.preventDefault();
      $('html, body').stop().animate({ scrollTop: $('#wb_contact').offset().top-80 }, 600, 'easeInQuad');
   });
   skrollr.init({forceHeight: false, mobileCheck: function() { return false; }, smoothScrolling: false});
});
</script>
</head>
<body>
<div data-role="page" data-theme="a" data-title="Ratib Film" id="index">
<div data-role="header" id="Header1" data-position="fixed">
<h1>Ratib Film</h1>
</div>
<div class="ui-content" role="main">
<div id="LayoutGrid1" class="LayoutGrid1-grid-solo LayoutGrid1-responsive">
<div class="LayoutGrid1-block-a">
</div>
</div>
<div id="LayoutGrid2" class="LayoutGrid2-grid-solo LayoutGrid2-responsive">
<div class="LayoutGrid2-block-a">
<div id="Html4" style="display:inline-block;width:300px;height:21px;z-index:0">
<script src="https://apis.google.com/js/platform.js"></script>

<div class="g-ytsubscribe" data-channelid="UCww5mfjXRFXYOWy0ACjRwwA" data-layout="default" data-count="default"></div></div>
</div>
</div>
<div id="LayoutGrid3" class="LayoutGrid3-grid-solo LayoutGrid3-responsive">
<div class="LayoutGrid3-block-a">
</div>
</div>
<iframe id="YouTube1" src="https://www.youtube.com/embed/9h_IqNS8gjE?rel=0&amp;loop=1&amp;playlist=9h_IqNS8gjE&amp;autoplay=1&amp;showinfo=0&amp;controls=0&amp;ap=%2526fmt%3D18&amp;autohide=0"></iframe>
<div id="LayoutGrid4" class="LayoutGrid4-grid-solo LayoutGrid4-responsive">
<div class="LayoutGrid4-block-a">
</div>
</div>
<div id="LayoutGrid5" class="LayoutGrid5-grid-solo LayoutGrid5-responsive">
<div class="LayoutGrid5-block-a">
</div>
</div>
<div id="wb_contact">
<div id="contact">
<div class="row">
<div class="col-1">
<div id="wb_Heading10" style="text-align:center;">
<h1 id="Heading10">CONTACT US</h1></div>
<div id="wb_Shape3" style="display:inline-block;position:relative;">
<div id="Shape3"></div></div>
<div id="wb_Text16" data--300-bottom="opacity:1.0;" data-bottom-top="opacity:0;">
<span style="color:#FFFFFF;font-family:Arial;font-size:15px;"><em>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. </em></span>
</div>
</div>
</div>
</div>
</div>
<div id="wb_LayoutGrid6">
<form name="LayoutGrid6" method="post" action="mailto:yourname@yourdomain.com" enctype="text/plain" data-ajax="false" data-transition="pop" id="LayoutGrid6">
<div class="row">
<div class="col-1">
<div id="wb_Text2">
<span style="color:#FFFFFF;font-family:Arial;font-size:13px;"><strong>Emden</strong> <br><br><strong>PHONE<br></strong>01738544054 <br><br><strong>EMAIL<br></strong>ratip783@gmail.com <br></span>
</div>
<div id="wb_FontAwesomeIcon3" style="text-align:center;">
<a href="https://www.facebook.com/Ratib-film-1697201330552577/"><div id="FontAwesomeIcon3"><i class="fa fa-facebook">&nbsp;</i></div></a></div>
<div id="wb_FontAwesomeIcon11" style="text-align:center;">
<a href="https://www.youtube.com/channel/UCww5mfjXRFXYOWy0ACjRwwA/videos"><div id="FontAwesomeIcon11"><i class="fa fa-youtube">&nbsp;</i></div></a></div>
</div>
<div class="col-2">
<div id="Button1">
<fieldset data-role="controlgroup" data-shadow="false">
</fieldset>
</div>
</div>
</div>
</form>
</div>
<div id="LayoutGrid7" class="LayoutGrid7-grid-solo LayoutGrid7-responsive">
<div class="LayoutGrid7-block-a">
<input type="button" id="Button2" onclick="window.location.href='./contact_use.php';return false;" name="" value="تواصل معنا">
</div>
</div>
<div id="LayoutGrid8" class="LayoutGrid8-grid-solo LayoutGrid8-responsive">
<div class="LayoutGrid8-block-a">
</div>
</div>
</div>
</div>
</body>
</html>