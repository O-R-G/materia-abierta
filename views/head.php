<?
// path to config file
$config = $_SERVER["DOCUMENT_ROOT"];
$config = $config."/open-records-generator/config/config.php";
require_once($config);

// specific to this 'app'
$config_dir = $root."config/";
require_once($config_dir."url.php");
require_once($config_dir."request.php");

$db = db_connect("guest");

$oo = new Objects();
$mm = new Media();
$ww = new Wires();
$uu = new URL();
// $rr = new Request();

// self
if($uu->id)
	$item = $oo->get($uu->id);
else
	$item = $oo->get(0);
$name = ltrim(strip_tags($item["name1"]), ".");

$title = "Materia Abierta";

?>
<!DOCTYPE html>
<html>
	<head>
		<title><? echo $title; ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" href="<? echo $host; ?>static/css/fonts.css">
		<link rel="stylesheet" href="<? echo $host; ?>static/css/global.css">
		<link rel="apple-touch-icon" href="<? echo $host; ?>media/png/touchicon.png" />
		<meta name="google-site-verification" content="YG-Tjy75z0WdQQX5WBjm3RDwyf6pnNeQQ81X0DEVpUE" />

		<meta property="og:title" content="Materia Abierta">
		<meta property="og:image" content="https://materiaabierta.com/media/00113.png">
		<meta property="og:type" content="website">

		<? if ($uri[1] == "es"): ?>
			<meta name="description" content="Materia Abierta es un programa independiente de verano sobre teoría, arte y tecnología establecido en la Ciudad de México.">
		  <meta name="keywords" content="verano,program,teoría,arte,tecnología,escuela,computación,seminario,conferencia,méxico">
		<? else: ?>
			<meta name="description" content="Materia Abierta is an independent summer program on theory, art, and technology based in Mexico City.">
			<meta name="keywords" content="summer,program,theory,art,technology,school,computing,seminar,lecture,mexico">
		<? endif; ?>

        <script src="/static/pde/processing-1.4.1.min.js"></script>
	</head>
<body>
