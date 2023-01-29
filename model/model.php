<?php

function showAllArticle() {
    require("dbconnection.php");
    $sql = "SELECT * FROM articles";
    $query = mysqli_query($db_conn, $sql);
    $result = "";
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
         $result = $result.'
         <div class="articleObject">
            <div class="articleImageWrapper">
                <img class="articleImage" src="'.$record["article_img"].'" />
            </div>
            <h2>'.$record["article_title"].'</h2>
            <p>'.$text.'</p>
            <form action="index2.php?id='.$record["article_id"].'&action=article" method="post">
            <input hidden name="id" value="'.$record["article_id"].' " >
            <button type="submit" id="hiddenButton"><div class="articleObjectOverlay"></div></button>
            </form>
         </div>
        ';
       
        
    }
    }
    else{
        $result += '<h2 id="category"> No articles</h2>';
    }

    return $result;
}

function showCategory($cat){
        $categoty = $cat;
     
          require("dbconnection.php");
          $sql = "SELECT * FROM articles WHERE article_category = '$categoty'";
          $query = mysqli_query($db_conn, $sql);
          $result = '<div id="category">'.$categoty.':</div>';
          $result = $result.'<div id="articleWrapper">';
        
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
                  
              $result = $result.'
              <div class="articleObject">
                  <div class="articleImageWrapper">
                      <img class="articleImage" src="'.$record["article_img"].'" />
                  </div>
                  <h2>'.$record["article_title"].'</h2>
                  <p>'.$text.'</p>
                  <form action="index2.php?id='.$record["article_id"].'&action=article" method="post">
                  <input hidden name="id" value="'.$record["article_id"].' " >
                  <button type="submit" id="hiddenButton"><div class="articleObjectOverlay"></div></button>
                  </form>
               </div>
              ';
          }
          }
          return $result;
}

function showArticle($id2){
    require("dbconnection.php");
  
        $id = $id2;
        $sql = "SELECT * FROM `articles` WHERE article_id  = '$id'";
        $query_login = mysqli_query($db_conn, $sql);
        $result = "";
        if(mysqli_num_rows($query_login) > 0) {
            $record = mysqli_fetch_assoc($query_login);
            $userId = $record["article_creatorId"];
            $sqlGetUser = "SELECT * FROM `users` WHERE user_id=$userId";
            $query = mysqli_query($db_conn, $sqlGetUser);
            $user = mysqli_fetch_assoc($query);
            $views = $record["articles_views"] + 1;
            $sqlUpdate = "UPDATE articles SET articles_views='".$views."' WHERE article_id='".$id."';";
            mysqli_query($db_conn, $sqlUpdate);

        $result = $result .'
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
            <form method="POST" action="index2.php?id='.$id.'&action=addComment">
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
        </br>
        </br>
    </form>
        
        
        ';
        }
        return $result;
}

function showComments($id2){
    require("dbconnection.php");
    $id = $id2;
    $sql = "SELECT * FROM comments WHERE comment_articleId ='$id'";
    $query = mysqli_query($db_conn, $sql);
    $result = "";
    if(mysqli_num_rows($query) > 0) {
        for ($i = 0; $i < mysqli_num_rows($query); $i++) {
        $record = mysqli_fetch_assoc($query);     
        $result = $result.'
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
        $result = $result. '<h2 style={color:white}> No comments</h2>';
    }
    return $result;
}

function addComment($name,$text,$id){
    require("dbconnection.php");
    $comment_name = $name;
    $comment_text = $text;
    $comment_articleId = $id;
    $data = date("Y-m-d H-i-s");
                       
     if (mysqli_query($db_conn, "INSERT INTO `comments`(`comment_name`, `comment_articleId`, `comment_text`, `comment_data`) VALUES ('$comment_name','$comment_articleId','$comment_text','$data')")){
         return true;
        } else{
        return false;
        }
}

function sprawdzLogowanie($login, $haslo){
    require("dbconnection.php");
    $user_password = mysqli_real_escape_string($db_conn, $haslo);
    $user_login = mysqli_real_escape_string($db_conn, $login);
    $query_login = mysqli_query($db_conn, "SELECT * FROM users WHERE user_login ='$user_login'");

    if(mysqli_num_rows($query_login) > 0) {
    $record = mysqli_fetch_assoc($query_login);
    $hash = $record["user_passwordhash"];
    if (password_verify($user_password, $hash)) {
        $user_id = $record["user_id"];
        
        $_SESSION["current_user"] = $user_id;
        return true;
        //var_dump($_SESSION);
       
    }
    else{
        return false;
    }
    }
}

function zajerestruj($user_name,$user_surname,$user_login,$user_email,$user_password){
    require("dbconnection.php");
    $user_password_hash = password_hash($user_password, PASSWORD_DEFAULT);
    if (mysqli_query($db_conn, "INSERT INTO `users` (`user_name`, `user_surname`, `user_login`, `user_email`, `user_passwordhash`) VALUES ('$user_name', '$user_surname', '$user_login', '$user_email', '$user_password_hash')")){
        return true;
    } else{
        return false;
    }
}

function getUserInfo(){
    require("dbconnection.php");
    if (isset($_SESSION["current_user"])){
        $user_id = $_SESSION["current_user"];
        $query_login = mysqli_query($db_conn, "SELECT * FROM users WHERE user_id ='$user_id'");
                        $record = mysqli_fetch_assoc($query_login);
                        $result = "";

                        $result = $result. "<div class='contentItem'>Name:". $record["user_name"]. "</div>";
                        $result = $result. "<div class='contentItem'>Surname:". $record["user_surname"]. "</div>";
                        $result = $result. "<div class='contentItem'>email:". $record["user_email"]. "</div>";

                        return $result;
       
     } else {
       echo "problem";
        //header( "Location: index2.php" );
     }
}

function getUserStat(){
    require("dbconnection.php");
    if (isset($_SESSION["current_user"])){
        $user_id = $_SESSION["current_user"];
        $query = mysqli_query($db_conn, "SELECT * FROM articles WHERE article_creatorId='$user_id'");
        $result = "<div class='contentItem'>Number of articles: ". mysqli_num_rows($query). "</div>"; 
        $suma = 0;
        foreach ($query as $value){                    
            $v = $value["articles_views"];
            $suma = $suma + $v;
        }
        $result = $result. "<div class='contentItem'>Total views: ". $suma. "</div>"; 
        return $result;
        }
    }
        
function logout(){
    $_SESSION = [];
    if ( isset($_COOKIE[session_name()]) ) {
        setcookie(session_name(),'', time() - 42000, '/');
    }
    session_destroy();
}

function showList(){
    require("dbconnection.php");
    $id = $_SESSION["current_user"];
    $sqlar = "SELECT * FROM ARTICLES WHERE article_creatorId  = '$id'";
    $query = mysqli_query($db_conn, $sqlar);
    $result = "";
    if(mysqli_num_rows($query) > 0) {
        for ($i = 0; $i < mysqli_num_rows($query); $i++) {
        $record = mysqli_fetch_assoc($query);
      
     
            
            $result = $result. '
            
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
                        <form action="index2.php?action=articleEddit" method="post">
                                <input type="hidden" name="id" value="'.$record["article_id"].'">
                                <button type="submit">
                            <i class="fa-solid fa-pen-to-square fa-xl"></i>
                            </button>
                        </form>
                        </div>

                        <div class="articleListItemItem" >
                            <form action="index2.php?action=listDelete" method="post">
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
        $result = "no articles";
    }
    return $result;
}

function deleteList($id2){
    require("dbconnection.php");
        $id = $id2;
        $sql = "DELETE FROM `articles` WHERE article_id  = '$id'";
        if (mysqli_query($db_conn, $sql)){
           return "Deleted!";
          
         } else{
            return "Error connection!";
         }
      
}



function addAricle($title,$img,$category,$text,$data,$userId,$views){
    require("dbconnection.php");
    $sql = "INSERT INTO `articles` (`article_title`, `article_img`, `article_category`, `article_text`, `article_creatorId`, `article_data`, `articles_views`) VALUES ('$title', '$img', '$category', '$text', '$userId', '$data', '$views')";
    if (mysqli_query($db_conn, $sql)){
        return "Added article!";
      
     } else{
        return "Error connection";
     }
}

function editArticle($id2){
        require("dbconnection.php");
        $id = $id2;
        $sql = "SELECT * FROM `articles` WHERE article_id  = '$id'";
        $query_login = mysqli_query($db_conn, $sql);
        if(mysqli_num_rows($query_login) > 0) {
            $record = mysqli_fetch_assoc($query_login);

        $result =  '<form method="POST" action="index2.php?action=articleEddited">
            <div class="form-group">
                <label for="titleInput">Title:</label>
                <input value='.$record["article_title"].' name="title" type="text" class="form-control" id="titleInput"
                    placeholder="Enter title">
            </div>
            </br>
            <div class="form-group">
                <label for="imgInput">Image link(url):</label>
                <input value='.$record["article_img"].' name="img" type="text" class="form-control" id="imgInput" placeholder="Enter url ">
            </div>
            </br>
            <div class="form-group">
                <label for="imgInput">Category:</label>
                <select name="category" class="form-control" id="selectInput" aria-label="Default select example">
                    <option hidden value='.$record["article_category"].' selected>'.$record["article_category"].'</option>
                    <option value="technology">Technology</option>
                    <option value="sport">Sport</option>
                    <option value="news">News </option>
                    <option value="other">Other</option>
                </select>
            </div>
            </br>
            <div class="form-group">
                <label for="text">Text:</label>
                <textarea name="text" class="form-control" id="text" rows="16">
                '.$record["article_text"].'
                </textarea>
            </div>
            <input hidden  name="old_id" value='.$record["article_id"].'>
            <input hidden  name="old_views" value='.$record["articles_views"].'>
            <div id="formSubmitWrapper">
                <button type="submit" class="btn btn-secondary">Add</button>
            </div>
        </form>
        ';
        }
        return $result;
    
}



function editArticle2($title,$img,$category,$text,$data,$userId,$views,$id){
    require("dbconnection.php");
    $sql2 = "DELETE FROM `articles` WHERE article_id  = '$id'";
    mysqli_query($db_conn, $sql2);
    $sql = "INSERT INTO `articles`( `article_id`,`article_title`, `article_img`, `article_category`, `article_text`, `article_creatorId`, `article_data`, `articles_views`) 
    VALUES ('$id','$title', '$img', '$category', '$text', '$userId', '$data', $views)";
    if (mysqli_query($db_conn, $sql)){
        return true; 
      
     } else{
        return false;
     }
}

?>