<?php

if (empty($_POST['url']))
{
  header('Location: /s');
  exit;
}

define('LOAD_DB', TRUE);
require('../inc/setup.php');

$short = ShortUrl::toShort($_POST['url']);

if ($short === false)
{
  header('Location: /s');
  exit;
}

$short = "http://{$_SERVER['HTTP_HOST']}/~{$short}";
?>

<div id='shorturl'>
  Short URL:
  <input class='readonly' type='text' value='<?php echo $short ?>' readonly />  <span id='short_url_clippy' style='display:none'><?php echo $short ?></span>

  <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000"
          width="110"
          height="14"
          id="clippy" >
  <param name="movie" value="/flash/clippy.swf"/>
  <param name="allowScriptAccess" value="always" />
  <param name="quality" value="high" />
  <param name="scale" value="noscale" />
  <param NAME="FlashVars" value="id=short_url_clippy">
  <param name="bgcolor" value="#F2E6FB">
  <embed src="/flash/clippy.swf"
         width="110"
         height="14"
         name="clippy"
         quality="high"
         allowScriptAccess="always"
         type="application/x-shockwave-flash"
         pluginspage="http://www.macromedia.com/go/getflashplayer"
         FlashVars="id=short_url_clippy"
         bgcolor="#F2E6FB"
  />
  </object>
</div>

<script>
$(document).ready(function() {
  $('.readonly').each(function() {
    $(this).click(function() {
      $(this).focus();
      $(this).select();
    });
  });
})
</script>
