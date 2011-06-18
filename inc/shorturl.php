<?php

class ShortUrl extends AN_Model
{
  static $chars = 'YgsHfbvMw6ECrjRn4p51hcUiIdy0LekD29NSFtGXqxlTBVQaKAz3PJWu8OZ7om';

  static function toShort($url)
  {
      $shorts = self::query('SELECT short FROM #table WHERE `long` = ? LIMIT 1', $url);

      // If there is already a short url, return it.
      if (empty($shorts[0]) === FALSE)
      {
        return $shorts[0]->short;
      }
      else // Otherwise, shorten it and save it to the db.
      {
        // (URL_FORMAT is defined at the bottom of this file.)
        if (preg_match(URL_FORMAT, $url))
        {
          $s = new self(array('long' => $url));
          $s->save();

          $s->short = self::_shortUrlFromId($s->id);
          $s->save();

          return $s->short;
        }

        return FALSE;
      }
  }

  static function fromShort($url)
  {
      $shorts = self::query('SELECT `long` FROM #table WHERE `short` = ? LIMIT 1', $url);

      // If there is already a short url
      if (empty($shorts[0]) === FALSE)
      {
        return $shorts[0]->long;
      }

      return FALSE;
  }

  static function _shortUrlFromId($integer)
  {
    $length = strlen(self::$chars);
    $out = '';

    while ($integer > $length - 1)
    {
      $out = self::$chars[fmod($integer, $length)] . $out;
      $integer = floor($integer / $length);
    }

    return self::$chars[$integer] . $out;
  }

  function _idFromShortUrl($string)
  {
    $length = strlen(self::$chars);
    $size = strlen($string) - 1;
    $string = str_split($string);
    $out = strpos(self::$chars, array_pop($string));

    foreach ($string as $i => $char)
    {
      $out += strpos(self::$chars, $char) * pow($length, $size - $i);
    }

    return $out;
  }
}

define('URL_FORMAT',
'/^(https?):\/\/'.                                         // protocol
'(([a-z0-9$_\.\+!\*\'\(\),;\?&=-]|%[0-9a-f]{2})+'.         // username
'(:([a-z0-9$_\.\+!\*\'\(\),;\?&=-]|%[0-9a-f]{2})+)?'.      // password
'@)?(?#'.                                                  // auth requires @
')((([a-z0-9][a-z0-9-]*[a-z0-9]\.)*'.                      // domain segments AND
'[a-z][a-z0-9-]*[a-z0-9]'.                                 // top level domain  OR
'|((\d|[1-9]\d|1\d{2}|2[0-4][0-9]|25[0-5])\.){3}'.
'(\d|[1-9]\d|1\d{2}|2[0-4][0-9]|25[0-5])'.                 // IP address
')(:\d+)?'.                                                // port
')(((\/+([a-z0-9$_\.\+!\*\'\(\),;:@&=-]|%[0-9a-f]{2})*)*'. // path
'(\?([a-z0-9$_\.\+!\*\'\(\),;:@&=-]|%[0-9a-f]{2})*)'.      // query string
'?)?)?'.                                                   // path and query string optional
'(#([a-z0-9$_\.\+!\*\'\(\),;:@&=-]|%[0-9a-f]{2})*)?'.      // fragment
'$/i');

?>
