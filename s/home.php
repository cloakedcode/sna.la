<h1>Shorten a URL</h1>
<form method='post' action='shorten.php'>
  <label>URL</label>
  <input type='text' name='url' />
  <input type='submit' value='Shorten' />
</form>

<div id='shortdata'></div>
<script>
$(document).ready(function() {
  $('form').submit(function() {
    $.post($(this).attr('action'), $(this).serialize(), function(data) {
      $('#shortdata').html(data);
    });
    return false;
  });
});
</script>
