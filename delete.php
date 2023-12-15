<?php
global $pdo;
if($_SERVER['REQUEST_METHOD']==='DELETE') {

    $id=$_GET['id'];
    include ($_SERVER["DOCUMENT_ROOT"]."/config/connection.php");
    $delPhoto = $pdo->prepare("SELECT photo FROM shop WHERE id = :id");
    $delPhoto->bindParam(':id', $id, PDO::PARAM_INT);
    $delPhoto->execute();
    $result = $delPhoto->fetch(PDO::FETCH_ASSOC);
    $destination = $_SERVER["DOCUMENT_ROOT"]."/images/".$result['photo'];
    unlink($destination);

    $sql = "DELETE from shop WHERE id=:id";

    $stmp = $pdo->prepare($sql);
    $stmp->bindParam(":id",$id,PDO::PARAM_INT);

    $stmp->execute();

   header("Location: http://localhost/");
    exit;

}
