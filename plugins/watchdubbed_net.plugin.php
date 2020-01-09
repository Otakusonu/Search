<?php
class watchdubbed_net
{
  public function query($query) {
    $query = explode('</a>', explode('</a> </ul>', explode('<ul class=\'list-inline\'>', file_get_contents('https://www.watchdubbed.net/search?term='.urlencode($query)))[1])[0]);
    $return = array();
    foreach($query as $key => $val) {
      $val = explode('\'>', str_replace('<li class=\'w-50 d-inline-block\'><a href=\'', '', $val));
      $return[preg_replace( "/\r|\n/", "",$val[0])] = preg_replace( "/\r|\n/", "",$val[1]);
    }
    return $return;
  }
}
?>
