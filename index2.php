<?php 
    require('model/model.php');
    session_start();
    
    $action = "";
    if(isset($_GET['action'])) {
        $action = $_GET['action'];
    } else {
        $action = '';
    }

    switch($action) {
        case 'category':
                if(isset($_GET['category'])) {
                    $category = $_GET['category'];
                    $categoryArticles = showCategory($category);
                    include('view/CategoryApp.php');
                    
                } else {
                    echo 'Error no category';
                }
                     
                //include('./view/BlogApp.php');
            break;
        case 'article':
                if(isset($_GET['id'])) {
                    
                    $id = $_GET['id'];
                    $article = showArticle($id);
                    $comments = showComments($id);
                    include('view/ArticleApp.php');
                    
                } else {
                    echo 'Error no article';
                }
                     
                //include('./view/BlogApp.php');
            break;
        case 'addComment':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $id = $_GET['id'];
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
                    $name = $input['name'];
                    $text = $input['text'];
                    $id = $_GET['id'];
                    $result = addComment($name,$text,$id);
                    if($result){
                        header('Location: index2.php?id='.$id.'&action=article');
                    }
                    else{
                        header('Location: index2.php?id='.$id.'&action=article');
                        echo "Blad polaczenia z baza sql";
                    }
                 }
                 else{
                    header('Location: index2.php?id='.$id.'&action=article');
                    echo "Zle dane dla komentarza";
                 }
            }
              
            break;
            case 'zaloguj':
                $text = "";
                include('view/ZalogujApp.php');
                     
                //include('./view/BlogApp.php');
            break;
            case 'logowanie':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $user_password = $_POST["password"];
                    $user_login = $_POST["login"];
                    $text = "";
                    $result = sprawdzLogowanie($user_login,$user_password);
                    if($result){
                        echo "udalo sie zalogowac";
                        header("Location:index2.php?action=dashboard");
                    }
                    else{
                        $text = "Niepoprawne dane";
                        include('view/ZalogujApp.php');
                    }
                }
                else{
                    echo "error zaloguj";
                }
               
            break;
            case 'rejestracja':
                $text = "";
                include('view/RejestracjaApp.php');
                     
                
            break;
            case 'zajerestruj':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $text = "";
                    $filters = array(
                    "name" => array("filter"=>FILTER_SANITIZE_STRING),
                    "surname" => array("filter"=>FILTER_SANITIZE_STRING),
                    "login" => array("filter"=>FILTER_VALIDATE_REGEXP, "options"=> ['regexp' =>'/^[a-zA-Z0-9_]{3,16}$/']),
                    "password" => array("filter"=>FILTER_SANITIZE_STRING, "options"=> ['regexp' =>'/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#$%^&*]).{8,}$/']),
                    "email" => array("filter"=>FILTER_VALIDATE_EMAIL)
                    );

                    $input = filter_input_array(INPUT_POST, $filters);
                    $errors = "";

                    foreach ($input as $key => $val) {
                    if ($val === false or $val === NULL) {
                    $errors .= $key . " ";
                    }
                    }

                    if ($errors === "") {
                        $user_name = $input["name"];
                        $user_surname = $input["surname"];
                        $user_login = $input["login"];
                        $user_email = $input["email"];
                        $user_password = $input["password"];
                       
                        $result = zajerestruj($user_name,$user_surname,$user_login,$user_email,$user_password);
                        if($result){
                            $text = "Rejestracja przebiegla pomyslnie";
                            include('view/RejestracjaApp.php');
                        }
                        else{
                            $text = "Nieoczekiwany błąd - użytkownik już istnieje lub błąd serwera MySQL.";
                            include('view/RejestracjaApp.php');
                        }
                    }
                    else {
                        $text = "Niepoprawne dane";
                        include('view/RejestracjaApp.php');
                    };
                }
            break;
            case 'dashboard':
                $info = getUserInfo();
                $stat = getUserStat();
                include('view/Dashboard.php');
                     
                
            break;
            case 'logout':
                logout();
                header("Location: index.php");
            break;
            case 'list':
                $list = showList();
                include('view/ListDashboard.php');
            break;
            case 'listDelete':
                if(isset($_POST['id'])) {
                    $id = $_POST['id'];
                    $result = deleteList($id);
                    $list = showList();
                    include('view/ListDashboard.php');
                    echo $result;
                }
                
            break;
            case 'addArticle':
                $text = "";
                
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
                        $text = addAricle($title,$img,$category,$text,$data,$userId,$views);
                         
                        
                    }
                    else{
                       $text = $errors;
                    }
                }
                include('view/AddDashboard.php');
                
            break;
            case 'articleEddit':
                if(isset($_POST['id'])) {
                    $id = $_POST['id'];
                    $edit = editArticle($id);
                    include('view/EditDashboard.php');
                }
                
            break;
            case 'articleEddited':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $filters = array(
                        "title" => array("filter"=>FILTER_VALIDATE_REGEXP, "options"=> ['regexp' =>"/^[a-zA-Z 0-9]+$/"]),
                        "img" => array("filter"=>FILTER_VALIDATE_REGEXP, "options"=> ['regexp' =>'/https?:\/\/[a-zA-Z0-9\.\/]+/']),
                        "category" =>array("filter"=>FILTER_VALIDATE_REGEXP, "options"=> ['regexp' =>"/^[a-zA-Z0-32]+$/"]),
                        "text" => array("filter"=>FILTER_VALIDATE_REGEXP, "options"=> ['regexp' =>'/^[\w\s\.\?,!\r\n]+$/']),
                        "old_id" => array("filter"=>FILTER_SANITIZE_NUMBER_INT),
                        "old_views" => array("filter"=>FILTER_SANITIZE_NUMBER_INT)
                     );
    
                     $input = filter_input_array(INPUT_POST, $filters);
                     $errors = "";
                     foreach ($input as $key => $val) {
                        if ($val === false or $val === NULL) {
                        $errors .= $key . " ";
                        }
                        }
                    if ($errors === ""){
                        $id = $input["old_id"];
                        $title = $input["title"];
                        $img = $input["img"];
                        $category = $input["category"];
                        $text = $input["text"];
                        $data = date("Y-m-d H-i-s");
                        $userId = $_SESSION["current_user"];
                        $views = $input["old_views"];
                        
                        $result =editArticle2($title,$img,$category,$text,$data,$userId,$views,$id);
                        if($result){
                            header("Location: index2.php?action=list");
                        }
                        else{
                            $text = "Error";
                            include('view/EditDashboard.php');
                        }
    
                    }
                    else{
                       $text = "Filter: $errors";
                       include('view/EditDashboard.php');
                    }
                }
                
            break;
        default:
            $allArticle = showAllArticle();
            //header("Location: view/BlogApp.php?data=s");
            include('view/BlogApp.php');
    }  