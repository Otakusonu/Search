<?php
class animeshow_tv
{
  public function query($query) {
    $html = $this->http_post('http://www.animeshow.tv/includes/pages/search_data.php', array('anime'=>$query))['content'];
    $html = explode('</li><li>', explode('</li></ul>', explode('<ul><li>', $html)[1])[0]);
    $return = array();
    foreach($html as $key => $val) {
      $link = explode('">', explode('<a href="', $val)[1])[0];
      $title = explode('</div><div class="search_result_genres', explode('search_result_title">', $val)[1])[0];
      if(!empty($title)) {
        $return[$link] = $title;
      }
    }
    return $return;
  }
  private function http_post ($url, $data) {
      $data_url = http_build_query ($data);
      $data_len = strlen ($data_url);
      return array ('content'=>file_get_contents ($url, false, stream_context_create (array ('http'=>array ('method'=>'POST'
              , 'header'=>"Connection: close\r\nContent-Length: $data_len\r\n"
              , 'content'=>$data_url
              ))))
          , 'headers'=>$http_response_header
      );
  }
}
?>
