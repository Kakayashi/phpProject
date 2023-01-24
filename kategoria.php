<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BlogApp</title>
    <script src="https://kit.fontawesome.com/1e8fd6d397.js" crossorigin="anonymous"></script>
    <link href="style/style.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
</head>

<body>
<nav class="navbar navbar-dark bg-dark navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand " href="index.php">BlogApp</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link active dropdown-toggle" href="index.php" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Categories
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="kategoria.php?category=sport">Sport</a></li>
                            <li><a class="dropdown-item" href="kategoria.php?category=news">News</a></li>
                            <li><a class="dropdown-item" href="kategoria.php?category=technology">Technology</a></li>
                            <li><a class="dropdown-item" href="kategoria.php?category=other">Other</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav my-2 my-lg-0">
                    <li class="nav-item d-flex">
                        <a class="nav-link" aria-current="page" href="login.php">Zaloguj</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <?php
      $categoty = $_GET['category'];
      echo "<div id='category'>$categoty:</div>";
      echo '<div id="articleWrapper">';


        
            require("dbconnection.php");
            $sql = "SELECT * FROM articles WHERE article_category = '$categoty'";
            $query = mysqli_query($db_conn, $sql);
            
          
            if(mysqli_num_rows($query) > 0) {
                for ($i = 0; $i < mysqli_num_rows($query); $i++) {
                $record = mysqli_fetch_assoc($query);
                $dlugosc = strlen($record["article_text"]);
                $text = "";
                if($dlugosc>497){
                    $text =  substr($record["article_text"],0,500);
                    $text = $text."...";
                }
                else {
                    $text = $record["article_text"];
                }
                    
                echo '
                <div class="articleObject">
                    <div class="articleImageWrapper">
                        <img class="articleImage" src="'.$record["article_img"].'" />
                    </div>
                    <h2>'.$record["article_title"].'</h2>
                    <p>'.$text.'</p>
                    <form action="article.php?id='.$record["article_id"].'" method="post">
                    <input hidden name="id" value="'.$record["article_id"].' " >
                    <button type="submit" id="hiddenButton"><div class="articleObjectOverlay"></div></button>
                    </form>
                 </div>
                ';
            }
            }
        ?>
    </div>


    <footer class="bg-dark text-center text-white footer fixed-bottom">
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            Karol Krawczynski
            <a class="btn btn-outline-light btn-floating m-1" href="https://github.com/Kakayashi" role="button">
                <i
                class="fab fa-github"></i></a>
        </div>
    </footer>


</body>

</html>