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
   $subject = '';
   $message = '';
   $success_url = '';
   $error_url = '';
   $error = '';
   $mysql_server = 'localhost';
   $mysql_database = 'msn123123123';
   $mysql_table = 'msn';
   $mysql_username = 'ivanshero123123123';
   $mysql_password = 'ivanshero1995ivo995ivo995';
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
   $body .= 'Content-Type: text/plain; charset=UTF-8'.$eol;
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
      mail($mailto, $subject, $body, $header);
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
   mysqli_set_charset($db, 'utf8');
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
<html>
<head>
<meta charset="utf-8">
<title>صفحة بدون عنوان</title>
<meta name="generator" content="WYSIWYG Web Builder 12 - http://www.wysiwygwebbuilder.com">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="dfdfsPSD.png" rel="shortcut icon" type="image/x-icon">
<link href="meeee/jquery.mobile.theme-1.4.5.css" rel="stylesheet">
<link href="meeee/jquery.mobile.icons-1.4.5.min.css" rel="stylesheet">
<link href="jquery.mobile.structure-1.4.5.min.css" rel="stylesheet">
<link href="Ratip_mobile.css" rel="stylesheet">
<link href="contact_use.css" rel="stylesheet">
<script src="jquery-1.12.4.min.js"></script>
<script>
$(document).on("mobileinit", function()
{
   $.mobile.ajaxEnabled = false;
});
</script>
<script src="jquery.mobile-1.4.5.min.js"></script>
</head>
<body>
<div data-role="page" data-theme="a" data-title="&#1589;&#1601;&#1581;&#1577; &#1576;&#1583;&#1608;&#1606; &#1593;&#1606;&#1608;&#1575;&#1606;" id="contact_use">
<div class="ui-content" role="main">
<div id="wb_Form1" style="">
<form name="Form1" method="post" action="<?php echo basename(__FILE__); ?>" enctype="multipart/form-data" accept-charset="UTF-8" data-ajax="false" data-transition="pop" id="Form1" style="display:inline;">
<input type="hidden" name="formid" value="form1">
<div id="Layer1" style="position:absolute;text-align:left;left:0px;top:0px;width:93.75%;height:44.0313%;z-index:4;">
<label for="Editbox1"></label>
<input type="text" id="Editbox1" style="" name="Editbox1" value="" spellcheck="false" placeholder="&#1575;&#1604;&#1575;&#1587;&#1605;">
<label for="Editbox2"></label>
<input type="email" id="Editbox2" style="" name="Editbox2" value="" spellcheck="false" placeholder="&#1575;&#1604;&#1576;&#1585;&#1610;&#1583; &#1575;&#1604;&#1575;&#1603;&#1578;&#1585;&#1608;&#1606;&#1610;">
<label for="TextArea1"></label>
<textarea name="TextArea1" id="TextArea1" style="" rows="1" cols="40" spellcheck="false" placeholder="&#1575;&#1604;&#1585;&#1587;&#1575;&#1604;&#1577;"></textarea>
<input type="button" data-icon="mail" data-iconpos="left" id="Button2" name="" value="ارسال">
</div>
</form>
</div>
</div>
</div>
</body>
</html>