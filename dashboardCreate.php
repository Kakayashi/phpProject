<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>
    <script src="https://kit.fontawesome.com/1e8fd6d397.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
     
        <link href="style/dashboard.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
        <link href="style/dashboardCreate.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />

</head>

<body>
    <div id="wrapper">
        <?php
        session_start();
        if (isset($_SESSION["current_user"])){
            /* Użytkownik jest zalogowany */
        } else {
            /* Użytkownik nie jest zalogowany */
            header( "Location: index.php" );
        }
        ?>
        <div id="sidebar">
            </br>
            <div id="sidebarTop">
                <div class="icon">
                    <a href="dashboard.php"><i class="fa-sharp fa-solid fa-circle-info fa-xl"></i></a>
                </div>
                <div class="icon">
                    <a href="dashboardList.php">  <i  class="fa-solid fa-list fa-xl"></i> </a>
                </div>
                <div class="icon">
                    <a href="dashboardCreate.php"><i id="pickedIcon" class="fa-solid fa-pen-to-square fa-xl"></i></a>
                </div>
            </div>

            <div id="sidebarBottom">
                <div class="icon">
                    <a href="logout.php"><i class="fa-solid fa-right-from-bracket fa-xl"></i></a>
                </div>
            </div>

        </div>
        <div id="content2">

            <div class="contentContenerCreate">
                <div class="contentContenerHeader" id="contentContenerHeaderId"> Create article: </div>
                <div id="contentCreateWrapper">
                    <form method="POST" action="dashboardCreate.php">
                        <div class="form-group">
                            <label for="titleInput">Title:</label>
                            <input name="title" type="text" class="form-control" id="titleInput"
                                placeholder="Enter title">
                        </div>
                        </br>
                        <div class="form-group">
                            <label for="imgInput">Image link(url):</label>
                            <input name="img" type="text" class="form-control" id="imgInput" placeholder="Enter url ">
                        </div>
                        </br>
                        <div class="form-group">
                            <label for="imgInput">Category:</label>
                            <select name="category" class="form-control" id="selectInput" aria-label="Default select example">
                                <option selected>Select a category</option>
                                <option value="technology">Technology</option>
                                <option value="sport">Sport</option>
                                <option value="news">News </option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        </br>
                        <div class="form-group">
                            <label for="text">Text:</label>
                            <textarea name="text" class="form-control" id="text" rows="16"></textarea>
                        </div>
                        <div id="formSubmitWrapper">
                            <button type="submit" class="btn btn-secondary">Add</button>
                        </div>
                    </form>
                </div>
                <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
              
           
                require("dbconnection.php");
                $filters = array(
                    "title" => array("filter"=>FILTER_VALIDATE_REGEXP, "options"=> ['regexp' =>"/^[a-zA-Z 0-9]+$/"]),
                    "img" => array("filter"=>FILTER_VALIDATE_REGEXP, "options"=> ['regexp' =>'/https?:\/\/[a-zA-Z0-9\.\/]+/']),
                    "category" =>array("filter"=>FILTER_VALIDATE_REGEXP, "options"=> ['regexp' =>"/^[a-zA-Z0-32]+$/"]),
                    "text" => array("filter"=>FILTER_VALIDATE_REGEXP, "options"=> ['regexp' =>'/^[\w\s\.\?,!\r\n]+$/']),
                 );

                 $input = filter_input_array(INPUT_POST, $filters);
                 $errors = "";
                 foreach ($input as $key => $val) {
                    if ($val === false or $val === NULL) {
                    $errors .= $key . " ";
                    }
                    }
                if ($errors === ""){
                    $title = $input["title"];
                    $img = $input["img"];
                    $category = $input["category"];
                    $text = $input["text"];
                    $data = date("Y-m-d H-i-s");
                    $userId = $_SESSION["current_user"];
                    $views = 0;
                    $sql = "INSERT INTO `articles` (`article_title`, `article_img`, `article_category`, `article_text`, `article_creatorId`, `article_data`, `articles_views`) VALUES ('$title', '$img', '$category', '$text', '$userId', '$data', '$views')";
                    if (mysqli_query($db_conn, $sql)){
                        echo "Added article!";
                      
                     } else{
                        echo "Error connection";
                     }
                    

                }
                else{
                   echo $errors;
                }
            }
            ?>
            </div>

          

        </div>
    </div>
</body>

</html>