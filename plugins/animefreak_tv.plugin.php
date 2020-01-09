<?php
class animefreak_tv
{
  public function query($query) {
    $list = (json_decode(file_get_contents('https://www.animefreak.tv/search/topSearch?q='.urlencode($query))))->data;
    $return = array();
    foreach($list as $key => $val) {
      $return["https://www.animefreak.tv/watch/{$val->seo_name}"] = $val->name;
    }
    return $return;
  }
}
?>
