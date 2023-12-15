<?php
global $pdo;
if($_SERVER['REQUEST_METHOD']==='POST'){
    $name = $_POST["name"];
    $price=$_POST["price"];
    $photoTmpName=$_FILES['photo']['tmp_name'];

    if($name != "" && $price!="" && $photoTmpName!=""){
        $dir="/images/";
        $photo_name=uniqid().".jpg";
        $destination = $_SERVER["DOCUMENT_ROOT"].$dir.$photo_name;
        move_uploaded_file($photoTmpName,$destination);

        include ($_SERVER["DOCUMENT_ROOT"]."/config/connection.php");
        $sql = "INSERT INTO shop (name,price,photo) VALUES (:name,:price,:photo)";

        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':name',$name,PDO::PARAM_STR);
        $stmt->bindParam(':price',$price,PDO::PARAM_INT);
        $stmt->bindParam(':photo',$photo_name,PDO::PARAM_STR);

        $stmt->execute();

        header("Location: /");

        exit;
    }
    else{
        echo '<script type ="text/JavaScript">';
        echo 'alert("Please fill all fields!")';
        echo '</script>';
    }

}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<?php include ($_SERVER["DOCUMENT_ROOT"]."/header.php"); ?>
<main>
    <div class="container">
        <h1 class="text-center">Додати категорію</h1>
        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control" id="price" name="price">
            </div>
            <div class="mb-3">
                <label class="form-label" for="photo">Photo</label>
                <input type="file" class="form-control" id="photo" name="photo" onchange="takePhoto()">
                <div class="m-3" id="imagePreview"></div>

            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>

    </div>
</main>

<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/myjs.js"></script>
</body>
</html>
