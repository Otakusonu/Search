<?php
if(empty($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] !== "on") {
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
    die();
}
spl_autoload_register(function($class) {
	$c = strtolower($class);
	if(file_exists("classes/{$c}.class.php"))
		include_once "classes/{$c}.class.php";
	elseif(file_exists("plugins/{$c}.plugin.php"))
		include_once "plugins/{$c}.plugin.php";
	else
		throw new Exception("Fatal error: Could not load class '{$class}'.");
});
$post = (object) $_POST;
$driver = new driver();
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>My Anime Search Engine</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/main.css?cb=<?=rand(1,999999);?>">
	<canvas id="test"></canvas>
</head>
<body>
<div id="searchBar">
<form method="post" action="">
	<div class="wrap">
   <div class="search">
      <input type="text" id="searchTerm" class="searchTerm" name="query" placeholder="Search..." value="<?=(isset($post->query))?$post->query:''?>" />
      <button type="submit" class="searchButton">
        <i class="fa fa-search"></i>
     </button>
   </div>
</div>
</form>
</div>
<div id="github">MyAnime.ml</div>
<?php
$post = (object) $_POST;
$driver = new driver();
if(isset($post->query)) {
	echo '<div id="results">';
	$results = $driver->search($post->query);
	foreach($results as $site => $data) {
		echo '<h3><u>'.str_replace('_', '.', $site).'</u></h3>';
		foreach($data as $key => $val) {
			echo "<b><a href='{$val['link']}' target='_blank'>{$val['title']}</a></b><br />";
		}
		echo '<br />';
	}
	echo '</div>';
}
?>
</body>
<footer>
	<script type="text/javascript" src="js/main.js"></script>
</footer>
</html>
