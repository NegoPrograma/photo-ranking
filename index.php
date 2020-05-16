<?php
require "./Photo.php";
require "./PhotoList.php";
if(isset($_FILES['photos'])){
    session_start();
    $_SESSION["photoList"] = new PhotoList();
    var_dump($_FILES['photos']);
    $index=0;
    foreach ($_FILES['photos']['tmp_name'] as $fileName) {
        $photo = new Photo();
        $photo->photoName = "photo".$index;
        move_uploaded_file($fileName, "./uploads/".$photo->photoName.".png");
        $photo->photoPath = "./uploads/".$photo->photoName.".png";
        $_SESSION['photoList']->photoList[] = $photo;
        $index++;
    }
    header("location: show.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="./index.php" method="post" enctype="multipart/form-data">
        <input type="file" name="photos[]" multiple>
        <input type="submit" value="envia ae lek">
    </form>
</body>
</html>