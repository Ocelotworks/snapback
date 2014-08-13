<html>
<?php
require_once("snapchat.php");
if($_POST)
{
    $snapchat = new Snapchat($_POST['username'], $_POST['password']);

    // Upload a snap and send it to me for 8 seconds:
    $id = $snapchat->upload(Snapchat::MEDIA_IMAGE, file_get_contents('test.jpg'));
    $snapchat->send($id, array('teknogeek'), 10);
}
?>
</html>