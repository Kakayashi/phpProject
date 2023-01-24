<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://kit.fontawesome.com/1e8fd6d397.js" crossorigin="anonymous"></script>
    <link href="style/dashboard.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <link href="style/dashboardList.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
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
                    <a href="dashboard.php"><i  class="fa-sharp fa-solid fa-circle-info fa-xl"></i></a>
                </div>
                <div class="icon">
                   <a href="dashboardList.php"> <i  id="pickedIcon" class="fa-solid fa-list fa-xl"></i></a>
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
        <div id="content2">
          <div id="dashboardListTitle">Article list:</div>
          
            <?php
               
                require("dbconnection.php");
                $id = $_SESSION["current_user"];
                $sqlar = "SELECT * FROM ARTICLES WHERE article_creatorId  = '$id'";
                $query = mysqli_query($db_conn, $sqlar);
                
                if(mysqli_num_rows($query) > 0) {
                    for ($i = 0; $i < mysqli_num_rows($query); $i++) {
                    $record = mysqli_fetch_assoc($query);
                  
                 
                        
                        echo '
                        
                        <div class="articleListItem">
                        <div id="articleListItemLeft" class="articleListItemSide" >
                            <div class="articleListItemItem">
                                    <div class="articleListItemItemTitle" >Img:</div>
                                    <img class="articleListItemImg" src="'.$record["article_img"].'" />
                            </div>
                            <div class="articleListItemItem">
                                    <div class="articleListItemItemTitle" >Title:</div>
                                    <div>'.$record["article_title"].'</div>
                            </div>
                            <div class="articleListItemItem">
                                    <div class="articleListItemItemTitle" >Id:</div>
                                    <div>'.$record["article_id"].'</div>
                            </div>
                            <div class="articleListItemItem">
                                    <div class="articleListItemItemTitle" >Data:</div>
                                    <div>'.$record["article_data"].'</div>
                            </div>
                            <div class="articleListItemItem">
                                    <div class="articleListItemItemTitle" >Views:</div>
                                    <div>'.$record["articles_views"].'</div>
                            </div>
                        </div>
        
                            <div id="articleListItemRight" class="articleListItemSide">
                                    <div class="articleListItemItem">
                                    <form action="dashboardEdit.php" method="post">
                                            <input type="hidden" name="id" value="'.$record["article_id"].'">
                                            <button type="submit">
                                        <i class="fa-solid fa-pen-to-square fa-xl"></i>
                                        </button>
                                    </form>
                                    </div>
        
                                    <div class="articleListItemItem" >
                                        <form action="dashboardList.php" method="post">
                                            <input type="hidden" name="id" value="'.$record["article_id"].'">
                                            <button type="submit">
                                            <i class="fa-solid fa-trash-can fa-xl"></i>
                                            </button>
                                        </form>
                                    </div>
                            </div>
                        </div>
                        
                        ';



                    
                     }
                }
                else{
                    echo "no articles";
                }
               
            ?>
            
           
            <div id="errors">
        <?php
        require("dbconnection.php");
        if(isset($_POST['id'])) {
            $id = $_POST['id'];
            $sql = "DELETE FROM `articles` WHERE article_id  = '$id'";
            if (mysqli_query($db_conn, $sql)){
                echo "Deleted!";
                echo "</br> Refresh to see changes.";
              
             } else{
                echo "Error connection!";
             }
          }
        ?>
        </div>
        </div>
    
</body>

</html>