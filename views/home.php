<?
$url = ($es) ? '/es' : '/en';
$skipHomepage = isset($_COOKIE['skipHomepage']);
if($skipHomepage)
	header('Location: '. $url);
else
{
	$cookie_name = "skipHomepage";
	$cookie_value = "true";
	setcookie($cookie_name, $cookie_value, time() + (100), "/"); // 86400 = 1 day
}
?>

<div id='children' class='centered centeralign'>
    <div><a href='<?= ($es) ? '/es' : '/en' ?>'>Materia Abierta</a></div>
</div>
