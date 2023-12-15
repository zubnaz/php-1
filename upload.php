<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $photoTmpName = $_FILES['photo']['tmp_name'];
    $dir = "/images/";
    $photo_name = uniqid() . ".jpg";
    $destination = $_SERVER["DOCUMENT_ROOT"] . $dir . $photo_name;
    move_uploaded_file($photoTmpName, $destination);

    echo '<img src="' . $dir . $photo_name . '" alt="Image Preview" width="150" onclick="selectPhoto()">';
}
