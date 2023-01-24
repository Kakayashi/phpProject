<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://kit.fontawesome.com/1e8fd6d397.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="style/style.css" />
    <link rel="stylesheet" type="text/css" href="style/login.css" />
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
                        <a class="nav-link dropdown-toggle" href="index.php" role="button" data-bs-toggle="dropdown"
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
                        <a class="nav-link active" aria-current="page" href="login.php">Zaloguj</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <div id="loginWrapper">
        <h4>Login:</h4>
        <form method="POST" action="login.php">
            <div class="form-group">
                <label for="loginInput">Login</label>
                <input name="login" type="text" class="form-control" id="loginInput" aria-describedby="loginHelp"
                    placeholder="Enter login">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                    else.</small>
            </div>
            <div class="form-group">
                <label for="inputPassword1">Password</label>
                <input name="password" type="password" class="form-control" id="inputPassword1" placeholder="Password">
            </div>
            </br>
            <a href="register.php">Sing up</a>
            <div id="formSubmitWrapper">
                <button type="submit" class="btn btn-secondary">Submit</button>
            </div>
        </form>
        <?php
          require("dbconnection.php");
 
          if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user_password = mysqli_real_escape_string($db_conn, $_POST["password"]);
            $user_login = mysqli_real_escape_string($db_conn, $_POST["login"]);
            $query_login = mysqli_query($db_conn, "SELECT * FROM users WHERE user_login ='$user_login'");

            if(mysqli_num_rows($query_login) > 0) {
            $record = mysqli_fetch_assoc($query_login);
            $hash = $record["user_passwordhash"];
            if (password_verify($user_password, $hash)) {
                $user_id = $record["user_id"];
                session_start();
                $_SESSION["current_user"] = $user_id;
                echo "Udalo sie zalogowac";
                header( "Location:dashboard.php" );
            }
            else{
                echo "</br>Niepoprawne haslo";
            }
            }
            else{
                echo "</br>Niepoprawny login";
            }

        }
?>
    </div>


    <footer class="bg-dark text-center text-white fixed-bottom">
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            Karol Krawczynski
            <a class="btn btn-outline-light btn-floating m-1" href="https://github.com/Kakayashi" role="button"><i
                    class="fab fa-github"></i></a>
        </div>
    </footer>
</body>

</html>