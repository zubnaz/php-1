<?php global $pdo; ?>
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
        <?php include ($_SERVER["DOCUMENT_ROOT"]."/config/connection.php"); ?>
        <h1 class="text-center">Список категорій</h1>
        <a href="/create.php" class="btn btn-success m-2">Create</a>
        <?php
        $stmt = $pdo->query("SELECT id,name,price,photo FROM shop");
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(count($result)>0){
        ?>
            <table class="table">
                <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>NAME</th>
                    <th>PRICE</th>
                    <th>IMAGE</th>
                    <th></th>
                </tr>

                </thead>
                <tbody>
                <?php
                foreach ($result as $row){
                ?>
                <tr>
                    <td><?php echo $row['id']?></td>
                    <td><?php echo $row['name']?></td>
                    <td><?php echo $row['price']?></td>
                    <td><img src="/images/<?php echo $row['photo']?>" width="150"/></td>
                    <td><a href="/edit.php?id=<?php echo $row['id']?>" class="btn btn-light">Edit</a>
                        <button onclick="deleteProduct(<?php echo $row['id']?>)" class="btn btn-light">Delete</button>
                    </td>
                </tr>

        <?php
                }
                ?>
                </tbody>
            </table>
        <?php
        }else{
            echo "<h3>Database is clear</h3>";
            //test
        }
        ?>

    </div>
</main>

<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/myjs.js"></script>
</body>
</html>
