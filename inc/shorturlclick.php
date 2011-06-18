<?php

class ShortUrlClick extends AN_Model
{
  static function track_click($short_url, $referer)
  {
    $id = $short_url->id;

    $host = parse_url($referer, PHP_URL_HOST);
    $path = parse_url($referer, PHP_URL_PATH);

    $clicks = self::query('SELECT * FROM #table WHERE `short_url_id` = ? `host` = ? AND `path` = ?', $id, $host, $path);

    if (empty($clicks[0]))
    {
      self::create(array(
        'short_url_id' => $id,
        'host' => $host,
        'path' => $path,
        'clicks' => 1
      ));
    }
    else
    {
      $click = $clicks[0];

      $click->clicks += 1;
      $click->save();
    }
  }
}
