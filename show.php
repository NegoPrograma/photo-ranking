<?php 

require "./Photo.php";
require "./PhotoList.php";
// server should keep session data for AT LEAST 1 hour
ini_set('session.gc_maxlifetime', 3600);

// each client should remember their session id for EXACTLY 1 hour
session_set_cookie_params(3600);

session_start(); // ready to go!
$list = $_SESSION['photoList'];
if(isset($_GET["vote"])){
    $choice = explode("/",$_POST['choice']);
    $winner = $choice[0];
    $loser = $choice[1];
    $list->assign($winner,$loser);

}
$list->choosePhotos();
$photo1 = $list->photoList[$list->photo1];
$photo2 = $list->photoList[$list->photo2];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="./show.php?vote=yes" method="post">
    <img src="<?php echo $photo1->photoPath; ?>" width="330px" heigth="330px">
    <input type="radio" name="choice" value="<?php echo $photo1->photoName.'/'.$photo2->photoName; ?>">
    <?php echo $photo1->photoName; ?><br>
    <img src="<?php echo $photo2->photoPath; ?>" width="330px" heigth="330px">
    <input type="radio" name="choice" value="<?php echo $photo2->photoName.'/'.$photo1->photoName;; ?>">
    <?php echo $photo2->photoName; ?>
    <button type="submit">Escolher</button>
    </form>
  
</body>
</html>

