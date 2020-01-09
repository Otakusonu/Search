<?php
if(empty($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] !== "on") {
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
    die();
}
spl_autoload_register(function($class) {
	$c = strtolower($class);
	if(file_exists("classes/{$c}.class.php"))
		include_once "classes/{$c}.class.php";
	elseif(file_exists("plugins/{$c}.plugin.php")) {
		include_once "plugins/{$c}.plugin.php";
	} else
		throw new Exception("Fatal error: Could not load class '{$class}'.");
});
$post = (object) $_POST;
$driver = new driver();
if(isset($post->query)) {
	$results = $driver->search($post->query);
	foreach($results as $site => $data) {
		echo '<h3><u>'.str_replace('_', '.', $site).'</u></h3>';
		foreach($data as $key => $val) {
			echo "<b><a href='{$val['link']}' target='_blank'>{$val['title']}</a></b><br />";
		}
		echo '<br />';
	}
} else {
	echo 'error';
}
?>
