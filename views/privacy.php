<?
$body = $item['body'];
$deck = $item['deck'];
if($body)
{
?><section id="contact"><?
    	echo nl2br($deck);
	echo "<br/><br/>";
    	echo nl2br($body);
?></section><?
}
?>
