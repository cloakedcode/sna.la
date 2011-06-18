<?php

class ShortUrlLoc extends AN_Model
{
  static function track_ip($short_url, $ip)
  {
    $id = $short_url->id;
    $data = file_get_contents('http://ip2country.sourceforge.net/ip2c.php?format=JSON&ip='.$ip);

    foreach (array('ip', 'hostname', 'country_code', 'country_name') as $key)
    {
      $data = str_replace($key, "\"{$key}\"", $data);
    }

    extract(json_decode($data, true));

    if ($country_name !== 'Reserved')
    {
      $locs = self::query('SELECT * FROM #table WHERE `short_url_id` = ? `country_name` = ?', $id, $country_name);

      if (empty($locs[0]))
      {
        self::create(array(
          'short_url_id' => $id,
          'country_name' => $country_name,
          'country_code' => $country_code,
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
}
