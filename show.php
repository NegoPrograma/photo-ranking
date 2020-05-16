<?php 

require "./Photo.php";
require "./PhotoList.php";
session_start();
    $list = $_SESSION['photoList'];
$list->choosePhotos();

$photo1 = $list->photoList[$list->photo1]->photoPath;
$photo2 = $list->photoList[$list->photo2]->photoPath;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <img src="<?php echo $photo1; ?>"  alt="">
    <img src="<?php echo $photo2; ?>"  alt="">
</body>
</html>

