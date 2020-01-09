<?php
class anime_planet_com
{
  public function query($query) {
    $query = explode('<a title="<h5 class=\'theme-font\'>', file_get_contents('https://www.anime-planet.com/anime/all?name='.urlencode($query).'&has_video=1'));
    $return = array();
    for($i=1;$i<count($query);$i++) {
      $link = 'https://www.anime-planet.com'.explode('"', explode('href="', $query[$i])[1])[0];
      $key = explode('<', explode('<h3 class=\'cardName\'>', $query[$i])[1])[0];
      $return[$link] = $key;
    }
    return $return;
  }
}
?>
