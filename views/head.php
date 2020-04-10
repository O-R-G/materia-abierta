<?
// path to config file
$config = $_SERVER['DOCUMENT_ROOT']."/open-records-generator/config/config.php";
require_once($config);

// specific to this 'app'
$config_dir = $root."/config/";
require_once($config_dir."url.php");
require_once($config_dir."request.php");

require_once("lib/lib.php");

$db = db_connect("guest");

$oo = new Objects();
$mm = new Media();
$ww = new Wires();
$uu = new URL();
$rr = new Request();

// self
if($uu->id)
	$item = $oo->get($uu->id);
else
	$item = $oo->get(0);
$name = ltrim(strip_tags($item["name1"]), ".");

// document title
$item = $oo->get($uu->id);
$title = $item["name1"];
$site_name = "Materia Abierta";
if ($title)
	$title = $site_name." | ".strip_tags($title);
else
	$title = $site_name;

$devhash = rand();  // to force .css reloads

?><!DOCTYPE html>
<html>
	<head>
		<title><? echo $title; ?></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, user-scalable=no">
		<link rel='stylesheet' type='text/css' media='all' href='/static/css/main.css?<?= $devhash; ?>'>
		<link rel="stylesheet" href="/static/css/hnr-medium.css">
   		<link rel="shortcut icon" type="image/png" href="/media/png/icon.png"/>
        <link rel="apple-touch-icon" href="<? echo $host; ?>media/png/touchicon.png" />
        <meta name="google-site-verification" content="YG-Tjy75z0WdQQX5WBjm3RDwyf6pnNeQQ81X0DEVpUE" />
        <meta property="og:title" content="Materia Abierta">
        <meta property="og:image" content="https://materiaabierta.com/media/00066.jpg">
        <meta property="og:type" content="website">
        <? if ($uri[1] == "es"): ?>
                <meta name="description" content="Materia Abierta es un programa independiente de verano sobre teoría, arte y tecnología establecido en la Ciudad de México.">
          <meta name="keywords" content="verano,program,teoría,arte,tecnología,escuela,computación,seminario,conferencia,méxico">
        <? else: ?>
                <meta name="description" content="Materia Abierta is an independent summer program on theory, art, and technology based in Mexico City.">
                <meta name="keywords" content="summer,program,theory,art,technology,school,computing,seminar,lecture,mexico">
        <? endif; ?>
        <meta name="twitter:card" content="summary" />
        <meta name="twitter:site" content="@materiaabierta" />
        <meta name="twitter:title" content="Materia Abierta" />
        <meta name="twitter:description" content="Materia Abierta is an independent summer program on theory, art, and technology based in Mexico City." />
        <meta name="twitter:image" content="https://materiaabierta.com/media/00066.jpg" />
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-138624239-1"></script>
		<script>
  			window.dataLayer = window.dataLayer || [];
  			function gtag(){dataLayer.push(arguments);}
  			gtag('js', new Date());
  			gtag('config', 'UA-138624239-1');
		</script>
        	<script src="/static/pde/processing-1.4.1.min.js"></script>
	</head>
	<body>
