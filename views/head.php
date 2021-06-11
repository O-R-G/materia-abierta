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
{
    try
    {
        $uri_temp = $uri;
        array_shift($uri_temp);
        $id = end($oo->urls_to_ids($uri_temp));
        $item = $oo->get($id);
    }
    catch(Exception $e)
    {
        $item = $oo->get(0);
    }
}

$name = ltrim(strip_tags($item["name1"]), ".");

// document title
// $item = $oo->get($uu->id);
$title = $item["name1"];
$site_name = "Materia Abierta";
if ($title)
    $title = $site_name." | ".strip_tags($title);
else
    $title = $site_name;

$en = isset($_GET['en']);
$es = isset($_GET['es']);
if (!$en && !$es)
    $es = true;

$background_color = isset($_GET['background_color']) ? $_GET['background_color'] : false;
$color_arr = array();
if(isset($_GET['color_begin']))
    $color_arr['color_begin'] = $_GET['color_begin'];

if(isset($_GET['color_end']))
    $color_arr['color_end'] = $_GET['color_end'];
if(empty($color_arr))
    $color_arr = false;
if($color_arr)
    $color_arr = array_values($color_arr);
$includeCaption = isset($_GET['includeCaption']);
require_once('static/php/function.php');

$isHome = false;
if(!$uri[1])
    $isHome = true;
$bw = isset($_GET['bw']);
$bodyclass = '';
if($bw)
    $bodyclass .= ' bw';
?><!DOCTYPE html>
<html>
    <head>
        <title><? echo $title; ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, user-scalable=no">
        <meta property="og:image" content="/media/jpg/website-thumbnail.jpg" />
        <meta property="og:type" content="website" />
        <link rel='stylesheet' type='text/css' media='all' href='/static/css/main.css'>
        <link rel="stylesheet" href="/static/css/hnr-medium.css">
        <link rel="shortcut icon" type="image/png" href="/media/png/icon.png"/>
        <script src="/static/pde/processing-1.4.1.min.js"></script>
        <script src="/static/js/function.js"></script>
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
            ga('create', 'UA-5802235-2', 'auto');
            ga('send', 'pageview');
        </script>
    </head>
    <body class="<?= $bodyclass; ?>">
    <script>
        document.body.classList.add('waiting');
    </script>
