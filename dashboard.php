<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://kit.fontawesome.com/1e8fd6d397.js" crossorigin="anonymous"></script>
    <link href="style/dashboard.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
</head>

<body>
    <?php
    session_start();
    if (isset($_SESSION["current_user"])){
        /* Użytkownik jest zalogowany */
       
     } else {
        /* Użytkownik nie jest zalogowany */
        header( "Location: index.php" );
     }
    ?> 
    <div id="wrapper">
        <div id="sidebar">
            </br>
            <div id="sidebarTop">
                <div class="icon">
                    <a href="dashboard.php"><i id="pickedIcon" class="fa-sharp fa-solid fa-circle-info fa-xl"></i></a>
                </div>
                <div class="icon">
                    <a href="dashboardList.php"><i  class="fa-solid fa-list fa-xl"></i></a>
                </div>
                <div class="icon">
                    <a href="dashboardCreate.php"><i class="fa-solid fa-pen-to-square fa-xl"></i></a>
                </div>
            </div>

            <div id="sidebarBottom">
                <div class="icon">
                    <a href="logout.php"><i class="fa-solid fa-right-from-bracket fa-xl"></i></a>
                </div>
            </div>

        </div>
        <div id="content">
            <div class="contentContener">
                <div class="contentContenerHeader"> Dane: </div>
                <div class="contentContenerData">

                    <?php
                        require("dbconnection.php");
                         
                        $user_id = $_SESSION["current_user"];
                        $query_login = mysqli_query($db_conn, "SELECT * FROM users WHERE user_id ='$user_id'");
                        $record = mysqli_fetch_assoc($query_login);
                       

                        echo "<div class='contentItem'>Name:". $record["user_name"]. "</div>";
                        echo "<div class='contentItem'>Surname:". $record["user_surname"]. "</div>";
                        echo "<div class='contentItem'>email:". $record["user_email"]. "</div>";
                        
                    ?>

                    
                </div>
            </div>

            <div class="contentContener">
                <div class="contentContenerHeader"> Statystyki: 
                    <?php
                        require("dbconnection.php");
                        $user_id = $_SESSION["current_user"];
                        $query = mysqli_query($db_conn, "SELECT * FROM articles WHERE article_creatorId='$user_id'");
                        echo "<div class='contentItem'>Number of articles: ". mysqli_num_rows($query). "</div>"; 
                        $suma = 0;
                        foreach ($query as $value){                    
                            $v = $value["articles_views"];
                            $suma = $suma + $v;
                        }
                        echo "<div class='contentItem'>Total views: ". $suma. "</div>"; 

                       

                        //$record = mysqli_fetch_assoc($query);
                    ?>
                </div>
            </div>

            
        </div>
    </div>
</body>

</html>