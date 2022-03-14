<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoodHouse | Change your mood with us!</title>
    <link rel="stylesheet" href="./assets/bootstrap/css/bootstrap.min.css">
    <script src="./assets/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./assets/main.css">
</head>

<body>
    <?php
    $pdo = new PDO('mysql:host=localhost;port=3306;dbname=moodhousedb', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $statement = $pdo->prepare("select * from films order by created_date");
    $statement->execute();
    $films = $statement->fetchAll(PDO::FETCH_ASSOC);
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $romance = $_POST['romance'];
        $adventure = $_POST['adventure'];
        $drama = $_POST['drama'];
        $sliceoflife = $_POST['sliceoflife'];
        $comedy = $_POST['comedy'];
        $fantasy = $_POST['fantasy'];
        $mystery = $_POST['mystery'];
        $year2016 = $_POST['year2016'];
        $year2017 = $_POST['year2017'];
        $year2018 = $_POST['year2018'];
        $year2019 = $_POST['year2019'];
        $year2020 = $_POST['year2020'];
        $year2021 = $_POST['year2022'];
        $year2022 = $_POST['year2022'];
    }
    ?>
    <div class="header">
        <img class="header-img" src="./assets/images/movie.jpg" alt="">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">MoodHouse</a>
                <form class="d-flex">
                    <button class="btn btn-primary" type="submit">SIGN IN</button>
                </form>
            </div>
        </nav>
        <div class='welcome'>
            <?php include("./components/slider.php") ?>
        </div>
    </div>
    <div class="text-light hero pt-4 m-0">
        <div class="p-0">
            <p class="title ps-1">Latest Shows</p>
            <div class="row m-0">
                <?php foreach ($films as $film) : ?>
                    <div class="col-6 col-sm-4 col-lg-3 p-1 cu-card">
                        <div class="cu-card-header">
                            <div class="card-relative">
                                <img src="<?php echo $film['Image'] ?>" alt="">
                                <div class="card-infos">
                                    <div class="info-box info-box-left">
                                        EP11
                                    </div>
                                    <div class="info-box info-box-right">
                                        SUB
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-hero">
                            <p class="card-title mt-1"><?php echo $film['Name'] ?></p>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>

        </div>
        <div class="right-side text-light">
            <p class="title">Filter</p>
            <form class="filter-box" method="POST">
                <div class="d-flex">
                    <div class="flex-fill">
                        <p class="text-info mb-1">Genres</p>
                        <input type="checkbox" id="romance" name="romance">
                        <label for="romance">Romance</label><br>
                        <input type="checkbox" id="adventure" name="adventure">
                        <label for="adventure">Adventure</label><br>
                        <input type="checkbox" id="drama" name="drama">
                        <label for="drama">Drama</label><br>
                        <input type="checkbox" id="sliceoflife" name="sliceoflife">
                        <label for="sliceoflife">Slice of life</label><br>
                        <input type="checkbox" id="comedy" name="comedy">
                        <label for="comedy">Comedy</label><br>
                        <input type="checkbox" id="fantasy" name="fantasy">
                        <label for="fantasy">Fantasy</label><br>
                        <input type="checkbox" id="mystery" name="mystery">
                        <label for="mystery">Mystery</label><br>
                    </div>
                    <div class="flex-fill">
                        <p class="text-info mb-1">Year</p>
                        <input type="checkbox" id="2016" name="year2016">
                        <label for="2016">2016</label><br>
                        <input type="checkbox" id="2017" name="year2017">
                        <label for="2017">2017</label><br>
                        <input type="checkbox" id="2018" name="year2018">
                        <label for="2018">2018</label><br>
                        <input type="checkbox" id="2019" name="year2019">
                        <label for="2019">2019</label><br>
                        <input type="checkbox" id="2020" name="year2020">
                        <label for="2020">2020</label><br>
                        <input type="checkbox" id="2021" name="year2021">
                        <label for="2021">2021</label><br>
                        <input type="checkbox" id="2022" name="year2022">
                        <label for="2022">2022</label><br>
                        <input type="checkbox" id="ongoing" name="ongoing">
                        <label for="ongoing">Ongoing</label><br>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-3 w-100">Filter</button>
            </form>
        </div>
    </div>
    <script src="./assets/main.js"></script>
</body>

</html>