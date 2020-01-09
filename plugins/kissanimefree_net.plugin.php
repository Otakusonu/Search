<?php
class kissanimefree_net
{
  public function query($query) {
    $query = explode('</div><div class="movie-preview', explode('</div><!--content-wrapper-->', explode('<div class="fix_category clearfix list_items">', file_get_contents('http://kissanimefree.net/?s='.urlencode($query)))[1])[0]);
    $return = array();
    foreach($query as $key => $val) {
      $val = explode('" title="', explode('">', explode('<a href="', $val)[2])[0]);
      $return[$val[0]] = $val[1];
    }
    return $return;
  }
}
?>
