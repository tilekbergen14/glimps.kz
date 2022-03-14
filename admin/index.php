<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="../assets/admin.css">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/main.css">
</head>
<?php
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=moodhousedb', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$statement = $pdo->prepare("select id, name, image, status from films order by created_date desc");
$statement->execute();
$films = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<body class='text-light'>
    <?php include("./navbar.php") ?>
    <div class="container mt-2">
        <table class="table table-light ">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <?php foreach ($films as $film) : ?>
                <tbody>
                    <tr>
                        <th scope="row"><?php echo $film["id"] ?></th>
                        <td scope="row">
                            <div class="list-img">
                                <img class="list-img" src="/<?php echo $film['image'] ?>" alt="No Image">
                            </div>
                        </td>
                        <td scope="row"><?php echo $film["name"] ?></td>
                        <td scope="row"><?php if ($film["status"] === "1") {
                                            echo "ongoing";
                                        } ?></td>
                        <td scope="row">
                            <form action="delete.php" method="POST">
                                <input name="id" type="hidden" value="<?php echo $film["id"] ?>">
                                <button type="submit" class=" btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            <?php endforeach ?>
        </table>
    </div>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>