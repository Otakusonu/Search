<?php
class animepahe_com
{
  public function query($query) {
    $list = (json_decode(file_get_contents('https://animepahe.com/api?m=search&l=-1&q='.urlencode($query))))->data;
    $return = array();
    if(!empty($list)) {
      foreach($list as $key => $val) {
        $return["https://animepahe.com/anime/{$val->slug}"] = $val->title;
      }
      return $return;
    }
    return array();
  }
}
?>
