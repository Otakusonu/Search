<?php
class gogoanime1_com
{
  public function query($query) {
    $list = (json_decode(file_get_contents('https://www.gogoanime1.com/search/topSearch?q='.urlencode($query))))->data;
    $return = array();
    foreach($list as $key => $val) {
      $return["https://www.gogoanime1.com/watch/{$val->seo_name}"] = $val->name;
    }
    return $return;
  }
}
?>
