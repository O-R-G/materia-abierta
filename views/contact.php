<?
$body = $item['body'];
$deck = $item['deck'];
if($body)
{
?><section id="contact"><?
    echo nl2br($body);

    // subscribe form
    $subscribe = $_POST['subscribe'];
    $message = $_POST['message'];
    if (!$subscribe) {
        ?><br /><br /><? 
            echo nl2br($deck);
        ?>
        <form enctype='multipart/form-data' action='contact' method='post'>
        <textarea name='message' cols='30' rows='2'></textarea><br />
        <input name='subscribe' type='submit' value='Subscribe'>
        </form><?
    } else {
        $to = "info@modernart.net";
        // $to = "alex@modernart.net";
        $subject = "Mailing list subcription request";
        $body = "Please subscribe " . $message . ".";
        $headers = "From: subscribe@modernart.net";
        mail($to,$subject,$body,$headers);
        ?><br /><br /><br />Thanks.<?
    }
?></section><?
}
?>

<!-- privacy policy -->

<div id="privacy">
    <a href="/main/contact/privacy">Privacy</a>
</div>



