
<?php
$id=$_GET['id'];
global $pdo;
global $id;
if($_SERVER['REQUEST_METHOD']==='POST'){
    $name = $_POST["name"];
    $price=$_POST["price"];

    if($name != "" && $price!=""){
        include ($_SERVER["DOCUMENT_ROOT"]."/config/connection.php");
        $sql = "UPDATE shop SET name=:name, price=:price WHERE id=:id";

        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':id',$id,PDO::PARAM_INT);
        $stmt->bindParam(':name',$name,PDO::PARAM_STR);
        $stmt->bindParam(':price',$price,PDO::PARAM_INT);


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
        <?php
        include ($_SERVER["DOCUMENT_ROOT"]."/config/connection.php");
        $stmt = $pdo->prepare("SELECT name, price FROM shop WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);


        ?>
        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $result['name'] ?>">
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control" id="price" name="price" value="<?php echo $result['price'] ?>">
            </div>
            <button type="submit" class="btn btn-primary">Edit</button>
        </form>

    </div>
</main>

<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/myjs.js"></script>
</body>
</html>
