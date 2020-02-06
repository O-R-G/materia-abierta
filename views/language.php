<?
/*
    +----+-----------+
    |  1 | _English  |
    +----+-----------+
    | 14 | _Español  |
    +----+-----------+
*/

$root = ($uri[0] == 'en') ? '1' : '14';

if (!$uri[1]) {
?><div id='lang-toggle'>
    <a href='/en' class='<?= $uri[0] == 'es' ? '' : 'active' ?>'>en</a> / 
    <a href='/es' class='<?= $uri[0] == 'es' ? 'active' : '' ?>'>es</a>
</div><?
}
?>

