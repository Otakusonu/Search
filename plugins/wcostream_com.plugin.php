<?php
class wcostream_com
{
  public function query($query) {
    $html = $this->http_post('https://www.wcostream.com/search', array('catara'=>$query,'konuara'=>'series'));
    $tmp = explode("</div>\r\n</div>\r\n", trim(explode('</ul>', explode("</form>\r\n</div>", $html['content'])[1])[0]));
    $return = array();
    foreach($tmp as $key => $val) {
      $x = explode('" title="', explode( '">', explode('<a href="', $val)[1])[0]);
      //https://www.wcostream.com/
      $return["https://www.wcostream.com{$x[0]}"] = $x[1];
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
