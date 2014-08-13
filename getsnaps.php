<html>
<?php
require_once("snapchat.php");
if($_POST)
{
    $snapchat = new Snapchat($_POST['username'], $_POST['password']);
    $snapList = $snapchat->getSnaps();

    echo '<pre>';
    //echo print_r($snapList, 1);
    echo '</pre>';

    error_reporting(0);
    for($i = 0; $i < 5; $i++)
    {
        $snap = get_object_vars($snapList[$i]);
        $data = $snapchat->getMedia($snap['id']);
        $img = imagecreatefromstring($data);
        if($img)
        {
            $b64 = base64_encode($data); // Get what we've just outputted and base64 it
            echo '<image src="data:image/png;base64,'.$b64.'"/><br/>';
        }
    }
}
error_reporting(E_ALL);
?>
</html>