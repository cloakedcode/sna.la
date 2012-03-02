<?php

class ShortUrlLoc extends AN_Model
{
  static function track_ip($short_url, $ip)
  {
    $id = $short_url->id;
    $data = self::get_data('http://ip2country.sourceforge.net/ip2c.php?format=JSON&ip='.$ip);

    foreach (array('ip', 'hostname', 'country_code', 'country_name') as $key)
    {
      $data = str_replace($key, "\"{$key}\"", $data);
    }

    $vars = json_decode($data, true);
    $country_name = $vars['country_name'];
    $country_code = $vars['country_code'];

    if ($country_name !== 'Reserved')
    {
      $locs = self::query('SELECT * FROM #table WHERE `short_url_id` = ? AND `country_name` = ?', $id, $country_name);

      if (empty($locs[0]))
      {
        $obj = self::create(array(
          'short_url_id' => $id,
          'country_name' => $country_name,
          'country_code' => $country_code,
          'clicks' => 1
        ));
      }
      else
      {
        $click = $locs[0];

        $click->clicks += 1;
        $click->save();
      }
    }
  }

  static private function get_data($url)
  {
    $ch = curl_init();
    $timeout = 5;
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
  }
}
