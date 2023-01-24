<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BlogApp</title>
    <script src="https://kit.fontawesome.com/1e8fd6d397.js" crossorigin="anonymous"></script>
    <link href="style/style.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <link href="style/articleStyle.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
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
                        <a class="nav-link" aria-current="page" href="index.php">Home</a>
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

    <div id="articleBigWrapper">
    <?php
                    require("dbconnection.php");
                    if(isset($_GET['id'])) {
                        $id = $_GET['id'];
                        $sql = "SELECT * FROM `articles` WHERE article_id  = '$id'";
                        $query_login = mysqli_query($db_conn, $sql);
                        if(mysqli_num_rows($query_login) > 0) {
                            $record = mysqli_fetch_assoc($query_login);
                            $userId = $record["article_creatorId"];
                            $sqlGetUser = "SELECT * FROM `users` WHERE user_id=$userId";
                            $query = mysqli_query($db_conn, $sqlGetUser);
                            $user = mysqli_fetch_assoc($query);
                            $views = $record["articles_views"] + 1;
                            $sqlUpdate = "UPDATE articles SET articles_views='".$views."' WHERE article_id='".$id."';";
                            mysqli_query($db_conn, $sqlUpdate);

                        echo '
                        <div id="aricleImg2">
                            <img class="articleImage" src="'.$record["article_img"].'" />
                        </div>
                        <div id="'.$record["article_title"].'">Lorem ipsum solet de</div>
                        <div id="articleInfo" >
                            <div id="articleData">Data: '.$record["article_data"].'</div>
                            <div id="articleViews">Views:'.$views.'</div>
                            <div id="articleViews">Author: '.$user["user_name"]." ".$user["user_surname"].'</div>
                        </div>
                        <div id="articleTextArea">'.(string)$record["article_text"].'</div>
                        </br>
                        <div id="articleInfo" >
                            Author: '.$user["user_name"]." ".$user["user_surname"].'
                            </br>
                        </div>
                        
                        </div>

                        <div id="addComentWrapper">
                            <div id="addComentTitle"> Add comment</div>
                            <form method="POST" action="article.php?id='.$id.'">
                        
                        
                        ';
                        }
                    }
                    else{
                        header("Location: index.php");
                    }
                    ?>
    
            <div class="form-group">
                <label for="loginInput">name:</label>
                <input name="name" type="text" class="form-control" id="nameInput" aria-describedby="loginHelp"
                    placeholder="Enter name">
            </div>
                </br>
            <div class="form-group">
                            <label for="text">Text:</label>
                            <textarea name="text" class="form-control" id="text" rows=""></textarea>
                        </div>
                </br>
            <div id="formSubmitWrapper">
                </br>
                <button type="submit" class="btn btn-secondary">Submit</button>
            </div>
        </form>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    require("dbconnection.php");
                    $filters = array(
                        "name" => array("filter"=>FILTER_VALIDATE_REGEXP, "options"=> ['regexp' =>"/^[a-zA-Z 0-9]+$/"]),
                        "text" => array("filter"=>FILTER_VALIDATE_REGEXP, "options"=> ['regexp' =>'/^[\w\s\.\?,!\r\n]+$/'])
                     );

                    $input = filter_input_array(INPUT_POST, $filters);
                    $errors = "";

                    foreach ($input as $key => $val) {
                    if ($val === false or $val === NULL) {
                    $errors .= $key . " ";
                    }
                    }

                    if ($errors === "") {
                        $comment_name = $input["name"];
                        $comment_text = $input["text"];
                        $comment_articleId = $_GET['id'];
                        $data = date("Y-m-d H-i-s");
                       
                        

                         if (mysqli_query($db_conn, "INSERT INTO `comments`(`comment_name`, `comment_articleId`, `comment_text`, `comment_data`) VALUES ('$comment_name','$comment_articleId','$comment_text','$data')")){
                             echo "Dodano komentarz";
                         } else{
                             echo "Nieoczekiwany błąd serwera MySQL.";
                         }
                    }
                    else echo "niepoprawne dane";
                }
?>
    </div>

    <div id="commentsWrapper">
    <?php
            require("dbconnection.php");
            $id = $_GET['id'];
            $sql = "SELECT * FROM comments WHERE comment_articleId ='$id'";
            $query = mysqli_query($db_conn, $sql);
            if(mysqli_num_rows($query) > 0) {
                for ($i = 0; $i < mysqli_num_rows($query); $i++) {
                $record = mysqli_fetch_assoc($query);     
                echo '
                <div class="comment">
                <div class="commentInformation">
                    <div class="comentTitle">'.$record["comment_name"].'</div>
                    <div class="comentData"> '.$record["comment_data"].'</div>
                </div>
                <div class="commentText">'.$record["comment_text"].'</div>
                </div>
                ';
            }
            }
            else{
                echo '<h2 style={color:white}> No comments</h2>';
            }
        ?>
     
    </div>


    <footer class="bg-dark text-center text-white">
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            Karol Krawczynski
            <a class="btn btn-outline-light btn-floating m-1" href="https://github.com/Kakayashi" role="button"><i
                    class="fab fa-github"></i></a>
        </div>
    </footer>



</body>

</html>