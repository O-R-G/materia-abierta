<?
/*
    +----+-----------+
    |  1 | _English  |
    +----+-----------+
    | 14 | _Español  |
    +----+-----------+
*/

// $root = ($uri[0] == 'en') ? '1' : '14';

?><div id='lang-toggle'>
    <a href='/?en' class='<?= ($es) ? '' : 'active' ?>'>en</a> / 
    <a href='/?es' class='<?= ($es || (!$en)) ? 'active' : '' ?>'>es</a>
</div>

