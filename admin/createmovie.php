<link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="../assets/main.css">

<?php
$errors = [];
$image = null;
$name = null;
$description = null;
$releasedyear = null;
$genres = null;
$country = null;
$type = null;
$version = null;
$status = null;
$imagePath = null;


if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'] ?? null;
    $releasedyear = $_POST['releasedyear'] ?? null;
    $genres = $_POST['genres'] ?? null;
    $country = $_POST['country'] ?? null;
    $type = $_POST['type'] ?? null;
    $version = $_POST['version'] ?? null;
    $status = $_POST['status'] ?? null;
    $image = $_FILES["image"] ?? null;
    if (!$name) {
        $errors[] = 'Name is required!';
        $status = $_POST['status'];
    }
    if (empty($errors)) {
        $errors = [];
        $pdo = new PDO('mysql:host=localhost;port=3306;dbname=moodhousedb', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $statement = $pdo->prepare("insert into films(name, description, releasedyear, genres, country, type, version, status, image)
                        values(:name, :description, :releasedyear, :genres, :country, :type, :version, :status, :image)
            ");
        if ($image) {
            if (!is_dir("../assets/files/thumbnails")) {
                mkdir("../assets/files/thumbnails");
            }
            $randomString = generateRandomString();
            $imagePath = $randomString . $image['name'];
            move_uploaded_file($image['tmp_name'],  "../assets/files/thumbnails/" . $imagePath);
            $imagePath = "/assets/files/thumbnails/" . $imagePath;
        }
        $statement->bindValue(':image', $imagePath);
        $statement->bindValue(':name', $name);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':releasedyear', $releasedyear);
        $statement->bindValue(':genres', $genres);
        $statement->bindValue(':country', $country);
        $statement->bindValue(':type', $type);
        $statement->bindValue(':version', $version);
        $statement->bindValue(':status', $status);
        $statement->execute();
        $image = null;
        $name = null;
        $description = null;
        $releasedyear = null;
        $genres = null;
        $country = null;
        $type = null;
        $version = null;
        $status = null;
        $imagePath = null;
    }
}
// echo '<pre class="text-light">';
// var_dump($image);
// echo '</pre>'
?>
<div class="container-fluid my-4">
    <h2 class="text-light">Add new!</h2>
    <form method="post" enctype="multipart/form-data">
        <?php if (!empty($errors)) : ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error) {
                    echo $error;
                } ?>
            </div>
        <?php endif ?>
        <div class="input-group flex-nowrap my-3">
            <span class="input-group-text" id="addon-wrapping">Name</span>
            <input value="<?php echo $name ?>" name='name' type="text" class="form-control" placeholder="Name" aria-label="Name" aria-describedby="addon-wrapping">
        </div>
        <div class="input-group flex-nowrap my-3">
            <span class="input-group-text" id="addon-wrapping">Description</span>
            <input value="<?php echo $description ?>" name='description' type="text" class="form-control" placeholder="Description" aria-label="Description" aria-describedby="addon-wrapping">
        </div>
        <div class="input-group flex-nowrap my-3">
            <span class="input-group-text" id="addon-wrapping">Released Year</span>
            <input value="<?php echo $releasedyear ?>" name='releasedyear' type="text" class="form-control" placeholder="Released Year" aria-label="Released Year" aria-describedby="addon-wrapping">
        </div>
        <div class="input-group flex-nowrap my-3">
            <span class="input-group-text" id="addon-wrapping">Genres</span>
            <input value="<?php echo $genres ?>" name='genres' type="text" class="form-control" placeholder="Genres">
        </div>
        <div class="input-group flex-nowrap my-3">
            <span class="input-group-text" id="addon-wrapping">Country</span>
            <input value="<?php echo $country ?>" name='country' type="text" class="form-control" placeholder="Country">
        </div>
        <div class="input-group mb-3">
            <label class="input-group-text" for="inputGroupSelect01">Type</label>
            <select value="<?php echo $type ?>" name='type' class="form-select" id="inputGroupSelect01">
                <option value="Movie">Movie</option>
                <option value="Serie">Serie</option>
            </select>
        </div>
        <div class="input-group mb-3">
            <label class="input-group-text" for="inputGroupSelect01">Version</label>
            <select name='version' class="form-select" id="inputGroupSelect01">
                <option value="Dub">Dub</option>
                <option value="Sub">Sub</option>
            </select>
        </div>
        <div class="input-group mb-3">
            <input name='image' type="file" class="form-control" id="inputGroupFile02">
            <label class="input-group-text" for="inputGroupFile02">Image</label>
        </div>
        <div class="input-group mb-3">
            <label class="input-group-text" for="inputGroupSelect01">Status</label>
            <select value="<?php echo $status ?>" name='status' class="form-select" id="inputGroupSelect01">
                <option selected value="1">Ongoing</option>
                <option value="0">Finished</option>
            </select>
        </div>
        <button type="submit" class="btn btn-info w-100">Add new</button>
    </form>
</div>


<?php
function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

?>