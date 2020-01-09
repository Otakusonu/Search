<?php
class driver
{
	public $plugins = array();
	public function __construct() {
		$this->plugins = $this->fetchPlugins();
	}
	private function fetchPlugins($path = 'plugins') {
		$tmp = array_diff(scandir($path), array('.', '..'));
		$return = array();
		foreach($tmp as $key => $val) {
			$return[] = explode('.', $val)[0];
		}
		return $return;
	}
	public function search( $query ) {
		$results = array();
		foreach($this->plugins as $key => $val) {
			$tmp = (new $val)->query($query);
			foreach($tmp as $k => $v) {
				if(!empty($k) && !empty($v)) {
					$results[$val][] = array('site'=>$val, 'title'=>$v, 'link'=>$k);
				}
			}
		}
		return $results;
	}
}
?>
